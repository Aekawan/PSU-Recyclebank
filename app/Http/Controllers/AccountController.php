<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Account;
use App\User;
use App\Garbage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        //fetch all posts data
        // $accounts = Account::get()->user;
        $user_data = User::where('role','!=','admin')->get();
        $uid_data = [];
        foreach ($user_data as $index=> $user) {
          $uid = $user->id;
          $new_uid = genUid($uid);
           array_push($uid_data,$new_uid);
        }
        //pass posts data to view and load list view
        return view('admin.account.index',['users' => $user_data,'uid' => $uid_data]);
    }

    public function detail(Request $request){

        $newuid = $request->input('username');
        $uid = extractUid($newuid);
        if($uid != 0){
        $userinfo = DB::table('users')
                          ->where('users.id','=',$uid)
                          ->get();

          $details = DB::table('accounts')
                          ->select('accounts.id','accounts.user_id','accounts.garbage_id','accounts.purchase_price','accounts.unit',
                          'accounts.deposit','accounts.withdraw','accounts.balance','accounts.created_at','users.firstname','users.lastname','users.username',
                          'users.password','users.role','garbages.type')
                          ->join('users', 'accounts.user_id', '=', 'users.id')
                          ->join('garbages', 'accounts.garbage_id', '=', 'garbages.id')
                          ->where('users.id','=',$uid)
                          ->orderby('accounts.created_at','asc')
                          ->get();

          return view('admin.account.detail',['userinfo' => $userinfo,'details' => $details]);
        } else {
          return view('admin.account.detail',['userinfo' => null,'details' => null]);
        }

    }

    public function deposit($user_id)
    {
      $users = User::find($user_id);

      $garbages = Garbage::all();

      $accounts = DB::table('accounts')->select('balance')->where('user_id','=',$user_id)->take(1)->orderBy('created_at', 'desc')->get();
      if (count($accounts) > 0) {
          $balance = $accounts[0]->balance;
      } else {
          $balance = 0;

      }

      return view('admin.account.deposit',['users' => $users,'garbages' => $garbages,'balance' => $balance ]);
    }

    public function insert(Request $request)
    {
      $this->validate($request, [
        'user_id' => 'required',
        'garbage_id' => 'required',
        'purchase_price' => 'required',
        'unit' => 'required',
        'deposit' => 'required',
        'withdraw' => 'required',
        'balance' => 'required'
      ]);

      $input = $request->all();
      Account::create($input);
      $user = User::find($request->input('user_id'));
      Session::flash('success_msg', 'ฝากสำเร็จ!');
      $newuid = genUid($user->id);
      return redirect('admin/account/detail?username='.$newuid);
    }


    public function withdraw($user_id)
    {
      $users = User::find($user_id);

      $garbages = Garbage::all();

      $accounts = DB::table('accounts')->select('balance')->where('user_id','=',$user_id)->take(1)->orderBy('created_at', 'desc')->get();
      if (count($accounts) > 0) {
          $balance = $accounts[0]->balance;
      } else {
          $balance = 0;
      }
      return view('admin.account.withdraw',['users' => $users,'garbages' => $garbages,'balance' => $balance ]);
    }


    public function update(Request $request)
    {
      $this->validate($request, [
        'user_id' => 'required',
        'garbage_id' => 'required',
        'purchase_price' => 'required',
        'unit' => 'required',
        'deposit' => 'required',
        'withdraw' => 'required',
        'balance' => 'required'
      ]);
      $accounts = DB::table('accounts')->select('balance')->where('user_id','=',$request->input('user_id'))->take(1)->orderBy('created_at', 'desc')->get();
      if ($request->input('withdraw') <= 0 || $request->input('withdraw') > $accounts[0]->balance ) {
        Session::flash('success_msg', 'การถอนผิดพลาด!');
        return redirect('admin/account/withdraw/'.$request->input('user_id'));
      } else {
      $input = $request->all();
      Account::create($input);
      $user = User::find($request->input('user_id'));
      Session::flash('success_msg', 'ถอนสำเร็จ!');
      $newuid = genUid($user->id);
      return redirect('admin/account/detail?username='.$newuid);
      }

    }






}
