@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 text-center">
      <h3>หน้าหลัก ฝาก/ถอน</h3>
      <hr class="gd">
  </div>
  <div class="row">
    <div class="col-md-12 text-center" style="margin-top:5px">
      <h4>ค้นหาบัญชี (ใช้รหัสฝาก/ถอน)</h4>
    </div>
    <div class="col-md-12 text-center" style="margin-top:10px">
      <form class="form-inline" action="{{route('account.detail')}}">
        <input class="form-control" name="username" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success" type="submit">Search</button>
      </form>
    </div>
    <div class="col-lg-12" style="margin-top:30px" style="background-color:#FFFFFF">
      @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if (isset($users))
    <table class="table" style="background-color:#FFFFFF">
    <thead>
      <th>#</th>
      <th>รหัสฝาก/ถอน</th>
      <th>ชื่อ</th>
      <th>นามสกุล</th>
      <th>สถานะ</th>
      <th></th>
    </thead>
    <tbody>
    @foreach ($users as $index => $user)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $uid[$index] }}</td>
        <td>{{ $user->firstname }}</td>
        <td>{{ $user->lastname }}</td>
        <td>{{matchRole($user->role)}}</td>
        <td><a href="account/detail?username={{$uid[$index]}}" class="btn btn-info"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
      </tr>
    @endforeach
  </tbody>
  </table>
    @else
     <div class="alert alert-warning" role="alert">ไม่พบข้อมูลรายการฝาก/ถอน </div>
    @endif
    </div>
  </div>
</div>
@endsection
