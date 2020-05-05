<?php

namespace App\Http\Controllers;

use App\Truck;
use App\Driver;
use Carbon\Carbon;
use App\DriverTuck;
use App\Performance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TruckDriverController extends Controller
{
    public function index()
    {

        $driver_truck= DB::table('driver_truck')
        ->join('drivers','drivers.id','=','driver_truck.driver_id')
        ->join('trucks','trucks.id','=','driver_truck.truck_id')
        ->select('driver_truck.*','drivers.name as Name','drivers.driverid as DriverId','trucks.plate AS Plate')
        ->where('driver_truck.status','=',1)
        ->orderBy('driver_truck.updated_at','DESC')
        ->get();

        return view('operation.drivertruck.index')->with('driver_truck',$driver_truck);
    }

    public function create()
    {
        $truckss = Truck::all();
        $dr = Driver::all();

        if ($truckss->count() == 0) {
            Session::flash('info', 'You must have some Trukes  before attempting to create Truck' );
            return redirect()->route('truck');
        }

        if ($dr->count()== 0) {
            Session::flash('info', 'You must have some Driver  before attempting to create Truck' );
            return redirect()->route('driver');
        }
            $trucks= $this->ready_trucks();
            $drivers= $this->ready_drivers();
            
        return view('operation.drivertruck.create')
            ->with('drivers',$drivers)
            ->with('dr',$dr)
            ->with('trucks',$trucks);
    }

    public function store(Request $request)
    {
       $this->validate($request, [
        'plate' => 'required', 
        'dname' => 'required', 
        'rdate' => 'required', 
        ]);
        $plate = $request->input('plate');
        $expolde_value =   explode('|', $plate);
        $truck_id = $expolde_value[0];
        $plateex = $expolde_value[1];
        $driver = $request->input('dname');
        $expolde_name =   explode('|', $driver);
        $driver_id = $expolde_name[0];
        $driverid = $expolde_name[1];

 
        $truck_driver = DB::table('driver_truck')
        ->select('driver_truck.driver_id','driver_truck.status','driver_truck.truck_id','driver_truck.is_attached')
        ->where('driver_truck.truck_id','=',$truck_id)
        ->where('driver_truck.driver_id','=',$driver_id)
        ->where('driver_truck.status','=',1)
        ->where('driver_truck.is_attached','=',1)
        ->get();
        
        if($truck_driver->count() > 0){
           
            Session::flash('error ', 'Driver and Plate Already registered' );
            return redirect()->route('drivertruck');
        }
        $mukera =  DriverTuck::where('truck_id','=',$truck_id)->where('is_attached','=',0)->get();
        
        if(  $mukera->count() >0){
            $mukera_internal =  DriverTuck::where('truck_id','=',$truck_id)->where('is_attached','=',1)->get();
            
            if( $mukera_internal->count() > 0){
  
                    Session::flash('error ', 'Truck  Already Attached' );
                    return redirect()->route('drivertruck');
                    
                }else{
                    $dt = new DriverTuck;
                    $dt->truck_id =  $truck_id;
                    $dt->plate =  $plateex;
                    $dt->driver_id = $driver_id;
                    $dt->driverid = $driverid;
                    $dt->date_recived = $request->rdate;
                    $dt->status = 1;
                    $dt->is_attached = 1;
                    $dt->save();
                    Session::flash('success', 'Truck and Driver Assiegned successfuly' );
                    return redirect()->route('drivertruck');
                }
            }else{
                $mukera2 =  DriverTuck::where('driver_id','=',$driver_id)->where('is_attached','=',0)->get();

                if(  $mukera2->count() >0){
                  $mukera_internal2 =  DriverTuck::where('driver_id','=',$driver_id)->where('is_attached','=',1)->get();
          
                  if( $mukera_internal2->count() > 0){
                      //  dd(" shuferu gin lela mekina yizwal ena tithew weta");
                          Session::flash('error ', 'Truck  Already Attached' );
                          return redirect()->route('drivertruck');
                          
                      }else{
                          $dt = new DriverTuck;
                          $dt->truck_id =  $truck_id;
                          $dt->plate =  $plateex;
                          $dt->driver_id = $driver_id;
                          $dt->driverid = $driverid;
                          $dt->date_recived = $request->rdate;
                          $dt->status = 1;
                          $dt->is_attached = 1;
                          $dt->save();
                          Session::flash('success', 'Truck and Driver Assiegned successfuly' );
                          return redirect()->route('drivertruck');
                      }
                  }else{
                    $dt = new DriverTuck;
                    $dt->truck_id =  $truck_id;
                    $dt->plate =  $plateex;
                    $dt->driver_id = $driver_id;
                    $dt->driverid = $driverid;
                    $dt->date_recived = $request->rdate;
                    $dt->status = 1;
                    $dt->is_attached = 1;
                    $dt->save();
                    Session::flash('success', 'Truck and Driver Assiegned successfuly' );
                    return redirect()->route('drivertruck');
                  } 
            }
   

    }
    
    public function show($id)
    {

        $td = DriverTuck::where('id','=',$id)->first();
        // dd($td);
         $start =  Carbon::parse($td->date_detach);
        $end  =  Carbon::parse($td->date_recived);
        $difinday = $end->diffInDays($start);
        $diffinhour = $end->diffInHours($start);

        $driver =DB::table('drivers')
        ->where('drivers.id','=',$td->driver_id) 
        ->first();

         return view('operation.drivertruck.show')
        ->with('td',$td)
        ->with('difinday',$difinday)
        ->with('diffinhour',$diffinhour)
         ->with('driver',$driver);
    }

    public function edit($id)
    {
        // dd($id);
      
        $dts= DB::table('driver_truck')
        ->select('driver_truck.*','drivers.name as NAME')
        ->leftjoin('drivers','drivers.id','=','driver_truck.driver_id')
        ->where('driver_truck.id','=',$id) 
        ->first();
// dd($dts);
         $trucks= $this->ready_trucks();
         $drivers=  $this->ready_drivers();
        return view('operation.drivertruck.edit')
        ->with('dts',$dts)
        ->with('trucks',$trucks)
        ->with('drivers', $drivers);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $this->validate($request, [
            'plate' => 'required',
            'dname' => 'required',
            'rdate' => 'required'
              ]);
              $plate = $request->input('plate');
              $expolde_value =   explode('|', $plate);
              $truck_id = $expolde_value[0];
              $plateex = $expolde_value[1];
              $driver = $request->input('dname');
              $expolde_name =   explode('|', $driver);
              $driver_id = $expolde_name[0];
              $driverid = $expolde_name[1];
    
           
        $truck_driver = DB::table('driver_truck')
        ->select('driver_truck.driver_id','driver_truck.status','driver_truck.truck_id','driver_truck.is_attached')
        ->where('driver_truck.truck_id','=',$truck_id)
        ->where('driver_truck.driver_id','=',$driver_id)
        ->where('driver_truck.status','=',1)
        ->where('driver_truck.is_attached','=',1)
        ->get();
        
        if($truck_driver->count() > 0){
           
            Session::flash('error ', 'Driver and Plate Already registered' );
            return redirect()->route('drivertruck');
        }
        $mukera =  DriverTuck::where('truck_id','=',$truck_id)->where('is_attached','=',0)->get();
        
        if(  $mukera->count() >0){
            $mukera_internal =  DriverTuck::where('truck_id','=',$truck_id)->where('is_attached','=',1)->get();
            
            if( $mukera_internal->count() > 0){
  
                    Session::flash('error ', 'Truck  Already Attached' );
                    return redirect()->route('drivertruck');
                    
                }else{
                    $dt = DriverTuck::findorFail($id);
                    $dt->truck_id =  $truck_id;
                    $dt->plate =  $plateex;
                    $dt->driver_id = $driver_id;
                    $dt->driverid = $driverid;
                    $dt->date_recived = $request->rdate;
                    $dt->status = 1;
                    $dt->is_attached = 1;
                    $dt->save();
                    Session::flash('success', 'Truck and Driver Assiegned successfuly' );
                    return redirect()->route('drivertruck');
                }
            }else{
                $mukera2 =  DriverTuck::where('driver_id','=',$driver_id)->where('is_attached','=',0)->get();

                if(  $mukera2->count() >0){
                  $mukera_internal2 =  DriverTuck::where('driver_id','=',$driver_id)->where('is_attached','=',1)->get();
          
                  if( $mukera_internal2->count() > 0){
                      //  dd(" shuferu gin lela mekina yizwal ena tithew weta");
                          Session::flash('error ', 'Truck  Already Attached' );
                          return redirect()->route('drivertruck');
                          
                      }else{
                        $dt = DriverTuck::findorFail($id);
                          $dt->truck_id =  $truck_id;
                          $dt->plate =  $plateex;
                          $dt->driver_id = $driver_id;
                          $dt->driverid = $driverid;
                          $dt->date_recived = $request->rdate;
                          $dt->status = 1;
                          $dt->is_attached = 1;
                          $dt->save();
                          Session::flash('success', 'Truck and Driver Assiegned successfuly' );
                          return redirect()->route('drivertruck');
                      }
                  }else{
                    $dt = DriverTuck::findorFail($id);
                    $dt->truck_id =  $truck_id;
                    $dt->plate =  $plateex;
                    $dt->driver_id = $driver_id;
                    $dt->driverid = $driverid;
                    $dt->date_recived = $request->rdate;
                    $dt->status = 1;
                    $dt->is_attached = 1;
                    $dt->save();
                    Session::flash('success', 'Truck and Driver Assiegned successfuly' );
                    return redirect()->route('drivertruck');
                  } 
            }
    }

   
    public function destroy($id)
    {
        $dt = DriverTuck::findorFail($id);
        $performance =  Performance::where('driver_truck_id','=', $dt->id)->first();
        if(isset($performance)){
                  
        Session::flash('error', 'There are records by this driver ' );
        return redirect()->route('drivertruck');
        }else{

            $dt->delete();
            Session::flash('success', 'Vehecle and Driver deleted successfuly' );
            return redirect()->route('drivertruck');
        }


    }
    public function detach($id)
    {
        $dts= DB::table('driver_truck')
        ->select('driver_truck.*','drivers.name as NAME')
        ->join('drivers','drivers.id','=','driver_truck.driver_id')
        ->where('driver_truck.id','=',$id) 
        ->first();
        // dd( $dts);
        return view('operation.drivertruck.detach')->with('dts',$dts);
    }
    
    public function update_dt(Request $request, $id)
    {
        // dd($request->all());
            $this->validate($request, [
            'rdate' => 'required',
            'ddate' => 'required|date|after:rdate'
              ]);
    
              $plate = $request->input('plate');
              $expolde_value =   explode('|', $plate);
              $truck_id = $expolde_value[0];
              $plateex = $expolde_value[1];
              $driver = $request->input('dname');
              $expolde_name =   explode('|', $driver);
              $driver_id = $expolde_name[0];
              $driverid = $expolde_name[1];

            $dt = DriverTuck::findOrFail($id);
           
            $dt->driver_id = $driver_id;
            $dt->truck_id =  $truck_id;
            $dt->driverid = $driverid;
            $dt->plate =  $plateex;
            $dt->date_recived = $request->rdate;
            $dt->date_detach = $request->ddate;
            $dt->reason = $request->comment;
            $dt->is_attached = 0;
            $dt->save();
            Session::flash('success', 'Truck and Driver Detached successfuly' );
           return redirect()->route('drivertruck');
    }
    public function ready_trucks()
    {
        $trucks=  DB::table('trucks')
            ->select('trucks.id','trucks.plate','driver_truck.driver_id','trucks.status','driver_truck.status','driver_truck.is_attached')
            ->leftjoin('driver_truck','driver_truck.truck_id','=','trucks.id')
            ->whereNull('driver_truck.status')
            ->orwhere('driver_truck.status','=',1) 
            ->whereNull('driver_truck.is_attached')
            ->orwhere('driver_truck.is_attached','=',0) 
            ->where('trucks.status','=',1) 
            ->groupBy('trucks.plate')
            ->orderBy('trucks.plate')
            // ->tosql();
            ->get();
            return $trucks;
    }
    public function ready_drivers()
    {
       $drivers =  DB::table('drivers')
        ->select('drivers.id','drivers.driverid as driverID','drivers.name','driver_truck.id as DTID'
        ,'drivers.status','driver_truck.status')
        ->leftjoin('driver_truck','driver_truck.driver_id','=','drivers.id')
        ->whereNull('driver_truck.status')
         ->orwhere('driver_truck.status','=',0) 
         ->whereNull('driver_truck.is_attached')
         ->orwhere('driver_truck.is_attached','=',0) 
         ->where('drivers.status','=',1) 
         ->groupBy('drivers.name')
         ->orderBy('drivers.name','asc')
         ->get();
         return $drivers;
    }

}
