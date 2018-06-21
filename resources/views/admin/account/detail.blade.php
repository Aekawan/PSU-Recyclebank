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
<div class="col-lg-12 mt-20">
  <div class="panel panel-default">
    <div class="panel-heading backgroung-gd">
      <div class="text-center">
        <h4 class="white-color">บัญชี ฝาก/ถอน</h4>
      </div>
    </div>
<div class="panel-body">
  @if (isset($userinfo) && $userinfo->count() > 0)
  <div class="col-lg-12" style="margin-bottom:20px">
    <h4>รหัสฝาก/ถอนเงิน: {{newUserId($userinfo[0]->id)}}</h4>
    <h4>ชื่อผูัใช้: {{$userinfo[0]->username}}</h4>
    <h4>ชื่อ: {{$userinfo[0]->firstname}}</h4>
    <h4>นามสกุล: {{$userinfo[0]->lastname}}</h4>
    <h4>สถานะ: {{$userinfo[0]->role}}</h4>
  </div>

  @if (isset($details) && $details->count() > 0)
    <div class="col-lg-12">
      <table class="table" style="background-color:#FFFFFF">
      <thead>
        <th>ประเภทขยะ</th>
        <th>ราคารับซื้อ</th>
        <th>จำนวน/กิโลกรัม</th>
        <th>ฝาก</th>
        <th>ถอน</th>
        <th>คงเหลือ</th>
        <th>วัน/เวลา ที่ทำรายการ</th>
      </thead>
      <tbody>
      @foreach ($details as $detail)
        <tr>
            @if ($detail->garbage_id == 1)
            <td>{{ "-" }}</td>
            <td>{{ "-" }}</td>
            <td>{{ "-" }}</td>
            <td>{{ "-" }}</td>
            <td>{{ $detail->withdraw }}</td>
            <td>{{ $detail->balance }}</td>
            <td>{{ $detail->created_at }}</td>
            @else
            <td>{{ $detail->type }}</td>
            <td>{{ $detail->purchase_price }}</td>
            <td>{{ $detail->unit }}</td>
            <td>{{ $detail->deposit }}</td>
            <td>{{ $detail->withdraw }}</td>
            <td>{{ $detail->balance }}</td>
            <td>{{ $detail->created_at }}</td>
            @endif
        </tr>
      @endforeach
    </tbody>
    </table>
    </div>
    @else
    <div class="col-lg-12">
       <div class="alert alert-warning" role="alert">ไม่มีข้อมูลการฝากถอน</div>
    </div>
    @endif
    @else
    <div class="col-lg-12">
       <div class="alert alert-warning" role="alert">ไม่พบข้อมูลผู้ใช้</div>
    </div>
    </div>
    @endif
</div>
<div class="panel-footer">
  @if (isset($userinfo) && $userinfo->count() > 0)
  <div class="text-center">
    <a href="{{ route('account.withdraw', $userinfo[0]->id) }}" type="button" class="btn btn-lg btn-red" style="width:150px"  name="button">- ถอน</a>
    <a href="{{ route('account.deposit', $userinfo[0]->id) }}" type="button" class="btn btn-lg btn-green" style="margin-left:50px;width:150px" name="button">+ ฝาก</a>
  </div>
  @else 
  <div class="text-center"> <button onclick="goBack()" type="button" class="btn btn-lg btn-outline-green-back" name="button" style="width:200px">ย้อนกลับ</button></div>
  
  @endif

</div>
</div>
</div>
</div>
@endsection
