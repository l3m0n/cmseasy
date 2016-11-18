
<?php
$st=$_GET['st'];
if(front::get('type')=='subscription'){
	
	
	if($_GET['site']!='default'){
		$path = config::get('site_url').'/data/subscriptionmail.txt';
	}else{
		$path = ROOT.'/data/subscriptionmail.txt';
	}
	
	
	$maillist = file_get_contents($path);
	$maillist = preg_match_all('/\[(.*?)\]/is',$maillist,$out);
	$out[1] = array_unique($out[1]);
	$maillist = implode(',',$out[1]);
	if($maillist[strlen($maillist)-1] == ',') $maillist = substr($maillist,0,-1);
}
?>

<form method="post" name="mail_form1" action=""  onsubmit="return checkform();">
<input type="hidden" name="onlymodify" value=""/>

<div class="blank20"></div>
<div id="tagscontent" class="right_box">

<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">

<tr>
<td width="19%" align="right">用户名</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<textarea name="mail_address" id="mail_address" class="textarea"><?php if($st) {?>{table_user::mail_before()}<?php }?><?php if(front::get('type')=='subscription'){ echo $maillist; }?></textarea>

<br /><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
发送格式示例: username1@cmseasy.cn,username2@cmseasy.cn....usernameN@cmseas.cn
</td>
</tr>

<tr>
<td width="19%" align="right">邮件标题</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input name="title" type="text" value="" class="input" />
</td>
</tr>

<tr>
<td width="19%" align="right">发送内容</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<div style="width:99%;">
<textarea name="content" id="sendmail" class="textarea"></textarea>
<br /><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
可以输入合法的html代码.
</div>
</td>
</tr>

</tbody>
</table>
</div>

<div class="blank20"></div>
<input type="submit" name="submit" value="发送" class="btn_a" />
</form>