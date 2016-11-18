<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
date_default_timezone_set('Asia/Shanghai');

define('MAGIC_QUOTES_GPC', function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc());
if (isset($_GET['GLOBALS']) || isset($_POST['GLOBALS']) || isset($_COOKIE['GLOBALS']) || isset($_FILES['GLOBALS'])) {
    exit('request_tainting');
}

if (!MAGIC_QUOTES_GPC) {
    $_GET = daddslashes($_GET);
    $_POST = daddslashes($_POST);
    $_COOKIE = daddslashes($_COOKIE);
    $_FILES = daddslashes($_FILES);
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
        $string = addslashes($string);
    }
    return $string;
}


$GLOBALS['config'] = require_once('../include/bbs_config.php');
require_once(ROOT.'/bbs/model/loadClass.php');
/*require_once(ROOT.'/editor/fckeditor.php');*/

/*
 * 配置fckeditor
 */
/*$editor = new FCKeditor('content');
$editor->BasePath = '../../editor/';
$editor->Height = 300;
$editor->Width = 500;
$editor->ToolbarSet = 'Default';*/
/******************************/
session_start();
/*$sessionox = db_sessionox::getInstance();
$spsession = new SPSession($sessionox,$GLOBALS['config']);*/
$admin = new action_admin();
$admin->check_admin_login();
$roles = $_SESSION['roles'];
