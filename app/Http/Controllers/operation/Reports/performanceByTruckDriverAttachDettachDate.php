<?php

namespace App\Http\Controllers\operation\Reports;

use App\Truck;
use App\Driver;
use App\DriverTuck;
use App\Performance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class performanceByTruckDriverAttachDettachDate extends Controller
{

    public function index()
    {
        // $dt = DriverTuck::all();
        $dt = DB::table('driver_truck')
            ->select(
                'driver_truck.id AS id',
                'driver_truck.driverid AS driverid',
                'drivers.name AS driver_name',
                'driver_truck.date_recived AS date_recived',
                'driver_truck.date_detach AS date_detach',
                'trucks.plate AS truck_plate',
                'driver_truck.is_attached AS is_attached',

            )
            ->leftjoin('drivers', 'drivers.id', '=',  'driver_truck.driver_id')
            ->leftjoin('trucks', 'trucks.id', '=',  'driver_truck.truck_id')
            ->orderBy('driver_truck.created_at', 'DESC')
            ->get();
        // dd( $dt );
        return view('operation.report.attach_detach_date.index')

            ->with('dt', $dt);
    }
}
