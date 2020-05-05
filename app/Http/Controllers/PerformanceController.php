<?php
namespace App\Http\Controllers;

use App\Place;
use App\Truck;
use App\Driver;
use App\Distance;
use App\Operation;
use Carbon\Carbon;
use App\DriverTuck;
use App\Performance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Notifications\PerformanceCreated;
use App\Http\Requests\PerformanceCreateRequest;
use App\Http\Requests\PerformanceUpdateRequest;

class PerformanceController extends Controller
{ 
    public function index()
    {
        $performances =  DB::table('performances')
        ->select('performances.*', 'performances.driver_truck_id','drivers.name as dname','trucks.plate as plate','places.name as orgion')
        ->LEFTJOIN('driver_truck','driver_truck.id','=','performances.driver_truck_id')
        ->LEFTJOIN('drivers','drivers.id','=','driver_truck.driver_id')
        ->LEFTJOIN('trucks','trucks.id','=','driver_truck.truck_id')
        ->JOIN('places','places.id','=','performances.orgion_id')
        ->where('driver_truck.status',1)
        ->where('drivers.status',1)
        ->where('trucks.status',1)
        ->orderBy('performances.created_at','DESC')
        ->get();
//    dd($performances);
        $statuslist= $this->statusList();
        $trucks = Truck::all();
        $drivers = Driver::all();
    
          return view('operation.performance.index')
        ->with('performances',$performances)
        ->with('trucks',$trucks)
        ->with('statuslist',$statuslist)
        ->with('drivers',$drivers);
     }
  
    public function create()
    {
        $performance = new  Performance;
        $operations=  Operation::active()->where('closed','=',1)->get();
        $place = Place::active()->orderBy('name')->get();
        $trucks = Truck::active()->get();

        $driver_truck = DB::table('driver_truck')
        ->select('driver_truck.id','driver_truck.driverid', 'driver_truck.plate', 
      'driver_truck.status','driver_truck.is_attached','drivers.name')
        ->LEFTJOIN('drivers','drivers.id','=','driver_truck.driver_id')
        ->where('driver_truck.is_attached',1)
        ->get();
  
    
       if($place->count() < 2){
           Session::flash('info', 'You must have two or more Place before attempting to create Performance' );
           return redirect()->route('place.create');
       }

        if($trucks->count() == 0){
            Session::flash('info', 'You must have some Truck  before attempting to create Performance' );
            return redirect()->route('drivertruck.create');
        }
        
         if($operations->count() == 0){
            Session::flash('info', 'You must have some Operation  before attempting to create Performance' );
            return redirect()->route('operation.create');
        }
        
        
     return view('operation.performance.create')
     ->with('operations',$operations)
     ->with('trucks',$trucks)
     ->with('performance',$performance)
     ->with('driver_truck',$driver_truck)
     ->with('place',$place);
    }

    public function store(PerformanceCreateRequest $request)
    {
     
         $performance = new Performance;
         $performance->trip = $request->trip ;
         $performance->LoadType = $request->chinet ;
         $performance->FOnumber = $request->fo;
         $performance->operation_id = $request->operation ;
         $performance->driver_truck_id = $request->truck ;
         $performance->DateDispach = $request->ddate ;
         $performance->orgion_id = $request->origion ;
         $performance->destination_id = $request->destination ;
         $performance->DistanceWCargo = $request->diswc;
         $performance->DistanceWOCargo = $request->diswoc ;
         $performance->tonkm = $request->tonkm ;
         $performance->CargoVolumMT = $request->cargovol ;
        //  $performance->tonkm = (($request->diswc ) * ($request->cargovol)) ;
         $performance->fuelInLitter = $request->fuell ;
         $performance->fuelInBirr = $request->fuelb ;
         $performance->perdiem = $request->perdiem ;
         $performance->workOnGoing = $request->wog ;
         $performance->other = $request->other ;
         $performance->comment = $request->comment ;
         $performance->user_id = Auth::user()->id ;

        $performance->save();
     auth()->user()->notify( new PerformanceCreated);

        Session::flash('success', 'Performance  registerd successfuly' );
        return redirect()->route('performace');
    }
 

    public function show($id)
    {
        $performance = Performance::findOrFail($id);
        $start =  Carbon::parse($performance->DateDispach);
        $end  =  Carbon::parse($performance->returned_date);
        $difinday = $end->diffInDays($start);
        $diffinhour = $end->diffInHours($start);


        $operations = Operation::active()->get();     
        $driver_detail =  DB::table('driver_truck')
        ->select('driver_truck.id','driver_truck.driverid', 'driver_truck.plate', 
        'driver_truck.date_recived', 'driver_truck.status','drivers.name')
        ->LEFTJOIN('drivers','drivers.driverid','=','driver_truck.driverid')
       ->where('driver_truck.id', '=', $performance->driver_truck_id )
        ->get();
        // dd( $driver_detail);
        return view('operation.performance.show')
        ->with('performance',$performance)
        ->with('operations',$operations)
        ->with('difinday',$difinday)
        ->with('diffinhour',$diffinhour)
        ->with('driver_detail',$driver_detail);
    }

    public function edit($id)
    {
 
        $performance = Performance::findOrFail($id);
        $operations=  Operation::active()->get();
        $place = Place::active()->get();
        $trucks = Truck::active()->get();

        $driver_truck = DB::table('driver_truck')
        ->select('driver_truck.id','driver_truck.driverid', 'driver_truck.plate', 
      'driver_truck.status','driver_truck.is_attached','drivers.name')
        ->LEFTJOIN('drivers','drivers.id','=','driver_truck.driver_id')
        ->where('driver_truck.is_attached',1)
        ->get();

        return view('operation.performance.edit')
        ->with('performance',$performance)
        ->with('operations',$operations)
        ->with('place',$place)
        ->with('driver_truck',$driver_truck)
        ->with('trucks',$trucks);
        // ->with('drivers',$drivers);
       
    }

    public function update(PerformanceUpdateRequest $request, $id)
    {

  
            $performance = Performance::findOrFail($id);
            $performance->trip = $request->trip ;
            $performance->LoadType = $request->chinet ;
            $performance->FOnumber = $request->fo;
            $performance->operation_id = $request->operation ;
            $performance->driver_truck_id = $request->truck ;
            $performance->DateDispach = $request->ddate ;
            $performance->orgion_id = $request->origion ;
            $performance->destination_id = $request->destination ;
            $performance->DistanceWCargo = $request->diswc;
            $performance->DistanceWOCargo = $request->diswoc ;
            $performance->tonkm = $request->tonkm ;
            $performance->CargoVolumMT = $request->cargovol ;
            $performance->fuelInLitter = $request->fuell ;
            $performance->fuelInBirr = $request->fuelb ;
            $performance->perdiem = $request->perdiem ;
            $performance->workOnGoing = $request->wog ;
            $performance->other = $request->other ;
            $performance->comment = $request->comment ;
            $performance->is_returned = $request->returned ;
            $performance->returned_date = $request->r_date ;
            $performance->save();
            Session::flash('success', 'Fo  Number '.$performance->FOnumber . ' updated successfuly' );
            return redirect()->route('performace.show',['id'=>$performance->id]);
    }

    public function destroy($id)
    {
        $performance = Performance::findOrFail($id);
        $performance->delete();
        Session::flash('success', 'Performance deleted successfuly' );
        return redirect()->route('performace');

    }
    public function statusList()
    {
        return [
            'All' => Performance::active()->count(),
            'Returned' => Performance::returned()->count(),
            'Not returned' => Performance::notreturned()->count(),
        ];
    }
    public function driver_truck()
    {
        $trucks =  DB::table('driver_truck')
        ->select('driver_truck.id','driver_truck.driverid',
         'driver_truck.plate', 'driver_truck.date_recived', 
         'driver_truck.status','drivers.name')
        ->LEFTJOIN('drivers','drivers.driverid','=','driver_truck.driverid')
        ->get();
        return $trucks;
    }

    // ajax request
    public function ajaxRequest()

    {

        return view('operation.performance.index');

    }


    public function ajaxRequestPost(Request $request)

    {
        $data = $request->all();
        $origion = $request->origion ;
        $destination = $request->destination;

        $distance = Distance::where('origin_id','=',$origion)
        ->where('destination_id','=',$destination)
        ->pluck('km')
        ->first();
       

        if (!$distance) {
            $distance = Distance::where('origin_id','=',$destination)
            ->where('destination_id','=',$origion)
            ->pluck('km')
            ->first();
            if(!$distance){
                $distance = 0;
                return $distance;
            }
            return $distance;
        }
        return $distance;

    }
    public function driverNameAndPlate(Type $var = null)
    {
        $trucks =  DB::table('driver_truck')
        ->select('driver_truck.id','driver_truck.driver_id', 'driver_truck.truck_id', 'driver_truck.date_recived',
         'driver_truck.status','drivers.name','trucks.plate')
        ->LEFTJOIN('drivers','drivers.id','=','driver_truck.driver_id')
        ->LEFTJOIN('trucks','trucks.id','=','driver_truck.truck_id')
        ->where('driver_truck.status',1)
        ->where('driver_truck.is_attached',1)
        ->where('drivers.status',1)
        ->where('trucks.status',1)
        ->get();
        return $trucks;

    }


}
