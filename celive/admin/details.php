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
header("Content-type: text/html; charset=utf-8");
include('../include/config.inc.php');
include(CE_ROOT.'/include/admin/check.inc.php');
include(CE_ROOT.'/include/celive.class.php');
$details = new celive();
$details->template();

$action = addslashes($_POST['action']);
$operatorid = $_SESSION['cel_operatorid'];

if($operatorid=='1'){
	$GLOBALS['template']->assign('ifadmin',1);
}
	
if($action == '1')
{
$old_password = addslashes($_POST['old_password']);
$new_password = addslashes($_POST['new_password']);
$new_password_again = addslashes($_POST['new_password_again']);
$realname = addslashes($_POST['realname']);
  if($operatorid=='1'){
	  if($realname != ''){
		  $sql = "UPDATE `operators` SET `firstname`='".$realname."' WHERE `id`='".$operatorid."'";
		  $db->query($sql);
		  echo "<script>alert('修改成功');</script>";
	  }else{
		  echo "<script>alert('填写不完整');history.back(-1);</script>";
		  exit;
	  }
  }else{
	if($old_password != '' && $new_password != '')
	{
		$sql = "SELECT `password` FROM `operators` WHERE `id`='".$operatorid."'";
		@$result = $db->query($sql);
		if($result[0]['password'] == md5($old_password))
		{
			if($new_password != $new_password_again){
				echo "<script>alert('两次输入密码不一致');history.back(-1);</script>";
			}else{
				$new_password = md5($new_password);
				$sql = "UPDATE `operators` SET `password`='".$new_password."',`firstname`='".$realname."' WHERE `id`='".$operatorid."'";
				$db->query($sql);
				echo "<script>alert('修改成功');</script>";
			}
		}else{
			echo "<script>alert('旧密码错误');history.back(-1);</script>";
			exit;
		}
	}
	else
	{
		echo "<script>alert('填写不完整');history.back(-1);</script>";
		exit;
	}
  }
}
$sql = "SELECT `username`,`firstname` FROM `operators` WHERE `id`='".$operatorid."'";
@$result = $db->query($sql);

$GLOBALS['template']->assign('username', $result[0]['username']);
$GLOBALS['template']->assign('realname', $result[0]['firstname']);

$GLOBALS['template']->assign('poweredby','Powered by CElive');
$GLOBALS['template']->display('admin/details.htm');
?>