@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 text-center">
      <h3>ข่าวสาร</h3>
      <hr class="gd">
  </div>
    <div class="row">
      <div class="col-lg-12 text-center" style="margin-top:10px"> 
        <a href="{{route('news.add')}}" class="btn btn-lg btn-green" type="button" name="button" style="width:200px"><i class="fa fa-plus"></i> เพิ่มข่าวสาร</a>
      </div>
      @if(Session::has('success_msg'))
      <div class="col-lg-12" style="margin-top:20px">
         <div class="alert alert-success">{{ Session::get('success_msg') }}</div>
      </div>
     @endif
      <div class="col-lg-12 col-md-12 col-xs-12 text-center" style="margin-top:30px;background-color:#ffffff">
      @if (isset($news))
        <table class="table table-hover">
          <thead>
            <tr class="text-center" style="margin-top:10px">
              <th class="text-center">#</th>
              <th class="text-center" style="width:200px">หัวข้อ</th>
              <th class="text-center" style="width:200px">เนื้อหา</th>
              <th class="text-center">ประเภท</th>
              <th class="text-center">แสดงสไลด์</th>
              <th class="text-center">อัพเดตวันที่</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($news as $index => $new)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td style="width:200px"><p class="text-style" style="width:200px">{{ $new->title }}</p></td>
                <td style="width:200px"><p class="text-style" style="width:200px">{{ str_replace(' ','',strip_tags($new->content))  }}</p></td>
                <td>{{ $new->type }}</td>
                <td>@if($new->slid_on == true) แสดง @else ไม่แสดง @endif</td>
                <td>{{ $new->updated_at }}</td>
                <td>
                  <a href="{{ route('news.show',$new->id) }}" type="button" class="btn btn-info" name="button"><i class="fa fa-eye"></i></a>
                  <a href="{{ route('news.edit',$new->id) }}" type="button" class="btn btn-warning" name="button"><i class="fa fa-pencil"></i></a>
                  <a href="{{ route('news.delete',$new->id) }}" onclick="return confirm('คุณต้องการลบข่าวสารนี้หรือไม่?')" type="button" class="btn btn-danger" name="button"><i class="fa fa-trash"></i> </a>
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
<script type="text/javascript">
  function confirmDelete(){
    let cf = swal({
      title: "คุณต้องการลบข่าวสารนี้?",
      text: "คุณต้องการลบข่าวสารนี้หรือไม่",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((value) => {
      if (value === true){
        let a = true
      }else {
        let a = false
      }
       return a
    })

    return cf
  }
</script>

@endsection
