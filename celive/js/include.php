<?php
/**
* CmsEasy Live http://www.cmseasy.cn 				  			 
* by CmsEasy Live Team 							  						
**
* Software Version: CmsEasy Live v 1.2.0 					  				  
* Software by: Aiens, UTA (http://www.aiens.cn) 		      
* Copyright 2009 by: CmsEasy, (http://www.cmseasy.cn) 	  
* Support, News, Updates at: http://www.cmseasy.cn 			  			  
**
* This program is not free software; you can't may redistribute it and modify it under	  
**
* This file contains configuration settings that need to altered                  
* in order for CE Live to work, and other settings that            
**/
error_reporting(0);
if(isset($_GET['cmseasylive'])){
include('../include/config.inc.php');
include(CE_ROOT.'/include/celive.class.php');

$ifonline = new celive();
$ifonline->db();

$ip = $_SERVER["REMOTE_ADDR"];
$ip = convertip($ip);
    

if(isset($_GET['qq']))
{
	$qq = explode(",", $_GET['qq']);
	$qqcode = '';
	for($i=0;$i<count($qq);$i++)
	{
		$qqcode = $qqcode.'<li><a target=_blank href=tencent://message/?uin='.$qq[$i].'&Site='.$config[company].'&Menu=yes><img border=0 SRC=http://wpa.qq.com/pa?p=1:'.$qq[$i].':42 alt=点击这里给我发消息></a></li>';
	}
}


$sql = "SELECT * FROM `".$config['prefix']."operators` ORDER BY `timestamp` DESC";
@$result = $db->my_fetch_array($sql);
$list = '';
for($i=0;$i<count($result);$i++)
{
	$operatorid = $result[$i]['id'];
	$username = $result[$i]['username'];
	$firstname = $result[$i]['firstname'];
	if($firstname==''){
		$firstname = $username;
	}
	$username = $firstname;
	if (isset($_GET['departmentid'])) {
        $departmentid = intval($_GET['departmentid']);
		$activity_sql = "SELECT `id` FROM `".$config['prefix']."activity` WHERE  `departmentid`='".$departmentid."' AND `operatorid`='".$operatorid."'";		
		$onlinelink2 = '</a></li>';
	    @$result2 = $db->my_fetch_array($activity_sql);
	   if(count($result2) == 0) {
		   $login = '[offline]';
		   $_status = 'offline';
	   }else {
		   $login = '[online]';
		   $_status = 'online';		   
	   }
	   $onlinelink1 = '<li><a href='.$config['url'].'/?departmentid='.$departmentid.'  target=_blank><IMG border=0 src='.$config['url'].'/js/images/'.$_status.'.gif alt='.$username.$login.'>';	
	   $list = $list.$onlinelink1.$onlinelink2;   
    } else {
        $departmentid = '';
		$activity_sql = "SELECT `id` FROM `".$config['prefix']."activity` WHERE `operatorid`='".$operatorid."'";		
    
		$onlinelink2 = '</a></li>';
		@$result2 = $db->my_fetch_array($activity_sql);
		if(count($result2) == 0) {
			$login = '[offline]';
			$_status = 'offline';
                        $link = 'index.php?case=guestbook&act=index';
		}else {
			$login = '[online]';
			$_status = 'online';
                        $link = $config['url'];
		}
		$onlinelink1 = '<li><a href='.$link.'><IMG border=0 src='.$config['url'].'/js/images/'.$_status.'.gif alt='.$username.$login.'>';
		$list = $list.$onlinelink1.$onlinelink2;
	}

}
}

$activity_sql3 = "SELECT `id` FROM `".$config['prefix']."activity`";
@$result3 = $db->my_fetch_array($activity_sql3);
	if(count($result3) == 0) {
		$login = '[<font color=#000>Offline</font>]<br />';
		$kefu_if_online = 'offline';
		$guest_btn = '留言';
	}else {
		$login = '[<font color=red>Online</font>]<br />';
		$kefu_if_online = 'online';
		$guest_btn = '接受';
	}
?>

document.writeln("<!--[if IE 6]>");
document.writeln("<style type=\"text\/css\">");
document.writeln("	.cleft_b {position:absolute;}");
document.writeln("    .cleft_b1 {position:absolute;}");
document.writeln("<\/style>");
document.writeln("<![endif]--> ")


document.writeln("<style> ");
document.writeln(" .celive_box_content {  display: none;  position:fixed;  top: 25%;  left: 35%;  width: 439px;  height: 94px; padding:75px 15px 0px;  font-size:12px;background:url(<?php echo $config['url']?>\/js\/images\/kf.gif) no-repeat left top; overflow: hidden;  font-size:13px; font-weight:bold ;color:white ;text-align:left;}");
document.writeln(" .celive_box_content  .diva{ display:block;width:56px;height:19px;line-height:19px;color:white;background:url(<?php echo $config['url']?>\/js\/images\/btn.gif);text-align:center; float:right; margin-left:10px;}");
document.writeln(" .celive_box_content  .diva a{font-size:12px; color:#FFF; text-decoration:none; font-weight:bold }");
document.writeln(" .blank15{clear:both;height:15px;overflow:hidden;}");
document.writeln("<\/style> ");
document.writeln("");
document.writeln("<div id=\"celive_box_tip\" class=\"celive_box_content\"> ");
document.writeln(" <span style=\"text-align:left;\">欢迎您!来自<?php echo $ip;?>的朋友,客服<?php echo $kefu_if_online;?>.<br \/>请问有什么可以帮助您的吗?<\/span>");
document.writeln("    <div class=\"blank15\"></div>");
document.writeln("    <div style=\"margin-right:130px;\"><div class=\"diva\">");
document.writeln("    <a href=\"javascript:void(0)\" onclick=\"document.getElementById(\'celive_box_tip\').style.display=\'none\';\">下次<\/a>");
document.writeln("    <\/div>");
document.writeln("    <div class=\"diva\">");
document.writeln("    <a href=\"<?php echo $config['url']?>\" target=\"_blank\"><?php echo $guest_btn;?><\/a>");
document.writeln("    <\/div><\/div>");
document.writeln("<\/div> ")


function celive51tuitan(){	
	if (getCookie('truecelivebox_cookies')==''){ 
	  setCookie("truecelivebox_cookies","<?php echo $ip;?>"); //写入cookies表示已经执行过了。
	  setTimeout("document.getElementById('celive_box_tip').style.display='block';document.getElementById('fade').style.display='block'",3000);
    } 
}




function setCookie(name, value) 
{ 
var argv = setCookie.arguments; 
var argc = setCookie.arguments.length; 
var expires = (argc > 2) ? argv[2] : null; 
if(expires!=null) 
{ 
var LargeExpDate = new Date (); 
LargeExpDate.setTime(LargeExpDate.getTime() + (expires*1000*3600*24)); 
} 
document.cookie = name + "=" + escape (value)+((expires == null) ? "" : ("; expires=" +LargeExpDate.toGMTString())); 
} 
function getCookie(Name) 
{ 
var search = Name + "=" 
if(document.cookie.length > 0) 
{ 
offset = document.cookie.indexOf(search) 
if(offset != -1) 
{ 
offset += search.length 
end = document.cookie.indexOf(";", offset) 
if(end == -1) end = document.cookie.length 
return unescape(document.cookie.substring(offset, end)) 
} 
else return "" 
} 
} 
<?php
if(!isset($_GET['text'])){
?>
document.writeln("<link href=\"<?php echo $config['url']?>\/js\/images\/left.css\" rel=\"stylesheet\" type=\"text\/css\" \/>")
document.writeln("<style type=\"text\/css\"> ");
document.writeln("* .cleft_box{");
document.writeln("padding:0;");
document.writeln("margin:0;");
document.writeln("}");
document.writeln(".cleft_b{");
document.writeln("position:fixed;top:30%;left:-136px;}");
document.writeln(".cleft_b1{");
document.writeln("position:fixed;top:30%;}");
document.writeln(".cleft_box{");
document.writeln("margin: 0px;");
document.writeln("font: 12px tahoma,Helvetica,arial, \"\\5b8b\\4f53\", sans-serif;");
document.writeln("padding: 0px;");
document.writeln("overflow: hidden;");
document.writeln("width:170px;}");
document.writeln(".cleft_box .cright{");
document.writeln("border: 1px solid #006BAF;");
document.writeln("background-color: #006BAF;");
document.writeln("width: 27px;");
document.writeln("height: 150px;");
document.writeln("color: #fff;");
document.writeln("font-size: 14px;");
document.writeln("font-weight: bold;");
document.writeln("text-align: center;");
document.writeln("padding-top: 35px;");
document.writeln("cursor: pointer;");
document.writeln("float: right;");
document.writeln("}");
document.writeln("<\/style> ");
document.writeln("<!--[if IE 6]>");
document.writeln("<style type=\"text\/css\">");
document.writeln("html{overflow:hidden;}");
document.writeln("body{height:100%;overflow:auto;}");
document.writeln(".cleft_b {position:absolute;}");
document.writeln("    .cleft_b1 {position:absolute;}");
document.writeln("<\/style>");
document.writeln("<![endif]-->  ");
document.writeln("<script type=\"text\/javascript\"> ");
document.writeln("function copen(){");
document.writeln("var para = document.getElementById(\"cleft_box\").className = \"cleft_b1\";");
document.writeln("}");
document.writeln("function cclose(){");
document.writeln("var para = document.getElementById(\"cleft_box\").className = \"cleft_b\"; ");
document.writeln("}");
document.writeln("<\/script> ");
document.writeln("<div id=\"cleft_box\" class=\"cleft_b\"> ");
document.writeln("  <div class=\"cleft_box\"> ");
document.writeln("<div class=\"cright\" onclick=\"copen()\"> ");
document.writeln("<div class=\"cright_ico\"><\/div> ");
document.writeln("在线客服");
document.writeln("<\/div> ");
document.writeln("<div class=\"cleft_box_content\"> ");
document.writeln("<div class=\"cheader\"> ");
document.writeln("<div class=\"ctitle\" onclick=\"cclose()\">在线客服(x)<\/div> ");
document.writeln("<\/div> ");
document.writeln("<div class=\"serverlist\"> ");
document.writeln("<ul> ");
document.writeln("<li><a href=\"<?php echo $config['url']?>\" target=\"_blank\"><IMG border=0 ");
document.writeln("            src=\"<?php echo $config['url']?>\/js\/images\/kefu_head.gif\" alt=\"Powered by CmsEasy\"><\/a> <\/li>");
document.writeln("<?php echo($list);?> ");
document.writeln("<?php echo $qqcode;?> ");
document.writeln("<li><A href=\"<?php echo $config['url']?>\/..\/index.php?case=guestbook&act=index\" target=\"_blank\"><IMG border=0 src=\"<?php echo $config['url']?>\/js\/images\/img3-5-btn2.gif\" width=81 height=23><\/A><\/li>");
document.writeln("<\/ul> ");
document.writeln("<\/div> ");
document.writeln("<div class=\"cfooter\"><\/div> ");
document.writeln("<\/div> ");
document.writeln("  <\/div> ");
document.writeln("<\/div> ");

<?php if(isset($_GET['liveboxtips'])){?>
celive51tuitan(); 
<?php }?>
<?php
}else{
?>
document.writeln("<?php echo $list;?>");
document.writeln("<?php echo $qqcode;?>");
<?php if(isset($_GET['liveboxtips'])){?>
celive51tuitan(); 
<?php }?>
<?php
}
?>