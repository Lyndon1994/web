<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<form id="login" action="<?php echo site_url('user/test');?>" method="post">
    <p>此例为session验证实例</p>
    <p>
        <span>验证码：</span>
        <input type="text" name="validate" value="<?php echo $_SESSION['code'];?>" size=10 />
        <img  title="点击刷新" src="<?php echo site_url('captcha');?>" align="absbottom" onclick="this.src='<?php echo site_url('captcha');?>?'+Math.random();"/>
    </p>
    <p>
        <input type="submit">
    </p>
</form>
</body>
</html>