<!-- 用户书籍记录 -->
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>history@book share</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>source/css/bootstrap.min.css" rel="stylesheet">
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
<!-- 显示申请借阅，借阅成功，借阅失败的表格-->
<div class="container">
<div class="jumbotron">
    <h1><?php echo $user->username;?></h1>
    <p><span class="label label-primary">Phone:<?php echo $user->phone;?></span>
        <span class="label label-info">Credit:<?php echo $user->credits;?></span>
    </p>
    <p><span class="label label-default">Address:<?php echo $user->address;?></span></p>
</div>
</div>
<br>
<div class="container">
    <h2 style="text-align: center;">My Shared Books</h2>
    <table class="table table-striped">
        <tr>
            <!-- 流水号 -->
            <th>No.</th>
            <th>Book name</th>
            <th>Owner</th>
            <th>Status</th>
            <th>Time</th>
        </tr>
        <!-- 成功分享，没有被借阅 -->
        <?php $i=1; foreach ($books as $book){?>
        <tr>
            <td><?php echo $i++;?></td>
            <td><a href="<?php echo site_url('book').'/'.$book->bookid;?>"><?php echo $book->bookname;?></a></td>
            <td><a href="<?php echo site_url('user/info').'/'.$book->owner;?>"><?php echo $book->owner;?></a></td>
            <td><a href="<?php echo site_url('user/info').'/'.$book->lender;?>"><?php echo $book->lender;?></a><?php echo $book->status;?></td>
            <td><?php echo $book->time;?></td>
        </tr>
        <?php }?>
    </table>
    <hr>
    <h2 style="text-align: center;">My Owned Books</h2>
    <table class="table table-striped">
        <tr>
            <!-- 流水号 -->
            <th>No.</th>
            <th>Book name</th>
            <th>Primitive Owner</th>
            <th>Status</th>
            <th>Time</th>
        </tr>
        <!-- 成功分享，没有被借阅 -->
        <?php $i=1; foreach ($ownbooks as $ownbook){?>
            <tr>
                <td><?php echo $i++;?></td>
                <td><a href="<?php echo site_url('book').'/'.$ownbook->bookid;?>"><?php echo $ownbook->bookname;?></a></td>
                <td><a href="<?php echo site_url('user/info').'/'.$ownbook->username;?>"><?php echo $ownbook->username;?></a></td>
                <td><a href="<?php echo site_url('user/info').'/'.$ownbook->lender;?>"><?php echo $ownbook->lender;?></a><?php echo $ownbook->status;?></td>
                <td><?php echo $ownbook->time;?></td>
            </tr>
        <?php }?>
    </table>
    <br>
    <!-- 返回按钮 -->
    <script type="text/javascript">
        function goBack() {
            history.back();
        }
    </script>
    <button onclick=" goBack() " class="glyphicon glyphicon-arrow-left btn-lg "></button>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js "></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js "></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url();?>source/js/bootstrap.min.js "></script>
</body>

</html>
