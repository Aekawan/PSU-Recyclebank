<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Garbage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class GarbageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

      $garbages = Garbage::all();

      //pass posts data to view and load list view
      return view('admin.garbage.index',['garbages' => $garbages]);
    }


    public function add()
    {
      return view('admin.garbage.add');
    }


    public function insert(Request $request)
    {
      $this->validate($request, [
        'type' => 'required',
        'purchase_price' => 'required',
        'detail' => 'required'
      ]);
      
      $input = $request->all();
      Garbage::create($input);

      Session::flash('success_msg', 'เพิ่มข้อมูลสำเร็จ!');
      return redirect('admin/garbage');
    }

    public function edit($id){
        //get post data by id
        $garbage = Garbage::find($id);
        //load form view
        return view('admin.garbage.edit', ['garbage' => $garbage]);
    }

    public function update($id, Request $request){
        //validate post data
        $this->validate($request, [
          'type' => 'required',
          'purchase_price' => 'required',
          'detail' => 'required'
        ]);

        //get post data
        $input = $request->all();

        //update post data
        Garbage::find($id)->update($input);

        //store status message
        Session::flash('success_msg', 'แก้ไขข้อมูลสำเร็จ');

        return redirect()->route('garbage.index');
    }

    public function delete($id){
        //update post data
        Garbage::find($id)->delete();

        //store status message
        Session::flash('success_msg', 'ลบข้อมูลสำเร็จ!');

        return redirect()->route('garbage.index');
    }

    public function purchaseprice($id){
       $purchaseprice = Garbage::find($id);
       //$json = json_encode($purchaseprice);
       return $purchaseprice;
    }


}
