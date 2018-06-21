<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-xs-12 text-center" style="margin-top:50px;">
          <form action="<?php echo e(route('garbage.insert')); ?>">
            <?php echo e(csrf_field()); ?>

        <div class="panel panel-default">
          <div class="panel-heading backgroung-gd" style="padding:1px"><h3 class="white-color">เพิ่มขยะ/กำหนดราคารับซื้อ</h3></div>
          <div class="panel-body">
              <?php if($errors->any()): ?>
    <div class="alert alert-danger">
       <p>ไม่สามารถเพิ่มได้ กรุณากรอกข้อมูลให้ครบ</p>
    </div>
<?php endif; ?>
              <div class="col-lg-3">

              </div>
              <div class="col-lg-6">
                <div class="form-group">
              <label class="control-label col-lg-12 text-left" > ประเภทขยะ</label>
                        <div class="col-lg-12">
                            <input type="text" name="type" class="form-control">
                            <br>
                        </div>

              </div>
              <div class="form-group">
                <label class="control-label col-lg-12 text-left" > รายละเอียด</label>
                          <div class="col-lg-12">
                              <input type="text" name="detail" class="form-control">
                              <br>
                          </div>

                </div>
                <div class="form-group">
                  <label class="control-label col-lg-12 text-left" > ราคารับซื้อ/กิโลกรัม</label>
                            <div class="col-lg-12">
                                <input type="number" min="1"  name="purchase_price" class="form-control" require>
                                <br>
                            </div>

                  </div>
              </div>
              <div class="col-lg-3">

              </div>

          </div>
           <div class="panel-footer">
              <button type="submit" class="btn btn-lg btn-green" name="button" style="width:200px">เพิ่ม</button>
     <button onclick="goBack()" type="button" class="btn btn-lg btn-outline-green-back" name="button" style="width:200px">ย้อนกลับ</button>
           </div>
        </div>
      </form>
      </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>