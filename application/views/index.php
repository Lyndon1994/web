<style>
    .box {
        float: left;
        padding: 10px;
        border: 1px solid #ccc;
        background: #f7f7f7;
        box-shadow: 0 0 8px #ccc;
        margin: 10px;
    }

    .box:hover { box-shadow: 0 0 10px #999; }
    .box{width: 210px}
    .box img { width: 210px; }
    .grid {
        position: relative;
    }
    .grid-item {
        position: absolute;
    }
    .grid-item {
        transition: .3s ease-in-out;
    }
</style>
<!-- 巨幕 -->
<!-- ================================================== -->
<div class="container">
    <div class="jumbotron">
        <h1>Book Share</h1>
        <br>
        <h3>Books is flying here! Find your own books! Share your books!</h3>
    </div>
</div>
<div class="container">
<div id="body" class="grid">
    <!-- 分享书籍的显示 -->
    <?php foreach ($books as $book) { ?>
        <div class="box grid-item">
            <img class="img-responsive col-md-2"
                 src="<?php echo $book->image; ?>"
                 alt="<?php echo $book->bookname; ?>"
                href="<?php echo site_url('book') . '/' . $book->bookid; ?>"/>
            <h3><a href="<?php echo site_url('book') . '/' . $book->bookid; ?>"><?php echo $book->bookname ?></a></h3>
            <!-- 书籍的作者 -->
            <p><span class="label label-info"><?php echo $book->author ?></span></p>
            <span class="label label-primary"><?php echo $book->status ?></span>
            <?php if ($book->status == '在架上' || $book->status == '在读') { ?>
                <span class="label label-success"><a href="<?php echo site_url('book/borrow') . '/' . $book->bookid; ?>" style="color: yellow">预约</a></span>
            <?php } ?>
            <p><?php if (mb_strlen($book->introduction,"utf-8")>30) echo mb_substr($book->introduction,0,30,'utf-8')."...";
                else echo $book->introduction;?></p>
        </div>
    <?php } ?>
</div>
</div>
<div id="nodata" class="container"></div>
<script type="text/javascript" src="/source/js/minigrid.js"></script>

<script>
    minigrid('.grid', '.grid-item',10);
    window.addEventListener('resize', function(){
        minigrid('.grid', '.grid-item',10);
    });
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
                        $.each(json, function (index, book) {
                            str+="<div class='box grid-item'><img class='img-responsive col-md-2' src='"+book['image']+"' alt='"+book['bookname']+"' href='/book/" + book['bookid']+"'/>";
                            str+="<h3><a href='/book/' "+ book['bookid']+"'>"+book['bookname']+"</a></h3>";
                            str+="<p><span class='label label-info'>"+book['author'] +"</span></p>";
                            str+="<span class='label label-primary'>"+book['status']+"</span>";
                            if (book['status'] == '在架上' || book['status'] == '在读') {
                                str+"<span class='label label-success'><a href='/book/borrow/' "+ book['bookid']+"' style='color: yellow'>预约</a></span>";
                            };
                            var intro=book['introduction'];
                            if (intro.length>30) {intro = intro.substr(0,30)+"...";}
                            str+="<p>"+intro+"</p>";
                            str+="</div>";
                        });
                        $("#body").append(str);
                        i++;
                        minigrid('.grid', '.grid-item',10);
                    } else {
                        $("#nodata").html("<div class='alert alert-warning' role='alert'>别滚动了，已经到底了。。。</div>");
                        return false;
                    }
                });
            }
        });
    });

</script>
