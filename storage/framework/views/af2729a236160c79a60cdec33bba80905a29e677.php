<?php $__env->startSection('content'); ?>
<div class="row">
  <?php if($message = Session::get('success_msg')): ?>
  <div class="col-lg-12">
    <div class="alert alert-success">
        <p><?php echo e($message); ?></p>
    </div>
    </div>
<?php endif; ?>
<?php if(isset($news)): ?>
  <div class="col-lg-12">
    <form action="">
    <div class="panel panel-default">
      <div class="panel-heading  backgroung-gd">
          <h4 class="white-color">[ <?php echo e($news->type); ?> ] <?php echo e($news->title); ?></h4>
      </div>
  <div class="panel-body">
    <img src="<?php echo e(asset('img/news/full/'.$news->img_full)); ?>" style="width:100%" alt="">
   <div class="col-lg-12" style="margin-top:10px">
      <?php echo $news->content; ?>

   </div>
</div>
  <div class="panel-footer">
    <?php if(isset(Auth::user()->role) && Auth::user()->role == "admin"): ?>
    <div class="text-center">
      <a href="#" onclick="goBack()" type="button" name="button" class="btn btn-lg btn-outline-green-back" style="width:150px">ย้อนกลับ</a>
      <a href="<?php echo e(route('news.edit',$news->id)); ?>" type="button" id="btn-submit" class="btn btn-lg btn-green" style="width:150px;margin-left:20px">แก้ไข</a>
    </div>
    <?php endif; ?>
  </div>
  </form>
</div>
  </div>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>