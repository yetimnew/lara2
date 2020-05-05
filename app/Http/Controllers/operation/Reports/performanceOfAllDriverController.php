<?php

namespace App\Http\Controllers\operation\Reports;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class performanceOfAllDriverController extends Controller
{

    public function index()
    {
        $drivers =DB::table('drivers')->orderBy('name','ASC')->get();
        $tds = DB::table('performance_by_driver_view')
        // $tds = DB::table('performance_by_driver_view')
       ->get();
       dd($tds);

        return view('operation.report.performance_of_all_driver.index')
         ->with('tds',$tds)
         ->with('drivers',$drivers);
       
    }

   
    public function store(Request $request)
    {
    $format = 'd-m-Y';
    $start = $request->input('startDate');
    $end = $request->input('endDate');

    $first = Carbon::createFromDate($request->input('startDate'));
    $second = Carbon::createFromDate($request->input('endDate'));
    $date_diff = ( strtotime( $start ) - strtotime( $end ) );
    $diff = abs( strtotime( $end ) - strtotime( $start ) );

    $years = floor( $diff / ( 365 * 60 * 60 * 24 ) );
    $months = floor( ( $diff - $years * 365 * 60 * 60 * 24 ) / ( 30 * 60 * 60 * 24 ) );
    $days = floor( ( $diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 ) / ( 60 * 60 * 24 ) );


    if ( $end > $start) {

        $tds = DB::table('performance_by_driver_view')
 
        ->whereBetween('DateDispach', [$first->toDateTimeString(), $second->toDateTimeString()])
   
       ->get();
       dd($tds);
        return view('operation.report.performance_of_all_driver.create')
        ->with('tds',$tds)
        ->with('start',$start)
        ->with('end',$end)
        ->with('months',$months)
        ->with('days',$days)
        ->with('years',$years);
    }else{
        
            Session::flash('info', 'Cheeck the input Date Please' );
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
