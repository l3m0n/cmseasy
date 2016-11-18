<div class="tags" style="margin-bottom:20px;">

<div id="tagstitle">
<a class="hover">编辑站点</a>
</div>
<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">

<div id="tagscontent" class="right_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">

<tr class="s_out" >
<td width="16%" align="right">站点名称</td>
<td width="1%">&nbsp;</td>
<td width="85%">
<input type="text" name="name" id="name" value="{$data[website][name]}" class="input" /> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的名称，例如：“香港网站”</span> <br /><br />
</div>
</div>

<tr class="s_out" >
<td width="16%" align="right">配置文件</td>
<td width="1%">&nbsp;</td>
<td width="85%">
<input type="text" name="path" id="path" value="{front::get(id)}" class="input" /> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的配置文件名称，例如："hk"</span> <br /><br />
</div>
</div>

<tr class="s_out" >
<td width="16%" align="right">站点URL</td>
<td width="1%">&nbsp;</td>
<td width="85%">
<input type="text" name="site_url" id="site_url" value="{$data[site_url]}" class="input" /> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的完整URL，结尾必须有“/”，例如："http://hk.cmseasy.com/"</span><br /><br />
</div>
</div>

<tr class="s_out" >
<td width="16%" align="right">站点用户名</td>
<td width="1%">&nbsp;</td>
<td width="85%">
<input type="text" name="site_username" id="site_username" value="{$data[site_username]}" class="input" /> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">站点用户名</span><br /><br />
</div>
</div>

<tr class="s_out" >
<td width="16%" align="right">站点密码</td>
<td width="1%">&nbsp;</td>
<td width="85%">
<input type="password" name="site_password" id="site_password" value="{$data[site_password]}" class="input" /> 
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">站点密码</span><br />
<br />
</div>
</div>

<tr class="s_out" >
<td width="16%" align="right">站点后台目录</td>
<td width="1%">&nbsp;</td>
<td width="85%">
<input type="text" name="site_admindir" id="site_admindir" value="{$data[site_admindir]}" class="input" /> 
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">站点后台目录 例如:admin</span>
</td>
</tr>

</table>

<!--<div class="blank10"></div>
<div style="width:100%; height:1px; border-bottom:1px solid #D9E6F4"></div>
<div class="blank10"></div>

<div class="hid_box">
<strong>数据库服务器：</strong>
<div class="hbox" style="background:none;">
<input type="text" name="hostname" id="hostname" value="{$data[database][hostname]}" class="input" /> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的数据库主机，例如："192.168.0.88"</span> <br /><br />
</div>
</div>

<div class="hid_box">
<strong>数据库用户：</strong>
<div class="hbox" style="background:none;">
<input type="text" name="user" id="user" value="{$data[database][user]}" class="input" /> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的数据库用户，例如："root"</span><br /><br />
</div>
</div>

<div class="hid_box">
<strong>数据库密码：</strong>
<div class="hbox" style="background:none;">
<input type="text" name="password" id="password" value="{$data[database][password]}" class="input" /> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的数据库密码，例如："123456"</span><br /><br />
</div>
</div>

<div class="hid_box">
<strong>数据库名称：</strong>
<div class="hbox" style="background:none;">
<input type="text" name="database" id="database" value="{$data[database][database]}" class="input" /> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的数据库名称，例如："hkcmseasy"</span><br /><br />
</div>
</div>

<div class="hid_box">
<strong>数据库表前缀：</strong>
<div class="hbox" style="background:none;">
<input type="text" name="prefix" id="prefix" value="{$data[database][prefix]}" class="input" /> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的数据库表前缀，例如："cmseasy_"</span><br /><br />
</div>
</div>
<input type="button" class="button" value="检查数据库" onclick="checkmysql()" /><span id="checkloading" style="display:none"><font color="blue">	检查中...	</font></span><span id="returnmessage"></span>

<div class="blank10"></div>
<div style="width:100%; height:1px; border-bottom:1px solid #D9E6F4"></div>
<div class="blank10"></div>


<div class="hid_box">
<strong>FTP IP地址：</strong>
<div class="hbox" style="background:none;">
<input type="text" name="ftpip" id="ftpip" value="{$data[website][ftpip]}" class="input" /> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的FTP ip地址，例如："192.168.0.88"</span><br /><br />
</div>
</div>

<div class="hid_box">
<strong>FTP 端口：</strong>
<div class="hbox" style="background:none;">
<input type="text" name="ftpport" id="ftpport" value="{$data[website][ftpport]}" class="input" /> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的FTP端口，例如："21"</span><br /><br />
</div>
</div>

<div class="hid_box">
<strong>FTP 用户名称：</strong>
<div class="hbox" style="background:none;">
<input type="text" name="ftpuser" id="ftpuser" value="{$data[website][ftpuser]}" class="input" /> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的FTP用户，例如："hkftp"</span><br /><br />
</div>
</div>

<div class="hid_box">
<strong>FTP 用户密码：</strong>
<div class="hbox" style="background:none;">
<input type="text" name="ftppwd" id="ftppwd" value="{$data[website][ftppwd]}" class="input" /> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的FTP登陆密码，例如："123456"</span><br /><br />
</div>
</div>

<div class="hid_box">
<strong>FTP 文件目录：</strong>
<div class="hbox" style="background:none;">
<input type="text" name="ftppath" id="ftppath" value="{$data[website][ftppath]}" class="input" /> <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"> <span class="tips">请填写站点的FTP根目录，例如："/"</span><br /><br />
</div>
</div>
<input type="button" value="检查FTP" class="button" onclick="checkftp()" />
<span id="checkftploading" style="display:none"><font color="blue">检查中...</font></span><span id="returnftpmessage"></span>	-->	

<div class="blank10"></div>
</div>
</div>
<div class="blank10"></div>

    <input type="submit" name="submit" value="提交" class="btn_a" />
    </form>
  
   <div class="blank10"></div>
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