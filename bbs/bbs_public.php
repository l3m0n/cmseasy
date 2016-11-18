<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
date_default_timezone_set('Asia/Shanghai');
define('MAGIC_QUOTES_GPC', function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc());
if (isset($_GET['GLOBALS']) || isset($_POST['GLOBALS']) || isset($_COOKIE['GLOBALS']) || isset($_FILES['GLOBALS'])) {
    exit('request_tainting');
}

if (!MAGIC_QUOTES_GPC) {
    $_GET = daddslashes($_GET);
    $_POST = daddslashes($_POST);
    $_COOKIE = daddslashes($_COOKIE);
    //$_FILES = daddslashes($_FILES);
}

function unescape($str) {
	$str = rawurldecode($str);
	preg_match_all("/%u.{4}|&#x.{4};|&#d+;|.+/U",$str,$r);
	$ar = $r[0];
	foreach($ar as $k=>$v){
		if(substr($v,0,2) == "%u"){
			$ar[$k] = iconv("UCS-2","UTF-8",pack("H4",substr($v,-4)));
		}elseif(substr($v,0,3) == "&#x"){
			$ar[$k] = iconv("UCS-2","UTF-8",pack("H4",substr($v,3,-1))); 
		}elseif(substr($v,0,2) == "&#"){
			$ar[$k] = iconv("UCS-2","UTF-8",pack("n",substr($v,2,-1)));
		}
	}
	return join("",$ar); 
}

/*if(is_array($_POST) && !empty($_POST)){
	$_POST = dxss($_POST);
}*/
function remove_xss($val){
	$val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);
	$search = 'abcdefghijklmnopqrstuvwxyz';
	$search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$search .= '1234567890!@#$%^&*()';
	$search .= '~`";:?+/={}[]-_|\'\\';
	for ($i = 0; $i < strlen($search); $i++) {

		$val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val);
		$val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val);
	}

	$val = html_entity_decode($val);
	if(preg_match('/&#(\d+)/', $val)){
		exit('error');
	}
	if(preg_match('/&#[xX](\d+)/', $val)){
		exit('error');
	}

	$ra1 = array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'base');
	$ra2 = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
	$ra = array_merge($ra1, $ra2);

	$found = true;
	while ($found == true) {
		$val_before = $val;
		for ($i = 0; $i < sizeof($ra); $i++) {
			$pattern = '/';
			for ($j = 0; $j < strlen($ra[$i]); $j++) {
				if ($j > 0) {
					$pattern .= '(';
					$pattern .= '(&#[xX]0{0,8}([9ab]))';
					$pattern .= '|';
					$pattern .= '|(&#0{0,8}([9|10|13]))';
					$pattern .= ')*';
				}
				$pattern .= $ra[$i][$j];
			}
			$pattern .= '/i';
			$replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2);
			$val = preg_replace($pattern, $replacement, $val);
			if ($val_before == $val) {
				$found = false;
			}
		}
	}
	return $val;
}

function dxss($string, $force = 1) {
	if (is_array($string)) {
		$keys = array_keys($string);
		foreach ($keys as $key) {
			$val = $string[$key];
			unset($string[$key]);
			$string[$key] = dxss($val, $force);
		}
	} else {
		$string = remove_xss($string);
	}
	return $string;
}

function daddslashes($string, $force = 1) {
    if (is_array($string)) {
        $keys = array_keys($string);
        foreach ($keys as $key) {
            $val = $string[$key];
            unset($string[$key]);
            $string[addslashes($key)] = daddslashes($val, $force);
        }
    } else {
        $string = remove_xss(addslashes($string));
    }
    return $string;
}


function ueditor($name,$value=''){
	$root = $GLOBALS['config']['site_url'].'/ueditor';
	$str = <<< EOT
    <script id="$name" name="$name" type="text/plain" style="width:680px;height:500px;">$value</script>
    <script type="text/javascript" charset="utf-8" src="{$root}/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="{$root}/ueditor.all.js"> </script>
    <script type="text/javascript" charset="utf-8" src="{$root}/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" charset="utf-8" src="{$root}/addCustomizeButton.js"></script>
    <script type="text/javascript">
        var ue_$name = UE.getEditor('$name',{
            autoHeightEnabled : false
        });
        function UheightAdd(ue,name){
            height = $('#'+name).height();
            ue.setHeight(height+100);
        }
        function UheightSub(ue,name){
            height = $('#'+name).height();
            ue.setHeight(height-100);
        }
    </script>
EOT;
	return $str;
}

function umeditor($name,$value=''){
	$root = $GLOBALS['config']['site_url'].'/bbs/umeditor';
	$str = <<< EOT
	<script type="text/plain" id="$name" name="$name" style="width:98%;height:450px;">$value</script>
	<link href="{$root}/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="{$root}/third-party/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="{$root}/umeditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="{$root}/umeditor.min.js"></script>
    <script type="text/javascript" src="{$root}/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript">var um_$name = UM.getEditor('$name');</script>
EOT;
	return $str;
}

$GLOBALS['config'] = require_once('include/bbs_config.php');

if(!$GLOBALS['config']['bbs_enable']){
	echo "<script>alert('论坛功能已关闭');window.location.href='../index.php';</script>";exit;
}
if($GLOBALS['config']['safe360_enable']){
    //echo dirname(__FILE__).'/../webscan360/360safe/360webscan.php';
    if(is_file(dirname(__FILE__).'/../webscan360/360safe/360webscan.php')){
        require_once(dirname(__FILE__).'/../webscan360/360safe/360webscan.php');
        //echo '1';
    }
}


require_once(ROOT . '/bbs/model/loadClass.php');
//require_once(ROOT . '/editor/fckeditor.php');

/*
 * 配置fckeditor
 */
/*$editor = new FCKeditor('content');
$editor->BasePath = '../editor/';
$editor->Height = 500;
$editor->Width = 680;
$editor->ToolbarSet = 'Default';*/
/******************************/

/*$sessionox = db_sessionox::getInstance();
$spsession = new SPSession($sessionox,$GLOBALS['config']);*/
session_start();


