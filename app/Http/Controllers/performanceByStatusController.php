<?php

namespace App\Http\Controllers;

use App\Truck;
use App\Status;
use App\Statustype;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class performanceByStatusController extends Controller
{
    public function index()
    {
        // $average= DB::table('statuses')->select('statustype_id')->get();
        // return collect($average->map(function($value,$key){
        // return [$value];
        // }));


        $maxDate= DB::table('statuses')->MAX('registerddate');
        $newDate = Carbon::parse($maxDate)->diffForHumans();
        $maxautoid= DB::table('statuses')->MAX('autoid');
        $plate = Truck::all();
        $tds = DB::table('statuses')
        ->select('statuses.id','statuses.registerddate','statuses.autoid','statuses.plate as plate','statustypes.name'
        ,DB::raw('COUNT(statuses.plate) as number')
                )
        ->join('statustypes','statustypes.id','=','statuses.statustype_id')
       ->where('statuses.registerddate','=',$maxDate)
        ->groupBy('statustypes.name')
        ->orderBy('statuses.id','ASC')
       ->get();
       
       $tdss = DB::table('statuses')
       ->select('statuses.id','statuses.autoid','statuses.plate as targa','statustypes.name','statuses.registerddate as registerddate')
       ->join('statustypes','statustypes.id','=','statuses.statustype_id')
       ->where('statuses.autoid','=',$maxautoid)
       ->orderBy('statuses.statustype_id','ASC')
       ->get();
     
         return view('operation.report.status_by_date.index')
         ->with('tds',$tds)
         ->with('maxDate',$maxDate)
         ->with('newDate',$newDate)
         ->with('plate',$plate)
         ->with('tdss',$tdss);
 
    }

    public function create()
    {
   
    }
  
    public function store(Request $request)
    {
          
        $plate = $request->input('plate');
        $start = $request->input('startdate');
        $end = $request->input('enddate');
        
        $first = Carbon::createFromDate($request->input('startdate'));
        $second = Carbon::createFromDate($request->input('enddate'));
    
        $date_diff = ( strtotime( $start ) - strtotime( $end ) );
        $diff = abs( strtotime( $end ) - strtotime( $start ) );

    $years = floor( $diff / ( 365 * 60 * 60 * 24 ) );
    $months = floor( ( $diff - $years * 365 * 60 * 60 * 24 ) / ( 30 * 60 * 60 * 24 ) );
    $days = floor( ( $diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 ) / ( 60 * 60 * 24 ) );



//        if(isset($start)){
     


        $status_date = DB::table('statuses')
                ->select('statuses.statustype_id','statuses.plate','statuses.registerddate','statustypes.name'
                ,DB::raw('COUNT(statuses.statustype_id) as number')
                        )
                ->leftjoin('statustypes','statustypes.id','=','statuses.statustype_id')
                ->where('statuses.plate','=',$plate)
                ->whereBetween('statuses.registerddate', [$first->toDateTimeString(), $second->toDateTimeString()])
                ->groupBy('statuses.statustype_id')
                ->orderBy('number','ASC')
                ->get();
                // dd( $status_date);

        $tds = DB::table('statuses')
        ->select('statuses.id','statuses.registerddate','statuses.autoid','statuses.plate as plate','statustypes.name'
        ,DB::raw('COUNT(statuses.plate) as number')
                )
        ->join('statustypes','statustypes.id','=','statuses.statustype_id')
       ->where('statuses.registerddate','=',$start)
        ->groupBy('statustypes.name')
        ->orderBy('statuses.id','ASC')
       ->get();

        $tdss = DB::table('statuses')
        ->select('statuses.id','statuses.autoid','statuses.plate as targa','statustypes.name','statuses.registerddate as registerddate')
        ->join('statustypes','statustypes.id','=','statuses.statustype_id')
        ->where('statuses.registerddate','=',$start)
        ->orderBy('statuses.statustype_id','ASC')
        ->get();
        // dd($tdss);
        return view('operation.report.status_by_date.create')
        ->with('tds',$tds)
        ->with('status_date',$status_date)
        ->with('tdss',$tdss);


}
  
    public function view(Request $request)
    {
          
        $plate = $request->input('plate');
        $start = $request->input('startdate');
        $end = $request->input('enddate');
        
        $first = Carbon::createFromDate($request->input('startdate'));
        $second = Carbon::createFromDate($request->input('enddate'));
    
        $date_diff = ( strtotime( $start ) - strtotime( $end ) );
        $diff = abs( strtotime( $end ) - strtotime( $start ) );

        $years = floor( $diff / ( 365 * 60 * 60 * 24 ) );
        $months = floor( ( $diff - $years * 365 * 60 * 60 * 24 ) / ( 30 * 60 * 60 * 24 ) );
        $days = floor( ( $diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 ) / ( 60 * 60 * 24 ) );


        $status_date = DB::table('statuses')
                ->select('statuses.statustype_id','statuses.plate','statuses.registerddate','statustypes.name'
                ,DB::raw('COUNT(statuses.statustype_id) as number')
                // ,DB::raw('SUM(statuses.statustype_id) as total')
                        )
                ->leftjoin('statustypes','statustypes.id','=','statuses.statustype_id')
                ->where('statuses.plate','=',$plate)
                ->whereBetween('statuses.registerddate', [$first->toDateTimeString(), $second->toDateTimeString()])
                ->groupBy('statuses.statustype_id')
                ->orderBy('number','DESC')
                ->get();
        $status_summery = DB::table('statuses')
                ->select('statuses.statustype_id','statuses.plate','statuses.registerddate','statustypes.name')
                ->leftjoin('statustypes','statustypes.id','=','statuses.statustype_id')
                ->where('statuses.plate','=',$plate)
                ->whereBetween('statuses.registerddate', [$first->toDateTimeString(), $second->toDateTimeString()])
                ->orderBy('statuses.registerddate','ASC')
                ->get();
    
        return view('operation.report.status_by_date.view')
        ->with('status_date',$status_date)
        ->with('status_summery',$status_summery);

}


    
}
