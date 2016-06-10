<!-- 登陆页面 -->
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>sign in@bookshare</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>source/css/bootstrap.min.css" rel="stylesheet">
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
<!-- 检查表单是否完整 -->
<script src="<?php echo base_url();?>source/js/bootstrap.min.js"></script>
<!-- 登陆 -->
<div class="container">
    <center>
        <!-- 登陆的表单 -->
        <form action="<?php echo site_url('user/login');?>" method="post" class="form-signin" style="width:300px;height:35px;text-align: left" ;>
            <h2 class="form-signin-heading">Please sign in</h2>
            <?php if (isset($tip)&&$tip!=''){ ?>
                <div class="alert alert-danger" role="alert"><?php echo $tip;?></div>
            <?php } ?>
            <br>
            <!-- 账户 -->
            <label for="inputEmail" class="sr-only">Email address</label>
            <input name="username" type="text" id="inputEmail" class="form-control" placeholder="user name" required autofocus>
            <br>
            <!-- 密码 -->
            <label for="inputPassword" class="sr-only">Password</label>
            <input name="password" type="password" id="inputPassword" class="form-control" placeholder="password" required>
            <br>
            <label for="inputPassword" class="sr-only">Captcha</label>
            <input type="text" name="validate" placeholder="captcha" size=10  class="form-control" required/>
            <img title="点击刷新" src="<?php echo site_url('captcha');?>" align="absbottom" onclick="this.src='<?php echo site_url('captcha');?>?'+Math.random();"/>

            <!-- 调转到注册页面 -->
            <p><a href="<?php echo site_url('user/register');?>">Do not have account!</a></p>
            <!-- 是否记住密码 -->
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <!-- 提交按钮 -->
            <button class="btn btn-lg btn-primary btn-block" type="submit"">Sign in</button>
        </form>
    </center>
</div>
<!-- /container -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
</body>

</html>
