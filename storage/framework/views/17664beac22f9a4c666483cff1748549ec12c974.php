<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 text-center">
      <h3>ข่าวสาร</h3>
      <hr class="gd">
  </div>
    <div class="row">
      <div class="col-lg-12 text-center" style="margin-top:10px">
        <a href="<?php echo e(route('news.add')); ?>" class="btn btn-lg btn-green" type="button" name="button" style="width:200px"><i class="fa fa-plus"></i> เพิ่มข่าวสาร</a>
      </div>
      <?php if(Session::has('success_msg')): ?>
      <div class="col-lg-12" style="margin-top:20px">
         <div class="alert alert-success"><?php echo e(Session::get('success_msg')); ?></div>
      </div>
     <?php endif; ?>
      <div class="col-lg-12 col-md-12 col-xs-12 text-center" style="margin-top:30px;background-color:#ffffff">
      <?php if(isset($news)): ?>
        <table class="table table-hover">
          <thead>
            <tr class="text-center" style="margin-top:10px">
              <th class="text-center">#</th>
              <th class="text-center" style="width:200px">หัวข้อ</th>
              <th class="text-center" style="width:200px">เนื้อหา</th>
              <th class="text-center">ประเภท</th>
              <th class="text-center">แสดงสไลด์</th>
              <th class="text-center">อัพเดตวันที่</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($index + 1); ?></td>
                <td style="width:200px"><p class="text-style" style="width:200px"><?php echo e($new->title); ?></p></td>
                <td style="width:200px"><p class="text-style" style="width:200px"><?php echo e(str_replace(' ','',strip_tags($new->content))); ?></p></td>
                <td><?php echo e($new->type); ?></td>
                <td><?php echo e($new->slid_on); ?></td>
                <td><?php echo e($new->updated_at); ?></td>
                <td>
                  <a href="<?php echo e(route('news.show',$new->id)); ?>" type="button" class="btn btn-warning" name="button"><i class="fa fa-pencil"></i></a>
                  <a href="<?php echo e(route('news.delete',$new->id)); ?>" onclick="return confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?');" type="button" class="btn btn-danger" name="button"><i class="fa fa-trash"></i> </a>
                </td>
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