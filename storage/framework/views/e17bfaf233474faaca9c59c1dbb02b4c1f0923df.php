<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body style="font-family: 'Kanit', sans-serif;">
<div id="app">
    <nav class="navbar navbar-default navbar-static-top backgroung-gd">
        <div class="container">
            <div class="navbar-header">
                <?php if(auth()->guard()->guest()): ?>
                <!-- Branding Image -->
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                <?php else: ?>
                <a class="navbar-brand" href="<?php echo e(url('/index')); ?>">
                <?php endif; ?>
                    <img src="<?php echo e(asset('img/logo2.png')); ?>" style="width:250px" alt="">
                </a>

            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav" style="color:#ffffff">
                  <?php if(auth()->guard()->guest()): ?>
                    &nbsp;
                  <?php elseif( Auth::user()->role == "admin"): ?>
                    <li ><a style="color:#ffffff"  href="">ข่าวกิจกรรม</a></li>
                    <li ><a style="color:#ffffff"  href="<?php echo e(route('garbage.index')); ?>">ราคารับซื้อ</a></li>
                    <li ><a style="color:#ffffff" href="<?php echo e(route('account.index')); ?>">ฝาก/ถอน</a></li>
                    <li ><a style="color:#ffffff" href="<?php echo e(route('sale.index')); ?>">ส่งขาย</a></li>
                    <li ><a style="color:#ffffff" href="<?php echo e(route('profit.index')); ?>">กำไร/ขาดทุน</a></li>
                    <li ><a style="color:#ffffff" href="">สรุปยอด</a></li>
                  <?php else: ?>
                    <li ><a style="color:#ffffff" href="<?php echo e(route('history.index')); ?>">ประวัติการฝาก/ถอน</a></li>
                  <?php endif; ?>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <?php if(auth()->guard()->guest()): ?>
                        <a class="btn btn-empty" style="height:40px;margin-top:5px;margin-right:10px" href="<?php echo e(route('login')); ?>">เข้าสู่ระบบ</a>
                        <a class="btn btn-white" style="height:40px;margin-top:5px" href="<?php echo e(route('register')); ?>">สมัครสมาชิก</a>
                    <?php else: ?>
                        <li class="dropdown" style="color:#ffffff">
                            <a style="color:#ffffff" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                              ยินดีต้อนรับคุณ  <?php echo e(Auth::user()->firstname); ?> <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu" >
                                <li>
                                  <a href="<?php echo e(route('profile.index')); ?>">ข้อมูลส่วนตัว</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('logout')); ?>"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        ออกจากระบบ
                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo e(csrf_field()); ?>

                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
      <?php if($message = Session::get('login')): ?>
         <?php if($message): ?>
         <style media="screen">
         .swal-text {
          font-size: 50px;
          }
         </style>
         <script>
          let uid = '<?php echo e($message); ?>'
          swal({html: true,title:"รหัสสำหรับฝาก/ถอน ของคุณคือ", text:uid});
         </script>
         <?php endif; ?>
    <?php endif; ?>
      <!-- Content here -->
    <?php echo $__env->yieldContent('content'); ?>
    </div>
</div>
<!-- Scripts   -->
</body>
</html>
