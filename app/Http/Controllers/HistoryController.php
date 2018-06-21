<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Auth;
use App\Account;
use App\User;
use App\Garbage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request){
        $query = $request->input('username');

        $userinfo = DB::table('users')
                        ->where('users.id','=', Auth::user()->id)
                        ->get();

        $accounts = DB::table('accounts')
                        ->select('accounts.id','accounts.user_id','accounts.garbage_id','accounts.purchase_price','accounts.unit',
                        'accounts.deposit','accounts.withdraw','accounts.balance','accounts.created_at','accounts.updated_at','users.firstname','users.lastname','users.username',
                        'users.password','users.role','garbages.type')
                        ->join('users', 'accounts.user_id', '=', 'users.id')
                        ->join('garbages', 'accounts.garbage_id', '=', 'garbages.id')
                        ->where('users.username','=',Auth::user()->username)
                        ->orderby('accounts.created_at','asc')
                        ->get();

        return view('user.history.index',['userinfo' => $userinfo,'accounts' => $accounts]);
    }
}
