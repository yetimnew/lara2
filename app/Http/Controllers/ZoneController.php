<?php

namespace App\Http\Controllers;


use App\Zone;
use App\Region;
use App\Woreda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ZoneController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $zones =  DB::table('zones')
                ->select(
                    'zones.id as id',
                    'zones.name as zoneName',
                    'regions.name as regionsaName',
                    'zones.comment as zoneComment',
                )
                // ->LEFTJOIN('zones', 'zones.id', '=', 'zones.woreda_id')
                ->LEFTJOIN('regions', 'regions.id', '=', 'zones.region_id')
                ->orderBy('zones.name')
                ->get();

            return DataTables::of($zones)
                ->addColumn('details', function ($zones) {

                    $button = '<a href="' . route('zone.show', $zones->id) . '"> <i class="fa fa-edit"></a>';
                    return $button;
                })
                ->rawColumns(['details'])
                ->make(true);
        }
        return view('operation.zone.index');
    }

    public function create()
    {
        $zone = new Zone();
        $regions = Region::all();
        $zones = Zone::all();
        $zones = zone::all();
        if ($regions->count() == 0) {
            Session::flash('info', 'You must have some Region  before attempting to create Truck');
            return redirect()->route('region');
        }

        return view('operation.zone.create')
            ->with('zone', $zone)
            ->with('regions', $regions)
            ->with('zones', $zones)
            ->with('zones', $zones);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [

            'name' => 'required|unique:zones',
            'region' => 'required',

        ]);

        $zone = new Zone;
        $zone->name = $request->name;
        $zone->region_id = $request->region;
        $zone->comment = $request->comment;

        $zone->save();
        Session::flash('success', 'zone  registerd successfuly');
        return redirect()->route('zone');
    }

    public function show($id)
    {
        $zone = Zone::findOrFail($id);
        $woredas = Woreda::where('zone_id', '=', $zone->id)
            ->orderBy('name')->get();
        // dd($zone);

        return view('operation.zone.show')
            ->with('woredas', $woredas)
            ->with('zone', $zone);
    }

    public function edit($id)
    {
        $zone = Zone::findOrFail($id);
        $zones = Zone::with('region')->get();
        $regions = Region::all();
        // dd($zones);
        return view('operation.zone.edit')
            ->with('zones', $zones)
            ->with('regions', $regions)
            ->with('zone', $zone);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'region' => 'required',

        ]);

        $zone = Zone::findOrFail($id);
        $zone->name = $request->name;
        $zone->region_id = $request->region;
        $zone->comment = $request->comment;

        $zone->save();
        Session::flash('success', 'zone updated successfuly');
        return redirect()->route('zone.show', $id);
    }

    public function destroy($id)
    {
        $zone = zone::findOrFail($id);
        $woreda = Woreda::where('zone_id', '=', $zone->id)
            ->get();
        // dd($woreda);

        if ($woreda->count() == 0) {
            $zone->delete();
            Session::flash('success', 'zone ' . $zone->name . ' Deleted successfully!!');
            return redirect()->route('zone');
        } else {

            Session::flash('error', 'UNABLE TO DELETE!!  zone  ' .  $woreda->count() . ' Plces  registerd on this zone');
            return redirect()->back();
        }
    }
}
