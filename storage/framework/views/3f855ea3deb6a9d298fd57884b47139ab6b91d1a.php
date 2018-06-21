<?php $__env->startSection('content'); ?>
<div class="row">
  <?php if($message = Session::get('success_msg')): ?>
  <div class="col-lg-12">
    <div class="alert alert-danger">
        <p><?php echo e($message); ?></p>
    </div>
    </div>
<?php endif; ?>
  <div class="col-lg-12">
    <form action="<?php echo e(route('account.update')); ?>" id="formWithdraw">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="text-center">
          <h2>ถอน</h2>
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
      <div class="col-lg-10 text-center" style="margin-bottom:40px">
        <h2>ยอดเงินคงเหลือ: <?php echo e($balance); ?> บาท</h2>
      </div>
      <div class="col-lg-10" style="margin-bottom:40px">
        <label for="">ระบุจำนวนเงินที่ต้องการถอน</label>
        <input class="form-control" name="withdraw" type="number" min="1"  value="" id="withdraw"  >
      </div>
      <div class="col-lg-2" style="margin-bottom:40px">
        <br>
        <h4>บาท</h4>
      </div>
    <input type="hidden" name="garbage_id" value="1" >
    <input type="hidden" name="unit" value="0" >
    <input type="hidden" name="deposit" value="0" >
    <input type="hidden" name="user_id" value="<?php echo e($users->id); ?>">
    <input type="hidden" name="purchase_price" value="0">
    <input type="hidden" name="balance" id="balance" value="">
  </div>
</div>
  <div class="panel-footer">
    <div class="text-center">
      <a href="../../account/detail?username=<?php echo e($users->username); ?>" type="button" name="button" class="btn btn-lg btn-danger">ย้อนกลับ</a>
      <button type="button" id="btn-submit" class="btn btn-lg btn-success" style="width:100px;margin-left:20px">ถอน</button>
    </div>
  </div>
  </form>
</div>
  </div>
  <script type="text/javascript">
    $('#btn-submit').on('click',function(e) {
        swal({
          title: "คุณต้องการถอนเงิน?",
          text: "คุณต้องการถอนเงินจำนวน "+$("#withdraw").val()+" บาท",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((value) => {
            if(value === true){
              $("#formWithdraw").submit()
            } else {
              $("#withdraw").val(null)
            }
        })
    })
    $("#withdraw").keyup(function(event) {
      let amount = event.target.value
      if(amount > <?php echo e($balance); ?> || amount <= 0) {
        swal("คุณใส่ยอดเงินเกินกว่าที่จะถอนได้!", "กรุณาใส่ยอดเงินที่ถูกต้อง", "error").then((value) => {
          if(value === true) {
            $("#balance").val(0)
            $("#withdraw").val(null)
          }
        })
      } else {
        $("#balance").val(<?php echo e($balance); ?> - amount)
      }
    })
  </script>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>