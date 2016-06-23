<!-- 注册-->
<div class="container">
    <center>
        <form action="<?php echo site_url('user/register'); ?>" method="post" class="form-signin"
              style="width:600px;height:70px;text-align: left" ;>
            <h2 class="form-signin-heading" style="text-align: center;"> Sign Up</h2>
            <?php if (isset($tip) && $tip != '') { ?>
                <div class="alert alert-danger" role="alert"><?php echo $tip; ?></div>
            <?php } ?>
            <!-- nickname -->
            <label for="inputName" class="form-group">Name</label>
            <span style=color: red">?php echo form_error('nickname'); ?></span>
            <input name="nickname" type="text" value="<?php echo set_value('nickname'); ?>" id="inputName"
                   class="form-control" placeholder="Your Name" required autofocus>
            <br>
            <!-- username -->
            <label for="inputEmail" class="form-group">Email</label>
            <span style="color: red"><?php echo form_error('username'); ?></span>
            <input name="username" type="email" value="<?php echo set_value('username'); ?>" id="inputEmail"
                   class="form-control" placeholder="Your email" required>
            <br>
            <!-- 密码 -->
            <label for="inputPassword " class="form-group">Input Password</label>
            <span style="color: red"><span style="color: red"><?php echo form_error('password'); ?></span></span>
            <input name="password" type="password" value="<?php echo set_value('password'); ?>" id="inputPassword "
                   class="form-control " placeholder="Input Password " required>
            <br>
            <!-- 重复密码 -->
            <label for="ReInputPassword " class="form-group">ReInput Password</label>
            <span style="color: red"><?php echo form_error('passconf'); ?></span>
            <input name="passconf" type="password" value="<?php echo set_value('passconf'); ?>" id="ReInputPassword "
                   class="form-control" placeholder="ReInput Password " required>
            <!-- 检查密码是否相同 -->
            <script type="text/javascript">
                function checkPasswaord() {
                    
                }
            </script>
            <br>
            <!-- phone -->
            <div class="form-group ">
                <label for="tel">Phone</label>
                <span style="color: red"><?php echo form_error('phone'); ?></span>
                <input name="phone" type="tel" value="<?php echo set_value('phone'); ?>" id="phone"
                       class="form-control " placeholder="Your Phone" required>
            </div>
            <br>
            <!-- address -->
            <div class="form-group ">
                <label for="address">Address</label>
                <span style="color: red"><?php echo form_error('address'); ?></span>
                <input name="address" type="text" value="<?php echo set_value('address'); ?>" id="address"
                       class="form-control " placeholder="Your Address" required>
            </div>
            <br>
            <!-- summit -->
            <button class="btn btn-lg btn-primary btn-block " type="submit">Sign up</button>
        </form>
        <br>
        <br>
        <br>
        <br>
    </center>
</div>

