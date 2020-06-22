<?php

namespace App\Http\Controllers;

use App\Operation;
use App\Region;
use App\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::with('zones')->get();
        return view('operation.region.index')->with('regions', $regions);
    }

    public function create()
    {
        $region = new Region;
        return view('operation.region.create')->with('region', $region);
    }

    public function store(Request $request)
    {

        $this->validate($request, [

            'name' => 'required',
            // 'comment' => 'required'

        ]);

        $region = new Region;
        $region->name = $request->name;
        $region->comment = $request->comment;


        $region->save();
        Session::flash('success', 'region  registerd successfuly');
        return redirect()->route('region');
    }

    public function edit($id)
    {
        $region = Region::findOrFail($id);
        $zones = Zone::where('region_id', '=', $region->id)->get();
        // return $region;
        // return $region;
        return view('operation.region.edit')
            ->with('zones', $zones)
            ->with('region', $region);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',

        ]);

        $region = Region::findorFail($id);
        $region->name = $request->name;
        $region->comment = $request->comment;

        $region->save();
        Session::flash('success', 'region updated successfuly');
        return redirect()->route('region');
    }

    public function destroy($id)
    {
        $region = Region::findOrFail($id);
        $zones = Zone::where('region_id', '=', $region->id)->get();

        if ($zones->count() >= 1) {
            Session::flash('error', 'UNABLE TO DELETE!!  Zone is registerd by this Region');
            return redirect()->back();
        } else {
            $operation = Operation::where('region_id', '=', $region->id)->get();
            if ($operation->count() >= 1) {
                Session::flash('error', 'UNABLE TO DELETE!!  Operation is registerd by this Region');
                return redirect()->back();
            } else {

                $region->delete();
                Session::flash('success', 'Region Deleted successfully!!');
                return redirect()->back();
            }
        }
    }
}
