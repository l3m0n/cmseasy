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
include_once(CE_ROOT.'/include/celive.class.php');

$root = dirname(__FILE__);
$root = str_replace('/celive/live','',$root);
$root = str_replace('\\celive\\live','',$root);
define('ROOT',$root);
//echo ROOT.'/config/config.php';exit;
$web_config = require_once(ROOT.'/config/config.php');
//echo dirname(__FILE__).'/../webscan360/360safe/360webscan.php';
if($web_config['safe360_enable']){
    if(is_file(dirname(__FILE__).'/../../webscan360/360safe/360webscan.php')){
        require_once(dirname(__FILE__).'/../../webscan360/360safe/360webscan.php');
        //echo 1;
    }
}

$ac=addslashes($_GET['action']);
if($ac=='1'){

  $live = new celive();
  $live->template();
  $live->xajax_live();

  $result=$db->query("SELECT COUNT(*) FROM `activity` WHERE `status`='2'");

  $status=$result[0]['COUNT(*)'];

   if($status == 0){
	  $GLOBALS['template']->assign('offline','<?php echo $lang[not_online]?>');
	  $GLOBALS['template']->assign('status',$status);
	  $GLOBALS['template']->assign('gotocmseasy','<a href="../../index.php?case=guestbook&act=index"><?php echo $lang[right_to_shout]?></a>');
   }else{
	   if(isset($_GET['departmentid'])){
		   $departmentid=addslashes($_GET['departmentid']);
	  }else{
		   $sql = "SELECT `departmentid` FROM `".$config['prefix']."assigns` WHERE 1";
		   @$result = $GLOBALS['db']->my_fetch_array($sql);
		   $tatolr=count($result)-1;
		   $randomr=rand(0,$tatolr);
		   $departmentid = $result[$randomr]['departmentid'];
	  }
	  $timestamp=time();
	  $name=addslashes($_POST['name']);
	  $email=addslashes($_POST['email']);
	  $phone=addslashes($_POST['phone']);
      $preg = '/(select|insert|extract|update|delete|from|where|limit|\(|\)|load|%|\'|"|concat)/is';
      if(preg_match($preg,$name) || preg_match($preg,$email) || preg_match($preg,$phone)){
          exit('parame error!');
      }
	  $name=(!empty($name)) ? $name : 'Guest';
	  $email=(!empty($email)) ? $email : '-';
	  $phone=(!empty($phone)) ? $phone : '0';
	  $ip=$_SERVER["REMOTE_ADDR"];
	  $ip=iconv('gb2312',$GLOBALS['lang']['charset'],$ip);
	  if(empty($departmentid)) $departmentid=0;
	  if($_SESSION['thislivetmp']==$_GET['thislive']){
		  $db->query("INSERT INTO `sessions` (`id` ,`name` ,`email` ,`phone` ,`departmentid` ,`timestamp` ,`ip` ,`status` ) VALUES (NULL , '".$name."', '".$email."', '".$phone."', '".$departmentid."', '".$timestamp."', '".$ip."', '0');");
		  $sessionid = mysql_insert_id();
		  $_SESSION['departmentid'] = $departmentid;
		  $_SESSION['sessionid'] = $sessionid;
		  $_SESSION['timestamp'] = $timestamp;
		  $_SESSION['name'] = $name;
	  }
	  $_SESSION['thislivetmp']=md5(time());
	  $GLOBALS['template']->assign('online',$lang[status_online]);
	  $GLOBALS['template']->assign('xajax_live',$xajax_live->getJavascript(''));
   }

   $GLOBALS['template']->display('request.htm');



}elseif($ac=='0'){

	global $inc;
	$inc = new celive();
	$inc->template();

	$GLOBALS['template']->assign('action','?action=1&module=celive&thislive='.$_SESSION['thislive'].'&departmentid='.addslashes($_GET['departmentid']));
	$GLOBALS['template']->display('collect.htm');

	$inc->finished();

}elseif($ac=='2'){

	global $clive;
	$clive = new celive();
	$clive->template();

	$sessionid = $_SESSION['sessionid'];
	$timestamp = $_SESSION['timestamp'];

	$sql = "SELECT `id`,`operatorid` FROM `chat` WHERE `sessionid`='".$sessionid."' AND `timestamp`='".$timestamp."'";
	@$result = $db->query($sql);

	$chatid = $result[0]['id'];
	$_SESSION['chatid'] = $chatid;

	$operatorid = $result[0]['operatorid'];
	$sql = "SELECT departmentid,`username` FROM `operators` WHERE `id`='".$operatorid."'";
	@$result = $db->query($sql);
	$operatorname = $result[0]['username'];
	$sql = "SELECT name as dname FROM `departments` WHERE `id`='".$result[0]['departmentid']."'";
	@$result = $db->query($sql);
	$dname = $result[0]['dname'];
	$_SESSION['operatorname'] = $operatorname;
	$_SESSION['dname'] = $dname;
	$GLOBALS['template']->assign('','');
	$GLOBALS['template']->display('live.htm');

}
?>