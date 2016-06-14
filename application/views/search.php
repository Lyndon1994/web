
<h2 style="text-align: center;">Users</h2>
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
            <?php if (isset($_SESSION['user'])&&$_SESSION['user']->role == 'admin') { ?>
                <th>manage</th>
            <?php } ?>
        </tr>
        <?php $i=1; foreach ($users as $user){?>
            <tr>
                <td><?php echo $i++;?></td>
                <td><a href="<?php echo site_url('user/info').'/'.$user->username;?>"><?php echo $user->username;?></a></td>
                <td><?php echo $user->phone;?></td>
                <td><?php echo $user->address;?></td>
                <td><?php echo $user->role;?></td>
                <td><?php echo $user->credits;?></td>
                <?php if (isset($_SESSION['user'])&&$_SESSION['user']->role == 'admin') { ?>
                <td>
                    <a href="<?php echo site_url('user/change_credits').'/'.'10'.'/'.$user->username;?>" type="button" class="btn btn-success">加10分</a>
                    <a href="<?php echo site_url('user/change_credits').'/'.'-10'.'/'.$user->username;?>" type="button" class="btn btn-warning">减10分</a>
                    <?php if ($user->role != 'admin') { ?>
                    <a href="<?php echo site_url('user/defriend').'/'.$user->username;?>" type="button" class="btn btn-danger">拉黑</a>
                    <?php } ?>
                </td>
                <?php } ?>
            </tr>
        <?php }?>
    </table>
    <br>
</div>
<hr>
<hr>
<h2 style="text-align: center;">Books</h2>
<br>
<div class="container">
    <table class="table table-striped">
        <tr>
            <!-- 流水号 -->
            <th>No.</th>
            <th>Book name</th>
            <th>Status</th>
            <th>Time</th>
            <?php if (isset($_SESSION['user'])&&$_SESSION['user']->role == 'admin') { ?>
                <th>manage</th>
            <?php } ?>
        </tr>
        <!-- 成功分享，没有被借阅 -->
        <?php $i=1; foreach ($books as $book){?>
            <tr>
                <td><?php echo $i++;?></td>
                <td><a href="<?php echo site_url('book').'/'.$book->bookid;?>"><?php echo $book->bookname;?></a></td>
                <td><a href="<?php echo site_url('user/info').'/'.$book->lender;?>"><?php echo $book->lender;?></a><?php echo $book->status;?></td>
                <td><?php echo $book->time;?></td>
                <?php if (isset($_SESSION['user'])&&$_SESSION['user']->role == 'admin') { ?>
                <td>
                    <?php if ($book->status=='审核中'){?>
                        <a href="<?php echo site_url('book/pass').'/'.$book->bookid;?>" type="button" class="btn btn-success">通过</a>
                    <?php } ?>
                    <a href="<?php echo site_url('book/delete').'/'.$book->bookid;?>" type="button" class="btn btn-danger">删除</a>
                </td>
                <?php } ?>
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

