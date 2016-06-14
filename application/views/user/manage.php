
<h2 style="text-align: center;">Manage Users</h2>
<br>
<div class="container">
    <table class="table table-striped">
        <tr>
            <!-- 流水号 -->
            <th>No.</th>
            <th>User name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>role</th>
            <th>credits</th>
            <th>manage</th>
        </tr>
        <!-- 成功分享，没有被借阅 -->
        <?php $i=1; foreach ($users as $user){?>
            <tr>
                <td><?php echo $i++;?></td>
                <td><a href="<?php echo site_url('user').'/'.$user->username;?>"><?php echo $user->username;?></a></td>
                <td><?php echo $user->phone;?></td>
                <td><?php echo $user->address;?></td>
                <td><?php echo $user->role;?></td>
                <td><?php echo $user->credits;?></td>
                <td>
                    <a href="<?php echo site_url('user/change_credits').'/'.'10'.'/'.$user->username;?>" type="button" class="btn btn-success">加10分</a>
                    <a href="<?php echo site_url('user/change_credits').'/'.'-10'.'/'.$user->username;?>" type="button" class="btn btn-warning">减10分</a>
                    <?php if ($user->role != 'admin') { ?>
                    <a href="<?php echo site_url('user/defriend').'/'.$user->username;?>" type="button" class="btn btn-danger">拉黑</a>
                    <?php } ?>
                </td>
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

