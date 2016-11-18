<?php
/**
* CmsEasy Live http://www.cmseasy.cn 				  			 
* by CmsEasy Live Team 							  						
**
* Software Version: CmsEasy Live v 1.2.0 					  				  	      
* Copyright 2009 by: CmsEasy, (http://www.cmseasy.cn) 	  
* Support, News, Updates at: http://www.cmseasy.cn 			  			  
**
* This program is not free software; you can't may redistribute it and modify it under	  
**
* This file contains configuration settings that need to altered                  
* in order for CE Live to work, and other settings that            
**/

include('../include/config.inc.php');
include(CE_ROOT.'/include/admin/check.inc.php');
include(CE_ROOT.'/include/celive.class.php');
include(CE_ROOT.'/include/version.inc.php');
$version=$config['version'];
$chatlist = new celive();
$chatlist->template();
$chatlist->auth();
$cel_operatorid = $_SESSION['cel_operatorid'];

$operatorid = addslashes($_REQUEST['operatorid']);

$action = addslashes($_REQUEST['action']);

if($action == 'delete')
{
	if($GLOBALS['auth']->admin())
	{
		$chatid = addslashes($_REQUEST['chatid']);

		$sql = "DELETE FROM `chat` WHERE `id`='".$chatid."'";
		$db->query($sql);
		$sql = "DELETE FROM `detail` WHERE `chatid`='".$chatid."'";
		$db->query($sql);
	}
	else
	{
		echo "<script>alert('不能删除自己')</script>";
	}
}


$list = '';
if($operatorid != '')
{
$sql = "SELECT * FROM `operators` WHERE `id`='".$operatorid."'";
@$result = $db->query($sql);
$oname = $result[0]['username'];
$sql = "SELECT * FROM `".$config['prefix']."chat` WHERE `operatorid`='".$operatorid."' ORDER BY `id` ASC";
@$result = $db->my_fetch_array($sql);
for($i=0;$i<count($result);$i++)
{
	$chatid = $result[$i]['id'];
	$name = $result[$i]['name'];
	$ip = $result[$i]['ip'];
	$ip = convertip($ip);

	$list = "<span style='WHITE-SPACE: nowrap'>[".$ip."]<a href='../admin/chatlist.php?action=list&oname=".$oname."&name=".$name."&chatid=".$chatid."'>".$name."</a>(<a href=\"../admin/chatlist.php?action=delete&operatorid=".$operatorid."&chatid=".$chatid."\" onClick=\"return confirm('确认删除交谈记录?');\">x</a>)&nbsp;&nbsp;</span>".$list;
}
}
$GLOBALS['template']->assign('list', $list);
$GLOBALS['template']->assign('oname', @$oname);


if(!$GLOBALS['auth']->admin())
{
	$sql = "SELECT * FROM `".$config['prefix']."operators` WHERE `id`=".$cel_operatorid."";
	@$result = $db->my_fetch_array($sql);
	$namelist = '';
	for($i=0;$i<count($result);$i++)
	{
		$operatorid = $result[$i]['id'];
		$username = $result[$i]['username'];
		$namelist = $namelist."(<a href='../admin/chatlist.php?operatorid=".$operatorid."'>".$username."</a>)&nbsp;&nbsp;";
	}
}
elseif($GLOBALS['auth']->admin())
{
	$sql = "SELECT * FROM `".$config['prefix']."operators`";
	@$result = $db->my_fetch_array($sql);
	$namelist = '';
	for($i=0;$i<count($result);$i++)
	{
		$operatorid = $result[$i]['id'];
		$username = $result[$i]['username'];
		$namelist = $namelist."(<a href='../admin/chatlist.php?operatorid=".$operatorid."'>".$username."</a>)&nbsp;&nbsp;";
	}
}
else
{
	$namelist = '';
}

if($action == 'list')
{
	
$chatid = htmlspecialchars(addslashes($_REQUEST['chatid']));
$oname = htmlspecialchars(addslashes($_REQUEST['oname']));
$name = htmlspecialchars(addslashes($_REQUEST['name']));
$GLOBALS['template']->assign('oname', $oname);
$GLOBALS['template']->assign('name', $name);
$list = '';
if($chatid != '')
{

$sql = "SELECT * FROM `chat` WHERE `id`='".$chatid."'";
@$result = $db->query($sql);
$ip = $result[0]['ip'];
$ip = convertip($ip);
$time = $result[0]['timestamp'];
$email = $result[0]['email'];
$phone = $result[0]['phone'];
$time = date('Y-m-d H:i:s',$time);
$chat_info = '详细信息:(交谈时间-'.$time.') (访客所在地-'.$ip.') (邮箱-'.$email.') (电话-'.$phone.')';
$GLOBALS['template']->assign('chat_info', $chat_info);

$sql = "SELECT * FROM `".$config['prefix']."detail` WHERE `chatid`='".$chatid."' ORDER BY `id` ASC";
@$result = $db->my_fetch_array($sql);
for($i=0;$i<count($result);$i++)
{
	$detail = $result[$i]['detail'];
	$who_witter = $result[$i]['who_witter'];
	if($who_witter == 2)
	{$tname = $name;}
	elseif($who_witter == 1)
	{$tname = $oname;}
	else
	{$tname = '';}	
	
	$list = $list."<b>".$tname.":</b>".$detail."<br />";
}
}
$GLOBALS['template']->assign('chat_list', $list);


if(!$GLOBALS['auth']->admin())
{
	$sql = "SELECT * FROM `".$config['prefix']."operators` WHERE `id`=".$cel_operatorid."";
	@$result = $db->my_fetch_array($sql);
	$namelist = '';
	for($i=0;$i<count($result);$i++)
	{
		$operatorid = $result[$i]['id'];
		$username = $result[$i]['username'];
		$namelist = $namelist."(<a href='../admin/chatlist.php?operatorid=".$operatorid."'>".$username."</a>)&nbsp;&nbsp;";
	}
}
elseif($GLOBALS['auth']->admin())
{
	$sql = "SELECT * FROM `".$config['prefix']."operators`";
	@$result = $db->my_fetch_array($sql);
	$namelist = '';
	for($i=0;$i<count($result);$i++)
	{
		$operatorid = $result[$i]['id'];
		$username = $result[$i]['username'];
		$namelist = $namelist."(<a href='../admin/chatlist.php?operatorid=".$operatorid."'>".$username."</a>)&nbsp;&nbsp;";
	}
}
else
{
	$namelist = '';
}
$GLOBALS['template']->assign('namelist', $namelist);

}
$GLOBALS['template']->assign('namelist', $namelist);
$GLOBALS['template']->display('admin/chatlist.htm');
?>