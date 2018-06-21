<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 text-center" style="border-bottom: 5px solid #212121;">
      <h3>บัญชี ฝาก/ถอน</h3>
  </div>
  <div class="row">

    <div class="col-lg-12" style="margin-top:20px" style="background-color:#FFFFFF">
      <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>
    <?php if(isset($details) && $details->count() > 0): ?>
    <div class="col-lg-12" style="margin-bottom:20px">
      <h3>ชื่อผูัใช้: <?php echo e($details[0]->username); ?></h3>
      <h3>ชื่อ: <?php echo e($details[0]->firstname); ?></h3>
      <h3>นามสกุล: <?php echo e($details[0]->lastname); ?></h3>
      <h3>บทบาท: <?php echo e($details[0]->role); ?></h3>
    </div>
    <table class="table" style="background-color:#FFFFFF">
    <thead>
      <th>ประเภทขยะ</th>
      <th>ราคารับซื้อ</th>
      <th>จำนวน/กิโลกรัม</th>
      <th>ฝาก</th>
      <th>ถอน</th>
      <th>คงเหลือ</th>
    </thead>
    <tbody>
    <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($detail->type); ?></td>
        <td><?php echo e($detail->purchase_price); ?></td>
        <td><?php echo e($detail->unit); ?></td>
        <td><?php echo e($detail->deposit); ?></td>
        <td><?php echo e($detail->withdraw); ?></td>
        <td><?php echo e($detail->balance); ?></td>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
  </table>
  <div class="row">
    <div class="col-lg-12 text-center">
      <a href="<?php echo e(route('account.deposit', $details[0]->user_id)); ?>" type="button" class="btn btn-lg btn-success" name="button">+ ฝาก</a>
      <a href="<?php echo e(route('account.withdraw', $details[0]->user_id)); ?>" type="button" class="btn btn-lg btn-danger" style="margin-left:50px" name="button">- ถอน</a>
    </div>
  </div>
    <?php else: ?>
     <div class="alert alert-warning" role="alert">ไม่มีข้อมูล</div>
    <?php endif; ?>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>