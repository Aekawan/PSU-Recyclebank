

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 text-center" style="border-bottom: 5px solid #212121;">
      <h3>ราคารับซื้อ</h3>
  </div>
    <div class="row">
      <div class="col-lg-12 text-center" style="margin-top:50px">
        <a href="<?php echo e(route('garbage.add')); ?>" class="btn btn-lg btn-success" type="button" name="button"><i class="fa fa-plus"></i> เพิ่มประเภทขยะ</a>
      </div>
      <?php if(Session::has('success_msg')): ?>
      <div class="col-lg-12" style="margin-top:20px">
         <div class="alert alert-success"><?php echo e(Session::get('success_msg')); ?></div>
      </div>
     <?php endif; ?>
      <div class="col-lg-12 col-md-12 col-xs-12 text-center" style="margin-top:20px;background-color:#ffffff">
      <?php if(isset($garbages)): ?>
        <table class="table table-hover">
          <thead>
            <tr class="text-center">
              <th class="text-center">#</th>
              <th class="text-center">ประเภทขยะ</th>
              <th class="text-center">รายละเอียด</th>
              <th class="text-center">ราคารับซื้อ(บาท)/กิโลกรัม</th>
              <th class="text-center">อัพเดตวันที่</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $garbages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $garbage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($garbage->id != 1): ?>
              <tr>
                <td><?php echo e($index); ?></td>
                <td><?php echo e($garbage->type); ?></td>
                <td><?php echo e($garbage->detail); ?></td>
                <td><?php echo e($garbage->purchase_price); ?> บาท/กิโลกรัม</td>
                <td><?php echo e($garbage->updated_at); ?></td>
                <td>
                  <a href="<?php echo e(route('garbage.edit',$garbage->id)); ?>" type="button" class="btn btn-warning" name="button"><i class="fa fa-pencil"></i></a>
                  <a href="<?php echo e(route('garbage.delete',$garbage->id)); ?>" onclick="return confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?');" type="button" class="btn btn-danger" name="button"><i class="fa fa-trash"></i> </a>
                </td>
              </tr>
              <?php endif; ?>
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