<?php $__env->startSection('content'); ?>
<?php echo e(csrf_field()); ?>

<div class="row">
    <div class="col-lg-12 text-center">
      <h3>สรุปยอด</h3>
      <hr class="gd">
  </div>
  <div class="row">
    <div class="col-lg-6 col-lg-offset-3 text-center">
      <form action="<?php echo e(route('chart.find')); ?>">
        <?php echo e(csrf_field()); ?>

    <div class="form-group">
      <label class="control-label col-lg-12 text-left" > เลือกการดูสรุปยอด</label>
      <div class="col-lg-12">
        <select class="form-control" name="find" id="selected_find">
          <option value="today">วันนี้</option>
          <option value="date">รายวัน</option>
          <option value="month">รายเดือน</option>
          <option value="year">รายปี</option>
          <option value="7day">ย้อนหลัง7วัน</option>
          <option value="one_month">ย้อนหลัง 1 เดือน</option>
          <option value="three_month">ย้อนหลัง 3 เดือน</option>
          <option value="one_year">ย้อนหลัง 1 ปี</option>
          <option value="custom">กำหนดเอง</option>
        </select>
        <br>
      </div>
    </div>
      <div class="form-group" id="dynamic_find">
         <input type="hidden" name="find" value="today" >
    </div>
    <button type="submit" class="btn btn-lg btn-outline-green" style="width:100px" name="button">ดูสรุปยอด</button>
    </form>
    <hr>
    </div>
</div>
<?php if(isset($sales) && count($sales) > 0): ?>
<?php if($message = Session::get('msg')): ?>
<h4 class="text-center"><?php echo e($message); ?></h4>
<br>
<?php endif; ?>
<canvas id="amount" style="margin-bottom:50px"></canvas>
<?php else: ?>
<div class="alert alert-info" role="alert">ไม่มีข้อมูลที่ต้องการ กรุณาค้นหาใหม่</div>
<?php endif; ?>
</div>


<?php if(isset($sales) ): ?>
<script type="text/javascript">
var ctx = document.getElementById('amount').getContext('2d');
var chart = new Chart(ctx, {
  // The type of chart we want to create
  type: 'bar',

  // The data for our dataset
  data: {
      labels: [<?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo '"'.$sale->type.'"'.','; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
      datasets: [{
          label: "สรุปยอดการขายขยะ",
          backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(250, 99, 80)',
                'rgb(35, 55, 80)'
                ],
          borderColor: 'rgb(255, 99, 132)',

          data: [<?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo ($sale->sum_sale_profit) - ($sale->sum_sale_loss).','; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>,0],
      }]
  },

  // Configuration options go here
  options: {}
});
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>