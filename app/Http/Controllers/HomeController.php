<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\News;
use App\Garbage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('admin',['except' => 'index','check']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();
        $slide = News::where('slid_on','=', 'true')->get();
        $garbages = Garbage::orderBy('updated_at', 'desc')->get();
        return view('home',['slide' => $slide,'news' => $news,'garbages' => $garbages]);
    }

    public function check()
    {
      if(isset(Auth::user()->role) && Auth::user()->role == "admin"){
        return redirect('dashboard');
      } else {
        return redirect('/');
      }
    }

    public function dashboard()
    {
      return view('admin.dashboard');
    }
}
