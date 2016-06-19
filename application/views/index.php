<!-- 巨幕 -->
<!-- ================================================== -->
<div class="container">
    <div class="jumbotron">
        <h1>Book Share</h1>
        <br>
        <h3>Books is flying here! Find your own books! Share your books!</h3>
    </div>
</div>

<div id="body">
    <!-- 分享书籍的显示 -->
    <?php foreach ($books as $book) { ?>
        <div class="container">
            <!-- 第一本书的介绍 -->
            <hr class="featurette-divider" align="center">
            <div>
                <div>
                    <!-- 书籍的图片 -->
                    <img class="img-responsive col-md-2"
                         src="<?php echo $book->image; ?>"
                         alt="<?php echo $book->bookname; ?>" width="100" height="100">
                </div>
                <div col-md-3>
                    <!-- 书籍的标题 -->
                    <h2 class="featurette-heading"><a
                            href="<?php echo site_url('book') . '/' . $book->bookid; ?>"><?php echo $book->bookname ?></a>
                        <!-- 书籍的作者 -->
                        <span class="label label-info"><?php echo $book->author ?></span>
                        <span class="label label-default"><?php echo $book->class ?></span>
                        <span class="label label-primary"><?php echo $book->status ?></span>
                        <?php if ($book->status == '在架上' || $book->status == '在读') { ?>
                            <span><a href="<?php echo site_url('book/borrow') . '/' . $book->bookid; ?>"
                                     class="btn btn-warning" style="color: blue" role="button">预约</a></span>
                        <?php } ?>
                    </h2>
                    <!-- 书籍的介绍 -->
                    <p class="lead"><?php echo $book->introduction ?></p>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<div id="nodata" class="container"></div>
<script>
    $(function () {
        var winH = $(window).height(); //页面可视区域高度
        var i = 1; //设置当前页数
        $(window).scroll(function () {
            var pageH = $(document.body).height();
            var scrollT = $(window).scrollTop(); //滚动条top
            var aa = (pageH - winH - scrollT) / winH;
            if (aa < 0.01) {
                $.getJSON("/book/more", {page: i}, function (json) {
                    if (json!='') {
                        var str = "";
                        $.each(json, function (index, array) {
                            str += "<div class='container'> <hr class='featurette-divider' align='center'> <div> <div> <img class='img-responsive col-md-2' src='"+array['image']+"' alt='"+ array['bookname'] +"' width='100' height='100'> </div> <div col-md-3>";
                            str += "<h2 class='featurette-heading'><a href='/book/" + array['bookid'] +"'>" + array['bookname'] + "</a>";
                            str += "<span class='label label-info'>"+ array['author'] + "</span>";
                            str += "<span class='label label-default'>"+ array['class'] +"</span>";
                            str += "<span class='label label-primary'>"+ array['status'] +"</span>";
                            if (array['status'] == '在架上' || array['status'] == '在读') {
                                str+="<span><a href='/book/borrow/"+ array['bookid'] + "' class='btn btn-warning' style='color: blue' role='button'>预约</a></span>";
                            };
                            str+="</h2>";
                            str+="<p class='lead'>"+ array['introduction'] +"</p> </div> </div> </div>";
                        });
                        $("#body").append(str);
                        i++;
                    } else {
                        $("#nodata").html("<div class='alert alert-warning' role='alert'>别滚动了，已经到底了。。。</div>");
                        return false;
                    }
                });
            }
        });
    });

</script>

