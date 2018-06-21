<?php $__env->startSection('content'); ?>
<div class="row">
    <?php if($message = Session::get('success_msg')): ?>
    <div class="col-lg-12">
      <div class="alert alert-success">
          <p><?php echo e($message); ?></p>
      </div>
      </div>
  <?php endif; ?>
<div class="col-lg-12 mt-20">
  <div class="panel panel-default">
    <div class="panel-heading backgroung-gd">
      <div class="text-center">
        <h4 class="white-color">บัญชี ฝาก/ถอน</h4>
      </div>
    </div>
<div class="panel-body">
  <?php if(isset($userinfo) && $userinfo->count() > 0): ?>
  <div class="col-lg-12" style="margin-bottom:20px">
    <h4>รหัสฝาก/ถอนเงิน: <?php echo e(newUserId($userinfo[0]->id)); ?></h4>
    <h4>ชื่อผูัใช้: <?php echo e($userinfo[0]->username); ?></h4>
    <h4>ชื่อ: <?php echo e($userinfo[0]->firstname); ?></h4>
    <h4>นามสกุล: <?php echo e($userinfo[0]->lastname); ?></h4>
    <h4>สถานะ: <?php echo e($userinfo[0]->role); ?></h4>
  </div>

  <?php if(isset($details) && $details->count() > 0): ?>
    <div class="col-lg-12">
      <table class="table" style="background-color:#FFFFFF">
      <thead>
        <th>ประเภทขยะ</th>
        <th>ราคารับซื้อ</th>
        <th>จำนวน/กิโลกรัม</th>
        <th>ฝาก</th>
        <th>ถอน</th>
        <th>คงเหลือ</th>
        <th>วัน/เวลา ที่ทำรายการ</th>
      </thead>
      <tbody>
      <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <?php if($detail->garbage_id == 1): ?>
            <td><?php echo e("-"); ?></td>
            <td><?php echo e("-"); ?></td>
            <td><?php echo e("-"); ?></td>
            <td><?php echo e("-"); ?></td>
            <td><?php echo e($detail->withdraw); ?></td>
            <td><?php echo e($detail->balance); ?></td>
            <td><?php echo e($detail->created_at); ?></td>
            <?php else: ?>
            <td><?php echo e($detail->type); ?></td>
            <td><?php echo e($detail->purchase_price); ?></td>
            <td><?php echo e($detail->unit); ?></td>
            <td><?php echo e($detail->deposit); ?></td>
            <td><?php echo e($detail->withdraw); ?></td>
            <td><?php echo e($detail->balance); ?></td>
            <td><?php echo e($detail->created_at); ?></td>
            <?php endif; ?>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    </table>
    </div>
    <?php else: ?>
    <div class="col-lg-12">
       <div class="alert alert-warning" role="alert">ไม่มีข้อมูลการฝากถอน</div>
    </div>
    <?php endif; ?>
    <?php else: ?>
    <div class="col-lg-12">
       <div class="alert alert-warning" role="alert">ไม่พบข้อมูลผู้ใช้</div>
    </div>
    </div>
    <?php endif; ?>
</div>
<div class="panel-footer">
  <?php if(isset($userinfo) && $userinfo->count() > 0): ?>
  <div class="text-center">
    <a href="<?php echo e(route('account.withdraw', $userinfo[0]->id)); ?>" type="button" class="btn btn-lg btn-red" style="width:150px"  name="button">- ถอน</a>
    <a href="<?php echo e(route('account.deposit', $userinfo[0]->id)); ?>" type="button" class="btn btn-lg btn-green" style="margin-left:50px;width:150px" name="button">+ ฝาก</a>
  </div>
  <?php endif; ?>
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>