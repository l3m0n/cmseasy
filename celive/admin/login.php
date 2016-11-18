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

session_start();
include('../include/config.inc.php');
include(CE_ROOT.'/include/celive.class.php');
$login = new celive();
$login->auth();
$login->template();

$preg = '/(select|insert|extract|update|delete|from|where|limit|\(|\)|load|%|\'|"|concat)/is';
if(preg_match($preg,$_POST['username']) || preg_match($preg,$_POST['password']) || preg_match($preg,$phone)){
    exit('parame error!');
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $GLOBALS['auth']->login(addslashes($_POST['username']), addslashes($_POST['password']));
}
if ($GLOBALS['auth']->check_login()) {
    header('Location: '.CE_ROOT.'/admin/index.php');
} else {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $GLOBALS['template']->assign('login_text', $GLOBALS['lang']['login_failure']);
    }
    $GLOBALS['template']->assign('action','login.php');
    $GLOBALS['template']->display('admin/login.htm');
}
?>