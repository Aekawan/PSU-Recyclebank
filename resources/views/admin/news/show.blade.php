@extends('layouts.app')

@section('content')
<div class="row">
  @if ($message = Session::get('success_msg'))
  <div class="col-lg-12">
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    </div>
@endif
@if(isset($news))
  <div class="col-lg-12">
    <form action="">
    <div class="panel panel-default">
      <div class="panel-heading  backgroung-gd">
          <h4 class="white-color">[ {{$news->type}} ] {{$news->title}}</h4>
      </div>
  <div class="panel-body">
    <img src="{{asset('img/news/full/'.$news->img_full)}}" style="width:100%" alt="">
   <div class="col-lg-12" style="margin-top:10px">
      {!! $news->content !!}
   </div>
</div>
  <div class="panel-footer">
    @if(isset(Auth::user()->role) && Auth::user()->role == "admin")
    <div class="text-center">
      <a href="#" onclick="goBack()" type="button" name="button" class="btn btn-lg btn-outline-green-back" style="width:150px">ย้อนกลับ</a>
      <a href="{{route('news.edit',$news->id)}}" type="button" id="btn-submit" class="btn btn-lg btn-green" style="width:150px;margin-left:20px">แก้ไข</a>
    </div>
    @endif
  </div>
  </form>
</div>
  </div>
  @endif
</div>
@endsection
