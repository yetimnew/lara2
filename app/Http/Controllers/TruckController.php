<?php

namespace App\Http\Controllers;

use App\Truck;
use App\Driver;
use App\DriverTuck;
use App\Vehecletype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TruckController extends Controller
{

    public function index()
    {
        $trucks = Truck::active()->orderBy('updated_at', 'DESC')->get();
        return view('operation.truck.index')->with('trucks', $trucks);
    }

    public function create()
    {
        $truck = new Truck;
        $vehcletypes = Vehecletype::all();
        if ($vehcletypes->count() == 0) {
            Session::flash('info', 'You must have some Vehecle Model before attempting to create Truck');
            return redirect()->route('vehecletype');
        }
        // Session::flash('success', 'vehecle type registerd successfuly');
        return view('operation.truck.create')
            ->with('truck', $truck)
            ->with('vehcletypes', $vehcletypes);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'plate' => 'required|unique:trucks,plate|max:20',
            'vehecle' => 'required',
            'chan' =>  'nullable|unique:trucks,chasisNumber|max:80',
            'engin' =>  'nullable|unique:trucks,engineNumber|max:80',
            'tyre' =>  'nullable|integer',
            'sik' =>  'nullable|integer',
            'price' => 'nullable|integer',
            'pdate' =>  'nullable|date',
            'ssdate' =>  'nullable|date'
        ]);

        $truck = new Truck;
        $truck->plate = $request->plate;
        $truck->vehecletype_id = $request->vehecle;
        $truck->chasisNumber = $request->chan;
        $truck->engineNumber = $request->engin;
        $truck->tyreSyze = $request->tyre;
        $truck->serviceIntervalKM = $request->sik;
        $truck->purchasePrice = $request->price;
        $truck->productionDate = $request->pdate;
        $truck->serviceStartDate = $request->ssdate;
        $truck->save();
        Session::flash('success', 'Truck  registerd successfuly');
        return redirect()->route('truck');
    }

    public function show($id)
    {
        $truck = Truck::findOrFail($id);
        return view('operation.truck.show')->with('truck', $truck);
    }

    public function edit($id)
    {
        $truck = Truck::findOrFail($id);
        $vehcletypes = Vehecletype::all();
        return view('operation.truck.edit')
            ->with('truck', $truck)
            ->with('vehcletypes', $vehcletypes);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'plate' => 'required',
            'vehecle' => 'required',
            'chan' =>  'nullable',
            'engin' =>  'nullable',
            'tyre' =>  'nullable|integer',
            'sik' =>  'nullable|integer',
            'price' => 'nullable|integer',
            'pdate' =>  'nullable|date',
            'ssdate' =>  'nullable|date'
        ]);

        $truck = Truck::findOrFail($id);
        $truck->plate = $request->plate;
        $truck->vehecletype_id = $request->vehecle;
        $truck->chasisNumber = $request->chan;
        $truck->engineNumber = $request->engin;
        $truck->tyreSyze = $request->tyre;
        $truck->serviceIntervalKM = $request->sik;
        $truck->purchasePrice = $request->price;
        $truck->productionDate = $request->pdate;
        $truck->serviceStartDate = $request->ssdate;
        $truck->save();
        Session::flash('success', 'Truck updated successfuly');
        return redirect()->route('truck');
    }


    public function destroy($id)
    {
        $truck = Truck::findOrFail($id);
        $plate =  $truck->plate;
        $td = DriverTuck::where('plate', '=', $plate)
            ->where('status', '=', 1)
            ->where('is_attached', '=', 1)
            ->first();
        if ($td) {
            $driver = Driver::where('driverid', '=', $td->driverid)->first();
            Session::flash('error', 'Not deleted ! ' . $plate . ' is attached to driver ' . $driver->name);
            return redirect()->back();
        } else {
            $truck->status = 0;
            $truck->save();
            Session::flash('success', 'vehecle  deleted successfuly');
            return redirect()->route('truck');
        }
    }
    public function deactivate($id)
    {
        $truck = Truck::findOrFail($id);
        $truck->status = 0;
        $truck->save();
        Session::flash('success', $truck->plate . ' Deactivate successfuly');
        return redirect()->back();
    }
    public function freeTrucks()
    {
        $free_trucks =   DB::table('trucks')
            ->select(
                'trucks.*',
                DB::raw('SUM(driver_truck.is_attached) as tone'),
            )
            ->leftJoin('driver_truck', 'trucks.id', '=', 'driver_truck.truck_id')
            ->where('trucks.status', '=', 1)
            ->GROUPBY('trucks.id')
            ->havingRaw('tone = 0')
            ->orHavingRaw('tone  is null')
            ->orderBy('trucks.plate')
            ->get();

        $free_drivers =   DB::table('drivers')
            ->select(
                'drivers.*',
                DB::raw('SUM(driver_truck.is_attached) as tone'),
            )
            ->leftJoin('driver_truck', 'drivers.id', '=', 'driver_truck.driver_id')
            ->where('drivers.status', '=', 1)
            ->GROUPBY('drivers.id')
            ->havingRaw('tone = 0')
            ->orHavingRaw('tone  is null')
            ->orderBy('drivers.name')
            ->get();
        // dd( $free_drivers);
        return view('operation.truck.free_trucks')
            ->with('free_trucks', $free_trucks)
            ->with('free_drivers', $free_drivers);
    }
}
