<?php

namespace App\Http\Controllers\operation\Reports;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Performance;
use Illuminate\Support\Facades\Session;

class performanceByModelController extends Controller
{
    public function index()
    {

        $performanceByModle = DB::table('performances')
            ->select(
                'vehecletypes.name AS model',
                DB::raw('SUM(performances.CargoVolumMT) as tone'),
                DB::raw('COUNT(performances.FOnumber) as trip'),
                DB::raw('COUNT(trucks.id) as nuber_of_trucks'),
                DB::raw('SUM(performances.DistanceWCargo) as TDWC'),
                DB::raw('SUM(performances.DistanceWOCargo) as TDWOC'),
                DB::raw('SUM(performances.tonkm) as tonkm'),
                DB::raw('SUM(performances.fuelInLitter) as fl'),
                DB::raw('SUM(performances.fuelInBirr) as fB'),
                DB::raw('SUM(performances.perdiem) as perdiem'),
                DB::raw('SUM(performances.workOnGoing) as workOnGoing'),
                DB::raw('SUM(performances.other) as other')
            )
            ->leftjoin('driver_truck', 'driver_truck.id', '=', 'performances.driver_truck_id')
            ->leftJoin('trucks', 'trucks.id', '=',  'driver_truck.truck_id')
            ->leftjoin('vehecletypes', 'vehecletypes.id', '=',  'trucks.vehecletype_id')
            ->groupBy('trucks.vehecletype_id')
            ->orderBy('tonkm', 'DESC')
            ->get();
        return view('operation.report.performance_by_model.index')
            ->with('performanceByModle', $performanceByModle);
    }

    public function store(Request $request)
    {
        $start1 = $request->input('startDate');
        $start =  $start1 . ' 00:00:00';

        $end1 = $request->input('endDate');
        $end = $end1 . ' 23:59:59';

        $diff = abs(strtotime($end) - strtotime($start));
        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

        if ($end > $start) {

            $tds = DB::table('performances')
                ->select(
                    'vehecletypes.name AS model',
                    DB::raw('SUM(performances.CargoVolumMT) as tone'),
                    DB::raw('COUNT(performances.FOnumber) as trip'),
                    DB::raw('COUNT(trucks.id) as nuber_of_trucks'),
                    DB::raw('SUM(performances.DistanceWCargo) as TDWC'),
                    DB::raw('SUM(performances.DistanceWOCargo) as TDWOC'),
                    DB::raw('SUM(performances.tonkm) as tonkm'),
                    DB::raw('SUM(performances.fuelInLitter) as fl'),
                    DB::raw('SUM(performances.fuelInBirr) as fB'),
                    DB::raw('SUM(performances.perdiem) as perdiem'),
                    DB::raw('SUM(performances.workOnGoing) as workOnGoing'),
                    DB::raw('SUM(performances.other) as other')
                )
                ->leftjoin('driver_truck', 'driver_truck.id', '=', 'performances.driver_truck_id')
                ->leftJoin('trucks', 'trucks.id', '=',  'driver_truck.truck_id')
                ->leftjoin('vehecletypes', 'vehecletypes.id', '=',  'trucks.vehecletype_id')
                ->whereBetween('performances.DateDispach', [$start,  $end])
                ->groupBy('trucks.vehecletype_id')
                ->orderBy('tonkm', 'DESC')
                ->get();

            return view('operation.report.performance_by_model.create')
                ->with('tds', $tds)
                ->with('start', $start)
                ->with('end', $end)
                ->with('months', $months)
                ->with('days', $days)
                ->with('years', $years);
        } else {

            Session::flash('info', 'Cheeck the input Date Please');
            return redirect()->route('performance_by_model');
        }
    }
}
