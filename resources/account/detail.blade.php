@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 text-center" style="border-bottom: 5px solid #212121;">
      <h3>บัญชี ฝาก/ถอน</h3>
  </div>
  <div class="row">

    <div class="col-lg-12" style="margin-top:20px" style="background-color:#FFFFFF">
      @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if (isset($details) && $details->count() > 0)
    <div class="col-lg-12" style="margin-bottom:20px">
      <h3>ชื่อผูัใช้: {{$details[0]->username}}</h3>
      <h3>ชื่อ: {{$details[0]->firstname}}</h3>
      <h3>นามสกุล: {{$details[0]->lastname}}</h3>
      <h3>บทบาท: {{$details[0]->role}}</h3>
    </div>
    <table class="table" style="background-color:#FFFFFF">
    <thead>
      <th>ประเภทขยะ</th>
      <th>ราคารับซื้อ</th>
      <th>จำนวน/กิโลกรัม</th>
      <th>ฝาก</th>
      <th>ถอน</th>
      <th>คงเหลือ</th>
    </thead>
    <tbody>
    @foreach ($details as $detail)
      <tr>
        <td>{{ $detail->type }}</td>
        <td>{{ $detail->purchase_price }}</td>
        <td>{{ $detail->unit }}</td>
        <td>{{ $detail->deposit }}</td>
        <td>{{ $detail->withdraw }}</td>
        <td>{{ $detail->balance }}</td>
      </tr>
    @endforeach
  </tbody>
  </table>
  <div class="row">
    <div class="col-lg-12 text-center">
      <a href="{{ route('account.deposit', $details[0]->user_id) }}" type="button" class="btn btn-lg btn-success" name="button">+ ฝาก</a>
      <a href="{{ route('account.withdraw', $details[0]->user_id) }}" type="button" class="btn btn-lg btn-danger" style="margin-left:50px" name="button">- ถอน</a>
    </div>
  </div>
    @else
     <div class="alert alert-warning" role="alert">ไม่มีข้อมูล</div>
    @endif
    </div>
  </div>
</div>

@endsection
