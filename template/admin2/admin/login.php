<!DOCTYPE html>
<html>
<head>
<title><?php echo get('sitename');?>管理登录 - Powered by CmsEasy.cn</title>
<meta name="renderer" content="webkit">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="shortcut icon" href="{$base_url}/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="{$skin_path}/css/login.css" type="text/css" media="all"  />
<link title="skin1" href="{$skin_path}/css/admin_style_a.css" type="text/css" rel="alternate stylesheet" disabled />
<link title="skin2" href="{$skin_path}/css/admin_style_b.css" type="text/css" rel="stylesheet"/>
<link title="skin3" href="{$skin_path}/css/admin_style_c.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="{$skin_path}/js/jquery-1.8.3.min.js"></script>

</head>
<body>
<div class="icons">
<a onclick="setActiveStyleSheet('skin1'); return false;" href="#"><img src="{$skin_path}/images/bg_1.gif" /></a>
<a onclick="setActiveStyleSheet('skin2'); return false;" href="#"><img src="{$skin_path}/images/bg_2.gif" /></a>
<a onclick="setActiveStyleSheet('skin3'); return false;" href="#"><img src="{$skin_path}/images/bg_3.gif" /></a>

</div> 

<div class="box">
<div class="logo">
<a title="{get(sitename)}" href="{$base_url}/">
<img src="{$skin_path}/images/login_logo.png" />
</a>
</div>


<div id="login">

<div class="login">


<h3>Admin <span>Login</span></h3>
<div class="blank10"></div>
<div class="line"></div>

<?php
    if(!get('submit')) flash();
    if(!get('submit') || hasflash()) {
?>



<ul>
<form name="loginform" action="<?php echo uri();?>" method="post" onsubmit="return Dcheck();">
<input type="hidden" name="submit" value="提交">
<li><input name="username" type="text" id="username" id="username" value="{get('username')}" tabindex="1" /></li>

<li><input name="password" type="password" id="password" value="<?php //echo $password;?>" tabindex="2" /></li>
<li style="display:none;"><select name="expire" class="ss">
<option selected value='31536000'>登录有效期-1年</option>
<option value=''>登录有效期-当前会话</option>
<option value='86400'>登录有效期-1天</option>
<option value='2592000'>登录有效期-1月</option>
</select></li>
{if config::get('verifycode') == 1}
<li><input type='text' id="verify"  tabindex="3"  name="verify" />{verify()}</li>
{/if}
{if config::get('mobilechk_enable') && config::get('mobilechk_admin')}
<style type="text/css">
#tel {width:290px;margin:10px 0px;height:28px;line-height:28px;padding:0px 10px 0px 50px;border:1px solid #ccc;border-radius: 5px;}
#mobilenum { float:left; width:140px; border:1px solid #ccc; height:26px; line-height:26px; padding:0px 10px;border-radius: 5px;}
#btm_sendMobileCode { float:right; width:180px; border:1px solid #ccc; height:28px; line-height:28px; padding:0px 10px;border-radius: 5px;}
</style>
<script src="{$base_url}/js/mobilechk.js"></script>
<input placeholder="{lang(tel)}" type='text' id="tel"  name="tel" value="" tabindex="3" class="input" />
<div class="blank10"></div>
<input id="btm_sendMobileCode" onclick="sendMobileCode('{url('tool/smscode')}',$('#tel'));" type="button" value="{lang(send_cell_phone_verification_code)}" />
<input type='text' placeholder="{lang(phone_verification_code)}" id="mobilenum" name="mobilenum" />
{/if}
<div class="blank10"></div>
{if config::get('verifycode') == 2}
<li>
<div id="verifycode_embed"></div>
<script src="http://api.geetest.com/get.php"></script>
<script>
var loadGeetest = function(config) {
	window.gt_captcha_obj = new window.Geetest({
		gt : config.gt,
		challenge : config.challenge,
		product : 'float',
		offline : !config.success
	});
	gt_captcha_obj.appendTo("#verifycode_embed");
};

$.ajax({
	url : '{url('tool/geetest',0)}',
	type : "get",
	dataType : 'JSON',
	success : function(result) {
		//console.log(result);
		loadGeetest(result)
	}
});
</script>
</li>
{/if}
<li class="submit"><input type="submit" name="submit" value=" 登录 " class="button" />

<a href="http://www.cmseasy.cn/plus/show_134.html" target="_blank">找回密码？</a> <a href="http://chm.cmseasy.cn/" target="_blank" class="help">帮助</a></li>
</form>
</ul>




<?php
    }
    if(get('submit')) {
	  if(hasflash()) {
	      echo '<div style="clear:both;margin:50px 0px;text-align:center;color:red;font-size:16px;font-weight:bold;">';
		  echo flash();
	  } else { ?>
            <div style="margin:50px 0px;padding-top:5px; text-align:center;font-size:16px;font-weight:bold;">
            登陆成功！
			
            <meta http-equiv="refresh" content="2;url={$admin_url}&site=<?php echo front::get('site')?>">
<?php
      }
	  echo '</div>';
	}
?>


<div class="blank20"></div>

<script type="text/javascript">
function ResumeError()
{
    return true;
}
window.onerror = ResumeError;
document.loginform.username.focus();
</script>
<script type="text/javascript" src="{$skin_path}/js/styleswitcher.js"></script>
</div>
</div>



<div id="copy">
<div class="box">
<p>{get(site_right)} <a title="{get('sitename')}" href="{$base_url}/">{get('sitename')}</a> All Rights Reserved.</p>
<p>
Powered by <a href="http://www.cmseasy.cn" title="CmsEasy企业网站系统" target="_blank">CmsEasy</a>
</p>
</div>
</div>






</body>
</html>