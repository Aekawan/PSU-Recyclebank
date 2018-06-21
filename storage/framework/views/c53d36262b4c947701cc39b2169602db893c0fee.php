<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 text-center" style="border-bottom: 5px solid #212121;">
      <h3>หน้าหลัก ฝาก/ถอน</h3>
  </div>
  <div class="row">
    <div class="col-md-12 text-center" style="margin-top:20px">
      <h4>ค้นหาบัญชี (ใช้ Username)</h4>
    </div>
    <div class="col-md-12 text-center" style="margin-top:10px">
      <form class="form-inline" action="<?php echo e(route('account.detail')); ?>">
        <input class="form-control" name="username" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success" type="submit">Search</button>
      </form>
    </div>
    <div class="col-lg-12" style="margin-top:20px" style="background-color:#FFFFFF">
      <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>
    <?php if(!isset($account)): ?>
    <table class="table" style="background-color:#FFFFFF">
    <thead>
      <th>#</th>
      <th>ชื่อ</th>
      <th>นามสกุล</th>
      <th>บทบาท</th>
      <th>ประเภทขยะ</th>
      <th>ราคารับซื้อ</th>
      <th>จำนวน/กิโลกรัม</th>
      <th>ฝาก</th>
      <th>ถอน</th>
      <th>คงเหลือ</th>
    </thead>
    <tbody>
    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($index + 1); ?></td>
        <td><?php echo e($account->firstname); ?></td>
        <td><?php echo e($account->lastname); ?></td>
        <td><?php echo e($account->role); ?></td>
        <td><?php echo e($account->type); ?></td>
        <td><?php echo e($account->purchase_price); ?></td>
        <td><?php echo e($account->unit); ?></td>
        <td><?php echo e($account->deposit); ?></td>
        <td><?php echo e($account->withdraw); ?></td>
        <td><?php echo e($account->balance); ?></td>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
  </table>
    <?php else: ?>
     <div class="alert alert-warning" role="alert">ไม่มีข้อมูล</div>
    <?php endif; ?>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>