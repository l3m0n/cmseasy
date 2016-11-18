<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo get('sitename');?>管理登录 - Powered by CmsEasy.cn</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="{$base_url}/favicon.ico" type="image/x-icon" />
</head>
<body>
<style>
html {
  scrollbar-face-color : #F5F5F5;
  scrollbar-arrow-color :#A0A0A0;
  
	width:100%;
	height:100%;
	overflow:hidden;
}
img  {border: 0px;}
* {
    padding:0;
    margin:0;
    }
	a {color:white;text-decoration:none;}
body {background:#226FA3 url({$skin_path}/login.jpg) center top no-repeat;}
#login {width:788px;height:155px;margin:0px auto;padding:0px auto;font-size:12px;color:white;text-align:left;}

.input {border:none;}

#footer {
position:absolute;
	bottom:0;
	z-index:99;
	width:100%;
	height:22px;
	font-size:12px;
	color:#9ED26D;
	text-align:center;
}
#footer a {color:#9ED26D;}

#username {width:210px;height:26px;line-height:26px;margin-bottom:12px; padding-left:30px;font-size:14px;font-weight:bold; background:url({$skin_path}/username.gif) no-repeat;}
#password {clear:both;width:210px;height:26px;line-height:26px;margin-bottom:22px; padding-left:30px; font-size:14px;font-weight:bold; background:url({$skin_path}/password.gif) no-repeat;}
#verify {width:80px; height:26px;margin-bottom:12px; font-size:14px;font-weight:bold; }

.login {clear:both; width:110px;height:26px;line-height:26px;text-align:center; font-weight:bold; background:url({$skin_path}/login.gif);border:none;color:white;}

</style>


<div id="login">
<div style="margin:200px 0px 0px 400px;">



<?php
    if(!get('submit')) flash();
    if(!get('submit') || hasflash()) {
?>

    <form name="loginform" action="<?php echo uri();?>" method="post" onsubmit="return Dcheck();">
    <input type="hidden" name="submit" value="提交">
     <input name="username" type="text" id="username" value="" class="input" tabindex="1" />
    <input name="password" type="password" id="password" value="<?php //echo $password;?>" tabindex="2" class="input" />
<?php
    if($loginfalse){
?>
     <p>请输入验证码: <input type='text' id="verify"  tabindex="3"  name="verify" />&nbsp;{verify()}</p>
<?php
	}
?>
     <p><input type="submit" name="submit" value=" 登 陆 " class="login" tabindex="4" /></p>
     </form>
   
   <div style="clear:both;">&nbsp;</div>
</div></div>

<?php
    }
    if(get('submit')) {
	  if(hasflash()) {
	      echo '<div style="clear:both;text-align:center;color:#A5EF54;font-size:16px;font-weight:bold;">';
		  echo flash();
	  } else { ?>
            <div style="text-align:center;color:#fff;font-size:16px;font-weight:bold;">
            登陆成功！
            <meta http-equiv="refresh" content="2;url={$admin_url}&site=<?php echo front::get('site')?>">
<?php
      }
	  echo '</div>';
	}
?>

<div id="footer">Copyright &copy; 2011 <a href="http://www.cmseasy.cn" title="Powered by CmsEasy" target="_blank">Powered by CmsEasy</a></div>

</div>
</div>
<script type="text/javascript">
function ResumeError()
{
    return true;
}
window.onerror = ResumeError;
document.loginform.username.focus();
</script>
</body>
</html>