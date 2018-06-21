<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-xs-12 text-center" style="margin-top:50px;">
          <?php echo e(csrf_field()); ?>

          <form action="<?php echo e(route('garbage.update',$garbage->id)); ?>">
        <div class="panel panel-default">
          <div class="panel-heading"><h3>แก้ไขข้อมูลขยะ/ราคารับซื้อ</h3></div>
          <div class="panel-body">
              <div class="col-lg-3">

              </div>
              <div class="col-lg-6">
                <div class="form-group">
              <label class="control-label col-lg-12 text-left" > ประเภทขยะ</label>
                        <div class="col-lg-12">
                            <input type="text" name="type" class="form-control" value="<?php echo e($garbage->type); ?>">
                            <br>
                        </div>

              </div>
              <div class="form-group">
                <label class="control-label col-lg-12 text-left" > รายละเอียด</label>
                          <div class="col-lg-12">
                              <input type="text" name="detail" class="form-control" value="<?php echo e($garbage->detail); ?>">
                              <br>
                          </div>

                </div>
                <div class="form-group">
                  <label class="control-label col-lg-12 text-left" > ราคารับซื้อ/กิโลกรัม</label>
                            <div class="col-lg-12">
                                <input type="number" name="purchase_price" class="form-control" value="<?php echo e($garbage->purchase_price); ?>">
                                <br>
                            </div>

                  </div>
              </div>
              <div class="col-lg-3">

              </div>

          </div>
           <div class="panel-footer">
             <button type="submit" name="button" class="btn btn-lg btn-success"><i class="fa fa-pencil"></i> แก้ไข</button>
           </div>
        </div>
      </form>
      </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>