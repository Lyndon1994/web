<div class="container">
    <center>
        <form action="<?php echo site_url('user/get_password'); ?>" method="post" class="form-signin"
              style="width:600px;height:70px;text-align: left" ;>
            <h2 class="form-signin-heading" style="text-align: center;"> Get Password</h2>
            <?php if (isset($error) && $error != '') { ?>
                <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
            <?php } ?>
            <?php if (isset($success) && $success != '') { ?>
                <div class="alert alert-success" role="alert"><?php echo $success; ?></div>
            <?php } ?>
            <!-- username -->
            <?php echo form_error('username'); ?>
            <input name="username" type="email" id="inputEmail"
                   class="form-control" placeholder="Your email" required autofocus>
            <br>
            <?php echo form_error('validate'); ?>
            <input type="text" name="validate" placeholder="captcha" size=10  class="form-control" required/>
            <img title="点击刷新" src="<?php echo site_url('captcha');?>" align="absbottom" onclick="this.src='<?php echo site_url('captcha');?>?'+Math.random();"/>
            <br><br>
            <!-- summit -->
            <button class="btn btn-lg btn-primary btn-block " type="submit">Commit</button>
        </form>
        <br>
        <br>
        <br>
        <br>
    </center>
</div>
