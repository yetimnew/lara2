<?php

namespace App\Http\Controllers;

use App\Charts\PerformanceChart;
use App\Truck;
use App\Driver;
use App\Operation;
use Carbon\Carbon;
use App\Performance;
use Illuminate\Support\Facades\DB;

class DashbordController extends Controller
{

    public function index()
    {
        $number_of_trucks = Truck::active()->count();
        $number_of_drivers = Driver::active()->count();
        $operations = Operation::active()->open()->count();
        $totalTone = Operation::active()->open()->sum('volume');
        $upliftedTone =  DB::table('performances')
            ->join('operations', 'performances.operation_id', '=', 'operations.id')
            ->where('operations.status', 1)
            ->where('operations.closed', 1)
            ->SUM('performances.CargoVolumMT');

        $outsourceupliftedTone = DB::table('outsource_performances')
            ->join('operations', 'outsource_performances.operation_id', '=', 'operations.id')
            ->where('operations.status', 1)
            ->where('operations.closed', 1)
            ->SUM('outsource_performances.CargoVolumMT');
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

        $daylyupliftedtonageoutsource = DB::table('outsource_performances')
            ->select(
                DB::raw('SUM(outsource_performances.CargoVolumMT) as ton'),
                DB::raw('COUNT(outsource_performances.trip) as trip'),
                DB::raw('SUM(outsource_performances.tonkm) as tonkm')
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
                DB::raw('COUNT(performances.trip)as fo'),
                // DB::raw('sum(outsource_performances.CargoVolumMT)as osTone'),
            )
            ->leftJoin('customers', 'operations.customer_id', '=', 'customers.id')
            ->leftJoin('performances', 'performances.operation_id', '=', 'operations.id')
            // ->leftJoin('outsource_performances', 'outsource_performances.operation_id', '=', 'operations.id')
            // ->SUM('outsource_performances.CargoVolumMT)as osTone')
            ->where('operations.status', '=', 1)
            ->where('operations.closed', '=', 1)
            ->groupBy('operations.id')
            ->get();
        // dd( $operationsReport);
        $outsource_operationsReport = DB::table('operations')
            ->select(
                'operations.operationid',
                'customers.name',
                DB::raw('SUM(outsource_performances.CargoVolumMT)as osTone'),
                DB::raw('SUM(outsource_performances.trip)as osfo')
            )
            // ->leftJoin('performances', 'performances.operation_id', '=', 'operations.id')
            ->leftJoin('customers', 'operations.customer_id', '=', 'customers.id')
            ->rightJoin('outsource_performances', 'outsource_performances.operation_id', '=', 'operations.id')
            ->where('operations.status', '=', 1)
            ->where('operations.closed', '=', 1)
            ->groupBy('operations.id')
            ->get();
        $statuslist = $this->statusList();
        $today = Carbon::now();
        $day7 = Carbon::now()->subDays(15);
        // dd( $day7);

        $performance = DB::table('performances')
            ->select(
                DB::raw('DATE(created_at) as dispachdate'),
                DB::raw('SUM(CargoVolumMT)as Tone'),
            )

            ->whereBetween('created_at', [$day7, $today])
            ->groupBy('dispachdate')
            ->orderBy('dispachdate', 'ASC')
            ->pluck('Tone', 'dispachdate');

        $osperformance = DB::table('outsource_performances')
            ->select(
                DB::raw('DATE(created_at) as dispachdate'),
                DB::raw('SUM(CargoVolumMT)as Tone'),
            )
            ->whereBetween('created_at', [$day7, $today])
            ->groupBy('dispachdate')
            ->orderBy('dispachdate', 'ASC')
            ->pluck('Tone', 'dispachdate');
        // return  $osperformance;

        $charts = new PerformanceChart;
        $charts->labels($performance->keys());
        $charts->dataset('Ton', 'line', $performance->values())->backgroundColor('rgba(78,240,15,0.2)');
        $charts->dataset(' Plan Ton', 'line', ['250', '250', '250', '250', '250', '250', '250', '250', '250', '250'])
            ->backgroundColor('rgba(2,117,216,0.2)');
        // $charts->dataset('OS Ton', 'line', $osperformance->values())->backgroundColor('red');



        return view('dashboard')
            ->with('number_of_trucks', $number_of_trucks)
            ->with('number_of_drivers', $number_of_drivers)
            ->with('operations', $operations)
            ->with('totalTone', $totalTone)
            ->with('upliftedTone', $upliftedTone)
            ->with('outsourceupliftedTone', $outsourceupliftedTone)
            ->with('maxDate', $maxDate)
            ->with('maxStatus', $maxStatus)
            ->with('tds', $tds)
            ->with('operationsReport', $operationsReport)
            ->with('outsource_operationsReport', $outsource_operationsReport)
            ->with('statuses', $statuses)
            ->with('daylyupliftedtonage', $daylyupliftedtonage)
            ->with('daylyupliftedtonageoutsource', $daylyupliftedtonageoutsource)
            ->with('statuslist', $statuslist)
            ->with('charts', $charts);
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
