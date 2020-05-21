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

class PerformanceByTruckController extends Controller
{
    public function index()
    {
        $trucks = Truck::active()->orderBy('plate')->get();
        $tds = DB::table('performances')
            ->select(
                'driver_truck.driverid AS driverid',
                'driver_truck.plate AS td_plate',
                'drivers.name AS driver_name',
                'driver_truck.is_attached AS is_attached',
                DB::raw('SUM(performances.CargoVolumMT) as tone'),
                DB::raw('COUNT(performances.FOnumber) as trip'),
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
            ->leftjoin('drivers', 'driver_truck.driverid', '=',  'drivers.driverid')
            ->groupBy('performances.driver_truck_id')
            ->orderBy('trip', 'DESC')
            ->get();

        return view('operation.report.performance_by_truck.index')
            ->with('tds', $tds)
            ->with('trucks', $trucks);
    }

    public function store(Request $request)
    {
        $plate = $request->input('plate');
        $start1 = $request->input('startDate');
        $start =  $start1.' 00:00:00';

        $end1 = $request->input('endDate');
        $end = $end1.' 23:59:59';

        $first = Carbon::createFromDate($request->input('startDate'));
        $second = Carbon::createFromDate($request->input('endDate'));

        $date_diff = (strtotime($start) - strtotime($end));
        $diff = abs(strtotime($end) - strtotime($start));

        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));


        if ($end >= $start) {

            $tds = DB::table('performances')
                ->select(
                    'driver_truck.driverid AS driverid',
                    'driver_truck.plate AS td_plate',
                    'drivers.name AS driver_name',
                    'driver_truck.is_attached AS is_attached',
                    DB::raw('SUM(performances.CargoVolumMT) as tone'),
                    DB::raw('COUNT(performances.FOnumber) as trip'),
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
                ->leftjoin('drivers', 'driver_truck.driverid', '=',  'drivers.driverid')
                ->where('driver_truck.plate', '=', $plate)
                ->whereBetween('performances.DateDispach', [$first->toDateTimeString(), $second->toDateTimeString()])
                ->groupBy('performances.driver_truck_id')
                ->orderBy('trip', 'DESC')
                ->get();
            // dd($tds);

            return view('operation.report.performance_by_truck.create')
                ->with('tds', $tds)
                ->with('start', $start)
                ->with('end', $end)
                ->with('months', $months)
                ->with('days', $days)
                ->with('years', $years);
        } else {

            Session::flash('info', 'Cheeck the input Date Please');
            return redirect()->route('performance_by_truck');
        }
    }

    public function all_trucks()
    {
        $tds = DB::table('performances')
            ->select(
                'driver_truck.driverid AS driverid',
                'driver_truck.plate AS td_plate',
                'drivers.name AS driver_name',
                'driver_truck.is_attached AS is_attached',
                DB::raw('SUM(performances.CargoVolumMT) as tone'),
                DB::raw('COUNT(performances.FOnumber) as trip'),
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
            ->leftjoin('drivers', 'driver_truck.driverid', '=',  'drivers.driverid')
            ->groupBy('performances.driver_truck_id')
            ->orderBy('trip', 'DESC')
            ->get();

        return view('operation.report.performance_by_truck.alltrucks')
            ->with('tds', $tds);
    }
    public function all_trucks_by_date(Request $request)
    {
        $start = $request->input('startDate');
        $end = $request->input('endDate');

        $first = Carbon::createFromDate($request->input('startDate'));
        $second = Carbon::createFromDate($request->input('endDate'));

        $date_diff = (strtotime($start) - strtotime($end));
        $diff = abs(strtotime($end) - strtotime($start));

        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));


        if ($end >= $start) {

            $tds = DB::table('performances')
                ->select(
                    'driver_truck.driverid AS driverid',
                    'driver_truck.plate AS td_plate',
                    'drivers.name AS driver_name',
                    'driver_truck.is_attached AS is_attached',
                    DB::raw('SUM(performances.CargoVolumMT) as tone'),
                    DB::raw('COUNT(performances.FOnumber) as trip'),
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
                ->leftjoin('drivers', 'driver_truck.driverid', '=',  'drivers.driverid')
                ->whereBetween('performances.DateDispach', [$first->toDateTimeString(), $second->toDateTimeString()])
                ->groupBy('performances.driver_truck_id')
                ->orderBy('trip', 'DESC')
                ->get();

            return view('operation.report.performance_by_truck.all_trucks_by_date')
                ->with('tds', $tds)
                ->with('start', $start)
                ->with('end', $end)
                ->with('months', $months)
                ->with('days', $days)
                ->with('years', $years);
        } else {

            Session::flash('info', 'Cheeck the input Date Please');
            return redirect()->route('performance_by_truck');
        }
    }
}
