<?php

namespace App\Http\Controllers\operation\Reports;

use App\Truck;
use App\Status;
use App\Statustype;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class performanceByStatusController extends Controller
{
    public function index()
    {

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
//        $allStatus= Status::all();
//        $platenew = Truck::where('status','=',1)->pluck('plate');
// $val = '';
//        foreach( $allStatus as $i){

//                 foreach($platenew as $pl){
//                         $st= Status::where('plate','=', $pl);


//                 }
//                 dd( $st);
//        }


//        dd( $platenew);
         return view('operation.report.status_by_date.index')
         ->with('tds',$tds)
         ->with('maxDate',$maxDate)
         ->with('newDate',$newDate)
         ->with('plate',$plate)
         ->with('tdss',$tdss);


    }

    public function store(Request $request)
    {

        $plate = $request->input('plate');
        $start1 = $request->input('startDate');
        $start =  $start1.' 00:00:00';

        $end1 = $request->input('endDate');
        $end = $end1.' 23:59:59';

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
        $plate = Truck::active()->get()->pluck('plate');
        $statuses = Status::get();
        // $arr = array();
        //  foreach( $statuses as $st){
        //         $arr = DB::table('statuses')
        //         ->select('statuses.statustype_id','statuses.plate','statuses.registerddate','statustypes.name')
        //         ->leftjoin('statustypes','statustypes.id','=','statuses.statustype_id')
        //         ->where('statuses.plate','=',$st->plate)
        //         // ->whereBetween('statuses.registerddate', [$first->toDateTimeString(), $second->toDateTimeString()])
        //         ->orderBy('statuses.registerddate','ASC')
        //         ->get();

        // }
        // dd($arr);

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


public function show(Request $request)

{
        dd($request->all());
        $status_date =DB::table('statuses')->select('plate','statustype_id')->get();

        foreach ($status_date as  $value) {
             $internal=    DB::table('statuses')->select('plate','statustype_id')->count('statustype_id')
                ->groupBy('plate')
                ->get();
                // echo $value->plate;
                dd($internal);
        }

        return view('operation.report.status_by_date.show');


}
public function mukera()
{
 $summery = array();
 $status = Status::all();
//  dd($status);
 foreach ($status as $st ) {
// echo $st->plate;
         array_push($summery, Statustype::find($st->id));
         return $summery;
 }
}

}
