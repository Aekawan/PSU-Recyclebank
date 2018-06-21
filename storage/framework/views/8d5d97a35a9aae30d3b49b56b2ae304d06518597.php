<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-xs-12 text-center" style="margin-top:50px;">
        <div class="panel panel-default">
          <div class="panel-heading"><h3>คิดกำไร/ขาดทุน (แยกตามประเภท)</h3></div>
          <div class="panel-body">
              <div class="col-lg-12" style="margin-bottom:20px">
                <a href="<?php echo e(route('profit.index')); ?>" type="button" class="btn btn-danger" name="button" style="width:200px">คิดกำไร/ขาดทุนรวม</a>
                <a href="<?php echo e(route('profit.type')); ?>" type="button" class="btn btn-info" name="button">คิดกำไร/ขาดทุนแยกตามประเภท</a>
              </div>
              <div class="col-lg-3">

              </div>
              <div class="col-lg-6">
                <form action="<?php echo e(route('profit.findbytype')); ?>">
                  <?php echo e(csrf_field()); ?>

                <div class="form-group">
              <label class="control-label col-lg-12 text-left" > ยอดขาย ณ วันที่ (เดือน/วัน/ปี)</label>
                        <div class="col-lg-12">
                            <input type="date" format="dd/mm/yyyy" name="saledate" id="saledate" class="form-control">
                            <br>
                        </div>
              </div>
              <div class="form-group">
            <label class="control-label col-lg-12 text-left" > ประเภทขยะ</label>
                      <div class="col-lg-12">
                          <select class="form-control" name="garbage_id">
                            <?php $__currentLoopData = $garbages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $garbage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($garbage->type != "0"): ?>
                              <option value="<?php echo e($garbage->id); ?>"><?php echo e($garbage->type); ?></option>
                              <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                          <br>
                      </div>
            </div>
              <button type="submitn" class="btn btn-lg btn-success" name="button">ค้นหา</button>
              </form>
              <?php if(isset($profit) && count($profit) > 0): ?>
              <div class="form-group">
                <br>
                <h4>ยอดขายรวม ณ วันที่ <?php echo e($saledate); ?></h4>
                <br>
                <h4>ประเภทขยะ <?php echo e($findgarbage->type); ?></h4>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-12 text-left" > ยอดขายออก</label>
                          <div class="col-lg-12">
                              <input type="text" name="sale_price" id="sale_price" class="form-control" value="<?php echo e($profit[0]->sum_sale_price); ?>" >
                              <br>
                          </div>

                </div>
                <div class="form-group">
                  <label class="control-label col-lg-12 text-left" > ยอดรับซื้อ</label>
                            <div class="col-lg-12">
                                <input type="number" name="purchase_price" id="purchase_price" class="form-control"  value="<?php echo e($profit[0]->sum_purchase_price); ?>">
                                <br>
                            </div>

                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-12 text-left" > กำไร</label>
                              <div class="col-lg-12">
                                  <input type="number" name="profit" id="profit" class="form-control" value="<?php echo e($sumprofit); ?>">
                                  <br>
                              </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-lg-12 text-left" > ขาดทุน</label>
                                <div class="col-lg-12">
                                    <input type="number" name="loss" id="loss" class="form-control"  value="<?php echo e($sumloss); ?>">
                                    <br>
                                </div>
                      </div>
                      <?php elseif(count($profit) == 0): ?>
                      <div class="col-lg-12" style="margin-top:20px">
                         <div class="alert alert-warning">ไม่พบข้อมูลการขาย</div>
                      </div>
                      <?php else: ?>
                      <div class="col-lg-12" style="margin-top:20px">
                         <div class="alert alert-warning">โปรดกดค้นหาเพื่อดูข้อมูล กำไร/ขาดทุน</div>
                      </div>
                      <?php endif; ?>
              </div>
              <div class="col-lg-3">

              </div>

          </div>
           <div class="panel-footer">

           </div>
        </div>
      </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>