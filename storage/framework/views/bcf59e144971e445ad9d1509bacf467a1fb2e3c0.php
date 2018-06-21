<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-xs-12 text-center" style="margin-top:20px;">
        <div class="panel panel-default">
          <div class="panel-heading backgroung-gd" style="padding:1px"><h3 class="white-color">คิดกำไร/ขาดทุน</h3></div>
          <div class="panel-body">
            <!--
              <div class="col-lg-12" style="margin-bottom:20px">
                <a href="<?php echo e(route('profit.index')); ?>" type="button" class="btn btn-danger" name="button" style="width:200px">คิดกำไร/ขาดทุนรวม</a>
                <a href="<?php echo e(route('profit.type')); ?>" type="button" class="btn btn-info" name="button">คิดกำไร/ขาดทุนแยกตามประเภท</a>
              </div>
            -->
              <div class="col-lg-3">

              </div>
              <div class="col-lg-6">
                <form action="<?php echo e(route('profit.find')); ?>">
                  <?php echo e(csrf_field()); ?>

                <div class="form-group">
              <label class="control-label col-lg-12 text-left" > ยอดขาย ณ วันที่ (เดือน/วัน/ปี)</label>
                        <div class="col-lg-12" id="sandbox-container">
                            <input type="text" value="<?php echo e($finddate); ?>" name="saledate" id="saledate" class="form-control">
                            <br>
                        </div>
              </div>
              <button type="submit" class="btn btn-lg btn-outline-green" style="width:100px" name="button">ค้นหา</button>
              </form>

              <?php if(isset($profit) && count($profit) > 0): ?>
              <div class="form-group">
                <br>
                <h4>ยอดขายรวม ณ วันที่ <?php echo e($saledate); ?></h4>
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
              <?php if(isset($profit) && count($profit) > 0): ?>
              <div class="col-lg-12">
               <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center">รายการ</th>
                    <th class="text-center">ขาย/กิโลกรัม</th>
                    <th class="text-center">รับซื้อ/กิโลกรัม</th>
                    <th class="text-center">กิโลกรัม/รวม</th>
                    <th class="text-center">รับซื้อสุทธิ</th>
                    <th class="text-center">ขายได้สุทธิ</th>
                    <th class="text-center">กำไร</th>
                    <th class="text-center">ขาดทุน</th>
                  </tr>
                </thead>
                <tbody>

                   <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <tr>
                   <td><?php echo e($sale->type); ?></td>
                   <td><?php echo e($sale->sum_sale_price); ?></td>
                   <td><?php echo e($sale->sum_purchase_price); ?></td>
                   <td><?php echo e($sale->sum_sale_unit); ?></td>
                   <td><?php echo e($sale->sum_purchase_price * $sale->sum_sale_unit); ?></td>
                   <td><?php echo e($sale->sum_sale_price * $sale->sum_sale_unit); ?></td>
                   <td><?php echo e($sale->sum_sale_profit); ?></td>
                   <td><?php echo e($sale->sum_sale_loss); ?></td>
                   </tr>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
                <tfoot>
                  <tr>
                    <th class="text-center">รวม</th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center"><?php echo e($totalbuy); ?></th>
                    <th class="text-center"><?php echo e($totalsale); ?></th>
                    <th class="text-center"><?php echo e($totalprofit); ?></th>
                    <th class="text-center"><?php echo e($totalloss); ?></th>
                  </tr>
                </tfoot>
              </table>
              </div>
              <?php endif; ?>
          </div>
           <div class="panel-footer">
           </div>
        </div>
      </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>