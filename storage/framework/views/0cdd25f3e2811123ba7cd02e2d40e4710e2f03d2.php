

<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-lg-12">
    <form action="<?php echo e(route('account.insert')); ?>">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="text-center">
          <h2>ฝาก</h2>
        </div>
      </div>
  <div class="panel-body">
    <div class="col-lg-5">
      <h4>ชื่อผู้ใช้: <?php echo e($users->username); ?></h4>
      <h4>ชื่อ: <?php echo e($users->firstname); ?></h4>
      <h4>นามสกุล: <?php echo e($users->lastname); ?></h4>
      <h4>บาทบาท: <?php echo e($users->role); ?></h4>
    </div>
    <div class="col-lg-7">
      <div class="col-lg-10" style="margin-bottom:20px">
        <label for="">ประเภทขยะ</label>
        <select class="form-control" id="garbage" name="garbage_id">
          <option value="0">--กรุณาเลือกประเภทขยะ--</option>
          <?php $__currentLoopData = $garbages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garbage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($garbage->id != 1): ?>
          <option value="<?php echo e($garbage->id); ?>"><?php echo e($garbage->type); ?></option>
          <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
      <div class="col-lg-10" style="margin-bottom:20px">
        <label for="">ราคาที่รับซื้อ/กิโลกรัม</label>
        <input class="form-control disabled" type="number" step="any" min="1" max="999999"  value="" id="purchase_price" disabled>
      </div>
      <div class="col-lg-2" style="margin-bottom:20px">
        <br>
        <h4>บาท</h4>
      </div>
      <div class="col-lg-10" style="margin-bottom:20px">
        <label for="">จำนวน</label>
        <input class="form-control" type="number" step="any" min="1" max="999999" name="unit" value="" id="unit">
      </div>
      <div class="col-lg-2" style="margin-bottom:20px">
        <br>
        <h4>กิโลกรัม</h4>
      </div>
      <div class="col-lg-10" style="margin-bottom:20px">
        <label for="">รวมเป็นเงิน</label>
        <input class="form-control" step="any" min="1" max="999999" name="deposit" value="" id="summoney">
      </div>
      <div class="col-lg-2" style="margin-bottom:20px">
        <br>
        <h4>บาท</h4>
      </div>
    </div>
    <input type="hidden" name="user_id" value="<?php echo e($users->id); ?>">
    <input type="hidden" name="purchase_price" value="" id="purchase_price2">
    <input type="hidden" name="withdraw" value="0">
    <input type="hidden" name="balance" id="balance" value="0">
  </div>
  <div class="panel-footer">
    <div class="text-center">
      <a href="../../account/detail?username=<?php echo e($users->username); ?>" type="submit" name="button" class="btn btn-lg btn-danger">ย้อนกลับ</a>
      <button type="submit" class="btn btn-lg btn-success" style="width:100px;margin-left:20px">ฝาก</button>
    </div>
  </div>
  </form>
</div>
  </div>
  <script type="text/javascript">
    $("#garbage").change(function() {
      let gid = $("#garbage").val();
      $.getJSON( "/laravel/recyclebank/public/admin/garbage/purchaseprice/"+gid, function( data ) {
        $("#purchase_price").val(data.purchase_price)
        $("#purchase_price2").val(data.purchase_price)
      });
    });

    $("#unit").keyup(function(event) {
      let unit = event.target.value;//$("#unit").val();
      let pprice = $("#purchase_price").val();
      $("#summoney").val(unit*pprice);
      $("#balance").val(<?php echo e($balance); ?>+ (unit*pprice))
  });
  </script>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>