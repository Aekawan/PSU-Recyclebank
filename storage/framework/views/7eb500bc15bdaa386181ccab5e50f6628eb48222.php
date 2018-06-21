<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 text-center border-gd">
      <h3>ยินดีต้อนรับสู่ระบบ Recycle Bank System For Admin</h3>
  </div>
  <div class="row" style="margin-top:10px">
    <br>
    <br>
    <br>
    <br>
    <div class="col-lg-4 text-center">
    <div class="panel panel-default border-green ">
  <div class="panel-body">
  <img src="https://image.flaticon.com/icons/svg/427/427728.svg" style="width:100px" alt="Kiwi standing on oval">
      <h4>ข่าวกิจกรรม</h4>
  </div>
</div>
    </div>
    <div class="col-lg-4 text-center">
    <a href="<?php echo e(route('garbage.index')); ?>">
    <div class="panel panel-default border-green ">
    <div class="panel-body">
      <img src="https://image.flaticon.com/icons/svg/600/600190.svg" style="width:100px" alt="Kiwi standing on oval">
      <h4>ราคารับซื้อ</h4>
</div>
</div>
</a>
    </div>
    <div class="col-lg-4 text-center" >
    <a href="<?php echo e(route('account.index')); ?>">
    <div class="panel panel-default border-green ">
    <div class="panel-body">
      <img src="https://image.flaticon.com/icons/svg/489/489323.svg" style="width:100px" alt="Kiwi standing on oval">
      <h4>ฝาก/ถอน</h4>
    </div>
  </div>
  </a>
    </div>
  </div>
  <div class="row" style="margin-top:50px">
    <div class="col-lg-4 text-center" >
    <a href="<?php echo e(route('sale.index')); ?>">
    <div class="panel panel-default border-green ">
    <div class="panel-body">
      <img src="https://image.flaticon.com/icons/svg/199/199529.svg" style="width:100px;" alt="Kiwi standing on oval">
      <h4>ส่งขาย</h4>
</div>
</div>
</a>
    </div>
    <div class="col-lg-4 text-center" >
    <a href="<?php echo e(route('profit.index')); ?>">
    <div class="panel panel-default border-green ">
    <div class="panel-body">
      <img src="https://image.flaticon.com/icons/svg/235/235242.svg" style="width:100px" alt="Kiwi standing on oval">
      <h4>กำไร/ขาดทุน</h4>
</div>
</div>
</a>
    </div>
    <div class="col-lg-4 text-center" >
    <div class="panel panel-default border-green ">
    <div class="panel-body">
      <img src="https://image.flaticon.com/icons/svg/164/164424.svg" style="width:100px" alt="Kiwi standing on oval">
      <h4>สรุปยอด</h4>
    </div>
</div>
</div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>