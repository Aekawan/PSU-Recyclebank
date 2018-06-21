@extends('layouts.app')

@section('content')
<div class="row">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-xs-12 text-center" style="margin-top:50px;">
          <form action="{{ route('sale.insert') }}">
            {{ csrf_field() }}
        <div class="panel panel-default">
          <div class="panel-heading backgroung-gd"><h4 class="white-color">ส่งขยะขาย</h4></div>
          <div class="panel-body">
              <div class="col-lg-3">

              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label col-lg-12 text-left" > วันที่ขาย</label>
                            <div class="col-lg-12" id="find-date">
                                <input type="text" name="dateofsale" id="dateofsale" class="form-control" value="">
                                <br>
                            </div>
                            <script>
                            var today = new Date();
                            var dd = today.getDate();
                            var mm = today.getMonth()+1; //January is 0!

                            var yyyy = today.getFullYear();
                            if(dd<10){
                                dd='0'+dd;
                            }
                            if(mm<10){
                                mm='0'+mm;
                            }
                            var today = dd+'/'+mm+'/'+yyyy;
                            $('#dateofsale').val(today)
                            $('#find-date input').datepicker({
                              format: "dd/mm/yyyy",
                              todayBtn: "linked",
                              language: "th",
                              toggleActive: true
                            });
                            </script>

                  </div>
                <div class="form-group">
              <label class="control-label col-lg-12 text-left" > ประเภทขยะ</label>
                        <div class="col-lg-12">
                            <select class="form-control" name="garbage_id" id="garbage">
                              <option value="0">--เลือกประเภทขยะ--</option>
                              @foreach ($garbages as $index => $garbage)
                                @if ($garbage->type != "0")
                                <option value="{{$garbage->id}}">{{$garbage->type}}</option>
                                @endif
                              @endforeach
                            </select>
                            <br>
                        </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-12 text-left" > ราคารับซื้อ/กิโลกรัม</label>
                          <div class="col-lg-12">
                              <input type="number" step="any" min="1" max="99999" name="purchase_price" id="purchase_price" class="form-control" >
                              <br>
                          </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-12 text-left" > ราคาที่ส่งขาย/กิโลกรัม</label>
                            <div class="col-lg-12">
                                <input type="number" step="any" min="1" max="99999" name="sale_price" id="sale_price" class="form-control">
                                <br>
                            </div>

                  </div>
                <div class="form-group">
                  <label class="control-label col-lg-12 text-left" > จำนวน(กิโลกรัม)</label>
                            <div class="col-lg-12">
                                <input type="number" step="any" min="1" max="99999" name="unit" id="unit" class="form-control">
                                <br>
                            </div>

                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-12 text-left" > ราคาส่งขายสุทธิ</label>
                              <div class="col-lg-12">
                                  <input type="number" step="any" min="1" max="99999" name="total" id="total" class="form-control">
                                  <br>
                              </div>

                    </div>
                  <div class="form-group">
                    <label class="control-label col-lg-12 text-left" > กำไร</label>
                              <div class="col-lg-12">
                                  <input type="number" step="any" min="0" max="999999" name="profit" id="profit" class="form-control">
                                  <br>
                              </div>

                    </div>
                    <div class="form-group">
                      <label class="control-label col-lg-12 text-left" > ขาดทุน</label>
                                <div class="col-lg-12">
                                    <input type="number" step="any" min="0" max="99999" name="loss" id="loss" class="form-control">
                                    <br>
                                </div>

                      </div>

                      <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
              </div>
              <div class="col-lg-3">
              </div>
          </div>
           <div class="panel-footer">
             <button onclick="goBack()" type="submit" name="button" class="btn btn-lg btn-outline-green-back" style="width:150px"><i class="fa fa-back"></i> ย้อนกลับ</button>
             <button type="submit" name="button" class="btn btn-lg btn-green" style="width:150px"> ตกลง</button>
           </div>
        </div>
      </form>
      </div>
    </div>
    <script type="text/javascript">
      $("#garbage").change(function() {
        let gid = $("#garbage").val();
        if(gid != 0 ) {
          $.getJSON( "/laravel/recyclebank/public/admin/garbage/purchaseprice/"+gid, function( data ) {
            $("#purchase_price").val(data.purchase_price)
          });
        } else {
            $("#purchase_price").val("")
        }
      });

      $("#unit").keyup(function(event) {
        let unit = event.target.value;//$("#unit").val();
        let sprice = $("#sale_price").val();
        let pprice = $("#purchase_price").val();
        let ssum = sprice * unit
        let psum = pprice * unit
        $("#total").val(ssum)
        if(sprice > pprice){
          $("#profit").val(ssum-psum);
          $("#loss").val(0)
        } else {
            $("#profit").val(0);
          $("#loss").val(psum-ssum)
        }
    });

    $("#sale_price").keyup(function(event) {
      let sprice = event.target.value;
      let unit = $("#unit").val();//$("#unit").val();
      let pprice = $("#purchase_price").val();
      let ssum = sprice * unit;
      let psum = pprice * unit
      $("#total").val(ssum)
      if(sprice > pprice){
        $("#profit").val(ssum-psum);
        $("#loss").val(0)
      } else {
          $("#profit").val(0);
        $("#loss").val(psum-ssum)
      }
  });

  $("#purchase_price").keyup(function(event) {
    let pprice = event.target.value;
    let sprice = $("#sale_price").val();
    let unit = $("#unit").val();//$("#unit").val();
    let ssum = sprice * unit;
    let psum = pprice * unit
    if(sprice > pprice){
      $("#profit").val(ssum-psum);
      $("#loss").val(0)
    } else {
        $("#profit").val(0);
      $("#loss").val(psum-ssum)
    }
})
    </script>
</div>

@endsection
