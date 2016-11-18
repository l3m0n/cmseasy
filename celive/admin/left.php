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
$left = new celive();
$left->template();
$left->auth();

if($GLOBALS['auth']->admin()){ 
	$GLOBALS['template']->assign('ifadmin',1);
}

$GLOBALS['template']->assign('poweredby','Powered by CElive');
$GLOBALS['template']->assign('gotocmseasy','../../index.php?case=guestbook&act=index');
$GLOBALS['template']->assign('version',$version);
$GLOBALS['template']->display('admin/left.htm');
?>