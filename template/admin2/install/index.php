<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<title>易通CMS-免费企业建站程序-{if $pass}填写数据库信息{else}检测数据库链接{/if}</title>
<link rel="shortcut icon" href="{$base_url}/favicon.ico" type="image/x-icon" />
<!-- 调用样式表 -->
<link type="text/css" rel="stylesheet" media="all" href="{$skin_path}/css/install.css" />
<link title="skin1" href="{$skin_path}/css/admin_style_b.css" type="text/css" rel="alternate stylesheet" disabled />
<link title="skin2" href="{$skin_path}/css/admin_style_a.css" type="text/css" rel="stylesheet"/>
<link title="skin3" href="{$skin_path}/css/admin_style_c.css" type="text/css" rel="stylesheet"/>

</head>
<body>
<body class="slide slide3 s1">
<!-- 头部 -->
<div class="icons">
<a onclick="setActiveStyleSheet('skin1'); return false;" href="#"><img src="{$skin_path}/images/bg_1.gif" /></a>
<a onclick="setActiveStyleSheet('skin2'); return false;" href="#"><img src="{$skin_path}/images/bg_2.gif" /></a>
<a onclick="setActiveStyleSheet('skin3'); return false;" href="#"><img src="{$skin_path}/images/bg_3.gif" /></a>

</div> 

<div class="box">
<div id="header">
<a href=""><img src="{$skin_path}/images/logo.png" class="logo" /></a>
<div class="top_right">
<ul>
<li><span>您好，<strong>{$user.username}！</strong> [<a href="{$base_url}/index.php?case=index&act=logout&admin_dir={config::get('admin_dir')}">退出</a>]</span></li>
<li><a href="http://www.cmseasy.cn" target="_blank">官方网站</a> | <a href="http://www.cmseasy.cn/service_1.html" target="_blank">商业授权</a> | <a href="http://www.cmseasy.org" target="_blank">支持论坛</a> | <a href="http://chm.cmseasy.cn/" target="_blank">帮助？</a></li>
</ul>
</div>
</div>

<div id="nav">
<div class="nav_bg">
<div class="nav">
<ul>
</ul>
</div>
</div>
</div>

<div id="c">
<div id="left">
<div id="menu">

<h5 class="h5">欢迎使用CmsEasy</h5>
<dl>
<dd class="d1"><a><span>使用协议</span></a></dd>
<dd class="d2"><a><span>检查环境</span></a></dd>
<dd class="d3"><a><span>配置系统</span></a></dd>
<dd class="d4"><a><span>完成安装</span></a></dd>
</dl>

</div>
</div>

<div id="right">
<div class="right">
<div id="right_box">

<div class="right_box">

<form name="form1" method="post" action="<?php echo uri();?>">
<?php  if(!get('step')) $this->render('install/license.php'); else { ?>
<input type="hidden" value="1" id="license_pass" name="license_pass"/>

  
<?php
  $pass=true;
  if(PHP_VERSION<5)    $pass=false;
   if(!$mysql_pass)  $pass=false;
   if(isset($adminerror))  $pass=false;
  ?>

 {if isset($install)}
<style type="text/css">
#menu dd.d4 a {
  font-weight:bold;
  background:url({$skin_path}/images/left_menu_a_on.gif) left top no-repeat;
}
</style>
<div class="result">
<h1>恭喜您，CmsEasy已经成功安装完成！</h1>
<h5>（基于安全考虑，请在安装后修改后台登陆目录名称！！！）</h5>
</div>
<div class="blank20"></div>
<center>
<input onclick="javascrtpt:window.location.href='{$base_url}/'" class="btn_b" style="margin-right:20px;" value=" 访问网站首页 " />
<input onclick="javascrtpt:window.location.href='{$base_url}/index.php?case=admin&act=login&admin_dir={get(admin_dir)}&site=default'" class="btn_a" value=" 登陆网站后台 " />
</center>

 {else}
<div class="table_box">
<table border="0"  cellspacing="1" cellpadding="4" id="table" width="100%">
<!--start-->
{if front::$get[step]==1}
<style type="text/css">
#menu dd.d2 a {
  font-weight:bold;
  background:url({$skin_path}/images/left_menu_a_on.gif) left top no-repeat;
}
</style>

 <tbody>
 <tr bgcolor="Silver">
 <th>项目</th>
<th>推荐要求</th> <th>系统环境</th> <th>是否通过</th>
 </tr>
 <tr>
 <td>PHP版本</td>
<td>5.2以上</td>
<td><?php echo PHP_VERSION; ?></td>
<td align="center"><?php echo helper::yes(PHP_VERSION>=5.0); ?></td>
 </tr>
  <tr>
 <td>MySQL版本</td>
<td>5.0以上</td>
<td>{=@$mysql_verion}</td>
<td align="center">
 {if $pass}
 <?php echo helper::yes($mysql_ver>=5); ?>
 {else}
   <input type="submit" name="submit"  class="button" value=" 检查 " />
 {/if}
 </td>
 </tr>
 </thead>

 <tbody>
  <tr>
 <th>目录</th><th colspan="4">可写</th>
 </tr>
<tr>
 <td><?php echo 'cache';?></td> <td colspan="4"><?php echo helper::yes(front::file_mode_info(ROOT.'/cache')>=2);  ?></td>
 </tr>
 <tr>
 <td><?php echo 'config';?></td> <td colspan="4"><?php echo helper::yes(front::file_mode_info(ROOT.'/config')>=2);  ?></td>
 </tr><tr>
 <td><?php echo 'config/config.php';?></td> <td colspan="4"><?php echo helper::yes(front::file_mode_info(ROOT.'/config/config.php')>=2);  ?></td>
 </tr>
<tr>
 <td><?php echo 'data';?></td> <td colspan="4"><?php echo helper::yes(front::file_mode_info(ROOT.'/data')>=2);  ?></td>
 </tr>
<tr>
 <td><?php echo 'install';?></td> <td colspan="4"><?php echo helper::yes(front::file_mode_info(ROOT.'/install')>=2);  ?></td>
 </tr>
 <tr>
 <td><?php echo 'template';?></td> <td colspan="4"><?php echo helper::yes(front::file_mode_info(ROOT.'/template')>=2);  ?></td>
 </tr>
 <tr>
 <td><?php echo 'upload';?></td> <td colspan="4"><?php echo helper::yes(front::file_mode_info(ROOT.'/upload')>=2);  ?></td>
 </tr>
 <tr>
 <td><?php echo '/celive/data';?></td> <td colspan="4"><?php echo helper::yes(front::file_mode_info(ROOT.'/celive/data')>=2);  ?></td>
 </tr>
 </tbody>
 </table>

 <div class="blank20"></div>

<center>
<input type="button" onclick="window.location.href='<?php echo url('install/index',true);?>';"  class="btn_b" value=" 上一步 " style="margin-right:20px;" />
<input type="button" onclick="window.location.href='<?php echo url('install/index/step/2',true);?>';"  class="btn_a" value=" 下一步 " />
</center>




 
 {else}
 <style type="text/css">
#menu dd.d3 a {
  font-weight:bold;
  background:url({$skin_path}/images/left_menu_a_on.gif) left top no-repeat;
}
</style>
<!--end-->
 <tbody>

 <tr>
 <th colspan="5">
 
  
<strong>MySQL设置  {if $mysql_pass}<span style="color:#FFFFFF;">( <?php echo helper::yes(1); ?> <font color="white">连接成功!</font> )</span>{else}{if get('submit')}<span style="color:red;">( <?php echo helper::yes(0); ?> 连接失败！){else}( 未测试连接！ ){/if}{/if}</span></strong>
<?php $input_disable=$pass?'':''; ?>

 </th>
 </tr>
 
 <tr>
 <td class="left">服务器</td><td colspan="4"><?php echo form::input('hostname',/*get('hostname') ? get('hostname'): */config::get('database','hostname'),$input_disable);?></td>
 </tr>

  <tr>
 <td class="left">MySQL用户名</td><td colspan="4"><?php echo form::input('user',/*get('user') ?get('user'):*/config::get('database','user'),$input_disable);?></td>
 </tr>
   <tr>
 <td class="left">MySQL密码</td><td colspan="4"><?php echo form::input('password',/*get('password') ? get('password') :*/config::get('database','password'),$input_disable);?></td>
 </tr>
  <tr>
 <td class="left">MySQL数据库名</td><td colspan="4"><?php echo form::input('database',/*front::post('database') ?front::post('database') : */config::get('database','database'),$input_disable);?>&nbsp;&nbsp;
 <input type="checkbox" value="1" style="width:15px;height:15px;background:none;border:none;" name="createdb" {$input_disable}/>&nbsp;&nbsp;新建数据库&nbsp;&nbsp;<input type="checkbox" value="1" style="width:15px;height:15px;background:none;border:none;" name="testdata" {if front::$post['database'] && !front::$post['testdata']}
 {else}
 checked
 {/if} />&nbsp;&nbsp;安装初始数据
 </td>
 </tr>

     <tr>

 <td class="left">表前缀</td><td colspan="4"><?php echo form::input('prefix',config::get('database','prefix'),'placeholder="cmseasy_"');?> &nbsp;&nbsp;&nbsp;&nbsp;<font color="red">推荐使用&nbsp;&nbsp;cmseasy_</font></td>

 <?php
 $_PHP_SELF = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : (isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : $_SERVER['ORIG_PATH_INFO']);
 $_ROOTPATH = str_replace("\\","/",dirname($_PHP_SELF));
 $_ROOTPATH = strlen($_ROOTPATH)>1 ? $_ROOTPATH."/" : "/";
 $_site_url = 'http://'.$_SERVER['HTTP_HOST'].$_ROOTPATH; 
 ?>
 <input type="hidden" value="<?php echo $_site_url?>" name="site_url" />
 </tr>


 <tr>
 <th colspan="5">
 
  管理帐号设置

 </th>
 </tr>
 
 <tr>
 <td class="left">管理员</td><td colspan="4"><?php echo form::input('admin_username',get('admin_username') ? get('admin_username'):'');?></td>
 </tr>
  <tr>
 <td class="left">密码</td><td colspan="4"><?php echo form::password('admin_password',get('admin_password') ?get('admin_password'): '');?></td>
 </tr>
   <tr>
 <td class="left">重复密码</td><td colspan="4"><?php echo form::password('admin_password2',get('admin_password2') ? get('admin_password2') :'');?></td>
 </tr>
  </tbody>
  
    <tbody>
 <tr style="display:none;">
 <th colspan="5">
 
  选择模块

 </th>
 </tr>
 
 <tr style="display:none;">
 <td colspan="5" align="center">
   <label>
     <input type="checkbox" name="smod[]" value="celive" id="smod_0" checked />
     CElive在线客服</label>&nbsp;&nbsp;
 </td>
</tr> 
</tbody>
  
 </td>
 </tr>
 <tr>
 </tbody>
 </table>

 <div class="blank20"></div>

 {if isset($dberror)}
 <script>alert('指定数据库不存在！如果确定使用指定数据库，请勾选 “新建数据库”! ');</script>
 {/if}
 
  {if isset($adminerror)}
 <script>alert('请设置好管理帐号! ');</script>
 {/if}

 {if $pass}
 <center>
<input type="button" onclick="window.location.href='<?php echo url('install/index/step/1',true);?>';"  class="btn_b" value=" 上一步 "style="margin-right:20px;" />
<input type="hidden" name="install" value="1"/>
<input type="submit" id="installbutton" name="submit" value=" 安装 " class="btn_a" onclick="changebutton();if(!confirm('你确实要把数据安装在数据库 [ '+this.form.database.value+' ] 吗？')) return false;"/>
 <center>
 {else}
<center>
<input type="button" onclick="window.location.href='<?php echo url('install/index/step/1',true);?>';"  class="btn_b" value=" 上一步 "style="margin-right:20px;" />
<input type="submit" name="submit"  class="btn_a" value=" 保存安装信息 " />
<center>
 {/if}
 {/if}
 <div class="blank10"></div>
</div>
 {/if}







<?php } ?>
</form>




<div class="clear"></div>
</div>
</div>
</div>
<div class="right_bottom">
</div>
</div>

<div id="footer">
</div>
</div>
<div class="clear"></div>
</div>

<div class="blank30"></div>
<div class="copy">
Powered by <a href="http://www.cmseasy.cn" title="CmsEasy企业网站系统" target="_blank">CmsEasy</a></div>
</div>



<script language="javascript" type="text/javascript">
function changebutton(){
	document.getElementById('installbutton').value="安装中...";
}
</script>
<script language='JavaScript'>
//去掉虚线框
function bluring(){
if(event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG") document.body.focus();
}
document.onfocusin=bluring;
</script>

<script type="text/javascript" src="{$skin_path}/js/styleswitcher.js"></script>
</body>
</html>