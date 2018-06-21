@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 text-center">
      <h3>ประวัติส่งขายขยะ</h3>
      <hr class="gd">
  </div>
    <div class="row">
      <div class="col-lg-12 text-center" style="margin-top:20px">
        <a href="{{route('sale.add')}}" class="btn btn-lg btn-green" type="button" name="button"><i class="fa fa-plus"></i> ส่งขายขยะ</a>
      </div>
      @if(Session::has('success_msg'))
      <div class="col-lg-12" style="margin-top:20px">
         <div class="alert alert-success">{{ Session::get('success_msg') }}</div>
      </div>
     @endif
     <div class="col-lg-12 col-md-12 col-xs-12 text-center" style="margin-top:20px;background-color:#ffffff">
     @if (isset($sales))
       <table class="table table-hover">
         <thead>
           <tr class="text-center">
             <th class="text-center">#</th>
             <th class="text-center">ประเภทขยะ</th>
             <th class="text-center">ราคาที่รับซื้อ(บาท/กิโลกรัม)</th>
             <th class="text-center">ราคาที่ขาย(บาท/กิโลกรัม)</th>
             <th class="text-center">จำนวน (กิโลกรัม)</th>
             <th class="text-center">ราคาขายสุทธิ</th>
             <th class="text-center">กำไร</th>
             <th class="text-center">ขาดทุน</th>
             <th class="text-center">วันที่ขาย</th>
           </tr>
         </thead>
         <tbody>
           @foreach ($sales as $index => $sale)
             <tr>
               <td>{{ $index +1}}</td>
               <td>{{ $sale->type }}</td>
               <td>{{ $sale->purchase_price }}</td>
                <td>{{ $sale->sale_price }}</td>
               <td>{{ $sale->unit }}</td>
               <td>{{ $sale->sale_price * $sale->unit }}</td>
               <td>{{ $sale->profit }}</td>
               <td>{{ $sale->loss }}</td>
               <td>{{ $sale->dateofsale }}</td>
               <td>
                 <a href="{{ route('sale.edit',$sale->id) }}" type="button" class="btn btn-warning" name="button"><i class="fa fa-pencil"></i></a>
                 <a href="{{ route('sale.delete',$sale->id)}}" onclick="return confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?');" type="button" class="btn btn-danger" name="button"><i class="fa fa-trash"></i> </a>
               </td>
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
