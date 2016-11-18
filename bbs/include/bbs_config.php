<?php
$root = dirname(__FILE__);
$root = str_replace('/bbs/include','',$root);
$root = str_replace('\\bbs\\include','',$root);
define('ROOT',$root);
$web_config = require_once(ROOT.'/config/config.php');
$bbs_config = array(
    'bbs_test' => 1,
);
return array_merge($web_config,$bbs_config);