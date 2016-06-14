<!-- 显示申请借阅，借阅成功，借阅失败的表格-->
<div class="container">
    <div class="jumbotron">
        <h1><?php echo $userInfo->username; ?></h1>
        <p><span class="label label-primary">Phone:<?php echo $userInfo->phone; ?></span>
            <span class="label label-info">Credit:<?php echo $userInfo->credits; ?></span>
        </p>
        <p><span class="label label-default">Address:<?php echo $userInfo->address; ?></span></p>
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
        <?php $i = 1;
        foreach ($books as $book) { ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><a href="<?php echo site_url('book') . '/' . $book->bookid; ?>"><?php echo $book->bookname; ?></a>
                </td>
                <td><a href="<?php echo site_url('user/info') . '/' . $book->owner; ?>"><?php echo $book->owner; ?></a>
                </td>
                <td>
                    <a href="<?php echo site_url('user/info') . '/' . $book->lender; ?>"><?php echo $book->lender; ?></a><?php echo $book->status; ?>
                </td>
                <td><?php echo $book->time; ?></td>
            </tr>
        <?php } ?>
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
        <?php $i = 1;
        foreach ($ownbooks as $ownbook) { ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td>
                    <a href="<?php echo site_url('book') . '/' . $ownbook->bookid; ?>"><?php echo $ownbook->bookname; ?></a>
                </td>
                <td>
                    <a href="<?php echo site_url('user/info') . '/' . $ownbook->username; ?>"><?php echo $ownbook->username; ?></a>
                </td>
                <td>
                    <a href="<?php echo site_url('user/info') . '/' . $ownbook->lender; ?>"><?php echo $ownbook->lender; ?></a><?php echo $ownbook->status; ?>
                </td>
                <td><?php echo $ownbook->time; ?></td>
            </tr>
        <?php } ?>
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

