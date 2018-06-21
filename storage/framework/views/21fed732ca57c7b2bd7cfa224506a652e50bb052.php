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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-datepicker3.min.css')); ?>">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?php echo e(asset('js/bootstrap-datepicker.min.js')); ?>" charset="utf-8"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-alpha.2/classic/ckeditor.js"></script>
    <script src="<?php echo e(asset('js/bootstrap-datepicker-custom.js')); ?>" charset="utf-8"></script>
    <script src="<?php echo e(asset('js/bootstrap-datepicker.th.min.js')); ?>" charset="utf-8"></script>
    <script src="<?php echo e(asset('js/script.js')); ?>" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script>
    $(function(){
      $('.bxslider').bxSlider({
        auto: true,
		    mode: 'fade'
      });
      $('#sandbox-container input').datepicker({
        format: "dd/mm/yyyy",
        todayBtn: "linked",
        language: "th",
        toggleActive: true
      });
    });
  </script>
</head>
<body style="font-family: 'Kanit', sans-serif;">
<div id="app">
    <nav class="navbar navbar-default navbar-static-top backgroung-gd">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                    <img src="<?php echo e(asset('img/psu-logo.png')); ?>" style="max-width:300px; margin-top: -9px;" alt="Brand">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav" style="color:#ffffff">
                  <?php if(auth()->guard()->guest()): ?>
                    &nbsp;
                  <?php elseif( Auth::user()->role == "admin"): ?>
                  <li ><a style="color:#ffffff"  href="<?php echo e(url('/index')); ?>">หน้าควบคุม</a></li>
                    <li ><a style="color:#ffffff"  href="<?php echo e(route('news.index')); ?>">ข่าวกิจกรรม</a></li>
                    <li ><a style="color:#ffffff"  href="<?php echo e(route('garbage.index')); ?>">ราคารับซื้อ</a></li>
                    <li ><a style="color:#ffffff" href="<?php echo e(route('account.index')); ?>">ฝาก/ถอน</a></li>
                    <li ><a style="color:#ffffff" href="<?php echo e(route('sale.index')); ?>">ส่งขาย</a></li>
                    <li ><a style="color:#ffffff" href="<?php echo e(route('profit.index')); ?>">กำไร/ขาดทุน</a></li>
                    <li ><a style="color:#ffffff" href="<?php echo e(route('chart.index')); ?>">สรุปยอด</a></li>
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
                        <li class="dropdown">
                            <a style="color:#ffffff" href="#" class="dropdown-toggle dd-t" data-toggle="dropdown" role="button" aria-expanded="false">
                              ยินดีต้อนรับคุณ  <?php echo e(Auth::user()->firstname); ?> <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu" >
                                <li>
                                  <a href="<?php echo e(route('profile.index')); ?>"><span class="lnr lnr-user"></span> ข้อมูลส่วนตัว</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('logout')); ?>"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        <span class="lnr lnr-exit"></span>
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
<script type="text/javascript">
ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .catch( error => {
        console.error( error );
    });

</script>
</body>
</html>
