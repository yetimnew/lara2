<?php

namespace App\Http\Controllers\operation\Reports;

use App\Truck;
use App\Driver;
use App\Performance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class performanceByOprationController extends Controller
{
    public function index()
    {

        $operationsReport = DB::table('operations')
            ->select(
                'operations.id',
                'operations.operationid',
                'customers.name',
                'operations.volume as Tone_Given',
                'operations.cargotype',
                'operations.km as tonkm',
                'operations.closed as closed',
                'operations.startdate as stratdate',
                'operations.enddate as enddate',
                'operations.status',
                'operations.tariff',
                // 'outsource_performances.CargoVolumMT',
                DB::raw('SUM(performances.CargoVolumMT) as Tone'),
                // DB::raw('SUM(outsource_performances.CargoVolumMT) as ostone'),

            )
            ->leftjoin('customers', 'operations.customer_id', '=', 'customers.id')
            ->leftjoin('performances', 'performances.operation_id', '=', 'operations.id')
            // ->leftjoin('outsource_performances', 'outsource_performances.operation_id', '=', 'operations.id')
            // ->where('operations.status','=',1)
            ->groupBy('operations.id')
            ->get();

        $osoperationsReport = DB::table('operations')
            ->select(
                'operations.id',
                'operations.operationid',
                'customers.name',
                'operations.volume as Tone_Given',
                'operations.cargotype',
                'operations.km as tonkm',
                'operations.closed as closed',
                'operations.startdate as stratdate',
                'operations.enddate as enddate',
                'operations.status',
                'operations.tariff',
                // 'outsource_performances.CargoVolumMT',
                // DB::raw('SUM(performances.CargoVolumMT) as Tone'),
                DB::raw('SUM(outsource_performances.CargoVolumMT) as ostone'),

            )
            ->leftjoin('customers', 'operations.customer_id', '=', 'customers.id')
            ->leftjoin('performances', 'performances.operation_id', '=', 'operations.id')
            ->leftjoin('outsource_performances', 'outsource_performances.operation_id', '=', 'operations.id')
            // ->where('operations.status','=',1)
            ->groupBy('operations.id')
            ->get();
        dd($osoperationsReport);
        return view('operation.report.performance_by_operation.index')
            ->with('osoperationsReport', $osoperationsReport)
            ->with('operationsReport', $operationsReport);
    }

    public function details($id)
    {

        $operationDetails = DB::table('operations')
            ->select(
                'operations.operationid',
                'customers.name',
                'operations.volume as Tone_Given',
                'operations.cargotype',
                'operations.km as tonkm',
                'operations.closed as closed',
                'operations.startdate as stratdate',
                'operations.enddate as enddate',
                'operations.status',
                'operations.tariff',
                DB::raw('SUM(performances.CargoVolumMT)as Tone'),
                DB::raw('COUNT(performances.driver_truck_id)as DriversNumber'),
                DB::raw('COUNT(performances.FOnumber) as fo'),
                DB::raw('SUM(performances.CargoVolumMT) as CargoVolumMT'),
                DB::raw('SUM(performances.DistanceWCargo) as TDWC'),
                DB::raw('SUM(performances.DistanceWOCargo) as TDWOC'),
                DB::raw('SUM(performances.tonkm) as tonkm'),
                DB::raw('SUM(performances.fuelInLitter) as fl'),
                DB::raw('SUM(performances.fuelInBirr) as fB'),
                DB::raw('SUM(performances.perdiem) as perdiem'),
                DB::raw('SUM(performances.workOnGoing) as workOnGoing'),
                DB::raw('SUM(performances.other) as other')
            )
            ->join('customers', 'operations.customer_id', '=', 'customers.id')
            ->leftjoin('performances', 'performances.operation_id', '=', 'operations.id')
            ->leftjoin('driver_truck', 'performances.driver_truck_id', '=', 'driver_truck.id')
            ->where('operations.id', '=', $id)
            ->groupBy('operations.id')
            ->get();
        return view('operation.report.performance_by_operation.details')
            ->with('operationDetails', $operationDetails);
    }

    public function store(Request $request)
    {
        $format = 'd-m-Y';
        $start1 = $request->input('startDate');
        $start =  $start1 . ' 00:00:00';

        $end1 = $request->input('endDate');
        $end = $end1 . ' 23:59:59';

        $first = Carbon::createFromDate($request->input('startDate'));
        $second = Carbon::createFromDate($request->input('endDate'));

        $date_diff = (strtotime($start) - strtotime($end));
        $diff = abs(strtotime($end) - strtotime($start));

        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

        if ($end > $start) {
            $operationsReport = DB::table('operations')
                ->select(
                    'operations.operationid',
                    'customers.name',
                    'operations.volume as Tone_Given',
                    'operations.cargotype',
                    'operations.startdate as stratdate',
                    'operations.enddate as enddate',
                    'operations.status',
                    'operations.tariff',
                    DB::raw('SUM(performances.CargoVolumMT)as Tone')
                )
                ->join('customers', 'operations.customer_id', '=', 'customers.id')
                ->leftjoin('performances', 'performances.operation_id', '=', 'operations.id')
                ->where('operations.status', '=', 1)
                ->whereBetween('operations.startdate', [$first->toDateTimeString(), $second->toDateTimeString()])
                ->groupBy('operations.id')
                ->get();
            return view('operation.report.performance_by_operation.create')
                ->with('operationsReport', $operationsReport)
                ->with('start', $start)
                ->with('end', $end)
                ->with('months', $months)
                ->with('days', $days)
                ->with('years', $years);
        } else {

            Session::flash('info', 'Cheeck the input Date Please');
            return redirect()->route('performance_by_opration');
        }
    }
}
