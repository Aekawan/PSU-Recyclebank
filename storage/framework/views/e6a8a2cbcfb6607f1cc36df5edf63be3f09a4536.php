<?php $__env->startSection('content'); ?>
<style media="screen">
  hr {
    border-color: #e2e1e1;
    margin: 5px;
  }
</style>
<?php if(isset($news)): ?>
<div class="row">
   <div class="col-lg-12 text-center">
     <h3>แก้ไขข่าวสาร</h3>
     <hr class="gd">
   </div>
   <form class="" action="<?php echo e(route('news.update',$news->id)); ?>" enctype="multipart/form-data" method="post" runat="server">
     <?php echo e(csrf_field()); ?>

   <div class="col-lg-12" style="margin-bottom:20px">
     <h4>หัวข้อ:</h4>
     <input type="text" class="form-control" name="title" value="<?php echo e($news->title); ?>" placeholder="พิมพ์หัวข้อข่าวสารที่ต้องการ....">
   </div>
   <div class="col-lg-12">
     <hr>
   </div>
   <div class="col-lg-6">
     <h4>ประเภทข่าวสาร</h4>
     <select class="form-control" name="type">
       <option value="สาระน่ารู้">สาระน่ารู้</option>
       <option value="การแนะนำ">การแนะนำ</option>
       <option value="ประชาสัมพนธ์">ประชาสัมพันธ์</option>
       <option value="โฆษณา">โฆษณา</option>
     </select>
   </div>
   <div class="col-lg-12" style="margin-top:15px">
     <hr>
   </div>
   <div class="col-lg-4" style="margin-bottom:20px">
     <h4>รูปภาพพรีวิว (ขนาดที่แนะนำ 200x350px):</h4>
     <div class="panel green panel-defualt" style="height:200px;width:350px;padding:0px">
       <img id="imgPreview" src="<?php echo e(asset('img/news/preview/'.$news->img_preview)); ?>" alt="" style="height:198px;width:100%;">
     </div>
     <div class="text-center">
       <div class="upload-btn-wrapper">
         <button class="btn btn-outline-green-back">เลือกรูปภาพ</button>
         <input type="file" accept="image/*" name="img_preview" id="btn-img-preview"  />
       </div>
     </div>
   </div>
   <div class="col-lg-8" style="margin-bottom:20px">
     <h4>รูปภาพประกอบบทความ (ขนาดที่แนะนำ 950x350px):</h4>
     <div class="panel green panel-defualt" style="height:200px;width:100%;padding:0px">
        <img id="imgFull" src="<?php echo e(asset('img/news/full/'.$news->img_full)); ?>" alt="" style="height:198px;width:100%;">
     </div>
     <div class="text-center">
       <div class="upload-btn-wrapper">
         <button class="btn btn-outline-green-back">เลือกรูปภาพ</button>
         <input type="file" accept="image/*" name="img_full" id="btn-img-full"  />
       </div>
     </div>
   </div>
   <div class="col-lg-12">
     <hr>
   </div>
   <div class="col-lg-12">
     <h4>รายละเอียดข่าวสาร:</h4>
     <textarea name="content" id="editor" class="custom-editor"><?php echo $news->content; ?></textarea>
   </div>
   <div class="col-lg-12" style="margin-top:5px;style="margin-bottom:20px"">
     <h4>ต้องการให้แสดงข่าวสารนี้บนสไลด์หรือไม่  <input type="checkbox" id="slid_on" class="form-color" name="slid_on" value="<?php echo e($news->slid_on); ?>" <?php if($news->slid_on != null): ?> checked <?php endif; ?> ></h4>
   </div>
   <div class="col-lg-12 text-center" style="margin-bottom:20px">
     <button type="button" onclick="goBack()" class="btn btn-lg btn-outline-green-back" name="button" style="width:200px">ย้อนกลับ</button>
     <button type="submit" class="btn btn-lg btn-green" name="button" style="width:200px">ส่งข่าวสาร</button>
   </div>
   <input type="hidden" name="url" value="0">
   </form>
</div>
<script>
      function imgPreview(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#imgPreview').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
          }
      }

      $("#btn-img-preview").change(function() {
        imgPreview(this);
      });
      function imgFull(input)  {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#imgFull').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
          }
      }

      $("#btn-img-full").change(function() {
        imgFull(this);
      });

      $("#slid_on").on('change', function() {
          if ($("#slid_on").is(':checked')) {
             $("#slid_on").attr('checked',true);
             $("#slid_on").val('true');
             console.log($("#slid_on").val());
          } else {
         $("#slid_on").attr('checked',false);
         $("#slid_on").val('0');
         console.log($("#slid_on").val());
        }
      });

</script>
<?php else: ?>
<div class="alert alert-danger" role="alert">
  เกิดข้อผิดพลาด
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>