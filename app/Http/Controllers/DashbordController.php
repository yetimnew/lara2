<?php

namespace App\Http\Controllers;

use DateTime;
use App\Truck;
use App\Driver;
use App\Operation;
use Carbon\Carbon;
use App\Performance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashbordController extends Controller
{

    public function index()
    {
        $number_of_trucks = Truck::active()->count();
        $number_of_drivers = Driver::active()->count();
        $operations = Operation::active()->count();
        $totalTone = Operation::active()->sum('volume');
        $upliftedTone = DB::table('performances')->where('satus', '=', 1)->sum('CargoVolumMT');
        $maxStatus = DB::table('statuses')->MAX('autoid');
        $maxDate = DB::table('statuses')->MAX('registerddate');
        $today =  Carbon::today()->toDateTimeString();
        $now =  Carbon::now()->toDateTimeString();

        $daylyupliftedtonage = DB::table('performances')
            ->select(
                DB::raw('SUM(performances.CargoVolumMT) as ton'),
                DB::raw('COUNT(performances.trip) as trip'),
                DB::raw('SUM(performances.tonkm) as tonkm')
            )
            ->whereBetween('created_at', [$today, $now])
            ->get();




        $tds = DB::table('statuses')
            ->select(
                'statustypes.name as name',
                'statustypes.statusgroup as statusgroup',
                'statuses.registerddate as registerddate',
                DB::raw('COUNT(statuses.statustype_id) as Number')
            )
            ->join('statustypes', 'statustypes.id', '=', 'statuses.statustype_id')
            ->where('statuses.autoid', '=', $maxStatus)
            ->groupBy('statuses.statustype_id')
            ->get();

        $statuses = DB::table('statuses')
            ->select(
                'statustypes.statusgroup',
                DB::raw('COUNT(statuses.statustype_id) as status')
            )
            ->join('statustypes', 'statustypes.id', '=', 'statuses.statustype_id')
            ->where('statuses.autoid', '=', $maxStatus)
            ->groupBy('statustypes.statusgroup')
            ->get();
        // Operations
        $operationsReport = DB::table('operations')
            ->select(
                'operations.operationid',
                'operations.volume as Tone_Given',
                'customers.name',
                DB::raw('SUM(performances.CargoVolumMT)as Tone'),
                DB::raw('SUM(performances.trip)as fo')
            )
            ->join('customers', 'operations.customer_id', '=', 'customers.id')
            ->leftjoin('performances', 'performances.operation_id', '=', 'operations.id')
            ->where('operations.status', '=', 1)
            ->where('operations.closed', '=', 1)
            ->groupBy('operations.id')
            ->get();
        $statuslist = $this->statusList();

        return view('dashboard')
            ->with('number_of_trucks', $number_of_trucks)
            ->with('number_of_drivers', $number_of_drivers)
            ->with('operations', $operations)
            ->with('totalTone', $totalTone)
            ->with('upliftedTone', $upliftedTone)
            ->with('maxDate', $maxDate)
            ->with('maxStatus', $maxStatus)
            ->with('tds', $tds)
            ->with('operationsReport', $operationsReport)
            ->with('statuses', $statuses)
            ->with('daylyupliftedtonage', $daylyupliftedtonage)
            ->with('statuslist', $statuslist);
    }

    public function statusList()
    {
        return [
            'Returned' => Performance::returned()->take(30)->count(),
            'Not returned' => Performance::notreturned()->take(30)->count(),
            'All' => Performance::where('trip', '=', 1)->active()->take(30)->count(),
        ];
    }

    function getAllMonths()
    {
        $now = Carbon::now();
        // $current_year =  $now->year; behwal atikeyirawlake ishi ena ketechim ale on 129
        $current_year =  '2019';
        $month_array = array();
        $posts_dates = Performance::orderBy('DateDispach', 'ASC')
            ->whereYear('DateDispach', $current_year)
            ->pluck('DateDispach');
        $posts_dates = json_decode($posts_dates);
        // dd( $posts_dates);

        if (!empty($posts_dates)) {
            foreach ($posts_dates as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array[$month_no] = $month_name;
            }
        }
        return $month_array;
    }

    function getMonthlyPostCount($month)
    {
        $now = Carbon::now();
        // $current_year =  $now->year;
        $current_year =  '2019';
        $monthly_post_count = Performance::whereMonth('DateDispach', $month)
            ->whereYear('DateDispach', $current_year)
            ->get()
            ->sum('tonkm');
        // return  number_format($monthly_post_count);
        return $monthly_post_count;
    }

    function getMonthlyPostData()
    {

        $monthly_post_count_array = array();
        $month_array = $this->getAllMonths();
        $month_name_array = array();
        if (!empty($month_array)) {
            foreach ($month_array as $month_no => $month_name) {
                $monthly_post_count = $this->getMonthlyPostCount($month_no);
                array_push($monthly_post_count_array, $monthly_post_count);
                array_push($month_name_array, $month_name);
            }
        }

        $max_no = max($monthly_post_count_array);
        // dd($max_no);
        $max = round(($max_no + 10 / 2) / 10) * 10;
        // dd($max);
        $monthly_post_data_array = array(
            'months' => $month_name_array,
            'post_count_data' => $monthly_post_count_array,
            'max' => $max,
        );
        // dd($monthly_post_data_array);
        return $monthly_post_data_array;
    }
}
