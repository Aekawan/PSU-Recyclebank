<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\User;
use App\Garbage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
      $uid = Auth::user()->id;
      $userinfo = User::find($uid);

      $new_uid = newUserId($uid);

      return view('profile',['userinfo' => $userinfo, 'uid' => $new_uid]);
    }


    public function edit($id){
        //get post data by id
      //  $sale = Sale::find($id);
      //  $garbages = Garbage::all();
        //load form view
        return view('admin.sale.edit');
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
        // $input = $request->all();

        //update post data
        //Sale::find($id)->update($input);

        //store status message
    //    Session::flash('success_msg', 'แก้ไขข้อมูลสำเร็จ');
        return redirect()->route('sale.index');
    }






}
