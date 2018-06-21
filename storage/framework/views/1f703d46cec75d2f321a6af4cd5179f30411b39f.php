<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 text-center">
      <h3>หน้าหลัก ฝาก/ถอน</h3>
      <hr class="gd">
  </div>
  <div class="row">
    <div class="col-md-12 text-center" style="margin-top:5px">
      <h4>ค้นหาบัญชี (ใช้รหัสฝาก/ถอน)</h4>
    </div>
    <div class="col-md-12 text-center" style="margin-top:10px">
      <form class="form-inline" action="<?php echo e(route('account.detail')); ?>">
        <input class="form-control" name="username" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success" type="submit">Search</button>
      </form>
    </div>
    <div class="col-lg-12" style="margin-top:30px" style="background-color:#FFFFFF">
      <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>
    <?php if(isset($users)): ?>
    <table class="table" style="background-color:#FFFFFF">
    <thead>
      <th>#</th>
      <th>รหัสฝาก/ถอน</th>
      <th>ชื่อ</th>
      <th>นามสกุล</th>
      <th>สถานะ</th>
      <th></th>
    </thead>
    <tbody>
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($index + 1); ?></td>
        <td><?php echo e($uid[$index]); ?></td>
        <td><?php echo e($user->firstname); ?></td>
        <td><?php echo e($user->lastname); ?></td>
        <td><?php echo e(matchRole($user->role)); ?></td>
        <td><a href="account/detail?username=<?php echo e($uid[$index]); ?>" class="btn btn-info"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
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