@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 text-center">
      <h3>ประวัติการฝาก/ถอน</h3>
      <hr class="gd">
  </div>
  <div class="row">
    <div class="col-lg-12" style="margin-top:20px" style="background-color:#FFFFFF">
      @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if (isset($accounts))
    <table class="table" style="background-color:#FFFFFF">
    <thead>
      <th>#</th>
      <th>ประเภทขยะ</th>
      <th>ราคารับซื้อ</th>
      <th>จำนวน/กิโลกรัม</th>
      <th>ฝาก</th>
      <th>ถอน</th>
      <th>คงเหลือ</th>
      <th>วันที่ทำรายการ</th>
    </thead>
    <tbody>
    @foreach ($accounts as $index => $account)
      <tr>
        <td>{{ $index + 1 }}</td>
        @if ($account->type == "0")
        <td>-</td>
        @else
        <td>{{ $account->type }}</td>
        @endif
        @if ($account->purchase_price == 0)
        <td>-</td>
        @else
        <td>{{ $account->purchase_price }}</td>
        @endif
        @if ($account->unit == 0)
        <td>-</td>
        @else
        <td>{{ $account->unit }}</td>
        @endif
        @if ($account->deposit == 0)
        <td></td>
        @else
        <td>{{  $account->deposit }}</td>
        @endif
        @if ($account->withdraw == 0)
        <td></td>
        @else
        <td>- {{ $account->withdraw }}</td>
        @endif
        <td>{{ $account->balance }}</td>
        <td>{{ $account->updated_at }}</td>
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
