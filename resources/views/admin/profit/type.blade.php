@extends('layouts.app')

@section('content')
<div class="row">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-xs-12 text-center" style="margin-top:50px;">
        <div class="panel panel-default">
          <div class="panel-heading"><h3>คิดกำไร/ขาดทุน (แยกตามประเภท)</h3></div>
          <div class="panel-body">
              <div class="col-lg-12" style="margin-bottom:20px">
                <a href="{{ route('profit.index')}}" type="button" class="btn btn-danger" name="button" style="width:200px">คิดกำไร/ขาดทุนรวม</a>
                <a href="{{ route('profit.type')}}" type="button" class="btn btn-info" name="button">คิดกำไร/ขาดทุนแยกตามประเภท</a>
              </div>
              <div class="col-lg-3">

              </div>
              <div class="col-lg-6">
                <form action="{{ route('profit.findbytype') }}">
                  {{ csrf_field() }}
                <div class="form-group">
              <label class="control-label col-lg-12 text-left" > ยอดขาย ณ วันที่ (เดือน/วัน/ปี)</label>
                        <div class="col-lg-12">
                            <input type="date" format="dd/mm/yyyy" name="saledate" id="saledate" class="form-control">
                            <br>
                        </div>
              </div>
              <div class="form-group">
            <label class="control-label col-lg-12 text-left" > ประเภทขยะ</label>
                      <div class="col-lg-12">
                          <select class="form-control" name="garbage_id">
                            @foreach ($garbages as $index => $garbage)
                            @if ($garbage->type != "0")
                              <option value="{{$garbage->id}}">{{$garbage->type}}</option>
                              @endif
                            @endforeach
                          </select>
                          <br>
                      </div>
            </div>
              <button type="submitn" class="btn btn-lg btn-success" name="button">ค้นหา</button>
              </form>
              @if(isset($profit) && count($profit) > 0)
              <div class="form-group">
                <br>
                <h4>ยอดขายรวม ณ วันที่ {{$saledate}}</h4>
                <br>
                <h4>ประเภทขยะ {{$findgarbage->type}}</h4>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-12 text-left" > ยอดขายออก</label>
                          <div class="col-lg-12">
                              <input type="text" name="sale_price" id="sale_price" class="form-control" value="{{$profit[0]->sum_sale_price}}" >
                              <br>
                          </div>

                </div>
                <div class="form-group">
                  <label class="control-label col-lg-12 text-left" > ยอดรับซื้อ</label>
                            <div class="col-lg-12">
                                <input type="number" name="purchase_price" id="purchase_price" class="form-control"  value="{{$profit[0]->sum_purchase_price}}">
                                <br>
                            </div>

                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-12 text-left" > กำไร</label>
                              <div class="col-lg-12">
                                  <input type="number" name="profit" id="profit" class="form-control" value="{{$sumprofit}}">
                                  <br>
                              </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-lg-12 text-left" > ขาดทุน</label>
                                <div class="col-lg-12">
                                    <input type="number" name="loss" id="loss" class="form-control"  value="{{$sumloss}}">
                                    <br>
                                </div>
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

          </div>
           <div class="panel-footer">

           </div>
        </div>
      </div>
    </div>
</div>

@endsection
