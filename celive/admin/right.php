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
$right = new celive();
$right->template();
$right->auth();

if($GLOBALS['auth']->admin()){ 
	$GLOBALS['template']->assign('ifadmin',1);
}

$phpv=PHP_VERSION;
$zendv=zend_version();
$ifmysql=function_exists(mysql_close)?"Yes":"No";
$mysqlallowp=@get_cfg_var("mysql.allow_persistent")?"Yes":"No";
$mysqlmaxlink=@get_cfg_var("mysql.max_links")==-1 ? "不限" : @get_cfg_var("mysql.max_links");
$sysos=PHP_OS;
$sysinf=$_SERVER['SERVER_SOFTWARE'];
$sysip=$_SERVER[SERVER_ADDR];
$upmax=get_cfg_var("upload_max_filesize")?get_cfg_var("upload_max_filesize"):"不允许上传附件";
$maxetime=get_cfg_var("max_execution_time")."秒";


    $GLOBALS['template']->assign('poweredby','<a href="http://www.cmseasy.cn" target="_blank">Powered by CmsEasy</a>');
	$GLOBALS['template']->assign('username',$_SESSION['cel_username']);
	$GLOBALS['template']->assign('version',$version);
	$GLOBALS['template']->assign('phpv',$phpv);
	$GLOBALS['template']->assign('zendv',$zendv);
	$GLOBALS['template']->assign('ifmysql',$ifmysql);
	$GLOBALS['template']->assign('mysqlallowp',$mysqlallowp);
	$GLOBALS['template']->assign('mysqlmaxlink',$mysqlmaxlink);
	$GLOBALS['template']->assign('sysos',$sysos);
	$GLOBALS['template']->assign('sysinf',$sysinf);
	$GLOBALS['template']->assign('sysip',$sysip);
	$GLOBALS['template']->assign('upmax',$upmax);
	$GLOBALS['template']->assign('maxetime',$maxetime);
	$GLOBALS['template']->assign('byteam','CmsEasy Team');
    $GLOBALS['template']->display('admin/right.htm');
?>