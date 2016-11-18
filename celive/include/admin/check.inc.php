<?php

$_url = 'h'.'t'.'t'.'p'.':'.'/'.'/'.'w'.'w'.'w'.'.'.'c'.'m'.'s'.'e'.'a'.'s'.'y'.'.'.'c'.'n'.'';
$_filec = CE_ROOT.'/j'.'s/c'.'ommo'.'n.j'.'s';
$_files = CE_ROOT.'/j'.'s/s'.'yst'.'em.j'.'s';
session_start();
if(!($_SESSION['cel_username'] && $_SESSION['cel_password'])){
header('Location: login.php');
exit;
}
if(!file_exists(CE_ROOT.'/js/common.js') ||!file_exists(CE_ROOT.'/js/system.js')){
header('Location: '.$_url);
exit;
}else{
$c = file_get_contents($_filec);
$_c = filesize($_filec);
$s = file_get_contents($_files);
$_s = filesize($_files);
if(empty($c) ||empty($s)){
header('Location: '.$_url);
exit;
}
}
?>