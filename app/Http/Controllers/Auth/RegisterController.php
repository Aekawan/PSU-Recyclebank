<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers {
      redirectPath as laravelRedirectPath;
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    public function redirectPath()
    {
      $uid = Auth::user()->id;
      $uidlength = strlen((string)$uid);
       if ($uidlength == 1){
         $new_uid = "RB000".$uid;
       }else if ($uidlength == 2) {
               $new_uid = "RB000".$uid;
       }else if ($uidlength == 3) {
         $new_uid = "RB00".$uid;
       }else if ($uidlength == 4) {
         $new_uid = "RB0".$uid;
       }else if ($uidlength == 5) {
         $new_uid = "RB".$uid;
       } else {
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
     protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'role' =>$data['role'],
        ]);
    }
}
