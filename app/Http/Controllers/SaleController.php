<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Sale;
use App\Garbage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
      $sales = DB::table('sales')
                      ->select('sales.id','sales.user_id','sales.garbage_id','sales.purchase_price','sales.unit',
                      'sales.sale_price','sales.profit','sales.loss','sales.dateofsale','sales.created_at','users.firstname','users.lastname','users.username',
                      'garbages.type')
                      ->join('users', 'sales.user_id', '=', 'users.id')
                      ->join('garbages', 'sales.garbage_id', '=', 'garbages.id')
                      ->orderby('sales.created_at','asc')
                      ->get();
      //pass posts data to view and load list view
      return view('admin.sale.index',['sales' => $sales]);
    }


    public function add()
    {
      $garbages = Garbage::all();
      return view('admin.sale.add',['garbages' => $garbages]);
    }


    public function insert(Request $request)
    {
      $this->validate($request, [
        'user_id' => 'required',
        'garbage_id' => 'required',
        'purchase_price' => 'required',
        'unit' => 'required',
        'sale_price' => 'required',
        'profit' => 'required',
        'loss' => 'required',
        'dateofsale' => 'required'
      ]);

      if($request->input('garbage_id') != 0){
              $inputdate = $request->input('dateofsale');
              $input = $request->all();

            //  $time = strtotime('11/16/2017');
            //  $newformat = date('Y-m-d',$time);

              list($day,$month,$year) = explode("/", $inputdate);
              $newdate = $year."-".$month."-".$day;
              $input['dateofsale'] = $newdate;
              Sale::create($input);
              Session::flash('success_msg', 'เพิ่มข้อมูลการขายสำเร็จ!');
              return redirect('admin/sale');
      } else {
             Session::flash('success_msg', 'เพิ่มข้อมูลการขายไม่สำเร็จ!');
              return redirect('admin/sale');
      }

   
    }

    public function edit($id){
        //get post data by id
        $sale = Sale::find($id);
        $garbages = Garbage::all();
        //load form view
        return view('admin.sale.edit', ['sale' => $sale,'garbages' => $garbages]);
    }

    public function update($id, Request $request){
      $this->validate($request, [
        'user_id' => 'required',
        'garbage_id' => 'required',
        'purchase_price' => 'required',
        'unit' => 'required',
        'sale_price' => 'required',
        'profit' => 'required',
        'loss' => 'required'
      ]);

        //get post data
        $inputdate = $request->input('dateofsale');
        $input = $request->all();

      //  $time = strtotime('11/16/2017');
      //  $newformat = date('Y-m-d',$time);


        //update post data
        Sale::find($id)->update($input);

        //store status message
        Session::flash('success_msg', 'แก้ไขข้อมูลสำเร็จ');
        return redirect()->route('sale.index');
    }

    public function delete($id){
        //update post data
        Sale::find($id)->delete();

        //store status message
        Session::flash('success_msg', 'ลบข้อมูลสำเร็จ!');

        return redirect()->route('sale.index');
    }




}
