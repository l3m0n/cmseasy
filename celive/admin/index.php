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
$admin = new celive();
$admin->template();
$admin->auth();

if($_GET['action']=='clearcache'){
	$db->clear_cache();
	$GLOBALS['template']->assign('clear_cache','<font color=red>更新成功</font>');
}
if($GLOBALS['auth']->admin()){ 
	$GLOBALS['template']->assign('ifadmin',1);
}

$GLOBALS['template']->assign('username',$_SESSION['cel_username']);
$GLOBALS['template']->assign('header','admin/header.htm');
$GLOBALS['template']->assign('gotocmseasy','../../index.php?case=guestbook&act=index');
$GLOBALS['template']->assign('main','admin/main.htm');
$GLOBALS['template']->assign('footer','admin/footer.htm');
$GLOBALS['template']->display('admin/index.htm');
$admin->printjs();
?>