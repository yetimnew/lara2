<?php

namespace App\Http\Controllers\operation\Reports;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class performanceByDriverController extends Controller
{

    public function index()
    {
        $drivers = DB::table('drivers')->where('status', 1)->orderBy('name', 'ASC')->get();
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
                DB::raw('SUM(performances.other) as other'),
                DB::raw('SUM(performances.tonkm * operations.tariff) as revenu'),
                DB::raw('SUM(performances.fuelInBirr + performances.perdiem + performances.workOnGoing + performances.other  ) as totalexpense'),
                // DB::raw('SUM(performances.fuelInBirr + performances.perdiem + performances.workOnGoing + performances.other  ) - (revenu) as profit')
            )
            ->leftjoin('driver_truck', 'driver_truck.id', '=', 'performances.driver_truck_id')
            ->leftjoin('drivers', 'driver_truck.driverid', '=',  'drivers.driverid')
            ->leftjoin('operations', 'operations.id', '=',  'performances.operation_id')
            ->groupBy('performances.driver_truck_id')
            ->orderBy('trip', 'DESC')
            ->get();
        // dd($tds);
        return view('operation.report.performance_by_driver.index')
            ->with('tds', $tds)
            ->with('drivers', $drivers);
    }

    public function store(Request $request)
    {
        $driver = $request->input('driver');
        if (!$driver) {
            Session::flash('info', 'Driver name is required');
            return redirect()->route('performance_by_driver');
        }
        $start1 = $request->input('startDate');
        $start =  $start1 . ' 00:00:00';

        $end1 = $request->input('endDate');
        $end = $end1 . ' 23:59:59';

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
                    DB::raw('SUM(performances.other) as other'),
                    // DB::raw('SUM(performances.fuelInBirr + performances.perdiem + performances.workOnGoing + performances.other  ) as totalexpense'),
                    DB::raw('SUM(performances.tonkm * operations.tariff) as revenu'),

                )
                ->leftjoin('driver_truck', 'driver_truck.id', '=', 'performances.driver_truck_id')
                ->leftjoin('drivers', 'driver_truck.driverid', '=',  'drivers.driverid')
                ->leftjoin('operations', 'operations.id', '=',  'performances.operation_id')
                ->where('driver_truck.driverid', '=', $driver)
                ->whereBetween('performances.DateDispach', [$start, $end])
                ->groupBy('performances.driver_truck_id')
                ->orderBy('trip', 'DESC')
                // ->tosql();
                ->get();

            // dd($tds);
            return view('operation.report.performance_by_driver.create')
                ->with('tds', $tds)
                ->with('start', $start)
                ->with('end', $end)
                ->with('months', $months)
                ->with('days', $days)
                ->with('years', $years);
        } else {

            Session::flash('info', 'Cheeck the input Date Please');
            return redirect()->route('performance_by_driver');
        }
    }
}
