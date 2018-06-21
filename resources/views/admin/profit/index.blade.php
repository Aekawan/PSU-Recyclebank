@extends('layouts.app')

@section('content')
<div class="row">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-xs-12 text-center" style="margin-top:20px;">
        <div class="panel panel-default">
          <div class="panel-heading backgroung-gd" style="padding:1px"><h3 class="white-color">คิดกำไร/ขาดทุน</h3></div>
          <div class="panel-body">
            <!--
              <div class="col-lg-12" style="margin-bottom:20px">
                <a href="{{ route('profit.index')}}" type="button" class="btn btn-danger" name="button" style="width:200px">คิดกำไร/ขาดทุนรวม</a>
                <a href="{{ route('profit.type')}}" type="button" class="btn btn-info" name="button">คิดกำไร/ขาดทุนแยกตามประเภท</a>
              </div>
            -->
              <div class="col-lg-3">
              </div>
              <div class="col-lg-6">
                <form action="{{ route('profit.find') }}">
                  {{ csrf_field() }}
              <div class="form-group">
                <label class="control-label col-lg-12 text-left" > เลือกการดูข้อมูลกำไร/ขาดทุน</label>
                <div class="col-lg-12">
                  <select class="form-control" name="find" id="selected_find">
                    <option value="today">วันนี้</option>
                    <option value="date">รายวัน</option>
                    <option value="month">รายเดือน</option>
                    <option value="year">รายปี</option>
                    <option value="7day">ย้อนหลัง7วัน</option>
                    <option value="one_month">ย้อนหลัง 1 เดือน</option>
                    <option value="three_month">ย้อนหลัง 3 เดือน</option>
                    <option value="one_year">ย้อนหลัง 1 ปี</option>
                    <option value="custom">กำหนดเอง</option>
                  </select>
                  <br>
                </div>
              </div>
                <div class="form-group" id="dynamic_find">
                   <input type="hidden" name="find" value="today" >
              </div>
              <button type="submit" class="btn btn-lg btn-outline-green" style="width:100px" name="button">ค้นหา</button>
              </form>

              @if(isset($profit) && count($profit) > 0)
              <div class="form-group">
                <br>
                @if($message = Session::get('msg'))
                <h4>{{$message}}</h4>
                @endif
              </div>
                      @elseif(count($profit) == 0)
                      <div class="col-lg-12" style="margin-top:20px">
                         <div class="alert alert-warning">ไม่พบข้อมูลการขาย</div>
                      </div>
                      @else
                      <div class="col-lg-12" style="margin-top:20px">
                         <div class="alert alert-warning">โปรดกดค้นหาเพื่อดูข้อมูล กำไร/ขาดทุน</div>
                      </div>
                      @endif
              </div>
              <div class="col-lg-3">

              </div>
              @if(isset($profit) && count($profit) > 0)
              <div class="col-lg-12">
               <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center">รายการ</th>
                    <th class="text-center">กิโลกรัม/รวม</th>
                    <th class="text-center">รับซื้อสุทธิ</th>
                    <th class="text-center">ขายได้สุทธิ</th>
                    <th class="text-center">กำไร</th>
                    <th class="text-center">ขาดทุน</th>
                  </tr>
                </thead>
                <tbody>

                   @foreach ($sales as $index => $sale)
                   <tr>
                   <td>{{ $sale->type }}</td>
                   <td>{{ $sale->sum_sale_unit }}</td>
                   <td>{{ $sale->sum_purchase_price * $sale->sum_sale_unit  }}</td>
                   <td>{{ $sale->sum_sale_price * $sale->sum_sale_unit  }}</td>
                   <td>{{ $sale->sum_sale_profit }}</td>
                   <td>{{ $sale->sum_sale_loss }}</td>
                   </tr>
                   @endforeach

                </tbody>
                <tfoot>
                  <tr>
                    <th class="text-center">รวม</th>
                    <th class="text-center">{{$totalkilo}}</th>
                    <th class="text-center">{{$totalbuy}}</th>
                    <th class="text-center">{{$totalsale}}</th>
                    <th class="text-center">{{$totalprofit}}</th>
                    <th class="text-center">{{$totalloss}}</th>
                  </tr>
                </tfoot>
              </table>
              </div>
              @endif
          </div>
           <div class="panel-footer">
           </div>
        </div>
      </div>
    </div>
</div>

@endsection
