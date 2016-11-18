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
include(CE_ROOT.'/include/celive.class.php');
$header = new celive();
$header->template();
$header->xajax_live();

$GLOBALS['template']->assign('ifexit','<script type="text/javascript">
							 function chat_unload()
							 {
								 if(event.clientX>document.body.clientWidth&&event.clientY<0||event.altKey) 
								 { 
								 xajax_EndChat();
								 } 
								 }
								 </script>');
$GLOBALS['template']->assign('xajax_live',$xajax_live->getJavascript(''));
$GLOBALS['template']->assign('operatorname',$_SESSION['operatorname']);
$GLOBALS['template']->assign('dname',$_SESSION['dname']);
$GLOBALS['template']->display('header.htm');
?>