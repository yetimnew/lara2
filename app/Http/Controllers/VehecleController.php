<?php

namespace App\Http\Controllers;

use App\Vehecletype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class VehecleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehecletypes = DB::table('vehecletypes')->where('status','!=',0)->get();
        return view('operation.vehecletype.index')->with('vehecletypes',$vehecletypes);
    }

    public function create()
    {
     return view('operation.vehecletype.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
        'name' => 'required|unique:vehecletypes', 
        // 'company' => 'required', 
        // 'pdate' =>  'required',
        // 'comment' =>  'required',
  
        ]);

        $vehecletype = new Vehecletype;
        $vehecletype->name = $request->name;
        $vehecletype->company = $request->company;
        $vehecletype->productiondate = $request->pdate;
        $vehecletype->comment = $request->comment;

        $vehecletype->save();
        Session::flash('success', 'vehecle Model  registerd successfuly' );
        return redirect()->route('vehecletype');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $vehecletype = vehecletype::find($id);
        // return $vehecletype;
        return view('operation.vehecletype.edit')->with('vehecletype',$vehecletype);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
            
            ]);
    
            $vehecletype = vehecletype::find($id);
            $vehecletype->name = $request->name;
            $vehecletype->company = $request->company;
            $vehecletype->productiondate = $request->pdate;
            $vehecletype->comment = $request->comment;
            $vehecletype->save();
            Session::flash('success', 'vehecle Model  Updated successfuly' );
    
            return redirect()->route('vehecletype');
    }

   
    public function destroy($id)
    {
        $vehecletype = vehecletype::find($id);
        $vehecletype->delete();
        Session::flash('success', 'vehecle Model  deleted successfuly' );

        return redirect()->back();

    }
}
