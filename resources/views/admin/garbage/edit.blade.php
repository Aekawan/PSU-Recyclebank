@extends('layouts.app')

@section('content')
<div class="row">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-xs-12 text-center" style="margin-top:50px;">
          {{ csrf_field() }}
          <form action="{{ route('garbage.update',$garbage->id) }}">
        <div class="panel panel-default">
          <div class="panel-heading backgroung-gd"><h4 class="white-color">แก้ไขข้อมูลขยะ/ราคารับซื้อ</h4></div>
          <div class="panel-body">
              <div class="col-lg-3">

              </div>
              <div class="col-lg-6">
                <div class="form-group">
              <label class="control-label col-lg-12 text-left" > ประเภทขยะ</label>
                        <div class="col-lg-12">
                            <input type="text" name="type" class="form-control" value="{{$garbage->type}}">
                            <br>
                        </div>

              </div>
              <div class="form-group">
                <label class="control-label col-lg-12 text-left" > รายละเอียด</label>
                          <div class="col-lg-12">
                              <input type="text" name="detail" class="form-control" value="{{$garbage->detail}}">
                              <br>
                          </div>

                </div>
                <div class="form-group">
                  <label class="control-label col-lg-12 text-left" > ราคารับซื้อ/กิโลกรัม</label>
                            <div class="col-lg-12">
                                <input type="number" name="purchase_price" class="form-control" value="{{$garbage->purchase_price}}">
                                <br>
                            </div>

                  </div>
              </div>
              <div class="col-lg-3">

              </div>

          </div>
           <div class="panel-footer">
              <button type="button" onclick="goBack()" class="btn btn-lg btn-outline-green-back" name="button" style="width:150px">ย้อนกลับ</button>
              <button type="submit" name="button" class="btn btn-lg btn-green" style="width:150px"><i class="fa fa-pencil"></i> แก้ไข</button>
           </div>
        </div>
      </form>
      </div>
    </div>
</div>

@endsection
