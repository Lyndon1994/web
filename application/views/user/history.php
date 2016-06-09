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
<!-- 导航条 -->
<div class="navbar-wrapper">
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- 标题的头部 -->
                <div class="navbar-header ">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                            aria-expanded="false" aria-controls="navbar">
                    </button>
                    <!-- 标题的名字 -->
                    <a class="navbar-brand" href="#">Book Share</a>
                </div>
                <!-- 副标题 -->
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <!-- 返回主页 -->
                        <li>
                            <a href="main.html"><span class="glyphicon glyphicon-home"></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- 显示申请借阅，借阅成功，借阅失败的表格-->
<h2 style="text-align: center;">My application</h2>
<br>
<div class="container">
    <table class="table table-striped">
        <tr>
            <!-- 流水号 -->
            <th>No.</th>
            <th>Book name</th>
            <!-- 记录类型：借阅，分享 -->
            <th>Starting time</th>
            <!-- 申请时间 -->
            <th>End time</th>
            <th>Status</th>
        </tr>
        <!-- 成功分享，没有被借阅 -->
        <?php $i=1; foreach ($logs as $log){?>
        <tr>
            <td><?php echo $i++;?></td>
            <td><a href="<?php echo site_url('book').'/'.$log->bookid;?>"><?php echo $log->bookname;?></a></td>
            <td><?php echo $log->begintime;?></td>
            <td><?php echo $log->endtime;?></td>
            <td><?php echo $log->status;?></td>
        </tr>
        <?php }?>
    </table>
    <br>
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
