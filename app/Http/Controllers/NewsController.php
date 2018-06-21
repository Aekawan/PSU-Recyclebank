<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\News;
use App\Garbage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin',['except' => 'show']);
    } 

    public function index(){
      $news = News::all();
      return view('admin.news.index',['news' => $news]);
    }

    public function add(){
        return view('admin.news.add');
    }

    public function insert(Request $request){
      $this->validate($request, [
        'title' => 'required',
        'type' => 'required',
        'content' => 'required',
        'img_preview' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        'img_full' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        'url' => 'required',
      ]);
      $input = $request->all();

      $imagepreview = $request->file('img_preview');
      $input['img_preview'] = "preview".time().'.'.$imagepreview->getClientOriginalExtension();
      $destinationPathPreview = public_path('/img/news/preview');
      $imagepreview->move($destinationPathPreview, $input['img_preview']);

      $imagefull = $request->file('img_full');
      $lastnamefile = strtolower($imagepreview->getClientOriginalExtension());
      $input['img_full'] = "full".time().'.'.$lastnamefile;
      $destinationPathFull = public_path('/img/news/full');
      $imagefull->move($destinationPathFull, $input['img_full']);

      $news = News::create($input);
      Session::flash('success_msg', 'เพิ่มข่าวสารสำเร็จ!');
      return redirect('news/show/'.$news->id);
    }

    public function show($id){
        $news = News::find($id);
        return view('admin.news.show',['news' => $news]);
    }

    public function edit($id)
    {
      //get post data by id
      $news = News::find($id);
      //load form view
      return view('admin.news.edit', ['news' => $news]);
    }

    public function update($id,Request $request)
    {
      $this->validate($request, [
        'title' => 'required',
        'type' => 'required',
        'content' => 'required',
        'url' => 'required',
      ]);

    
     
      $input = $request->all();

      if (isset($input['slid_on'])) {
               $input['slid_on'] = "true";
      } else {
              $input['slid_on'] = "";
      }

      isset($input['slid_on']) ? $input['slid_on'] : "false"; 

      if ($request->input('img_preview') != null){
      $imagepreview = $request->file('img_preview');
      $input['img_preview'] = "preview".time().'.'.$imagepreview->getClientOriginalExtension();
      $destinationPathPreview = public_path('/img/news/preview');
      $imagepreview->move($destinationPathPreview, $input['img_preview']);
      $imagefull = $request->file('img_full');
      $lastnamefile = strtolower($imagepreview->getClientOriginalExtension());
      }

      if ($request->input('img_full') != null){
      $input['img_full'] = "full".time().'.'.$lastnamefile;
      $destinationPathFull = public_path('/img/news/full');
      $imagefull->move($destinationPathFull, $input['img_full']);
      }

      $news = News::find($id)->update($input);
      Session::flash('success_msg', 'อัพเดตสำเร็จ!');
      return redirect('news/show/'.$id);
    }

    public function delete($id)
    {
      //update post data
      News::find($id)->delete();

      //store status message
      Session::flash('success_msg', 'ลบข้อมูลสำเร็จ!');

      return redirect()->route('news.index');
    }


}
