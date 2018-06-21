<?php $__env->startSection('content'); ?>
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
    <img src="<?php echo e(asset('img/te_logo2015.png')); ?>" style="width:250px;margin-bottom:10px" alt="">
  </div>
  <div class="col-lg-4  style="height:80vh">
    <div class="panel panel-default" style="height:60vh">
  <div class="panel-heading text-center backgroung-gd" style="background-color:#ffffff"><h5 class="white-color" style="margin:2px"><span class="lnr lnr-diamond"></span> ราคารับซื้อขยะ (อัพเดตวันที่ <?php if(isset($garbages)): ?> <?php echo e($garbages[0]->updated_at); ?> <?php endif; ?>)</h5></div>
  <div class="panel-body">
    <div class="row">
      <div class="col-lg-7">
        <?php if(isset($garbages)): ?>
         <?php $__currentLoopData = $garbages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garbage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($garbage->id != 1): ?>
        <label><?php echo e($garbage->type); ?></label>
        <hr class="gd-l">
         <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
      </div>
      <div class="col-lg-5">
        <?php if(isset($garbages)): ?>
         <?php $__currentLoopData = $garbages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garbage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <?php if($garbage->id != 1): ?>
         <label><?php echo e($garbage->purchase_price); ?> บาท/กิโลกรัม</label>
         <hr class="gd-l">
         <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
  </div>
  <div class="col-lg-8 col-md-12 col-xs-12" style="height:60vh">
    <div class="bxslider">
      <?php if(isset($slide)): ?>
       <?php $__currentLoopData = $slide; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide_one): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div><img src="<?php echo e(asset('img/news/full/'.$slide_one->img_full)); ?>" style="height:330px;width:950px"></div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
    <div><img src="<?php echo e(asset('img/gb.png')); ?>" style="height:330px;width:950px"></div>
  </div>
  </div>
</div>
<div class="row" style="margin-bottom:20px">
  <div class="col-lg-12">
      <hr class="gd">
    <h3>ข่าวสาร</h3>
  </div>
  <?php if(isset($news) && count($news) > 0): ?>
  <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="col-lg-4">
    <div class="panel green panel-default">
      <div class="panel-heading text-center bg-white" style="padding:0px"><img src="<?php echo e(asset('img/news/preview/'.$new->img_preview)); ?>" style="height:200px;width:100%"></div>
      <div class="panel-body">
            <h4 class="text-style"><?php echo e($new->title); ?></h4>
            <p class="text-style text-left"><?php echo e(str_replace(' ','',strip_tags($new->content))); ?></p>
      </div>
      <div class="panel-footer text-right bg-white"><a href="news/show/<?php echo e($new->id); ?>" class="btn btn-outline-green">อ่านต่อ</a></div>
    </div>
  </div>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php else: ?>
  <div class="col-lg-12">
    <div class="alert alert-info">
      ยังไม่มีข่าวสาร
    </div>
  </div>
  <?php endif; ?>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>