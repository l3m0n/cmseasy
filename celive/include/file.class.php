<?php

class File {
function max_size()
{
if (intval(ini_get('upload_max_filesize')) >intval(ini_get('post_max_size'))) {
return ini_get('post_max_size');
}else {
return ini_get('upload_max_filesize');
}
}
function read($file)
{
$handle = fopen($file,"r");
if (filesize($file) >0) {
$contents = fread($handle,filesize($file));
fclose($handle);
}else {
$contents = '';
}
return $contents;
}
function check_write($file)
{
if (is_writable($file)) {
$contents = file_get_contents($file);
$handle = fopen($file,"w");
$write = fwrite($handle,$contents);
fclose($handle);
if ($write === FALSE) {
return false;
}else {
return true;
}
}else {
return false;
}
}
function save($file,$contents)
{
if (is_writable($file)) {
$handle = fopen($file,"w");
fwrite($handle,$contents);
fclose($handle);
return true;
}else {
return false;
}
}
function create($file,$contents)
{
if ($handle = @fopen($file,"w")) {
fwrite($handle,$contents);
fclose($handle);
return true;
}else {
return false;
}
}
function rdelete($dir)
{
if (file_exists($dir)) {
if ($dp = opendir($dir)) {
while (false !== ($file = readdir($dp))) {
if ($file !== '.'&&$file !== '..') {
if (!is_dir($dir.DIRECTORY_SEPARATOR.$file)) {
@unlink($dir.DIRECTORY_SEPARATOR.$file);
}else {
$this->rdelete($dir.DIRECTORY_SEPARATOR.$file);
}
}
}
closedir($dp);
}
}
}
function filelist($dir,$arg = '')
{
$list = array();
$handle = opendir($dir);
while ($file = readdir($handle)) {
if ($file !== '.'&&$file !== '..') {
switch ($arg) {
case 'php':
if (substr($file,-3) == 'php') {
$list[] = array('file'=>$file);
}
break;
default:
$list[] = array('file'=>$file);
}
}
}
closedir($handle);
return $list;
}
function dirlist($dir)
{
$list = array();
$handle = @opendir($dir);
while ($name = @readdir($handle)) {
if ($name !== '.'&&$name !== '..') {
$list[] = array('dir'=>$name);
}
}
@closedir($handle);
return $list;
}
function request_transfer($chatid)
{
return $GLOBALS['db']->query('UPDATE `sessions` SET `transfer`="yes" WHERE `chatid`="'.$chatid.'"');
}
}
?>