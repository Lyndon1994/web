<!-- 提交书本的表单-->
<div class="container">
    <center>
        <form action="<?php echo site_url('book/add'); ?>" enctype="multipart/form-data" method="post"
              class="form-signin"
              style="width:600px;height:70px;text-align: left" ;>
            <h2 class="form-signin-heading" style="text-align: center;">Share My Book</h2>
            <?php if (isset($tip) && $tip != '') { ?>
                <div class="alert alert-danger" role="alert"><?php echo $tip; ?></div>
            <?php } ?>
            <!--图书ID-->
            <input name="bookid" type="hidden" value="<?php
            $sql = "select bookid from book order by bookid desc limit 1";
            $ids = $this->db->query($sql)->result();
            echo($ids[0]->bookid + 1); ?>">
            <!-- 图书名字 -->
            <label for="bookName" class="form-group">Book Name</label>
            <?php echo form_error('bookname'); ?>
            <input name="bookname" type="text" id="bookName" class="form-control" placeholder="Book Name" required
                   autofocus>
            <br>
            <!-- 选择图书的图片 -->
            <div class="form-group">
                <label for="inputImg"><span data-toggle="tooltip" data-placement="left" title="优先使用自己上传的图片">Image(Within 1M)</span></label>
                <input type="file" name="userfile" id="inputImg">
                <input type="text" name="webimage" id="webImg" class="form-control" placeholder="Book Web Image">
            </div>
            <script>
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            </script>
            <br>
            <!-- 图书作者 -->
            <label for="bookAuthor" class="form-group">Book Author</label>
            <?php echo form_error('author'); ?>
            <input name="author" type="text" id="bookAuthor" class="form-control" placeholder="Book Author" required>
            <br>
            <!-- 图书种类 -->
            <label for="class" class="form-group">Book Tags</label>
            <?php echo form_error('class'); ?>
            <input name="class" type="text" id="bookClass" class="form-control"
                   placeholder="Book Tags(More tags separated by spaces)" required>
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

<script src="<?php echo base_url(); ?>source/js/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#bookName").change(function () {
            var bookname = $("#bookName")[0].value;
            $.ajax({
                url: "https://api.douban.com/v2/book/search",
                data:{q: bookname, count: 1},
                type: "GET",
                dataType: 'JSONP',
                success: function(result){
                    console.log(result);
                    $.each(result.books, function (index, item) {
                        console.log(item.author);
                        console.log(item.pubdate);
                        $('#bookAuthor')[0].value=item.author;
                        var tags = '';
                        $.each(item.tags,function (i, names) {
                            tags+=names.name+" ";
                        });
                        $('#bookClass')[0].value=tags;
                        $('#about').val(item.summary);
                        $('#webImg').val(item.images.large);
                        $('#bookName').val(item.title);
                    });
                }
            });

        });
    });

</script>