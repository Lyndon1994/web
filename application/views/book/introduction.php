<!-- 单本书的介绍 -->
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title><?php echo $book->bookname ?></title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>source/css/bootstrap.min.css" rel="stylesheet">
    <!-- 提示成功提交 -->
    <script type="text/javascript">
        function rentOK() {
            alert("The rent information is successful upload");
        }
    </script>
</head>

<body>
<!-- 导航栏
================================================== -->
<div class="navbar-wrapper">
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- 标题的头部 -->
                <div class="navbar-header ">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                            aria-expanded="false" aria-controls="navbar">
                        <!--  <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar">zjw</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span> -->
                    </button>
                    <!-- 标题的名字 -->
                    <a class="navbar-brand" href="#">Book Share</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- 返回主页 -->
                        <li>
                            <a href="main.html"><span class="glyphicon glyphicon-home"></span></a>
                        </li>
                    </ul>
                </div>
        </nav>
    </div>
</div>
</div>
<!-- 显示的内容 -->
<br>
<br>
<div class="container">
    <!-- 书籍显示的内容 -->
    <center>
        <div class="row center-block">
            <div class="col-lg-10">
                <!-- 书本的名字 -->
                <h1>
                    <a href="<?php echo site_url('book/' . $book->bookid . '/drifting'); ?>"><?php echo $book->bookname ?></a>
                </h1>
                <br>
                <br>
                <!-- 书本的图片 -->
                <img class="img-thumbnail col-md-5" src="<?php echo $book->image ?>" alt="<?php echo $book->bookname ?>"
                     width="600" height="600">
                <!-- 书本的介绍 -->
                <div class="panel panel-info">
                    <!-- 书籍的介绍组件 -->
                    <div class="panel-heading" style="align-content: center;">
                        <h3>Introduction</h3></div>
                    <!-- 书籍介绍的具体内容 -->
                    <div class="panel-body" style="text-align: left;" ;><?php echo $book->introduction ?></div>
                </div>
                <br>
                <!-- 书籍的附加信息 -->
                <div class="row featurette">
                    <!-- 书籍的作者 -->
                    <div class="panel panel-success col-md-3">
                        <div class="panel-heading" style="align-content: center;">book author</div>
                        <!-- 书籍的作者 -->
                        <div class="panel-body" style="text-align: center;"><?php echo $book->author ?></div>
                    </div>
                    <!-- 书籍的主人 -->
                    <div class="panel panel-default col-md-3">
                        <div class="panel-heading" style="align-content: center;">book owner</div>
                        <!-- 书籍的主人 -->
                        <div class="panel-body" style="text-align: center;"><?php echo $book->username ?></div>
                    </div>
                    <!-- 书籍的状态 -->
                    <div class="panel panel-warning col-md-3 ">
                        <div class="panel-heading" style="align-content: center;">book status</div>
                        <div class="panel-body" style="text-align: center;"><?php echo $book->status ?></div>
                    </div>
                    <!-- 书籍的登记时间 -->
                    <div class="panel panel-danger col-md-3">
                        <div class="panel-heading" style="align-content: center;">book record time</div>
                        <div class="panel-body" style="text-align: center;"><?php echo $book->time ?></div>
                    </div>
                </div>
                <!-- 显示评论的地方 -->
                <br>
                <h2 style="text-align: center;">I have so many comments</h2>
                <br>
                <div class="row center-block">
                    <!-- 每一条评论 -->
                    <?php foreach ($comments as $comment) { ?>
                        <div class="panel panel-info">
                            <div class="panel-heading pull-right" style="align-content: right;">
                                <?php echo $comment->username; ?>
                                <label>
                                    <?php echo $comment->time; ?>
                                </label>
                            </div>
                            <div class="panel-body">
                                <p style="text-align: left;">
                                    <?php echo $comment->content; ?>
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- 评论书籍的地方 -->
                <br>
                <br>
                <a name="commentA"></a>
                <h2 style="text-align: center;">welcome to comment here!</h2>
                <form action="<?php echo site_url('book/comment'); ?>" method="post">
                    <input name="bookid" type="hidden" value="<?php echo $book->bookid; ?>"/>
                    <label>
                        <textarea name="content" rows="10" cols="100"></textarea>
                    </label>
                    <br>
                    <input type="submit" value="submit comments"/>
                </form>
                <br>
                <br>
                <!-- 租借书的按钮 -->
                <?php if ($book->status == '在架上') { ?>
                    <p><a href="<?php echo site_url('book/borrow').'/'.$book->bookid; ?>" class="btn btn-warning" style="color: blue" role="button">rent this book</a></p>
                <?php } ?>
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
    </center>
    <!-- 书籍介绍 -->
</div>
<!-- 页面的页脚-->
<div class="container">
    <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2016 zjw &middot; <a href="#">Privacy</a> &middot; </p>
    </footer>
</div>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url(); ?>source/js/bootstrap.min.js"></script>
</body>

</html>
