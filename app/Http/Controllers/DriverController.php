<?php

namespace App\Http\Controllers;

use App\Driver;
use App\DriverTuck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DriverController extends Controller
{

    public function index()
    {

        $drivers = Driver::active()->orderBy('created_at', 'DESC')->get();
        return view('operation.driver.index')->with('drivers', $drivers);
    }

    public function create()
    {
        $driver = new  Driver;
        return view('operation.driver.create')->with('driver', $driver);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'did' => 'required',
            'name' => 'required',
            'sex' => 'required',
            'bdate' => 'required',
            'mob' => 'required',
            'hd' => 'required',

        ]);

        $driver = new Driver;

        $driver->driverid = $request->did;
        $driver->name = $request->name;
        $driver->sex = $request->sex;
        $driver->birthdate = $request->bdate;
        $driver->zone = $request->zone;
        $driver->woreda = $request->woreda;
        $driver->kebele = $request->kebele;
        $driver->housenumber = $request->hn;
        $driver->mobile = $request->mob;
        $driver->hireddate = $request->hd;
        $driver->save();
        Session::flash('success',  $driver->name .  ' registerd successfuly');
        return redirect()->route('driver');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $driver = Driver::findOrFail($id);
        return view('operation.driver.edit')->with('driver', $driver);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'did' => 'required',
            'name' => 'required',
            'sex' => 'required',
            'bdate' => 'required',
            'mob' => 'required',
            'hd' => 'required',

        ]);

        $driver = Driver::findOrFail($id);

        $driver->driverid = $request->did;
        $driver->name = $request->name;
        $driver->sex = $request->sex;
        $driver->birthdate = $request->bdate;
        $driver->zone = $request->zone;
        $driver->woreda = $request->woreda;
        $driver->kebele = $request->kebele;
        $driver->housenumber = $request->hn;
        $driver->mobile = $request->mob;
        $driver->hireddate = $request->hd;
        $driver->save();
        Session::flash('success',  $driver->name . ' updated successfuly');
        return redirect()->route('driver');
    }


    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);
        $driver_id =  $driver->driverid;
        $td = DriverTuck::where('driverid', '=', $driver_id)->first();
        // dd($td->plate);
        if ($td) {
            Session::flash('error', 'Not deleted ! ' . $driver->name . ' is attached to Plate ' . $td->plate);
            return redirect()->back();
        } else {
            $driver->status = 0;
            $driver->save();
            Session::flash('success', $driver->name . ' deleted successfuly');
            return redirect()->back();
        }
    }
    public function deactivate($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->status = 0;
        $driver->save();
        Session::flash('success', $driver->name . ' Deactivate successfuly');
        return redirect()->back();
    }
}
