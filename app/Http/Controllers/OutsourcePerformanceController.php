<?php

namespace App\Http\Controllers;

use App\Distance;
use App\Notifications\PerformanceCreated;
use App\Operation;
use App\Outsource;
use App\Outsource_performance;
use App\Performance;
use App\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class OutsourcePerformanceController extends Controller
{
    public function index(Request  $request)
    {
        if ($request->ajax()) {
            $osperformances = DB::table('outsource_performances')
                ->select(
                    'outsource_performances.id as id',
                    'outsources.name as osname',
                    'operations.operationid as operationid',
                    'outsource_performances.FOnumber as fo',
                    'outsource_performances.DateDispach as ddate',
                    'outsource_performances.plate_number as plate',
                    'places.name as orgion',
                    'outsource_performances.tonkm as tonkm',
                    'outsource_performances.CargoVolumMT as tone',
                    'outsource_performances.trip as trip'
                )
                ->JOIN('places', 'places.id', '=', 'outsource_performances.destination_id')
                ->JOIN('operations', 'operations.id', '=', 'outsource_performances.operation_id')
                ->JOIN('outsources', 'outsources.id', '=', 'outsource_performances.outsource_id')
                ->orderBy('outsource_performances.created_at', 'DESC')
                ->get();

            return DataTables::of($osperformances)
                ->addColumn('details', function ($osperformances) {
                    $button = '<a href="' . route('osperformance.show', $osperformances->id) . '"> <i class="fa fa-edit"></a>';
                    return $button;
                })->editColumn('tone', function ($data) {
                    return number_format($data->tone, 2);
                })->editColumn('tonkm', function ($data) {
                    return number_format($data->tonkm, 2);
                })->editColumn('trip', function ($data) {
                    if ($data->trip == 1) {
                        $button = 'Trip';
                    } else {
                        $button = 'Part Of Trip';
                    }
                    return $button;
                })
                ->rawColumns(['details'])
                ->make(true);
        }
        return view('operation.osperformance.index');
    }

    public function create()
    {
        $osperformance =  new  Outsource_performance;
        $outsource =  Outsource::active()->get();
        $osperformanceold =  Outsource_performance::active()->get();
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
        if ($outsource->count() <= 0) {
            Session::flash('info', 'You must have some Outsource  before attempting to create oustsource Performance');
            return redirect()->route('outsource.create');
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

        $available_tone = Operation::where('id', $request->operation)->sum('volume');
        $liffted_ton_erte = Performance::where('operation_id', $request->operation)->sum('CargoVolumMT');
        $liffted_ton_os = Outsource_performance::where('operation_id', $request->operation)->sum('CargoVolumMT');
        $total_uplifted =  $liffted_ton_erte +  $liffted_ton_os;
        // dd($total_uplifted);
        if ($total_uplifted < $available_tone) {
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

            // $osperformance->save();
            // auth()->user()->notify(new PerformanceCreated);

            Session::flash('success', 'Performance  registerd successfuly');
            return redirect()->route('osperformance');
        } else {
            Session::flash('error', 'NOT REGISTERED This Operation is Full');
            return redirect()->route('osperformance.create');
        }
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
        Session::flash('success', 'Outsource Performance deleted successfuly');
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
