
<!-- 检查表单是否完整 -->
<script src="<?php echo base_url();?>source/js/bootstrap.min.js"></script>
<!-- 登陆 -->
<div class="container">
    <center>
        <!-- 登陆的表单 -->
        <form action="<?php echo site_url('user/login');?>" method="post" class="form-signin" style="width:300px;height:35px;text-align: left" ;>
            <h2 class="form-signin-heading">Please sign in</h2>
            <?php if (isset($tip)&&$tip!=''){ ?>
                <div class="alert alert-danger" role="alert"><?php echo $tip;?></div>
            <?php } ?>
            <br>
            <!-- 账户 -->
            <label for="inputEmail" class="sr-only">Email address</label>
            <input name="username" type="text" id="inputEmail" class="form-control" placeholder="user name" required autofocus>
            <br>
            <!-- 密码 -->
            <label for="inputPassword" class="sr-only">Password</label>
            <input name="password" type="password" id="inputPassword" class="form-control" placeholder="password" required>
            <br>
            <label for="inputPassword" class="sr-only">Captcha</label>
            <input type="text" name="validate" placeholder="captcha" size=10  class="form-control" required/>
            <img title="点击刷新" src="<?php echo site_url('captcha');?>" align="absbottom" onclick="this.src='<?php echo site_url('captcha');?>?'+Math.random();"/>

            <!-- 调转到注册页面 -->
            <p><a href="<?php echo site_url('user/register');?>">Do not have account!</a></p>
            <!-- 是否记住密码 -->
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <!-- 提交按钮 -->
            <button class="btn btn-lg btn-primary btn-block" type="submit"">Sign in</button>
        </form>
    </center>
</div>

