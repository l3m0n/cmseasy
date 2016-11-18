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

require_once("include/config.inc.php");
require_once(CE_ROOT."/include/celive.class.php");
$celive = new celive();
$celive->detect_install();
$_SESSION['thislive'] = md5(time());
$_SESSION['thislivetmp'] = $_SESSION['thislive'];

if ($config['customer_info']) {
	header('Location: '.$config['url'].'/live/?action=0&module=celive&thislive='.$_SESSION['thislive'].'&departmentid='.addslashes($_GET['departmentid']));
} else {
	header('Location: '.$config['url'].'/live/?action=1&module=celive&thislive='.$_SESSION['thislive'].'&departmentid='.addslashes($_GET['departmentid']));
}

$celive->finished();
?>