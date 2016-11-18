<div class="tags" style="margin-bottom:20px;">

<div id="tagstitle">
<a class="hover">添加站点</a>
</div>

<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">

<div id="tagscontent" class="right_box" style="height:383px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">

<tr class="s_out" >
<td width="19%" align="right">站点名称</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input type="text" name="name" id="name" value="新建站点" class="input" />
<span class="hotspot" onmouseover="tooltip.show('请填写站点的名称，例如“香港网站”！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
</td>
</tr>

<tr class="s_out" >
<td width="19%" align="right">配置文件</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input type="text" name="path" id="path" value="new" class="input" />
<span class="hotspot" onmouseover="tooltip.show('请填写站点的配置文件名称，例如 [ hk ] ！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
</td>
</tr>

<tr class="s_out" >
<td width="19%" align="right">站点URL</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input type="text" name="site_url" id="site_url" value="http://new.cmseasy.com/" class="input" />
<span class="hotspot" onmouseover="tooltip.show('请填写站点的完整URL，结尾必须有“/”，例如“http://hk.cmseasy.com/”！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
</td>
</tr>

<tr class="s_out" >
<td width="19%" align="right">站点用户名</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input type="text" name="site_username" id="site_username" value="admin" class="input" />
<span class="hotspot" onmouseover="tooltip.show('请填写站点的站点用户名，即登录后台帐号！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
</td>
</tr>

<tr class="s_out" >
<td width="19%" align="right">站点密码</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input type="password" name="site_password" id="site_password" value="admin" class="input" />
<span class="hotspot" onmouseover="tooltip.show('请填写站点的站点用户密码，即登录后台密码！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
</td>
</tr>

<tr class="s_out" >
<td width="19%" align="right">站点后台目录</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input type="text" name="site_admindir" id="site_admindir" value="admin" class="input" />
<span class="hotspot" onmouseover="tooltip.show('请填写站点后台目录，即后台访问地址，例如:admin！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
</td>
</tr>

</table>

<!--<div class="blank10"></div>
<div style="width:100%; height:1px; border-bottom:1px solid #D9E6F4"></div>
<div class="blank10"></div>

<div class="hid_box">
<strong>数据库服务器</strong>
<div class="hbox" style="background:none;">
<input type="text" name="hostname" id="hostname" value="127.0.0.1"   size="40" class="skey"/> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的数据库主机，例如"127.0.0.1"</span> <br /><br />
</div>
</div>

<div class="hid_box">
<strong>数据库用户</strong>
<div class="hbox" style="background:none;">
<input type="text" name="user" id="user" value="user"   size="40" class="skey"/> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的数据库用户，例如"root"</span><br /><br />
</div>
</div>

<div class="hid_box">
<strong>数据库密码</strong>
<div class="hbox" style="background:none;">
<input type="text" name="password" id="password" value="password"   size="40" class="skey"/> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的数据库密码，例如"123456"</span><br /><br />
</div>
</div>

<div class="hid_box">
<strong>数据库名称</strong>
<div class="hbox" style="background:none;">
<input type="text" name="database" id="database" value="sql"   size="40" class="skey"/> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的数据库名称，例如"hkcmseasy"</span><br /><br />
</div>
</div>

<div class="hid_box">
<strong>数据库表前缀</strong>
<div class="hbox" style="background:none;">
<input type="text" name="prefix" id="prefix" value="cmseasy_new_"   size="40" class="skey"/> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的数据库表前缀，例如"cmseasy_"</span><br /><br />
</div>
</div>
<input type="button" class="button" value="检查数据库" onclick="checkmysql()" /><span id="checkloading" style="display:none"><font color="blue">检查中...</font></span><span id="returnmessage"></span>

<div class="blank10"></div>
<div style="width:100%; height:1px; border-bottom:1px solid #D9E6F4"></div>
<div class="blank10"></div>

<div class="hid_box">
<strong>FTP IP地址</strong>
<div class="hbox" style="background:none;">
<input type="text" name="ftpip" id="ftpip" value="127.0.0.1"   size="40" class="skey"/> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的FTP ip地址，例如"127.0.0.1"</span><br /><br />
</div>
</div>

<div class="hid_box">
<strong>FTP 端口</strong>
<div class="hbox" style="background:none;">
<input type="text" name="ftpport" id="ftpport" value="21"   size="40" class="skey"/> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的FTP端口，例如"21"</span><br /><br />
</div>
</div>

<div class="hid_box">
<strong>FTP 用户名称</strong>
<div class="hbox" style="background:none;">
<input type="text" name="ftpuser" id="ftpuser" value="user"   size="40" class="skey"/> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的FTP用户，例如"hkftp"</span><br /><br />
</div>
</div>

<div class="hid_box">
<strong>FTP 用户密码</strong>
<div class="hbox" style="background:none;">
<input type="text" name="ftppwd" id="ftppwd" value="password"   size="40" class="skey"/> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的FTP登陆密码，例如"123456"</span><br /><br />
</div>
</div>

<div class="hid_box">
<strong>FTP 文件目录</strong>
<div class="hbox" style="background:none;">
<input type="text" name="ftppath" id="ftppath" value="/"   size="40" class="skey"/> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的FTP根目录，例如"/"</span><br /><br />
</div>
</div>
<input type="button" value="检查FTP" class="button" onclick="checkftp()" />
<span id="checkftploading" style="display:none"><font color="blue">检查中...</font></span><span id="returnftpmessage"></span>	
-->


</div>
</div>

    <input type="submit" name="submit" value="提交" class="btn_a" />
    </form>
    
    
  
  

<script type="text/javascript">
function checkmysql(){
	$('#checkloading').show();
	var host = $("#hostname").val();
	var user = $("#user").val();
	var pwd = $("#password").val();
	$.ajax({
		url: '<?php echo url('website/checkmysql',true);?>',
		data:'host='+host+'&user='+user+'&pwd='+pwd+'&request='+Math.random()*5,
		type: 'GET',
		dataType: 'html',
		timeout: 30000,
		success: function(data){
			$('#checkloading').hide();
			$('#returnmessage').html(data);
		},
		error: function(data){
			$('#checkloading').hide();
			$('#returnmessage').html('请重试！');
		}		
	});
}
function checkftp(){
	$('#checkftploading').show();
	var ftpip = $("#ftpip").val();
	var ftpuser = $("#ftpuser").val();
	var ftppwd = $("#ftppwd").val();
	$.ajax({
		url: '<?php echo url('website/checkftp',true);?>',
		data:'ftpip='+ftpip+'&ftpuser='+ftpuser+'&ftppwd='+ftppwd+'&request='+Math.random()*5,
		type: 'GET',
		dataType: 'html',
		timeout: 30000,
		success: function(data){
			$('#checkftploading').hide();
			$('#returnftpmessage').html(data);
		},
		error: function(data){
			$('#returnftpmessage').html('请重试！');
		}		
	});
}
</script>