<?php

namespace App\Http\Controllers;

use App\Place;
use App\Region;
use App\Distance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::active()->get();

        return view('operation.place.index')->with('places', $places);
    }

    public function create()
    {
        $place = new Place;
        $regions = Region::all();
        if ($regions->count() == 0) {
            Session::flash('info', 'You must have some Region  before attempting to create Truck');
            return redirect()->route('region');
        }
        return view('operation.place.create')
            ->with('place', $place)
            ->with('regions', $regions);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [

            'name' => 'required|unique:places',
            'region' => 'required'

        ]);

        $place = new Place;
        $place->name = $request->name;
        $place->region_id = $request->region;
        $place->comment = $request->comment;


        $place->save();
        Session::flash('success', 'place  registerd successfuly');
        return redirect()->route('place');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $place = Place::findOrFail($id);
        $regions = Region::all();
        return view('operation.place.edit')->with('place', $place)->with('regions', $regions);
    }

    public function update(Request $request, $id)
    {
        // dd( $request->all());
        $this->validate($request, [
            'name' => 'required',
            'region' => 'required'

        ]);

        $place = Place::findOrFail($id);
        $place->name = $request->name;
        $place->region_id = $request->region;
        $place->comment = $request->comment;

        $place->save();
        Session::flash('success', 'place updated successfuly');
        return redirect()->route('place');
    }




    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        $distance = Distance::where('origin_id', '=', $place->id)->orwhere('destination_id', '=', $place->id)->get();
        if (isset($distance)) {
            Session::flash('error', 'UNABLE TO DELETE!!  Distance is registerd by this place');
            return redirect()->back();
        } else {
            $place->delete();
            Session::flash('success', 'Place Deleted successfully!!');
            return redirect()->back();
        }
    }
}
