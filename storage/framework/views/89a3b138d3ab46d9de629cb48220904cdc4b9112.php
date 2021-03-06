<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center backgroung-gd"><h4 style="color:#ffffff">เข้าสู่ระบบ</h4></div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group<?php echo e($errors->has('username') ? ' has-error' : ''); ?>">
                            <label for="username" class="col-md-4 control-label">ชื่อผู้ใช้/อีเมล</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="<?php echo e(old('username')); ?>" required autofocus>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('username') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">รหัสผ่าน</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                                <?php if($errors->has('username')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('username')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> จดจำฉัน
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-lg btn-green">
                                    เข้าสู่ระบบ
                                </button>
                                <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                    ลืมรหัสผ่าน?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>