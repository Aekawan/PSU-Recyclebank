<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\Session;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
      redirectPath as laravelRedirectPath;
    }


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/index';

    public function redirectPath()
    {
       $uid = Auth::user()->id;
       $uidlength = strlen((string)$uid);
        if ($uidlength == 1){
        	$new_uid = "RB0000".$uid;
        }else if ($uidlength == 2) {
                $new_uid = "RB000".$uid;
        }else if ($uidlength == 3) {
        	$new_uid = "RB00".$uid;
        }else if ($uidlength == 4) {
        	$new_uid = "RB0".$uid;
        }else if ($uidlength == 5) {
        	$new_uid = "RB".$uid;
        }else {
        	$new_uid = null;
        }
    // Do your logic to flash data to session...
    if(Auth::user()->role != "admin") {
    session()->flash('login', $new_uid);
    }

    // Return the results of the method we are overriding that we aliased.
    return $this->laravelRedirectPath();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

     public function username()
    {
        return 'username';
    }

    protected function credentials(Request $request)
    {
        $field = filter_var($request->get('username'), FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        return [
             $field => $request->get('username'),
            'password' => $request->password,
        ];
    }

}
