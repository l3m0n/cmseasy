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
$system = new celive();
$system->template();
$system->file();
$system->auth();
$system->celsysteminfo();
$system->department();
$system->auth();

if($GLOBALS['auth']->admin()){
	$GLOBALS['template']->assign('ifadmin',1);
}
$GLOBALS['template']->assign('username',$_SESSION['cel_username']);

if(!$GLOBALS['auth']->admin())
{
	$GLOBALS['template']->assign('createcode',true);
	$GLOBALS['template']->assign('cel_departments', $GLOBALS['department']->listall('', 'all'));
	if (isset($_POST['departmentid'])) {
        $GLOBALS['template']->assign('departmentid', $_POST['departmentid']);
    } else {
        $GLOBALS['template']->assign('departmentid', '');
    }
	if (isset($_POST['ifimages']) && $_POST['ifimages']=='text') {
        $GLOBALS['template']->assign('mode', 'text');
    } else {
        $GLOBALS['template']->assign('mode', 'images');
    }
	if (isset($_POST['qq'])) {
        $GLOBALS['template']->assign('qq', $_POST['qq']);
    } else {
        $GLOBALS['template']->assign('qq', '');
	}
}else{

if($_GET['action']=='systeminfo'){

$GLOBALS['template']->assign('system',true);

if (isset($_POST['systeminfo'])) {
        if (isset($_POST['submit'])) {
			if(addslashes($_POST['customer_info']))
			{
				$customer_info='true';
			}else{
				$customer_info='false';
			}
            $GLOBALS['celsysteminfo']->conf(addslashes($_POST['url']), addslashes($_POST['template']), addslashes($_POST['company']),addslashes($_POST['companyinfos']), addslashes($_POST['language']), $customer_info, addslashes($_POST['tracker_refresh']));
            //提交修改后，需自动刷新一次，才能显示修改的内容
            echo "<script>window.history.go(-1);</script>";
        }
        $GLOBALS['template']->assign('up_sys_success', '<font color=red>(更新成功)</font>');
    }

}elseif($_GET['action']=='departments'){

	$GLOBALS['template']->assign('departments',true);

$do = addslashes($_REQUEST['do']);
$name = addslashes($_POST['name']);

if($do == 'add' and $name != '')
{

	$sql = "SELECT `id` FROM `".$config['prefix']."departments` WHERE `name`='".$name."'";
	@$result = $db->my_fetch_array($sql);
	if(count($result) == 0) {
	$sql = "INSERT INTO `departments` (`name`) VALUES('".$name."')";
	$db->query($sql);
	}
}


if($do == 'delete')
{
	$departmentid = addslashes($_GET['departmentid']);
	$sql = "DELETE FROM `departments` WHERE `id`='".$departmentid."'";
	$db->query($sql);
	$sql = "DELETE FROM `assigns` WHERE `departmentid`='".$departmentid."'";
	$db->query($sql);
}

$sql = "SELECT * FROM `".$config['prefix']."departments` ORDER BY `id` DESC";
@$result = $db->my_fetch_array($sql);
$list = '';
for($i=0;$i<count($result);$i++)
{
	$departmentid = $result[$i]['id'];
	$name = $result[$i]['name'];
	$list = $list."
	<tr class=\"light\">
      <td align=\"right\" width=\"11%\"><strong>".$name."</strong></td>
	  <td width=\"1%\">&nbsp;</td>
      <td align=\"left\" width=\"80%\"> <img src=\"".$config['url']."/templates/".$config['template']."/images/del.gif\" width=\"16\" height=\"16\" /> <a href=\"system.php?action=departments&do=delete&departmentid=".$departmentid."\" onClick=\"return confirm('确认删除?');\">删除</a>
	  </td>
    </tr>
";
}

$GLOBALS['template']->assign('list', $list);

}elseif($_GET['action']=='operators'){

	$GLOBALS['template']->assign('operators',true);

$do = addslashes($_REQUEST['do']);
$username = addslashes($_REQUEST['username']);

if($do == 'add' and $username != '')
{
	$password = addslashes($_REQUEST['password']);
	$password = md5($password);
	$realname = addslashes($_REQUEST['realname']);
	$timestamp = time();
	$level = addslashes($_REQUEST['level']);
        $departmentid = intval($_REQUEST['departmentid']);

	$sql = "SELECT `id` FROM `".$config['prefix']."operators` WHERE `username`='".$username."' AND `password`='".$password."'";
	@$result = $db->my_fetch_array($sql);
	if(count($result) == 0) {
	$sql = "INSERT INTO `operators` (`username`,`password`,`firstname`,`level`,`timestamp`,`departmentid`) VALUES('".$username."','".$password."','".$realname."','".$level."','".$timestamp."','$departmentid')";
	$db->query($sql);
	}
}

if($do == 'delete')
{
	$operatorid = addslashes($_REQUEST['operatorid']);
	$sql = "DELETE FROM `operators` WHERE `id`='".$operatorid."'";
	if($operatorid=='1'){
		$GLOBALS['template']->assign('isadmin', '<font color=red>(创始人账号不能删除)</font>');
	}else{
	$db->query($sql);
	$sql = "DELETE FROM `assigns` WHERE `operatorid`='".$operatorid."'";
	$db->query($sql);
	}
}

$sql = "SELECT t1.*,t2.name as dname FROM `".$config['prefix']."operators` t1 LEFT JOIN `".$config['prefix']."departments` t2 ON t1.departmentid=t2.id  ORDER BY `timestamp` DESC";
@$result = $db->my_fetch_array($sql);
$list = '';
for($i=0;$i<count($result);$i++)
{
	$operatorid = $result[$i]['id'];
	$username = $result[$i]['username'];
	$realname = $result[$i]['firstname'];
        $dname = $result[$i]['dname'];
	$level = $result[$i]['level'];
	if($level=='0')
	{
		$level="管理";
	}else{
		$level="客服";
	}
	$sql = "SELECT `id` FROM `".$config['prefix']."activity` WHERE `operatorid`='".$operatorid."'";
	@$result2 = $db->my_fetch_array($sql);
	if(count($result2) == 0) {
		$login = '离线';}else {
		$login = '<font color=red>在线</font>';
	}
	$list = $list."
	<tr class=\"light\">
      <td align=\"center\">".$realname."</td>
      <td align=\"center\">".$username."</td>
      <td align=\"center\">".$dname."</td>
      <td align=\"center\">".$level."</td>
      <td align=\"center\">".$login."</td>
      <td align=\"left\"><img src=\"".$config['url']."/templates/".$config['template']."/images/del.gif\" width=\"16\" height=\"16\" /><a href=\"system.php?action=operators&do=delete&operatorid=".$operatorid."\" onClick=\"return confirm('确认删除?');\">删除</a></td>
    </tr>
";
}
$GLOBALS['template']->assign('list', $list);
//phpox b
$sql = "SELECT id,name FROM `".$config['prefix']."departments` ORDER BY `id` ASC";
@$result = $db->my_fetch_array($sql);
$selectdname = '';
for($i=0;$i<count($result);$i++)
{
    $id = $result[$i]['id'];
    $name = $result[$i]['name'];
    $selectdname .= "<option value=\"$id\">$name</option>";
}
$GLOBALS['template']->assign('selectdname', $selectdname);
//phpox e
}elseif($_GET['action']=='assigns'){

	$GLOBALS['template']->assign('assigns',true);
	$do = addslashes($_REQUEST['do']);

if($do == 'edit')
{
	$departmentid = addslashes($_REQUEST['departmentid']);
	$operatorid = addslashes($_REQUEST['operatorid']);
    $sql = "DELETE FROM `assigns` WHERE `operatorid`='".$operatorid."'";
	@$db->query($sql);
	if($departmentid != '')
	{
		$sql = "INSERT INTO `assigns` (`departmentid`,`operatorid`) VALUES('".$departmentid."','".$operatorid."')";
		@$db->query($sql);
	}
}

$sql = "SELECT * FROM `".$config['prefix']."operators` ORDER BY `timestamp` DESC";
@$result = $db->my_fetch_array($sql);
$list = '';
for($i=0;$i<count($result);$i++)
{
	$operatorid = $result[$i]['id'];
	$username = $result[$i]['username'];
	$sql = "SELECT * FROM `".$config['prefix']."assigns` WHERE `operatorid`='".$operatorid."'";
	@$result3 = $db->my_fetch_array($sql);
	if(count($result3) != 0)
	{
		$did = $result3[0]['departmentid'];
	}
	else
	{
		$did = '';
	}
	$department = '';
	$sql = "SELECT * FROM `".$config['prefix']."departments` ORDER BY `id` ASC";
	@$result2 = $db->my_fetch_array($sql);
	for($j=0;$j<count($result2);$j++)
	{
		if($did == $result2[$j]['id'])
		{$selected = 'selected';}
		else
		{$selected = '';}
		$department = $department."<option value=\"".$result2[$j]['id']."\" ".$selected.">".$result2[$j]['name']."</option>";
	}
	$department = "<select name=\"departmentid\"><option value=\"\">默认接待所有请求</option>".$department."</select>";

	$list = $list."
	<form action=\"system.php?action=assigns\" method=\"post\" name=\"assigns\">
	<tr class=\"light\">
      <td align=\"right\">".$username."</td>
      <td align=\"left\">".$department."</td>
      <td align=\"left\"><input type=\"submit\" name=\"edit\" value=\"分配\" /><input type=\"hidden\" name=\"do\" value=\"edit\" /><input type=\"hidden\" name=\"operatorid\" value=\"".$operatorid."\" /></td>
    </tr>
	</form>
";
}

$GLOBALS['template']->assign('list', $list);

}elseif($_GET['action']=='createcode'){

	$GLOBALS['template']->assign('createcode',true);
	$GLOBALS['template']->assign('cel_departments', $GLOBALS['department']->listall('', 'all'));
	if (isset($_POST['departmentid'])) {
        $GLOBALS['template']->assign('departmentid', $_POST['departmentid']);
    } else {
        $GLOBALS['template']->assign('departmentid', '');
    }
	if (isset($_POST['ifimages']) && $_POST['ifimages']=='text') {
        $GLOBALS['template']->assign('mode', 'text');
    } else {
        $GLOBALS['template']->assign('mode', 'images');
    }
	if (isset($_POST['qq'])) {
        $GLOBALS['template']->assign('qq', $_POST['qq']);
    } else {
        $GLOBALS['template']->assign('qq', '');
    }

}elseif($_GET['action']=='companyinfos'){

	$GLOBALS['template']->assign('companyinfos',true);
	if (isset($_POST['_companyinfos'])) {
        if (isset($_POST['submit'])) {
            $GLOBALS['celsysteminfo']->confcompanyinfos(addslashes($_POST['companyinfos']));
        }
        $GLOBALS['template']->assign('c_up_sys_success', '<font color=red>(保存成功,刷新可以见保存后的内容.)</font>');
    }

}
}



    $GLOBALS['template']->assign('poweredby','<a href="http://www.cmseasy.cn" target="_blank">Powered by CElive</a>');
	$GLOBALS['template']->assign('version',$version);
	$GLOBALS['template']->assign('byteam','Uniter Team');
	$GLOBALS['template']->assign('language', $GLOBALS['celsysteminfo']->language());
    $GLOBALS['template']->assign('template', $GLOBALS['celsysteminfo']->template());
    $GLOBALS['template']->display('admin/system.htm');

?>