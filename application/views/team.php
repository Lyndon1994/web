<!-- 成员的介绍 -->
<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
  <title>memberIntro@book share</title>
  <!-- Bootstrap -->
  <link href="<?php echo base_url(); ?>source/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<!-- 导航栏================================================== -->
<div class="navbar-wrapper">
  <div class="container">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- 标题的头部 -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                  aria-expanded="false" aria-controls="navbar">
            <!--  <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar">zjw</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span> -->
          </button>
          <!-- 标题的名字 -->
          <a class="navbar-brand" href="<?php echo site_url(); ?>">Book Share</a>
        </div>
        <!-- 副标题 -->
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <!-- 登录 -->
            <!--
            <script type="text/javascript">
            signinFuc();
            haveSigned(zjw);
            // 如果没有登录了，调用这个方法
            function signinFuc() {
              document.write("<li><a href=/"
                login.html / ">Sign in</a></li>");
            }
            //如果已经登录，那么调用这个方法
            function haveSigned(username) {
              document.write("<li><a href=/"
                login.html / ">" + username + "</a></li>");
            }
            </script>
            <li onloadstart="signinFuc()">
            </li> -->
            <?php
            if (isset($_SESSION['user'])) {
              $user = $_SESSION['user']; ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                   aria-haspopup="true" aria-expanded="false"><?php echo $user->username ?><span
                      class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo site_url('book/add'); ?>">Share my books</a></li>
                  <li><a href="<?php echo site_url('user'); ?>">My books</a></li>
                  <li><a href="<?php echo site_url('user/history'); ?>">History</a></li>
                  <?php if ($user->role == 'admin') { ?>
                    <li><a href="<?php echo site_url('book/manage'); ?>">Manage Books</a></li>
                    <li><a href="<?php echo site_url('user/manage'); ?>">Manage Users</a></li>
                  <?php } ?>
                  <li role="separator" class="divider"></li>
                  <!-- 如果是管理员，那么跳到管理员的界面 -->
                  <!-- 如果不是没有效果 -->
                  <li><a href="<?php echo site_url('user/logout'); ?>">Log Out</a></li>
                </ul>
              </li>
            <?php } else {
              ?>
              <li><a href="<?php echo site_url('user/login'); ?>">Sign in</a></li>
            <?php } ?>
            <!-- 搜索图书-->
            <!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!11 -->
            <li><a href="<?php echo site_url('about'); ?>">About</a></li>
            <form action="<?php echo site_url('book/search');?>" method="post" class="navbar-right navbar-form " role="search">
              <div class="form-group">
                <input name="key" type="text" class="form-control" placeholder="Search">
              </div>
              <button type="submit" class="btn btn-default">Search</button>
            </form>
          </ul>
          <!-- dropdown  -->
        </div>
    </nav>
  </div>
</div>
<!-- 人员介绍 -->
<div class="container">
  <h1 style="text-align: center;">Members Introduction</h1>
  <br>
  <br>
  <br>
  <div class="row">
    <!-- 人员 -->
    <div class="col-lg-4" align="center">
      <img class="img-circle" vertical-align="down" src="<?php echo base_url('source/images'); ?>/ly.jpg" width="140" height="140">
      <h2>Yi Lin</h2>
      <p class="text-danger">group leader</p>
      <p><a class="btn btn-default" href="#" role="button">support</a></p>
    </div>
    <!-- zjw -->
    <div class="col-lg-4" align="center">
      <img class="img-circle" src="<?php echo base_url('source/images'); ?>/zjw.jpg" width="140" height="140">
      <h2>Jiawei Zhou</h2>
      <p class="text-danger">Front-end web developer for this web</p>
      <p><a class="btn btn-default" href="#" role="button">support</a></p>
    </div>
    <!-- xiao nan -->
    <div class="col-lg-4" align="center">
      <img class="img-circle" src="<?php echo base_url('source/images'); ?>/pic.jpg" alt="Generic placeholder image" width="140" height="140">
      <h2>Nan Xiao</h2>
      <p class="text-danger">Database Designer</p>
      <p><a class="btn btn-default" href="#" role="button">View details </a></p>
    </div>
  </div>
  <!-- /.row -->
</div>
<!-- 其他人 -->
<div class="container">
  <div class="row">
    <!-- 人员 -->
    <div class="col-lg-4" align="center">
      <img class="img-circle" vertical-align="down" src="<?php echo base_url('source/images'); ?>/pic.jpg" width="140" height="140">
      <h2>Ming Wang</h2>
      <p>intro</p>
      <p><a class="btn btn-default" href="#" role="button">support</a></p>
    </div>
    <!-- zjw -->
    <div class="col-lg-4" align="center">
      <img class="img-circle" src="<?php echo base_url('source/images'); ?>/pic.jpg" width="140" height="140">
      <h2>Fangnin Chao</h2>
      <p>intro</p>
      <p><a class="btn btn-default" href="#" role="button">support</a></p>
    </div>
    <!-- xiao nan -->
    <div class="col-lg-4" align="center">
      <img class="img-circle" src="<?php echo base_url('source/images'); ?>/pic.jpg" alt="Generic placeholder image" width="140" height="140">
      <h2>Ruowen Ren</h2>
      <p>intro</p>
      <p><a class="btn btn-default" href="#" role="button">View details </a></p>
    </div>
  </div>
  <!-- /.row -->
</div>
<div class="container">
  <div class="row">
    <!-- 人员 -->
    <div class="col-lg-4" align="center">
      <img class="img-circle" vertical-align="down" src="<?php echo base_url('source/images'); ?>/pic.jpg" width="140" height="140">
      <h2>Yue Li</h2>
      <p>intro</p>
      <p><a class="btn btn-default" href="#" role="button">support</a></p>
    </div>
    <!-- zjw -->
    <div class="col-lg-4" align="center">
      <img class="img-circle" src="<?php echo base_url('source/images'); ?>/pic.jpg" width="140" height="140">
      <h2>Xin Wang</h2>
      <p>intro</p>
      <p><a class="btn btn-default" href="#" role="button">support</a></p>
    </div>
    <!-- xiao nan -->
    <div class="col-lg-4" align="center">
      <img class="img-circle" src="<?php echo base_url('source/images'); ?>/pic.jpg" alt="Generic placeholder image" width="140" height="140">
      <h2>Tian Yang</h2>
      <p>intro</p>
      <p><a class="btn btn-default" href="#" role="button">View details </a></p>
    </div>
  </div>
</div>
<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!! -->
<div class="container">
  <div class="row">
    <!-- 人员 -->
    <div class="col-lg-4" align="center">
      <img class="img-circle" vertical-align="down" src="<?php echo base_url('source/images'); ?>/pic.jpg" width="140" height="140">
      <h2>Xueting Zhang</h2>
      <p>intro</p>
      <p><a class="btn btn-default" href="#" role="button">support</a></p>
    </div>
  </div>
</div>
<!-- /.row -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url(); ?>source/js/bootstrap.min.js"></script>
</body>

</html>
