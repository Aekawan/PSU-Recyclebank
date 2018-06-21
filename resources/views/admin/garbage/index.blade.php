@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 text-center">
      <h3>ราคารับซื้อ</h3>
      <hr class="gd">
  </div>
    <div class="row">
      <div class="col-lg-12 text-center" style="margin-top:10px">
        <a href="{{route('garbage.add')}}" class="btn btn-lg btn-green" type="button" name="button" style="width:200px"><i class="fa fa-plus"></i> เพิ่มประเภทขยะ</a>
      </div>
      @if(Session::has('success_msg'))
      <div class="col-lg-12" style="margin-top:20px">
         <div class="alert alert-success">{{ Session::get('success_msg') }}</div>
      </div>
     @endif
      <div class="col-lg-12 col-md-12 col-xs-12 text-center" style="margin-top:30px;background-color:#ffffff">
      @if (isset($garbages))
        <table class="table table-hover">
          <thead>
            <tr class="text-center" style="margin-top:10px">
              <th class="text-center">#</th>
              <th class="text-center">ประเภทขยะ</th>
              <th class="text-center">รายละเอียด</th>
              <th class="text-center">ราคารับซื้อ(บาท)/กิโลกรัม</th>
              <th class="text-center">อัพเดตวันที่</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($garbages as $index => $garbage)
            @if($garbage->id != 1)
              <tr>
                <td>{{ $index }}</td>
                <td>{{ $garbage->type }}</td>
                <td>{{ $garbage->detail }}</td>
                <td>{{ $garbage->purchase_price }} บาท/กิโลกรัม</td>
                <td>{{ $garbage->updated_at }}</td>
                <td>
                  <a href="{{ route('garbage.edit',$garbage->id) }}" type="button" class="btn btn-warning" name="button"><i class="fa fa-pencil"></i></a>
                  <a href="{{ route('garbage.delete',$garbage->id) }}" onclick="return confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?');" type="button" class="btn btn-danger" name="button"><i class="fa fa-trash"></i> </a>
                </td>
              </tr>
              @endif
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
