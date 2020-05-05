<?php

namespace App\Http\Controllers;

use App\Place;
use App\Distance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DistanceController extends Controller
{
    public function index()
    {

        $distances =  Distance::where('status', 1)

            ->get();

        return view('operation.distance.index')
            ->with('distances', $distances);
    }

    public function create()
    {
        $places = Place::all();
        $distance = new Distance;
        return view('operation.distance.create')
            ->with('distance', $distance)
            ->with('places', $places);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'origin' => 'required',
            'destination' => 'required|different:origin',
            'km' => 'required',


        ]);

        $distance = new Distance;
        $origin = $request->origin;
        $destination  = $request->destination;
        $distances =  DB::table('distances')->where('origin_id', '=', $origin)->Where('destination_id', '=', $destination)->get();

        $orginName_arr =  DB::table('places')->where('id', '=', $origin)->pluck('name')->toArray();
        $destination_arr =  DB::table('places')->where('id', '=', $destination)->pluck('name')->toArray();
        $distance_count = $distances->count();
        if ($distance_count >= 1) {

            Session::flash('error', $orginName_arr[0] . ' and ' . $destination_arr[0] . ' alredy registerd!');
            return redirect()->back();
        } else {

            $distance->origin_id =  $origin;
            $distance->origin_name =  $orginName_arr[0];
            $distance->destination_id =  $destination;
            $distance->destination_name =   $destination_arr[0];
            $distance->km = $request->km;
            $distance->status = 1;

            $distance->save();
            Session::flash('success',  ' Distance registerd successfuly');
            return redirect()->route('distance');
        }
    }


    public function edit($id)
    {
        $distances = Distance::all();
        $places = Place::all();
        $distance = Distance::findOrFail($id);
        return view('operation.distance.edit')
            ->with('distance', $distance)
            ->with('places', $places)
            ->with('distances', $distances);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'origin' => 'required',
            'destination' => 'required|different:origin',
            'km' => 'required',
        ]);

        $distance = Distance::findOrFail($id);
        $distance->km = $request->km;

        $distance->save();
        Session::flash('success',  ' Distance registerd successfuly');
        return redirect()->route('distance');
    }

    public function destroy($id)
    {
        $distance = Distance::findOrFail($id);

        $distance->delete();
        Session::flash('info', 'The distance b/n' . $distance->origin_name . ' and ' . $distance->destination_name . ' deleted successfuly');
        return redirect()->back();
    }
}
