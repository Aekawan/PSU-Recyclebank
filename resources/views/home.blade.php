@extends('layouts.app')

@section('content')
<style media="screen">
.bg-white {
  background-color:#ffffff;
}
hr {
  margin-top: 2px;
  margin-bottom: 3px;
}
.te-logo {
    width: 200px;
}

</style>
<div class="row">
  <div class="col-lg-12">
    <img src="{{asset('img/te_logo2015.png')}}" style="width:250px;margin-bottom:10px" alt="">
  </div>
  <div class="col-lg-4  style="height:80vh">
    <div class="panel panel-default" style="height:60vh">
  <div class="panel-heading text-center backgroung-gd" style="background-color:#ffffff"><h5 class="white-color" style="margin:2px"><span class="lnr lnr-diamond"></span> ราคารับซื้อขยะ (อัพเดตวันที่ @if (isset($garbages)) {{$garbages[0]->updated_at}} @endif)</h5></div>
  <div class="panel-body">
    <div class="row">
      <div class="col-lg-7">
        @if (isset($garbages))
         @foreach ($garbages as $garbage)
          @if ($garbage->id != 1)
        <label>{{$garbage->type}}</label>
        <hr class="gd-l">
         @endif
        @endforeach
        @endif
      </div>
      <div class="col-lg-5">
        @if (isset($garbages))
         @foreach ($garbages as $garbage)
           @if ($garbage->id != 1)
         <label>{{$garbage->purchase_price}} บาท/กิโลกรัม</label>
         <hr class="gd-l">
         @endif
        @endforeach
        @endif
      </div>
    </div>
  </div>
</div>
  </div>
  <div class="col-lg-8 col-md-12 col-xs-12" style="height:60vh">
    <div class="bxslider">
      @if (isset($slide))
       @foreach ($slide as $slide_one)
      <div><img src="{{asset('img/news/full/'.$slide_one->img_full)}}" style="height:330px;width:950px"></div>
      @endforeach
      @endif
    <div><img src="{{asset('img/gb.png')}}" style="height:330px;width:950px"></div>
  </div>
  </div>
</div>
<div class="row" style="margin-bottom:20px">
  <div class="col-lg-12">
      <hr class="gd">
    <h3>ข่าวสาร</h3>
  </div>
  @if (isset($news) && count($news) > 0)
  @foreach ($news as $new)
  <div class="col-lg-4">
    <div class="panel green panel-default">
      <div class="panel-heading text-center bg-white" style="padding:0px"><img src="{{asset('img/news/preview/'.$new->img_preview)}}" style="height:200px;width:100%"></div>
      <div class="panel-body">
            <h4 class="text-style">{{$new->title}}</h4>
            <p class="text-style text-left">{{ str_replace(' ','',strip_tags($new->content))  }}</p>
      </div>
      <div class="panel-footer text-right bg-white"><a href="news/show/{{$new->id}}" class="btn btn-outline-green">อ่านต่อ</a></div>
    </div>
  </div>
   @endforeach
  @else
  <div class="col-lg-12">
    <div class="alert alert-info">
      ยังไม่มีข่าวสาร
    </div>
  </div>
  @endif
</div>


@endsection
