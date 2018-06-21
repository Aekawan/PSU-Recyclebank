@extends('layouts.app')

@section('content')
<div class="row">
      @if(Session::has('success_msg'))
      <div class="col-lg-12" style="margin-top:20px">
         <div class="alert alert-success">{{ Session::get('success_msg') }}</div>
      </div>
     @endif
     <div class="col-lg-12 col-md-12 col-xs-12 text-center">
       <div class="col-lg-12">
         <div class="panel panel-default">
           <div class="panel-heading">
             <div class="text-center">
               <h3>ข้อมูลส่วนตัว</h3>
             </div>
           </div>
       <div class="panel-body">
         <div class="row">
           <div class="col-lg-12">
             <img src="http://icons.iconarchive.com/icons/icons8/ios7/512/Users-User-Male-2-icon.png" style="width:200px;margin: 0 auto;" class="img-circle img-responsive">
           </div>
         </div>
         <div class="row">
           <div class="col-lg-4">
           </div>
           <div class="col-lg-8 text-left">
             @if(isset(Auth::user()->role) && Auth::user()->role != "admin")
               <h3>รหัสฝาก/ถอนเงิน: {{$uid}}</h3>
             @endif
             <h3>ชื่อผู้ใช้: {{$userinfo->username}}</h3>
             <h3>ชื่อ: {{$userinfo->firstname}}  นามสกุล: {{$userinfo->lastname}}</h3>
             <h3>สถานะ: {{$userinfo->role}}</h3>
           </div>
         </div>
       </div>
       <div class="panel-footer">
         <div class="row">
           <div class="col-lg-12">
             <a href="#" class="btn btn-lg btn-success">แก้ไขข้อมูลส่วนตัว</a>
           </div>
         </div>
       </div>
     </div>
     </div>
    </div>
@endsection
