<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="text-center">
          <h2>ฝาก</h2>
        </div>
      </div>
  <div class="panel-body">
    <div class="col-lg-5">
      <h4>ชื่อผู้ใช้: <?php echo e($users[0]->username); ?></h4>
      <h4>ชื่อ: <?php echo e($users[0]->firstname); ?></h4>
      <h4>นามสกุล: <?php echo e($users[0]->lastname); ?></h4>
      <h4>บาทบาท: <?php echo e($users[0]->role); ?></h4>
    </div>
    <div class="col-lg-7">
      <div class="col-lg-10" style="margin-bottom:20px">
        <label for="">ประเภทขยะ</label>
        <select class="form-control" name="garbage">
          <option value="0">--กรุณาเลือกประเภทขยะ--</option>
          <?php $__currentLoopData = $garbages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garbage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($garbage->id); ?>"><?php echo e($garbage->type); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
      <div class="col-lg-10" style="margin-bottom:20px">
        <label for="">ราคาที่รับซื้อ</label>
        <input class="form-control" type="text" name="" value="">
      </div>
      <div class="col-lg-2" style="margin-bottom:20px">
        <br>
        <h4>บาท</h4>
      </div>
      <div class="col-lg-10" style="margin-bottom:20px">
        <label for="">จำนวน</label>
        <input class="form-control" type="text" name="" value="">
      </div>
      <div class="col-lg-2" style="margin-bottom:20px">
        <br>
        <h4>กิโลกรัม</h4>
      </div>
      <div class="col-lg-10" style="margin-bottom:20px">
        <label for="">รวมเป็นเงิน</label>
        <input class="form-control" type="text" name="" value="">
      </div>
      <div class="col-lg-2" style="margin-bottom:20px">
        <br>
        <h4>บาท</h4>
      </div>
    </div>
  </div>
  <div class="panel-footer">
    <div class="text-center">
      <a href="../../account/detail?username=<?php echo e($users[0]->username); ?>" type="submit" name="button" class="btn btn-lg btn-danger">ย้อนกลับ</a>
      <button type="submit" name="button" class="btn btn-lg btn-success" style="width:100px;margin-left:20px">ฝาก</button>
    </div>
  </div>
</div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>