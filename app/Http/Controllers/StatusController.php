<?php

namespace App\Http\Controllers;

use App\Truck;
use App\Status;
use App\Statustype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        return view('operation.status.index')->with('statuses', $statuses);
    }

    public function create()
    {
        $truck = Truck::all();
        $statustype = Statustype::all();
        if ($statustype->count() == 0) {
            Session::flash('info', 'You must have some Status Type before attempting to create Truck');
            return redirect()->route('statustype');
        }
        if ($truck->count() == 0) {
            Session::flash('info', 'You must have some Status Group before attempting to create Truck');
            return redirect()->route('truck');
        }
        return view('operation.status.create')->with('trucks', $truck)
            ->with('statustypes', $statustype);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'today' => 'required|date',
            'status' => 'required',
        ]);

        $plate =  $request->plate;
        $status =  $request->status;
        $autoid =  Status::max('autoid');
        $date =   $request->today;
        $status_date =  Status::where('registerddate', $date)->first();

        $count  = count($plate);
        if (!$status_date) {
            for ($i = 0; $i < $count; $i++) {
                $data = array(
                    'autoid' => $autoid + 1,
                    'statustype_id' => $status[$i],
                    'plate' => $plate[$i],
                    'registerddate' =>  $date,
                    'created_at' => today(),
                    'updated_at' => now()
                );

                $insertData[] = $data;
            }
            Status::insert($insertData);

            Session::flash('success', 'Daily  Status registerd successfuly');
            return redirect()->route('status');
        } else {
            Session::flash('error', 'Daily  Status  not registerd check the date');
            return redirect()->route('status.create');
        }
    }
    public function plate()
    {
        $trucks = Truck::all();
        $statust = Statustype::all();
        $count = $trucks->count();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $statustypes = Statustype::all();
        $status = Status::findOrFail($id);
        // return $status;
        return view('operation.status.edit')->with('status', $status)->with('statustypes', $statustypes);
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            // 'type' => 'required'

        ]);

        $status = Status::findOrFail($id);
        $status->statustype_id = $request->name;

        $status->save();

        Session::flash('success', 'Status updated successfuly');
        return redirect()->route('status');
    }


    public function destroy($id)
    {
        $status = Status::findOrFail($id);
        $status->delete();
        Session::flash('success', 'Status group deleted successfuly');
        return redirect()->back();
    }
}
