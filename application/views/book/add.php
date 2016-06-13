<!-- 分享书本的介绍 -->
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url(); ?>source/images/book.ico">
    <title>share my book</title>
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
<!-- 提交书本的表单-->
<div class="container">
    <center>
        <form action="<?php echo site_url('book/add'); ?>" enctype="multipart/form-data" method="post" class="form-signin"
              style="width:600px;height:70px;text-align: left" ;>
            <h2 class="form-signin-heading" style="text-align: center;">Share My Book</h2>
            <?php if (isset($tip)&&$tip!=''){ ?>
                <div class="alert alert-danger" role="alert"><?php echo $tip;?></div>
            <?php } ?>
            <!--图书ID-->
            <input name="bookid" type="hidden" value="<?php
            $sql = "select bookid from book order by bookid desc limit 1";
            $ids = $this->db->query($sql)->result();
            echo ($ids[0]->bookid+1);?>">
            <!-- 图书名字 -->
            <label for="bookName" class="form-group">Book Name</label>
            <?php echo form_error('bookname'); ?>
            <input name="bookname" type="text" id="bookName" class="form-control" placeholder="Book Name" required autofocus>
            <br>
            <!-- 选择图书的图片 -->
            <div class="form-group">
                <label for="inputImg">Image(Within 1M)</label>
                <input type="file" name="userfile" id="inputImg">
            </div>
            <br>
            <!-- 图书作者 -->
            <label for="bookAuthor" class="form-group">Book Author</label>
            <?php echo form_error('author'); ?>
            <input name="author" type="text" id="bookAuthor" class="form-control" placeholder="Book Author" required>
            <br>
            <!-- 图书种类 -->
            <label for="class" class="form-group">Book Author</label>
            <?php echo form_error('class'); ?>
            <input name="class" type="text" id="class" class="form-control"
                   placeholder="Book Class(More tags separated by spaces)" required>
            <br>
            <!-- 图书简介 -->
            <div>
                <label for="introduction" class="form-group">Book Introduction</label>
                <?php echo form_error('introduction'); ?>
                <textarea name="introduction" cols="60" rows="10" id="about"></textarea>
            </div>
            <br>
            <!-- summit -->
            <button class="btn btn-lg btn-primary btn-block" type="submit">Share</button>
            <br>
            <br>
            <br>
            <br>
            <br>
        </form>
    </center>
</div>
<!-- /container -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url(); ?>source/js/bootstrap.min.js"></script>
</body>

</html>
