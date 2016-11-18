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

include('../../include/config.inc.php');
include(CE_ROOT.'/include/admin/check.inc.php');
include(CE_ROOT.'/include/celive.class.php');
$adminlive = new celive();
$adminlive->template();

$sessionid=addslashes($_GET['sessionid']);
$adminthislive=addslashes($_GET['thislive']);

if($_SESSION['adminthislivetmp']==$adminthislive)
{
	$sql = "SELECT * FROM `sessions` WHERE `id`='".$sessionid."'";
	@$result = $db->query($sql);
	
	$name = $result[0]['name'];
	$email = $result[0]['email'];
	$phone = $result[0]['phone'];
	$departmentid = $result[0]['departmentid'];
	$operatorid = $_SESSION['cel_operatorid'];
	$timestamp = $result[0]['timestamp'];
	$ip = $result[0]['ip'];
	$status = 1;
	
	$sql = "INSERT INTO `chat` (`sessionid`,`name`,`email`,`phone`,`timestamp`,`ip`,`departmentid`,`operatorid`,`status`) VALUES('".$sessionid."','".$name."','".$email."','".$phone."','".$timestamp."','".$ip."','".$departmentid."','".$operatorid."','".$status."')";
	
	$db->query($sql);
	$chatid = mysql_insert_id();
	$_SESSION['adminthislivechatid']=$chatid;
	$_SESSION['adminthislivechatname']=$name;
	
	$sql = "UPDATE `sessions` SET `status`='1' WHERE `id`='".$sessionid."'";
	$db->query($sql);
}
$_SESSION['adminthislivetmp']=md5(time().$sessionid);

$GLOBALS['template']->assign('chatid', $_SESSION['adminthislivechatid']);
$GLOBALS['template']->assign('name', $_SESSION['adminthislivechatname']);
$GLOBALS['template']->display('admin/live.htm');

?>