<?php

namespace App\Http\Controllers\operation\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Outsource;
use App\Outsource_performance;
use Illuminate\Contracts\Session\Session;

class OutsourcePerformanceReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $osperformances =  Outsource_performance::with('operation')->with('orgion')->with('destination')->get();
        $oursources = Outsource::all();
        return view('operation.report.performance_by_outsource.index')
            ->with('oursources', $oursources)
            ->with('osperformances', $osperformances);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // $driver = $request->input('customer');
        $driver = $request->input('customer');
        $oscustomername = Outsource::where('id', '=', $driver)->pluck('name');
        $start1 = $request->input('startDate');
        $start =  $start1 . ' 00:00:00';

        $end1 = $request->input('endDate');
        $end = $end1 . ' 23:59:59';

        $diff = abs(strtotime($end) - strtotime($start));

        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        if ($end >= $start) {
            if ($driver == -1) {
                $osperformances =  Outsource_performance::with('operation')->with('orgion')->with('destination')
                    ->whereBetween('DateDispach', [$start, $end])
                    ->orderBy('DateDispach')
                    ->get();
                // dd( $osperformances);
                return view('operation.report.performance_by_outsource.create')
                    ->with('osperformances', $osperformances)
                    ->with('start', $start)
                    ->with('end', $end)
                    ->with('months', $months)
                    ->with('days', $days)
                    ->with('years', $years)
                    ->with('oscustomername', $oscustomername);
            } else {
                $osperformances =  Outsource_performance::with('operation')->with('orgion')->with('destination')
                    ->where('outsource_id', '=', $driver)
                    ->whereBetween('DateDispach', [$start, $end])
                    ->orderBy('DateDispach')
                    ->get();
                // dd( $osperformances);
                return view('operation.report.performance_by_outsource.create')
                    ->with('osperformances', $osperformances)
                    ->with('start', $start)
                    ->with('end', $end)
                    ->with('months', $months)
                    ->with('days', $days)
                    ->with('years', $years)
                    ->with('oscustomername', $oscustomername);
            }
        } else {

            Session::flash('info', 'Cheeck the input Date Please');
            return redirect()->route('performance_by_driver');
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
