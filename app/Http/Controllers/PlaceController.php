<?php

namespace App\Http\Controllers;

use App\Place;
use App\Region;
use App\Distance;
use App\Performance;
use App\Woreda;
use App\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class PlaceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $places =  DB::table('places')
                ->select(
                    'places.id as id',
                    'places.name as placeName',
                    'woredas.name as woredaName',
                    'zones.name as zoneaName',
                    'regions.name as regionsaName',
                    'places.comment as placeComment',
                )
                ->LEFTJOIN('woredas', 'woredas.id', '=', 'places.woreda_id')
                ->LEFTJOIN('zones', 'zones.id', '=', 'woredas.zone_id')
                ->LEFTJOIN('regions', 'regions.id', '=', 'zones.region_id')
                ->orderBy('places.name')
                ->get();

            return DataTables::of($places)
                ->addColumn('details', function ($places) {

                    $button = '<a href="' . route('place.show', $places->id) . '"> <i
            class="fa fa-edit"></a>';
                    return $button;
                })
                ->rawColumns(['details'])
                ->make(true);
        }
        return view('operation.place.index');
    }

    public function create()
    {
        $place = new Place;
        $regions = Region::all();
        $zones = Zone::all();
        $woredas = Woreda::all();
        if ($regions->count() == 0) {
            Session::flash('info', 'You must have some Region  before attempting to create Truck');
            return redirect()->route('region');
        }

        return view('operation.place.create')
            ->with('place', $place)
            ->with('regions', $regions)
            ->with('zones', $zones)
            ->with('woredas', $woredas);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [

            'woreda' => 'required',
            'name' => 'required|unique:places',

        ]);

        $place = new Place;
        $place->woreda_id = $request->woreda;
        $place->name = $request->name;
        $place->comment = $request->comment;

        $place->save();
        Session::flash('success', 'place  registerd successfuly');
        return redirect()->route('place');
    }

    public function show($id)
    {
        $place = Place::with('woreda')->findOrFail($id);
        return view('operation.place.show')->with('place', $place);
    }

    public function edit($id)
    {
        $place = Place::findOrFail($id);
        $woredas = Woreda::with('zone')->get();
        $zones = Zone::with('region')->get();
        $regions = Region::all();
        return view('operation.place.edit')
            ->with('zones', $zones)
            ->with('regions', $regions)
            ->with('place', $place)
            ->with('woredas', $woredas);
    }

    public function update(Request $request, $id)
    {
        // dd( $request->all());
        $this->validate($request, [
            'woreda' => 'required',
            'name' => 'required'

        ]);

        $place = Place::findOrFail($id);
        $place->name = $request->name;
        $place->woreda_id = $request->woreda;
        $place->comment = $request->comment;

        $place->save();
        Session::flash('success', 'place updated successfuly');
        return redirect()->route('place');
    }

    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        $distance = Distance::where('origin_id', '=', $place->id)
            ->orwhere('destination_id', '=', $place->id)
            ->get();

        if ($distance->count() == 0) {
            $performance = Performance::where('destination_id', '=', $place->id)->get();
            if ($performance->count() >= 1) {
                $place->delete();
                Session::flash('success', 'Place Deleted successfully!!');
                return redirect()->route('place');
            } else {
                Session::flash('error', 'UNABLE TO DELETE!!  Performance is registerd by this place');
                return redirect()->back();
            }
        } else {
            Session::flash('error', 'UNABLE TO DELETE!!  Distance is registerd by this place');
            return redirect()->back();
        }
    }
    public function allPlaces()
    {
        // $places = Place::with('woreda')->active()->get();
        $places =  DB::table('places')
            ->select(
                'places.id as id',
                'places.name as placeName',
                'woredas.name as woredaName',
                'zones.name as zoneaName',
                'regions.name as regionsaName',
                'places.comment as placeComment',
            )
            ->LEFTJOIN('woredas', 'woredas.id', '=', 'places.woreda_id')
            ->LEFTJOIN('zones', 'zones.id', '=', 'woredas.zone_id')
            ->LEFTJOIN('regions', 'regions.id', '=', 'zones.region_id')
            // ->where('outsource_performances.operation_id', $operation->id)
            // ->Where('outsource_performances.trip',1)
            ->get();

        // $places = DB::Place::with('woreda')->active()->get();
        return DataTables::of($places)->make(true);
    }
}
