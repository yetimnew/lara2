<?php

namespace App\Http\Controllers\operation\Reports;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class performanceOfAllDriverController extends Controller
{

    public function index()
    {
        // $drivers = DB::table('drivers')->orderBy('name', 'ASC')->get();
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
            )
            ->leftjoin('driver_truck', 'driver_truck.id', '=', 'performances.driver_truck_id')
            ->leftjoin('drivers', 'driver_truck.driverid', '=',  'drivers.driverid')
            ->leftjoin('operations', 'operations.id', '=',  'performances.operation_id')

            ->groupBy('performances.driver_truck_id')
            ->orderBy('trip', 'DESC')
            ->orderBy('performances.DateDispach', 'DESC')
            ->limit(100)
            // ->toSql();
            ->get();
        // dd($tds);


        return view('operation.report.performance_of_all_driver.index')
            ->with('tds', $tds);
    }

    public function store(Request $request)
    {
        $start1 = $request->input('startDate');
        $start =  $start1 . ' 00:00:00';
        $end1 = $request->input('endDate');
        $end = $end1 . ' 23:59:59';
        $in_details = $request->input('in_details');
        $diff = abs(strtotime($end) - strtotime($start));
        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

        if ($end >= $start) {
            if ($in_details == 1) {
                $tds = DB::table('performances')
                    ->select(
                        'trucks.id AS truckid',
                        'driver_truck.driverid AS driverid',
                        'driver_truck.plate AS td_plate',
                        'vehecletypes.name AS model',
                        'drivers.name AS driver_name',
                        'driver_truck.is_attached AS is_attached',
                        DB::raw('SUM(performances.CargoVolumMT) as tone'),
                        DB::raw('COUNT(performances.FOnumber) as trip'),
                        // DB::raw('SUM(performances.CargoVolumMT) as CargoVolumMT'),
                        DB::raw('SUM(performances.DistanceWCargo) as TDWC'),
                        DB::raw('SUM(performances.DistanceWOCargo) as TDWOC'),
                        DB::raw('SUM(performances.tonkm) as tonkm'),
                        DB::raw('SUM(performances.fuelInLitter) as fl'),
                        DB::raw('SUM(performances.fuelInBirr) as fB'),
                        DB::raw('SUM(performances.perdiem) as perdiem'),
                        DB::raw('SUM(performances.workOnGoing) as workOnGoing'),
                        DB::raw('SUM(performances.other) as other'),
                        DB::raw('SUM(performances.tonkm * operations.tariff) as revenu'),
                    )
                    ->leftjoin('driver_truck', 'driver_truck.id', '=', 'performances.driver_truck_id')
                    ->leftjoin('drivers', 'driver_truck.driverid', '=',  'drivers.driverid')
                    ->leftjoin('trucks', 'driver_truck.truck_id', '=',  'trucks.id')
                    ->leftjoin('vehecletypes', 'vehecletypes.id', '=',  'trucks.vehecletype_id')
                    ->leftjoin('operations', 'operations.id', '=',  'performances.operation_id')
                    ->whereBetween('performances.DateDispach', [$start, $end])
                    ->groupBy('performances.driver_truck_id')
                    ->orderBy('trip', 'DESC')
                    ->get();
                // ->tosql();
                // dd($tds);
                return view('operation.report.performance_of_all_driver.create')
                    ->with('tds', $tds)
                    ->with('start', $start)
                    ->with('end', $end)
                    ->with('months', $months)
                    ->with('days', $days)
                    ->with('years', $years);
            } else {
                $tds = DB::table('performances')
                    ->select(
                        'trucks.id AS truckid',
                        'driver_truck.driverid AS driverid',
                        'driver_truck.plate AS td_plate',
                        'vehecletypes.name AS model',
                        'drivers.name AS driver_name',
                        'driver_truck.is_attached AS is_attached',
                        DB::raw('SUM(performances.CargoVolumMT) as tone'),
                        DB::raw('COUNT(performances.FOnumber) as trip'),
                        // DB::raw('SUM(performances.CargoVolumMT) as CargoVolumMT'),
                        DB::raw('SUM(performances.DistanceWCargo) as TDWC'),
                        DB::raw('SUM(performances.DistanceWOCargo) as TDWOC'),
                        DB::raw('SUM(performances.tonkm) as tonkm'),
                        DB::raw('SUM(performances.fuelInLitter) as fl'),
                        DB::raw('SUM(performances.fuelInBirr) as fB'),
                        DB::raw('SUM(performances.perdiem) as perdiem'),
                        DB::raw('SUM(performances.workOnGoing) as workOnGoing'),
                        DB::raw('SUM(performances.other) as other'),
                        DB::raw('SUM(performances.tonkm * operations.tariff) as revenu'),
                    )
                    ->leftjoin('driver_truck', 'driver_truck.id', '=', 'performances.driver_truck_id')
                    ->leftjoin('drivers', 'driver_truck.driverid', '=',  'drivers.driverid')
                    ->leftjoin('trucks', 'driver_truck.truck_id', '=',  'trucks.id')
                    ->leftjoin('vehecletypes', 'vehecletypes.id', '=',  'trucks.vehecletype_id')
                    ->leftjoin('operations', 'operations.id', '=',  'performances.operation_id')
                    ->whereBetween('performances.DateDispach', [$start, $end])
                    ->groupBy('drivers.id')
                    ->orderBy('trip', 'DESC')
                    ->get();
                // ->tosql();
                // dd($tds);
                return view('operation.report.performance_of_all_driver.create')
                    ->with('tds', $tds)
                    ->with('start', $start)
                    ->with('end', $end)
                    ->with('months', $months)
                    ->with('days', $days)
                    ->with('years', $years);
            }
        } else {

            Session::flash('info', 'Cheeck the input Date Please');
            return redirect()->route('performance_of_all_driver');
        }
    }
}
