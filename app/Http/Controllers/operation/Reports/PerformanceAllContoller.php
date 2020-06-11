<?php

namespace App\Http\Controllers\operation\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Performance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PerformanceAllContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $performances = DB::table('performances')
            ->select(
                'performances.*',
                'performances.driver_truck_id',
                'drivers.name as dname',
                'trucks.plate as plate',
                // 'trucks.vehecletype_id as model',
                'places.name as destination',
                'vehecletypes.name as model',
                'operations.operationid as operationid',
                'operations.tariff as tariff',
            )
            ->LEFTJOIN('driver_truck', 'driver_truck.id', '=', 'performances.driver_truck_id')
            ->LEFTJOIN('operations', 'operations.id', '=', 'performances.operation_id')
            ->LEFTJOIN('drivers', 'drivers.id', '=', 'driver_truck.driver_id')
            ->LEFTJOIN('trucks', 'trucks.id', '=', 'driver_truck.truck_id')
            // ->LEFTJOIN('trucks', 'trucks.vehecletype_id', '=', 'vehecletypes.id')
            ->leftJoin('vehecletypes', 'vehecletypes.id', '=', 'trucks.vehecletype_id')
            ->JOIN('places', 'places.id', '=', 'performances.destination_id')
            // ->JOIN('places', 'places.id', '=', 'performances.orgion_id')
            ->where('driver_truck.status', 1)
            ->where('drivers.status', 1)
            ->where('trucks.status', 1)
            ->orderBy('performances.created_at', 'DESC')
            ->limit(200)
            ->get();

        return view('operation.report.performance_all.index')->with('performances', $performances);
        // return view('operation.performance.index')
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

        if ($end >= $start) {
            $performances = Performance::with('operation')->with('orgion')->with('destination')
                ->select(
                    'performances.*',
                    'performances.driver_truck_id',
                    'drivers.name as dname',
                    'trucks.plate as plate',
                    'vehecletypes.name as model',
                    'operations.operationid as operationid',
                    'operations.tariff as tariff',
                )
                ->LEFTJOIN('driver_truck', 'driver_truck.id', '=', 'performances.driver_truck_id')
                ->LEFTJOIN('operations', 'operations.id', '=', 'performances.operation_id')
                ->LEFTJOIN('drivers', 'drivers.id', '=', 'driver_truck.driver_id')
                ->LEFTJOIN('trucks', 'trucks.id', '=', 'driver_truck.truck_id')
                ->leftJoin('vehecletypes', 'vehecletypes.id', '=', 'trucks.vehecletype_id')
                ->whereBetween('performances.DateDispach', [$start, $end])
                ->orderBy('performances.DateDispach', 'DESC')
                ->get();

            // dd($performances);
            return view('operation.report.performance_all.create')
                ->with('performances', $performances)
                ->with('start', $start)
                ->with('end', $end)
                ->with('months', $months)
                ->with('days', $days)
                ->with('years', $years);
        } else {

            Session::flash('info', 'Cheeck the input Date Please');
            return redirect()->route('performanceall');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
