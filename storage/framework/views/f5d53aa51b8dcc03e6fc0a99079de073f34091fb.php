<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 text-center">
      <h3>ประวัติส่งขายขยะ</h3>
      <hr class="gd">
  </div>
    <div class="row">
      <div class="col-lg-12 text-center" style="margin-top:20px">
        <a href="<?php echo e(route('sale.add')); ?>" class="btn btn-lg btn-green" type="button" name="button"><i class="fa fa-plus"></i> ส่งขายขยะ</a>
      </div>
      <?php if(Session::has('success_msg')): ?>
      <div class="col-lg-12" style="margin-top:20px">
         <div class="alert alert-success"><?php echo e(Session::get('success_msg')); ?></div>
      </div>
     <?php endif; ?>
     <div class="col-lg-12 col-md-12 col-xs-12 text-center" style="margin-top:20px;background-color:#ffffff">
     <?php if(isset($sales)): ?>
       <table class="table table-hover">
         <thead>
           <tr class="text-center">
             <th class="text-center">#</th>
             <th class="text-center">ประเภทขยะ</th>
             <th class="text-center">ราคาที่รับซื้อ(บาท/กิโลกรัม)</th>
             <th class="text-center">ราคาที่ขาย(บาท/กิโลกรัม)</th>
             <th class="text-center">จำนวน (กิโลกรัม)</th>
             <th class="text-center">ราคาขายสุทธิ</th>
             <th class="text-center">กำไร</th>
             <th class="text-center">ขาดทุน</th>
             <th class="text-center">วันที่ขาย</th>
           </tr>
         </thead>
         <tbody>
           <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <tr>
               <td><?php echo e($index +1); ?></td>
               <td><?php echo e($sale->type); ?></td>
               <td><?php echo e($sale->purchase_price); ?></td>
                <td><?php echo e($sale->sale_price); ?></td>
               <td><?php echo e($sale->unit); ?></td>
               <td><?php echo e($sale->sale_price * $sale->unit); ?></td>
               <td><?php echo e($sale->profit); ?></td>
               <td><?php echo e($sale->loss); ?></td>
               <td><?php echo e($sale->dateofsale); ?></td>
               <td>
                 <a href="<?php echo e(route('sale.edit',$sale->id)); ?>" type="button" class="btn btn-warning" name="button"><i class="fa fa-pencil"></i></a>
                 <a href="<?php echo e(route('sale.delete',$sale->id)); ?>" onclick="return confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?');" type="button" class="btn btn-danger" name="button"><i class="fa fa-trash"></i> </a>
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