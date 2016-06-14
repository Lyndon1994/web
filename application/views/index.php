<!-- 巨幕 -->
<!-- ================================================== -->
<div class="container">
    <div class="jumbotron">
        <h1>Book Share</h1>
        <br>
        <h3>Books is flying here! Find your own books! Share your books!</h3>
    </div>
</div>
<!-- Marketing messaging and featurettes
  ==================================================
  <!-- Wrap the rest of the page in another container to center all the content.

  <div class="container marketing">

    <!-- 分享书籍的显示 -->
<?php foreach ($books as $book) { ?>
    <div class="container">
        <!-- 第一本书的介绍 -->
        <hr class="featurette-divider" align="center">
        <div>
            <div>
                <!-- 书籍的图片 -->
                <img class="img-responsive col-md-2" src="<?php echo base_url('source/images/books').'/'.$book->image ?>"
                     alt="<?php echo $book->bookname ?>" width="100" height="100">
            </div>
            <div col-md-3>
                <!-- 书籍的标题 -->
                <h2 class="featurette-heading"><a
                        href="<?php echo site_url('book') . '/' . $book->bookid; ?>"><?php echo $book->bookname ?></a>
                    <!-- 书籍的作者 -->
                    <span class="label label-info"><?php echo $book->author ?></span>
                    <span class="label label-default"><?php echo $book->class ?></span>
                    <span class="label label-primary"><?php echo $book->status ?></span>
                    <?php if ($book->status == '在架上'||$book->status == '在读') { ?>
                        <span><a href="<?php echo site_url('book/borrow').'/'.$book->bookid; ?>" class="btn btn-warning" style="color: blue" role="button">预约</a></span>
                    <?php } ?>
                </h2>
                <!-- 书籍的介绍 -->
                <p class="lead"><?php echo $book->introduction ?></p>
            </div>
        </div>
    </div>
<?php } ?>

