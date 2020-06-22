<?php

namespace App\Http\Controllers;

use App\Place;
use App\Region;
use App\Woreda;
use App\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class WoredaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $woredas =  DB::table('woredas')
                ->select(
                    'woredas.id as id',
                    'woredas.name as woredaName',
                    'zones.name as zoneaName',
                    'regions.name as regionsaName',
                    'woredas.comment as woredaComment',
                )
                // ->LEFTJOIN('woredas', 'woredas.id', '=', 'woredas.woreda_id')
                ->LEFTJOIN('zones', 'zones.id', '=', 'woredas.zone_id')
                ->LEFTJOIN('regions', 'regions.id', '=', 'zones.region_id')
                ->orderBy('woredas.name')
                ->get();

            return DataTables::of($woredas)
                ->addColumn('details', function ($woredas) {

                    $button = '<a href="' . route('woreda.show', $woredas->id) . '"> <i class="fa fa-edit"></a>';
                    return $button;
                })
                ->rawColumns(['details'])
                ->make(true);
        }
        return view('operation.woreda.index');
    }

    public function create()
    {
        $woreda = new Woreda();
        $regions = Region::all();
        $zones = Zone::all();
        $woredas = Woreda::all();
        if ($regions->count() == 0) {
            Session::flash('info', 'You must have some Region  before attempting to create Truck');
            return redirect()->route('region');
        }

        return view('operation.woreda.create')
            ->with('woreda', $woreda)
            ->with('regions', $regions)
            ->with('zones', $zones)
            ->with('woredas', $woredas);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [

            'name' => 'required|unique:woredas',
            'zone' => 'required',

        ]);

        $woreda = new Woreda;
        $woreda->name = $request->name;
        $woreda->zone_id = $request->zone;
        $woreda->comment = $request->comment;

        $woreda->save();
        Session::flash('success', 'woreda  registerd successfuly');
        return redirect()->route('woreda');
    }

    public function show($id)
    {
        $woreda = Woreda::with('zone')->findOrFail($id);
        $places = Place::where('woreda_id', '=', $woreda->id)->orderBy('name')->get();

        return view('operation.woreda.show')
            ->with('places', $places)
            ->with('woreda', $woreda);
    }

    public function edit($id)
    {
        $woreda = Woreda::with('zone')->findOrFail($id);
        $woredas = Woreda::with('zone')->get();
        $zones = Zone::with('region')->get();
        return view('operation.woreda.edit')
            ->with('zones', $zones)
            ->with('woreda', $woreda)
            ->with('woredas', $woredas);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'zone' => 'required',

        ]);

        $woreda = Woreda::findOrFail($id);
        $woreda->name = $request->name;
        $woreda->zone_id = $request->zone;
        $woreda->comment = $request->comment;

        $woreda->save();
        Session::flash('success', 'woreda updated successfuly');
        return redirect()->route('woreda.show', $id);
    }

    public function destroy($id)
    {
        $woreda = Woreda::findOrFail($id);
        $place = Place::where('woreda_id', '=', $woreda->id)
            ->get();

        if ($place->count() == 0) {
            $woreda->delete();
            Session::flash('success', 'woreda ' . $woreda->name . ' Deleted successfully!!');
            return redirect()->route('woreda');
        } else {

            Session::flash('error', 'UNABLE TO DELETE!!  Woreda  ' .  $place->count() . ' Plces  registerd on this woreda');
            return redirect()->back();
        }
    }
}
