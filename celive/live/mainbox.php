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
$mainbox = new celive();
$mainbox->template();
$mainbox->xajax_live();


$operatorname = $_SESSION['operatorname'];
$dname = $_SESSION['dname'];
$chatid = $_SESSION['chatid'];
$GLOBALS['template']->assign('chatid',$chatid);
$GLOBALS['template']->assign('operatorname',$operatorname);
$GLOBALS['template']->assign('dname',$dname);
$GLOBALS['template']->assign('xajax_live',$xajax_live->getJavascript(''));
$GLOBALS['template']->display('mainbox.htm');
?>