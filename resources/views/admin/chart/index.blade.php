@extends('layouts.app')

@section('content')
{{ csrf_field() }}
<div class="row">
    <div class="col-lg-12 text-center">
      <h3>สรุปยอด</h3>
      <hr class="gd">
  </div>
  <div class="row">
    <div class="col-lg-6 col-lg-offset-3 text-center">
      <form action="{{ route('chart.find') }}">
        {{ csrf_field() }}
    <div class="form-group">
      <label class="control-label col-lg-12 text-left" > เลือกการดูสรุปยอด</label>
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
    <button type="submit" class="btn btn-lg btn-outline-green" style="width:100px" name="button">ดูสรุปยอด</button>
    </form>
    <hr>
    </div>
</div>
@if(isset($sales) && count($sales) > 0)
@if($message = Session::get('msg'))
<h4 class="text-center">{{$message}}</h4>
<br>
@endif
<canvas id="amount" style="margin-bottom:50px"></canvas>
@else
<div class="alert alert-info" role="alert">ไม่มีข้อมูลที่ต้องการ กรุณาค้นหาใหม่</div>
@endif
</div>


@if (isset($sales) )
<script type="text/javascript">
var ctx = document.getElementById('amount').getContext('2d');
var chart = new Chart(ctx, {
  // The type of chart we want to create
  type: 'bar',

  // The data for our dataset
  data: {
      labels: [@foreach ($sales as $index => $sale) {!! '"'.$sale->type.'"'.','!!} @endforeach],
      datasets: [{
          label: "สรุปยอดการขายขยะ",
          backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(250, 99, 80)',
                'rgb(84, 255, 195)',
                'rgb(255, 255, 0)',
                'rgb(35, 55, 80)'
                ],
          borderColor: 'rgb(255, 99, 132)',

          data: [@foreach ($sales as $index => $sale) {!! ($sale->sum_sale_profit) - ($sale->sum_sale_loss).','!!} @endforeach,0],
      }]
  },

  // Configuration options go here
  options: {}
});
</script>
@endif
@endsection
