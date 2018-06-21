<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Garbage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }


    public function index(){
      return $this->find_today();
    }

    public function find(Request $request)
    {
      if($request->input('find') != null  && $request->input('find') == "today"){
        return $this->find_today();
      } elseif($request->input('find') != null && $request->input('find') == "date"){
        return $this->find_date($request->input('saledate'));
      } elseif($request->input('find') != null && $request->input('find') == "month"){
        return $this->find_month($request->input('month'),$request->input('year'));
      } elseif($request->input('find') != null && $request->input('find') == "year"){
          return $this->find_year($request->input('year'));
      } elseif($request->input('find') != null && $request->input('find') == "7day"){
          return $this->find_before(Carbon::now()->subDays(7),'>=','7day');
      } elseif($request->input('find') != null && $request->input('find') == "one_month"){
          return $this->find_before(Carbon::now()->subMonth(),'>=','one_month');
      } elseif($request->input('find') != null && $request->input('find') == "three_month"){
          return $this->find_before(Carbon::now()->subMonth(3),'>=','three_month');
      } elseif($request->input('find') != null && $request->input('find') == "one_year"){
          return $this->find_before(Carbon::now()->subYear(),'>=','one_year');
      } elseif($request->input('find') != null && $request->input('find') == "custom"){
          return $this->find_custom($request->input('fromdate'),$request->input('todate'));
      } else {
        return view('admin.profit.index',['profit' => null,'finddate' => null]);
      }
    }


    public function find_today()
    {
      $today = date("Y-m-d");
      $datefind = $today.'%';

      $sales = DB::table('sales')
                      ->select('sales.garbage_id','garbages.type','sales.purchase_price as sum_purchase_price','sales.sale_price as sum_sale_price',DB::raw('sum(sales.unit) as sum_sale_unit'),DB::raw('sum(sales.profit) as sum_sale_profit'),DB::raw('sum(sales.loss) as sum_sale_loss'))
                      ->join('garbages', 'sales.garbage_id', '=', 'garbages.id')
                      ->where('sales.dateofsale','LIKE',$datefind)
                      ->groupBy('sales.garbage_id')
                      ->orderby('sales.dateofsale','asc')
                      ->get();

      $profit =  DB::table('sales')
                      ->select( DB::raw('sum(purchase_price) as sum_purchase_price'),DB::raw('sum(sale_price) as sum_sale_price'))
                      ->groupBy('garbage_id')
                      ->where('dateofsale','LIKE',$datefind)
                      ->orderby('dateofsale','asc')
                      ->get();
      $totalsale = 0;
      $totalkilo = 0;
      $totalbuy = 0;
      $totalprofit = 0;
      $totalloss = 0;

      foreach ($sales as $index => $sale) {
        $totalsale = ($sale->sum_sale_price * $sale->sum_sale_unit) + $totalsale;
        $totalkilo = $sale->sum_sale_unit + $totalkilo;
        $totalbuy = ($sale->sum_purchase_price * $sale->sum_sale_unit) + $totalbuy;
        $totalprofit = $sale->sum_sale_profit + $totalprofit;
        $totalloss = $sale->sum_sale_loss + $totalloss;
      }


       if(count($profit) > 0){
         if ($profit[0]->sum_purchase_price < $profit[0]->sum_sale_price) {
           $sumprofit =   $profit[0]->sum_sale_price - $profit[0]->sum_purchase_price;
           $sumloss =  0;
         } else {
           $sumprofit = 0;
           $sumloss =   $profit[0]->sum_purchase_price - $profit[0]->sum_sale_price;
         }
         $newdate = dateFormat(date("d/m/Y"));
         Session::flash('msg', 'สรุปยอดวันนี้');
         return view('admin.chart.index',['finddate' => date("d/m/Y"),'saledate' => $newdate, 'sales' => $sales, 'profit' => $profit,'sumprofit' => $sumprofit, 'sumloss' => $sumloss,'totalsale'=>$totalsale,'totalbuy'=>$totalbuy,'totalprofit'=>$totalprofit,'totalkilo'=>$totalkilo,'totalloss'=>$totalloss]);
       } else {
         list($day,$month,$year) = explode("/", date("d/m/Y"));
         $newdate = $day."/".$month."/".$year;
         return view('admin.chart.index',['finddate' => $newdate,'profit' => $profit, 'sales' => $sales,'totalsale'=>$totalsale,'totalbuy'=>$totalbuy,'totalprofit'=>$totalprofit,'totalloss'=>$totalloss]);
       }

    }

    public function find_date($saledate)
    {
      $query = $saledate;
      if (isset($query)){
      $datesplit = explode("/", $query);
      $newdate = $datesplit[2]."-".$datesplit[1]."-".$datesplit[0];
      $datefind = $newdate.'%';

      $sales = DB::table('sales')
                      ->select('sales.garbage_id','garbages.type','sales.purchase_price as sum_purchase_price','sales.sale_price as sum_sale_price',DB::raw('sum(sales.unit) as sum_sale_unit'),DB::raw('sum(sales.profit) as sum_sale_profit'),DB::raw('sum(sales.loss) as sum_sale_loss'))
                      ->join('garbages', 'sales.garbage_id', '=', 'garbages.id')
                      ->where('sales.dateofsale','LIKE',$datefind)
                      ->groupBy('sales.garbage_id')
                      ->orderby('sales.dateofsale','asc')
                      ->get();

      $profit =  DB::table('sales')
                      ->select( DB::raw('sum(purchase_price) as sum_purchase_price'),DB::raw('sum(sale_price) as sum_sale_price'))
                      ->groupBy('garbage_id')
                      ->where('dateofsale','LIKE',$datefind)
                      ->orderby('dateofsale','asc')
                      ->get();
      $totalsale = 0;
      $totalbuy = 0;
      $totalkilo = 0;
      $totalprofit = 0;
      $totalloss = 0;

      foreach ($sales as $index => $sale) {
        $totalsale = ($sale->sum_sale_price * $sale->sum_sale_unit) + $totalsale;
        $totalkilo = $sale->sum_sale_unit + $totalkilo;
        $totalbuy = ($sale->sum_purchase_price * $sale->sum_sale_unit) + $totalbuy;
        $totalprofit = $sale->sum_sale_profit + $totalprofit;
        $totalloss = $sale->sum_sale_loss + $totalloss;
      }

       if(count($profit) > 0){
         if ($profit[0]->sum_purchase_price < $profit[0]->sum_sale_price) {
           $sumprofit =   $profit[0]->sum_sale_price - $profit[0]->sum_purchase_price;
           $sumloss =  0;
         } else {
           $sumprofit = 0;
           $sumloss =   $profit[0]->sum_purchase_price - $profit[0]->sum_sale_price;
         }
         $newdate = dateFormat($query);
         Session::flash('msg', 'สรุปยอดวันที่ '.$newdate);
         return view('admin.chart.index',['finddate' => $query,'saledate' => $newdate, 'sales' => $sales, 'profit' => $profit,'sumprofit' => $sumprofit, 'sumloss' => $sumloss,'totalsale'=>$totalsale,'totalbuy'=>$totalbuy,'totalprofit'=>$totalprofit,'totalloss'=>$totalloss,'totalkilo'=>$totalkilo]);
       } else {
         list($day,$month,$year) = explode("/", date("d/m/Y"));
         $newyear = intval($year);
         $newdate = $day."/".$month."/".$year;
         return view('admin.chart.index',['finddate' => $newdate,'profit' => $profit, 'sales' => $sales,'totalsale'=>$totalsale,'totalbuy'=>$totalbuy,'totalprofit'=>$totalprofit,'totalloss'=>$totalloss,'totalkilo'=>$totalkilo]);
       }
       } else {
         list($day,$month,$year) = explode("/", date("d/m/Y"));
         $newyear = intval($year);
         $newdate = $day."/".$month."/".$year;
         return view('admin.chart.index',['profit' => null,'finddate' => $newdate]);
     }
    }

    public function find_month($month,$year)
    {

      $sales = DB::table('sales')
                      ->select('sales.garbage_id','garbages.type','sales.purchase_price as sum_purchase_price','sales.sale_price as sum_sale_price',DB::raw('sum(sales.unit) as sum_sale_unit'),DB::raw('sum(sales.profit) as sum_sale_profit'),DB::raw('sum(sales.loss) as sum_sale_loss'))
                      ->join('garbages', 'sales.garbage_id', '=', 'garbages.id')
                      ->whereYear('sales.dateofsale', '=', $year)
                      ->whereMonth('sales.dateofsale', '=', $month)
                      ->groupBy('sales.garbage_id')
                      ->orderby('sales.dateofsale','asc')
                      ->get();

      $profit =  DB::table('sales')
                      ->select( DB::raw('sum(purchase_price) as sum_purchase_price'),DB::raw('sum(sale_price) as sum_sale_price'))
                      ->groupBy('garbage_id')
                      ->whereYear('dateofsale','=',$year)
                      ->whereMonth('dateofsale','=',$month)
                      ->orderby('dateofsale','asc')
                      ->get();
      $totalsale = 0;
      $totalbuy = 0;
      $totalkilo = 0;
      $totalprofit = 0;
      $totalloss = 0;

      foreach ($sales as $index => $sale) {
        $totalsale = ($sale->sum_sale_price * $sale->sum_sale_unit) + $totalsale;
        $totalkilo = $sale->sum_sale_unit + $totalkilo;
        $totalbuy = ($sale->sum_purchase_price * $sale->sum_sale_unit) + $totalbuy;
        $totalprofit = $sale->sum_sale_profit + $totalprofit;
        $totalloss = $sale->sum_sale_loss + $totalloss;
      }

       if(count($profit) > 0){
         if ($profit[0]->sum_purchase_price < $profit[0]->sum_sale_price) {
           $sumprofit =   $profit[0]->sum_sale_price - $profit[0]->sum_purchase_price;
           $sumloss =  0;
         } else {
           $sumprofit = 0;
           $sumloss =   $profit[0]->sum_purchase_price - $profit[0]->sum_sale_price;
         }
         Session::flash('msg', 'สรุปยอด เดือน'.$month.' '.'ปี'.' '.$year);
         return view('admin.chart.index',['finddate' => null,'saledate' => null, 'sales' => $sales, 'profit' => $profit,'sumprofit' => $sumprofit, 'sumloss' => $sumloss,'totalsale'=>$totalsale,'totalbuy'=>$totalbuy,'totalprofit'=>$totalprofit,'totalloss'=>$totalloss,'totalkilo'=>$totalkilo]);
       } else {
         list($day,$month,$year) = explode("/", date("d/m/Y"));
         $newyear = intval($year);
         $newdate = $day."/".$month."/".$year;
         return view('admin.chart.index',['finddate' => null,'profit' => $profit, 'sales' => $sales,'totalsale'=>$totalsale,'totalbuy'=>$totalbuy,'totalprofit'=>$totalprofit,'totalloss'=>$totalloss,'totalkilo'=>$totalkilo]);
       }
    }

    public function find_year($year)
    {
      $sales = DB::table('sales')
                      ->select('sales.garbage_id','garbages.type','sales.purchase_price as sum_purchase_price','sales.sale_price as sum_sale_price',DB::raw('sum(sales.unit) as sum_sale_unit'),DB::raw('sum(sales.profit) as sum_sale_profit'),DB::raw('sum(sales.loss) as sum_sale_loss'))
                      ->join('garbages', 'sales.garbage_id', '=', 'garbages.id')
                      ->whereYear('sales.dateofsale', '=', $year)
                      ->groupBy('sales.garbage_id')
                      ->orderby('sales.dateofsale','asc')
                      ->get();

      $profit =  DB::table('sales')
                      ->select( DB::raw('sum(purchase_price) as sum_purchase_price'),DB::raw('sum(sale_price) as sum_sale_price'))
                      ->groupBy('garbage_id')
                      ->whereYear('dateofsale','=',$year)
                      ->orderby('dateofsale','asc')
                      ->get();
      $totalsale = 0;
      $totalkilo = 0;
      $totalbuy = 0;
      $totalprofit = 0;
      $totalloss = 0;

      foreach ($sales as $index => $sale) {
        $totalsale = ($sale->sum_sale_price * $sale->sum_sale_unit) + $totalsale;
        $totalkilo = $sale->sum_sale_unit + $totalkilo;
        $totalbuy = ($sale->sum_purchase_price * $sale->sum_sale_unit) + $totalbuy;
        $totalprofit = $sale->sum_sale_profit + $totalprofit;
        $totalloss = $sale->sum_sale_loss + $totalloss;
      }

       if(count($profit) > 0){
         if ($profit[0]->sum_purchase_price < $profit[0]->sum_sale_price) {
           $sumprofit =   $profit[0]->sum_sale_price - $profit[0]->sum_purchase_price;
           $sumloss =  0;
         } else {
           $sumprofit = 0;
           $sumloss =   $profit[0]->sum_purchase_price - $profit[0]->sum_sale_price;
         }
         Session::flash('msg', 'สรุปยอด ปี'.' '.$year);
         return view('admin.chart.index',['finddate' => $year,'saledate' => $year, 'sales' => $sales, 'profit' => $profit,'sumprofit' => $sumprofit, 'sumloss' => $sumloss,'totalsale'=>$totalsale,'totalbuy'=>$totalbuy,'totalprofit'=>$totalprofit,'totalloss'=>$totalloss,'totalkilo'=>$totalkilo]);
       } else {
         list($day,$month,$year) = explode("/", date("d/m/Y"));
         $newyear = intval($year);
         $newdate = $day."/".$month."/".$year;
         return view('admin.chart.index',['finddate' => null,'profit' => $profit, 'sales' => $sales,'totalsale'=>$totalsale,'totalbuy'=>$totalbuy,'totalprofit'=>$totalprofit,'totalloss'=>$totalloss,'totalkilo'=>$totalkilo]);
       }
    }

    public function find_before($req,$action,$msg)
    {
      $sales = DB::table('sales')
                      ->select('sales.garbage_id','garbages.type','sales.purchase_price as sum_purchase_price','sales.sale_price as sum_sale_price',DB::raw('sum(sales.unit) as sum_sale_unit'),DB::raw('sum(sales.profit) as sum_sale_profit'),DB::raw('sum(sales.loss) as sum_sale_loss'))
                      ->join('garbages', 'sales.garbage_id', '=', 'garbages.id')
                      ->where('sales.dateofsale', $action, $req)
                      ->groupBy('sales.garbage_id')
                      ->orderby('sales.dateofsale','asc')
                      ->get();

      $profit =  DB::table('sales')
                      ->select( DB::raw('sum(purchase_price) as sum_purchase_price'),DB::raw('sum(sale_price) as sum_sale_price'))
                      ->groupBy('garbage_id')
                      ->where('dateofsale', $action, $req)
                      ->orderby('dateofsale','asc')
                      ->get();
      $totalsale = 0;
      $totalbuy = 0;
      $totalkilo = 0;
      $totalprofit = 0;
      $totalloss = 0;

      foreach ($sales as $index => $sale) {
        $totalsale = ($sale->sum_sale_price * $sale->sum_sale_unit) + $totalsale;
        $totalkilo = $sale->sum_sale_unit + $totalkilo;
        $totalbuy = ($sale->sum_purchase_price * $sale->sum_sale_unit) + $totalbuy;
        $totalprofit = $sale->sum_sale_profit + $totalprofit;
        $totalloss = $sale->sum_sale_loss + $totalloss;
      }

       if(count($profit) > 0){
         if ($profit[0]->sum_purchase_price < $profit[0]->sum_sale_price) {
           $sumprofit =   $profit[0]->sum_sale_price - $profit[0]->sum_purchase_price;
           $sumloss =  0;
         } else {
           $sumprofit = 0;
           $sumloss =   $profit[0]->sum_purchase_price - $profit[0]->sum_sale_price;
         }
          if($msg == '7day'){
            Session::flash('msg', 'สรุปยอดย้อนหลัง 7 วัน');
          } else if($msg == 'one_month'){
            Session::flash('msg', 'สรุปยอดย้อนหลัง 1 เดือน');
          } else if($msg == 'three_month'){
            Session::flash('msg', 'สรุปยอดย้อนหลัง 3 เดือน');
          } else if($msg == 'one_year'){
            Session::flash('msg', 'สรุปยอดย้อนหลัง 1 ปี');
          }
         return view('admin.chart.index',['finddate' => null,'saledate' => null, 'sales' => $sales, 'profit' => $profit,'sumprofit' => $sumprofit, 'sumloss' => $sumloss,'totalsale'=>$totalsale,'totalbuy'=>$totalbuy,'totalprofit'=>$totalprofit,'totalloss'=>$totalloss,'totalkilo'=>$totalkilo]);
       } else {
         list($day,$month,$year) = explode("/", date("d/m/Y"));
         $newyear = intval($year);
         $newdate = $day."/".$month."/".$year;
         return view('admin.chart.index',['finddate' => null,'profit' => $profit, 'sales' => $sales,'totalsale'=>$totalsale,'totalbuy'=>$totalbuy,'totalprofit'=>$totalprofit,'totalloss'=>$totalloss,'totalkilo'=>$totalkilo]);
       }
    }


    public function find_custom($start_date,$end_date)
    {
      $s_split = explode("/",$start_date);
      $s_date = $s_split[2]."-".$s_split[1]."-".$s_split[0];
      $e_split = explode("/",$end_date);
      $new_end = intval($e_split[0]) + 1;
      $e_date = $e_split[2]."-".$e_split[1]."-".$new_end;

      $sales = DB::table('sales')
                      ->select('sales.garbage_id','garbages.type','sales.purchase_price as sum_purchase_price','sales.sale_price as sum_sale_price',DB::raw('sum(sales.unit) as sum_sale_unit'),DB::raw('sum(sales.profit) as sum_sale_profit'),DB::raw('sum(sales.loss) as sum_sale_loss'))
                      ->join('garbages', 'sales.garbage_id', '=', 'garbages.id')
                      ->where('sales.dateofsale', '>=', $s_date)
                      ->where('sales.dateofsale', '<=', $e_date)
                      ->groupBy('sales.garbage_id')
                      ->orderby('sales.dateofsale','asc')
                      ->get();

      $profit =  DB::table('sales')
                      ->select( DB::raw('sum(purchase_price) as sum_purchase_price'),DB::raw('sum(sale_price) as sum_sale_price'))
                      ->groupBy('garbage_id')
                      ->where('dateofsale', '>=', $s_date)
                      ->where('dateofsale', '<=', $e_date)
                      ->orderby('dateofsale','asc')
                      ->get();
      $totalsale = 0;
      $totalbuy = 0;
      $totalkilo = 0;
      $totalprofit = 0;
      $totalloss = 0;

      foreach ($sales as $index => $sale) {
        $totalsale = ($sale->sum_sale_price * $sale->sum_sale_unit) + $totalsale;
        $totalkilo = $sale->sum_sale_unit + $totalkilo;
        $totalbuy = ($sale->sum_purchase_price * $sale->sum_sale_unit) + $totalbuy;
        $totalprofit = $sale->sum_sale_profit + $totalprofit;
        $totalloss = $sale->sum_sale_loss + $totalloss;
      }

       if(count($profit) > 0){
         if ($profit[0]->sum_purchase_price < $profit[0]->sum_sale_price) {
           $sumprofit =   $profit[0]->sum_sale_price - $profit[0]->sum_purchase_price;
           $sumloss =  0;
         } else {
           $sumprofit = 0;
           $sumloss =   $profit[0]->sum_purchase_price - $profit[0]->sum_sale_price;
         }
         Session::flash('msg', 'สรุปยอด จากวันที่ '.$start_date.' '.'ถึงวันที่'.' '.$end_date);
         return view('admin.chart.index',['finddate' => null,'saledate' => null, 'sales' => $sales, 'profit' => $profit,'sumprofit' => $sumprofit, 'sumloss' => $sumloss,'totalsale'=>$totalsale,'totalbuy'=>$totalbuy,'totalprofit'=>$totalprofit,'totalloss'=>$totalloss,'totalkilo'=>$totalkilo]);
       } else {
         list($day,$month,$year) = explode("/", date("d/m/Y"));
         $newyear = intval($year);
         $newdate = $day."/".$month."/".$year;
         return view('admin.chart.index',['finddate' => null,'profit' => $profit, 'sales' => $sales,'totalsale'=>$totalsale,'totalbuy'=>$totalbuy,'totalprofit'=>$totalprofit,'totalloss'=>$totalloss,'totalkilo'=>$totalkilo]);
       }
    }
}
