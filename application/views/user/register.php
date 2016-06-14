<!-- 注册页面 -->
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>sign up@book share</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>source/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
                        <li><a href="<?php echo site_url('user/login'); ?>">Sign in</a></li>
                        <!-- 搜索图书-->
                        <!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!11 -->
                        <li><a href="<?php echo site_url('about'); ?>">About</a></li>
                        <form action="<?php echo site_url('book/search'); ?>" method="post"
                              class="navbar-right navbar-form " role="search">
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
<!-- 注册-->
<div class="container">
    <center>
        <form action="<?php echo site_url('user/register'); ?>" method="post" class="form-signin"
              style="width:600px;height:70px;text-align: left" ;>
            <h2 class="form-signin-heading" style="text-align: center;"> Sign Up</h2>
            <?php if (isset($tip) && $tip != '') { ?>
                <div class="alert alert-danger" role="alert"><?php echo $tip; ?></div>
            <?php } ?>
            <!-- username -->
            <label for="inputEmail" class="form-group">Email</label>
            <?php echo form_error('username'); ?>
            <input name="username" type="email" value="<?php echo set_value('username'); ?>" id="inputEmail"
                   class="form-control" placeholder="Your email" required autofocus>
            <br>
            <!-- 密码 -->
            <label for="inputPassword " class="form-group">Input Password</label>
            <?php echo form_error('password'); ?>
            <input name="password" type="password" value="<?php echo set_value('password'); ?>" id="inputPassword "
                   class="form-control " placeholder="Input Password " required>
            <br>
            <!-- 重复密码 -->
            <label for="ReInputPassword " class="form-group">ReInput Password</label>
            <?php echo form_error('passconf'); ?>
            <input name="passconf" type="password" value="<?php echo set_value('passconf'); ?>" id="ReInputPassword "
                   class="form-control" placeholder="ReInput Password " required>
            <!-- 检查密码是否相同 -->
            <script type="text/javascript">
                function checkPasswaord() {
                    
                }
            </script>
            <br>
            <!-- phone -->
            <div class="form-group ">
                <label for="tel">Phone</label>
                <?php echo form_error('phone'); ?>
                <input name="phone" type="tel" value="<?php echo set_value('phone'); ?>" id="phone"
                       class="form-control " placeholder="Your Phone" required>
            </div>
            <br>
            <!-- address -->
            <div class="form-group ">
                <label for="address">Address</label>
                <?php echo form_error('address'); ?>
                <input name="address" type="text" value="<?php echo set_value('address'); ?>" id="address"
                       class="form-control " placeholder="Your Address" required>
            </div>
            <br>
            <!-- summit -->
            <button class="btn btn-lg btn-primary btn-block " type="submit">Sign up</button>
        </form>
        <br>
        <br>
        <br>
        <br>
    </center>
</div>
<!-- /container -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js "></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js "></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url(); ?>source/js/bootstrap.min.js "></script>
</body>

</html>
