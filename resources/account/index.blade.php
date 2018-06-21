@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 text-center" style="border-bottom: 5px solid #212121;">
      <h3>หน้าหลัก ฝาก/ถอน</h3>
  </div>
  <div class="row">
    <div class="col-md-12 text-center" style="margin-top:20px">
      <h4>ค้นหาบัญชี (ใช้ Username)</h4>
    </div>
    <div class="col-md-12 text-center" style="margin-top:10px">
      <form class="form-inline" action="{{route('account.detail')}}">
        <input class="form-control" name="username" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success" type="submit">Search</button>
      </form>
    </div>
    <div class="col-lg-12" style="margin-top:20px" style="background-color:#FFFFFF">
      @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if (!isset($account))
    <table class="table" style="background-color:#FFFFFF">
    <thead>
      <th>#</th>
      <th>ชื่อ</th>
      <th>นามสกุล</th>
      <th>บทบาท</th>
      <th>ประเภทขยะ</th>
      <th>ราคารับซื้อ</th>
      <th>จำนวน/กิโลกรัม</th>
      <th>ฝาก</th>
      <th>ถอน</th>
      <th>คงเหลือ</th>
    </thead>
    <tbody>
    @foreach ($accounts as $index => $account)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $account->firstname }}</td>
        <td>{{ $account->lastname }}</td>
        <td>{{ $account->role }}</td>
        <td>{{ $account->type }}</td>
        <td>{{ $account->purchase_price }}</td>
        <td>{{ $account->unit }}</td>
        <td>{{ $account->deposit }}</td>
        <td>{{ $account->withdraw }}</td>
        <td>{{ $account->balance }}</td>
      </tr>
    @endforeach
  </tbody>
  </table>
    @else
     <div class="alert alert-warning" role="alert">ไม่มีข้อมูล</div>
    @endif
    </div>
  </div>
</div>

@endsection
