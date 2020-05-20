<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Distance;
use App\Notifications\PerformanceCreated;
use App\Operation;
use App\Outsource;
use App\Outsource_performance;
use App\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OutsourcePerformanceController extends Controller
{
    public function index()
    {

        $osperformances =  Outsource_performance::orderBy('created_at', 'DESC')->get();

        return view('operation.osperformance.index')
            ->with('osperformances', $osperformances);
    }

    public function create()
    {
        $osperformance = new  Outsource_performance;
        $operations =  Operation::active()->where('closed', '=', 1)->get();
        $place = Place::active()->orderBy('name')->get();
        $cusotmers = Outsource::active()->orderBy('name')->get();

        if ($place->count() < 2) {
            Session::flash('info', 'You must have two or more Place before attempting to create Performance');
            return redirect()->route('place.create');
        }


        if ($operations->count() == 0) {
            Session::flash('info', 'You must have some Operation  before attempting to create Performance');
            return redirect()->route('operation.create');
        }


        return view('operation.osperformance.create')
            ->with('cusotmers', $cusotmers)
            ->with('osperformance', $osperformance)
            ->with('operations', $operations)
            ->with('place', $place);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'trip' => 'required',
            'chinet' => 'required',
            'custormer' => 'required',
            'fo' => 'required|unique:outsource_performances,fonumber',
            'operation' => 'required',
            'driver_name' => 'required',
            'plate_number' => 'required',
            'ddate' => 'required|date',
            'cargovol' => 'required|numeric',
            'tariff' => 'required|numeric',
            'origion' => 'nullable',
            'destination' => 'different:origion',
            'diswc' => 'nullable|numeric',
            'diswoc' => 'nullable|numeric',
            'tonkm' => 'required|numeric',
            'comment' => '',

        ]);

        // dd($request->all());
        $osperformance = new Outsource_performance;
        $osperformance->trip = $request->trip;
        $osperformance->LoadType = $request->chinet;
        $osperformance->outsource_id = $request->custormer;
        $osperformance->FOnumber = $request->fo;
        $osperformance->operation_id = $request->operation;
        $osperformance->driver_name = $request->driver_name;
        $osperformance->plate_number = $request->plate_number;
        $osperformance->DateDispach = $request->ddate;
        $osperformance->orgion_id = $request->origion;
        $osperformance->destination_id = $request->destination;
        $osperformance->DistanceWCargo = $request->diswc;
        $osperformance->DistanceWOCargo = $request->diswoc;
        $osperformance->tonkm = $request->tonkm;
        $osperformance->CargoVolumMT = $request->cargovol;
        $osperformance->tariff = $request->tariff;
        $osperformance->comment = $request->comment;
        $osperformance->user_id = Auth::user()->id;

        // dd($osperformance);

        $osperformance->save();
        auth()->user()->notify(new PerformanceCreated);

        Session::flash('success', 'Performance  registerd successfuly');
        return redirect()->route('osperformance');
    }


    public function show($id)
    {
        $osperformance = Outsource_performance::findOrFail($id);

        $operations = Operation::active()->get();
        // dd( $driver_detail);
        return view('operation.osperformance.show')
            ->with('osperformance', $osperformance)
            ->with('operations', $operations);
    }

    public function edit($id)
    {

        $osperformance = Outsource_performance::findOrFail($id);
        $operations =  Operation::active()->where('closed', '=', 1)->get();
        $place = Place::active()->orderBy('name')->get();
        $cusotmers = Outsource::active()->orderBy('name')->get();
        return view('operation.osperformance.edit')
            ->with('osperformance', $osperformance)
            ->with('operations', $operations)
            ->with('cusotmers', $cusotmers)
            ->with('place', $place);
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [

            'trip' => 'required',
            'chinet' => 'required',
            'custormer' => 'required',
            'fo' => 'required',
            'operation' => 'required',
            'driver_name' => 'required',
            'plate_number' => 'required',
            'ddate' => 'required|date',
            'cargovol' => 'required',
            'tariff' => 'required',
            'origion' => 'nullable',
            'destination' => 'different:origion',
            'diswc' => 'nullable|numeric',
            'diswoc' => 'nullable|numeric',
            'tonkm' => 'required|numeric',
            'comment' => '',

        ]);

        $osperformance = Outsource_performance::findOrFail($id);
        $osperformance->trip = $request->trip;
        $osperformance->LoadType = $request->chinet;
        $osperformance->outsource_id = $request->custormer;
        $osperformance->FOnumber = $request->fo;
        $osperformance->operation_id = $request->operation;
        $osperformance->driver_name = $request->driver_name;
        $osperformance->plate_number = $request->plate_number;
        $osperformance->DateDispach = $request->ddate;
        $osperformance->orgion_id = $request->origion;
        $osperformance->destination_id = $request->destination;
        $osperformance->DistanceWCargo = $request->diswc;
        $osperformance->DistanceWOCargo = $request->diswoc;
        $osperformance->tonkm = $request->tonkm;
        $osperformance->CargoVolumMT = $request->cargovol;
        $osperformance->tariff = $request->tariff;
        $osperformance->comment = $request->comment;
        $osperformance->user_id = Auth::user()->id;
        $osperformance->save();
        Session::flash('success', 'Fo  Number ' . $osperformance->fonumber . ' updated successfuly');
        return redirect()->route('osperformance.show', ['id' => $osperformance->id]);
    }

    public function destroy($id)
    {
        $osperformance = Outsource_performance::findOrFail($id);
        $osperformance->delete();
        Session::flash('success', 'Performance deleted successfuly');
        return redirect()->route('osperformance');
    }


    // ajax request
    public function ajaxRequest()

    {

        return view('operation.performance.index');
    }


    public function ajaxRequestPost(Request $request)

    {
        $data = $request->all();
        $origion = $request->origion;
        $destination = $request->destination;

        $distance = Distance::where('origin_id', '=', $origion)
            ->where('destination_id', '=', $destination)
            ->pluck('km')
            ->first();

        if (!$distance) {
            $distance = Distance::where('origin_id', '=', $destination)
                ->where('destination_id', '=', $origion)
                ->pluck('km')
                ->first();
            if (!$distance) {
                $distance = 0;
                return $distance;
            }
            return $distance;
        }
        return $distance;
    }
}
