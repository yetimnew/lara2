<?php

namespace App\Http\Controllers;

use App\Outsource;
use App\Outsource_performance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OutsourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outsources = Outsource::active()->get();
        return view('operation.outsource.index', compact('outsources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outsource = new Outsource;
        return view('operation.outsource.create')->with('outsource', $outsource);
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $data = request()->validate([
            'name' => 'required|unique:outsources,name',
            'address' => 'required',
            'officenumber' => '',
            'mobile' => '',
            'remark' => '',
        ]);

        Outsource::create($data);

        Session::flash('success', 'Outsource customer  registerd successfuly');
        return redirect()->route('outsource');
    }


    public function edit(Outsource $outsource, $id)
    {
        $outsource = Outsource::findOrFail($id);
        return view('operation.outsource.edit')
            ->with('outsource', $outsource);
    }

    public function update(Request $request, Outsource $outsource, $id)
    {
        $this->validate($request, [
            'name' => 'required'

        ]);
        $outsource = Outsource::findOrFail($id);
        $outsource->name = $request->name;
        $outsource->address = $request->address;
        $outsource->officenumber = $request->officenumber;
        $outsource->mobile = $request->mobile;
        $outsource->remark = $request->remark;
        $outsource->save();
        Session::flash('success', 'Outsource customer updated successfuly');
        return redirect()->route('outsource');
    }


    public function destroy(Outsource $outsource, $id)
    {
        // dd($id);
        $outsource = Outsource::findOrFail($id);
        $performance = Outsource_performance::where('outsource_id', '=', $outsource->id)->first();
        if (isset($performance)) {
            Session::flash('error', 'UNABLE TO DELETE !! Customer ');
            return redirect()->back();
        } else {
            $outsource->delete();
            Session::flash('success', 'Outsource Customer Deleted Successfuly!! ');
            return redirect()->back();
        }
    }
}
