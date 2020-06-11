<?php

namespace App\Http\Controllers;

use App\Region;
use App\Customer;
use App\Operation;
use App\Performance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
// use RealRashid\SweetAlert\Facades\Alert;

class OperationController extends Controller
{

    public function index()
    {
        $operations = Operation::active()->orderBy('updated_at', 'DESC')->get();
        return view('operation.operation.index')->with('operations', $operations);
    }

    public function create()
    {

        $operation = new Operation;
        $regions = Region::all();
        $customers = Customer::all();
        if ($regions->count() == 0) {
            // alert()->warning('WarningAlert','You must have some Region before attempting to create Operation.')->width('250px');
            // example:
            // alert()->question('Are you sure?','You won\'t be able to revert this!')->showCancelButton()->showConfirmButton()->focusConfirm(true);
            // alert('Info','You must have some Region before attempting to create Operation', 'info')->width('250px');
            // alert()->success('Post Created', '<strong>Successfully</strong>')->toHtml();
            // alert()->question('Are you sure?','You won\'t be able to revert this!')
            // ->showConfirmButton('Yes! Delete it', '#3085d6')
            // ->showCancelButton('Cancel', '#aaa')->reverseButtons();

            // alert()->question('Are you sure?','You won\'t be able to revert this!')->showCancelButton('Cancel', '#aaa');

            // alert()->error('Delete','Are You shure want to delete.')->persistent(true,false);

            // toast('You must have some Region before attempting to create Operation','info')->autoClose(5000)->position('top-end');
            // example:
            // alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.')->persistent(false);

            // toast('Info Toast','info');
            // example:
            // alert()->info('SuccessAlert','Lorem ipsum dolor sit amet.')->showConfirmButton('Confirm', '#3085d6');

            // Alert::info('Info Title', 'Info Message');
            // alert()->info('Title','Lorem Lorem Lorem');
            Session::flash('info', 'You must have some Region before attempting to create Operation');
            return redirect()->route('region.create');
        }

        if ($customers->count() == 0) {
            // toast('You must have some Customer before attempting to create Operation','info')->autoClose(5000)->position('top-end');

            Session::flash('info', 'You must have some Customer before attempting to create Operation');
            return redirect()->route('customer.create');
        }

        return view('operation.operation.create')
            ->with('regions', $regions)
            ->with('customers', $customers)
            ->with('operation', $operation);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'oid' => 'required|unique:operations,operationid',
            'customer' => 'required',
            'sdate' => 'required',
            'region' => 'required',
            'volume' => 'required|integer',
            'ctype' => 'required',
            'tone' => 'required',
            'tariff' => 'required',

        ]);

        $operation = new Operation;
        $operation->operationid = $request->oid;
        $operation->customer_id = $request->customer;
        $operation->startdate = $request->sdate;
        $operation->region_id = $request->region;
        $operation->volume = $request->volume;
        $operation->cargotype = $request->ctype;
        $operation->km = $request->tone;
        $operation->tariff = $request->tariff;
        $operation->user_id = Auth::user()->id;
        $operation->save();
        // alert()->success('SuccessAlert','operation  registerd successfuly.');
        Session::flash('success', 'operation  registerd successfuly');
        return redirect()->route('operation');
    }

    public function show($id)
    {

        $operation = Operation::findOrFail($id);
        // $operation = Operation::where('id', '=', $id)->first();
        $performance =  DB::table('performances')
            ->select(
                DB::raw('SUM(performances.trip) as trip'),
                DB::raw('SUM(performances.CargoVolumMT) as mt'),
                DB::raw('SUM(performances.tonkm) as tonekm'),
                DB::raw('SUM(performances.DistanceWCargo) as dwc'),
                DB::raw('SUM(performances.DistanceWOCargo) as dwoc'),
                DB::raw('SUM(performances.fuelInBirr) as fuel'),
                DB::raw('SUM(performances.perdiem) as per'),
                DB::raw('SUM(performances.workOnGoing) as wog'),
                DB::raw('SUM(performances.other) as other')
            )
            ->LEFTJOIN('operations', 'operations.id', '=', 'performances.operation_id')
            ->where('performances.operation_id', $operation->id)
            ->first();

        $outsource_performance =  DB::table('outsource_performances')
            ->select(
                // 'outsource_performances.trip',
                DB::raw('SUM(outsource_performances.trip) as trip'),
                DB::raw('SUM(outsource_performances.CargoVolumMT) as mt'),
                DB::raw('SUM(outsource_performances.tonkm) as tonekm'),
                DB::raw('SUM(outsource_performances.DistanceWCargo) as dwc'),
                DB::raw('SUM(outsource_performances.DistanceWOCargo) as dwoc'),
                DB::raw('SUM(outsource_performances.tonkm * outsource_performances.tariff) as revenue')

            )
            ->LEFTJOIN('operations', 'operations.id', '=', 'outsource_performances.operation_id')
            ->where('outsource_performances.operation_id', $operation->id)
            ->first();

            $outsource_performance_km =  DB::table('outsource_performances')
            ->select(
                DB::raw('SUM(outsource_performances.DistanceWCargo) as dwc'),
                DB::raw('SUM(outsource_performances.DistanceWOCargo) as dwoc'),

            )
            ->LEFTJOIN('operations', 'operations.id', '=', 'outsource_performances.operation_id')
            ->where('outsource_performances.operation_id', $operation->id)
            ->Where('outsource_performances.trip',1)
            ->first();

        // dd( $outsource_performance);

        return view('operation.operation.show')
            ->with('performance', $performance)
            ->with('outsource_performance', $outsource_performance)
            ->with('outsource_performance_km', $outsource_performance_km)
            ->with('operation', $operation);
    }

    public function edit($id)
    {

        $operation = Operation::findorfail($id);

        $regions = Region::all();
        $customers = Customer::all();
        if ($regions->count() == 0) {
            return redirect()->route('region');
            // toast('You must have some Region before attempting to create Truck','info')->autoClose(5000)->position('top-end');
            Session::flash('info', 'You must have some Region before attempting to create Truck');
        }

        if ($customers->count() == 0) {
            return redirect()->route('customer');
            // toast('YYou must have some Customer before attempting to create Truck','info')->autoClose(5000)->position('top-end');
            Session::flash('info', 'You must have some Customer before attempting to create Truck');
        }

        return view('operation.operation.edit')
            ->with('operation', $operation)
            ->with('regions', $regions)
            ->with('customers', $customers);
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'oid' => 'required',
            'customer' => 'required',
            'sdate' => 'required',
            'region' => 'required',
            'volume' => 'required',
            'ctype' => 'required',
            'tone' => 'required',
            'tariff' => 'required',

        ]);

        $operation = Operation::findOrFail($id);
        $operation->operationid = $request->oid;
        $operation->customer_id = $request->customer;
        $operation->startdate = $request->sdate;
        $operation->region_id = $request->region;
        $operation->volume = $request->volume;
        $operation->cargotype = $request->ctype;
        $operation->km = $request->tone;
        $operation->tariff = $request->tariff;
        $operation->user_id = Auth::user()->id;
        $operation->save();
        alert()->success('SuccessAlert', 'operation updated successfuly.');
        // Session::flash('success', 'operation updated successfuly' );
        return redirect()->route('operation');
    }


    public function destroy($id)
    {
        $operation = Operation::findOrFail($id);
        $performance = Performance::where('operation_id', '=', $operation->id)->first();
        if (isset($performance)) {
            Session::flash('error', 'NOT DELETED ! There are records by this operation id');
            return redirect()->back();
        } else {
            $operation->delete();
            Session::flash('success', 'Operation deleted successfuly');
            return redirect()->route('operation');
        }
    }
    public function close($id)
    {
        $operation = Operation::findOrFail($id);
        return view('operation.operation.close')->with('operation', $operation);
    }

    public function open($id)
    {
        $operation = Operation::findOrFail($id);
        $operation->closed = 1;
        $operation->enddate = Null;
        $operation->save();
        alert()->success('SuccessAlert', 'Operation Opend successfuly.');
        // Session::flash('success', 'Operation Opend successfuly' );
        return redirect()->back();
    }
    public function update2(Request $request, $id)
    {
        // dd($request->all());
        $this->validate($request, [
            'edate' => 'required',
            'remark' => '',
        ]);

        $operation = Operation::findOrFail($id);

        $operation->enddate = $request->edate;
        $operation->remark = $request->remark;
        $operation->closed = 0;
        $operation->save();
        alert()->success('SuccessAlert', 'Operation Updated successfuly.');
        // Session::flash('success', 'operation updated successfuly' );
        return redirect()->route('operation');
    }
}
