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
$admin_header = new celive();
$admin_header->template();
$admin_header->admin_xajax_live();

$chatid = addslashes($_GET['chatid']);
$sql = "SELECT * FROM `chat` WHERE `id`='".$chatid."'";
@$result = $db->query($sql);
$ip = $result[0]['ip'];
$ip = convertip($ip);

$GLOBALS['template']->assign('chatid',$chatid);

$GLOBALS['template']->assign('name', $result[0]['name']);
$GLOBALS['template']->assign('email', $result[0]['email']);
$GLOBALS['template']->assign('phone', $result[0]['phone']);
$GLOBALS['template']->assign('ip', $result[0]['ip']);
$GLOBALS['template']->assign('area', $ip);

$GLOBALS['template']->assign('ifexit','<script type="text/javascript">
							 function chat_unload()
							 {
								 if(event.clientX>document.body.clientWidth&&event.clientY<0||event.altKey) 
								 { 
								 xajax_EndChat();
								 } 
								 }
								 </script>');
$GLOBALS['template']->assign('xajax_live',$admin_xajax_live->getJavascript('../'));
$GLOBALS['template']->display('admin/live/header.htm');
?>