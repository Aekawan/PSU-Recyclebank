

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 text-center" style="border-bottom: 5px solid #212121;">
      <h3>ประวัติการฝากถอน</h3>
  </div>
  <div class="row">
    <div class="col-lg-12" style="margin-top:20px" style="background-color:#FFFFFF">
      <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>
    <?php if(isset($accounts)): ?>
    <table class="table" style="background-color:#FFFFFF">
    <thead>
      <th>#</th>
      <th>ประเภทขยะ</th>
      <th>ราคารับซื้อ</th>
      <th>จำนวน/กิโลกรัม</th>
      <th>ฝาก</th>
      <th>ถอน</th>
      <th>คงเหลือ</th>
      <th>วันที่ทำรายการ</th>
    </thead>
    <tbody>
    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($index + 1); ?></td>
        <?php if($account->type == "0"): ?>
        <td>-</td>
        <?php else: ?>
        <td><?php echo e($account->type); ?></td>
        <?php endif; ?>
        <?php if($account->purchase_price == 0): ?>
        <td>-</td>
        <?php else: ?>
        <td><?php echo e($account->purchase_price); ?></td>
        <?php endif; ?>
        <?php if($account->unit == 0): ?>
        <td>-</td>
        <?php else: ?>
        <td><?php echo e($account->unit); ?></td>
        <?php endif; ?>
        <?php if($account->deposit == 0): ?>
        <td></td>
        <?php else: ?>
        <td><?php echo e($account->deposit); ?></td>
        <?php endif; ?>
        <?php if($account->withdraw == 0): ?>
        <td></td>
        <?php else: ?>
        <td>- <?php echo e($account->withdraw); ?></td>
        <?php endif; ?>
        <td><?php echo e($account->balance); ?></td>
        <td><?php echo e($account->updated_at); ?></td>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
  </table>
    <?php else: ?>
     <div class="alert alert-warning" role="alert">ไม่พบข้อมูลรายการฝาก/ถอน </div>
    <?php endif; ?>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>