
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>服务说明 - 图书漂流系统新手帮助及导引</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="alternate icon" type="image/png" href="/assets/i/favicon.png">
    <link rel="stylesheet" href="<?php echo base_url(); ?>source/css/amazeui.min.css"/>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>source/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .get {
            background: #1E5B94;
            color: #fff;
            text-align: center;
            padding: 100px 0;
        }

        .get-title {
            font-size: 200%;
            border: 2px solid #fff;
            padding: 20px;
            display: inline-block;
        }

        .get-btn {
            background: #fff;
        }

        .detail {
            background: #fff;
        }

        .detail-h2 {
            text-align: center;
            font-size: 150%;
            margin: 40px 0;
        }

        .detail-h3 {
            color: #1f8dd6;
        }

        .detail-p {
            color: #7f8c8d;
        }

        .detail-mb {
            margin-bottom: 30px;
        }

        .hope {
            background: #0bb59b;
            padding: 50px 0;
        }

        .hope-img {
            text-align: center;
        }

        .hope-hr {
            border-color: #149C88;
        }

        .hope-title {
            font-size: 140%;
        }

        .about {
            background: #fff;
            padding: 40px 0;
            color: #7f8c8d;
        }

        .about-color {
            color: #34495e;
        }

        .about-title {
            font-size: 180%;
            padding: 30px 0 50px 0;
            text-align: center;
        }

        .footer p {
            color: #7f8c8d;
            margin: 0;
            padding: 15px 0;
            text-align: center;
            background: #2d3e50;
        }
    </style>
</head>
<body>
<!-- 导航栏================================================== -->
<div class="navbar-wrapper">
    <div class="container-fluid">
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

<div class="get">
    <div class="am-g">
        <div class="col-lg-12">
            <h1 class="get-title">图书漂流系统</h1>

            <p>
                首创P2P图书漂流溯源模式，期待你的参与，共同打造一个简单易用的图书漂流系统
            </p>

            <p>
                <a href="<?php echo site_url('user/register');?>" class="am-btn am-btn-sm get-btn">即刻注册√</a>
            </p>
        </div>
    </div>
</div>

<div class="detail">
    <div class="am-g am-container">
        <div class="col-lg-12">
            <!-- <h2 class="detail-h2">Enjoy our BookCrossing!</h2>-->
            <h2 class="detail-h2"></h2>
            <div class="am-g" name="project">
                <div class="col-lg-3 col-md-6 col-sm-12 detail-mb">

                    <h3 class="detail-h3">
                        <i class="am-icon-mobile am-icon-sm"></i>
                        为漂流而生
                    </h3>

                    <p class="detail-p">
                        图书漂流系统采用先进的 Mobile First 理念，从小屏逐步扩展到大屏，最终实现所有屏幕适配，适应移动互联潮流。
                    </p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 detail-mb">
                    <h3 class="detail-h3">
                        <i class="am-icon-cogs am-icon-sm"></i>
                        数据可控，漂流可视化
                    </h3>

                    <p class="detail-p">
                        从您注册的一刻起，依照您的权限，显示以及管理漂流信息。交换漂流图书时，拍下交换时候的图片凭据，录入数据即可完成漂流中转。
                    </p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 detail-mb">
                    <h3 class="detail-h3">
                        <i class="am-icon-check-square-o am-icon-sm"></i>
                        支持检索、点评、分享
                    </h3>

                    <p class="detail-p">
                        大量的图书，无法一一浏览，通过微信公众平台(book-crossing)或者站内搜索，用户可以检索到自己需要的图书。每册图书都有自己的页面，通过“多说”进行点评。无论哪个页面都可以分享出去，建议通过微信朋友圈。
                    </p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 detail-mb">
                    <h3 class="detail-h3">
                        <i class="am-icon-send-o am-icon-sm"></i>
                        轻量级，高性能
                    </h3>

                    <p class="detail-p">
                        图书漂流系统非常注重性能，小而美的架构，只有图书信息、漂流历史、会员数据，不过三个数据表而已。
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="hope">
    <div class="am-g am-container">
        <div class="col-lg-4 col-md-6 col-sm-12 hope-img">
            <img src="<?php echo base_url();?>source/images/landing.png" alt="" data-am-scrollspy="{animation:'slide-left', repeat: false}">
            <hr class="am-article-divider am-show-sm-only hope-hr">
        </div>
        <div class="col-lg-8 col-md-6 col-sm-12">
            <h2 class="hope-title">分享知识光荣，浪费智力可耻！</h2>

            <p>
                在知识爆炸的年代，我们不愿成为知识的过客，拥抱公益文化，发挥志愿服务联盟的力量，参与到图书漂流项目能获得自我提升。
            </p>
        </div>
    </div>
</div>

<div class="about">
    <div class="am-g am-container">
        <div class="col-lg-12">
            <h2 class="about-title about-color">图书漂流系统崇尚开放、自由，非常欢迎大家的参与</h2>

        </div>
    </div>
</div>

<footer class="footer">
    <p>Copyright © <a href="<?php echo site_url('about/team');?>">WEB.</a></p>
</footer>
</body>
</html>