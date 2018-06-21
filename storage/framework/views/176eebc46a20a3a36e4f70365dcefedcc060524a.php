<?php $__env->startSection('content'); ?>
<div class="row">
      <?php if(Session::has('success_msg')): ?>
      <div class="col-lg-12" style="margin-top:20px">
         <div class="alert alert-success"><?php echo e(Session::get('success_msg')); ?></div>
      </div>
     <?php endif; ?>
     <div class="col-lg-12 col-md-12 col-xs-12 text-center">
       <div class="col-lg-12">
         <div class="panel panel-default">
           <div class="panel-heading">
             <div class="text-center">
               <h3>ข้อมูลส่วนตัว</h3>
             </div>
           </div>
       <div class="panel-body">
         <div class="row">
           <div class="col-lg-12">
             <img src="http://icons.iconarchive.com/icons/icons8/ios7/512/Users-User-Male-2-icon.png" style="width:200px;margin: 0 auto;" class="img-circle img-responsive">
           </div>
         </div>
         <div class="row">
           <div class="col-lg-4">
           </div>
           <div class="col-lg-8 text-left">
             <h3>รหัสฝาก/ถอนเงิน: <?php echo e($uid); ?></h3>
             <h3>ชื่อผู้ใช้: <?php echo e($userinfo->username); ?></h3>
             <h3>ชื่อ: <?php echo e($userinfo->firstname); ?>  นามสกุล: <?php echo e($userinfo->lastname); ?></h3>
             <h3>สถานะ: <?php echo e($userinfo->role); ?></h3>
           </div>
         </div>
       </div>
       <div class="panel-footer">
         <div class="row">
           <div class="col-lg-12">
             <a href="#" class="btn btn-lg btn-success">แก้ไขข้อมูลส่วนตัว</a>
           </div>
         </div>
       </div>
     </div>
     </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>