
<h2 style="text-align: center;">Manage Books</h2>
<br>
<div class="container">
    <table class="table table-striped">
        <tr>
            <!-- 流水号 -->
            <th>No.</th>
            <th>Book name</th>
            <th>Status</th>
            <th>Time</th>
            <th>Manage</th>
        </tr>
        <!-- 成功分享，没有被借阅 -->
        <?php $i=1; foreach ($books as $book){?>
        <tr>
            <td><?php echo $i++;?></td>
            <td><a href="<?php echo site_url('book').'/'.$book->bookid;?>"><?php echo $book->bookname;?></a></td>
            <td><a href="<?php echo site_url('user/info').'/'.$book->lender;?>"><?php echo $book->lender;?></a><?php echo $book->status;?></td>
            <td><?php echo $book->time;?></td>
            <td>
                <?php if ($book->status=='审核中'){?>
                    <a href="<?php echo site_url('book/pass').'/'.$book->bookid;?>" type="button" class="btn btn-success">通过</a>
                <?php } ?>
                <a href="<?php echo site_url('book/delete').'/'.$book->bookid;?>" type="button" class="btn btn-danger">删除</a>
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

