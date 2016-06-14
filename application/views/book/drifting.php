
<!-- 显示申请借阅，借阅成功，借阅失败的表格-->
<h2 style="text-align: center;">The history of drifting</h2>
<br>
<div class="container">
    <table class="table table-striped">
        <tr>
            <!-- 流水号 -->
            <th>No.</th>
            <th>User</th>
            <th>Starting time</th>
            <th>End time</th>
            <th>Status</th>
        </tr>
        <!-- 成功分享，没有被借阅 -->
        <?php $i=1; foreach ($logs as $log){?>
        <tr>
            <td><?php echo $i++;?></td>
            <td><a href="<?php echo site_url('user/info').'/'.$log->username;?>"><?php echo $log->username;?></a></td>
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

