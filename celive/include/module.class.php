<?php

class Module {
var $result;
var $modules;
var $links;
var $array;
function exists($module) {
if (is_dir(dirname(__FILE__).'/../modules/'.$module)) {
return true;
}else {
return false;
}
}
function active($module) {
$this->get_all();
foreach ($this->modules as $key =>$var) {
if ($this->modules[$key]['dir'] == $module) {
if ($this->get_config($this->modules[$key]['dir'])) {
if ($GLOBALS['config']['modules'][$this->modules[$key]['dir']]['active']) {
return true;
}else {
return false;
}
}else {
return false;
}
}
}
}
function auth($module)
{
if ($this->exists($module)) {
include_once(dirname(__FILE__).'/../modules/'.$module.'/auth.php');
return true;
}else {
return false;
}
}
function links($type,$display = '')
{
$this->links = array();
$this->get_all();
foreach ($this->modules as $key =>$val) {
if ($this->get_config($this->modules[$key]['dir'])) {
if ($GLOBALS['config']['modules'][$this->modules[$key]['dir']]['active'] &&($GLOBALS['config']['modules'][$this->modules[$key]['dir']]['display'] ||$display == 'true')) {
if ($GLOBALS['config']['modules'][$this->modules[$key]['dir']]['operator'] !== '') {
$this->array['name'] = $this->modules[$key]['dir'];
$this->array['title'] = $GLOBALS['config']['modules'][$this->modules[$key]['dir']]['title'];
switch ($type) {
case 'operator':
$this->array['url'] = $GLOBALS['config']['url'].'/admin/module.php?module='.$this->modules[$key]['dir'].'&file='.$GLOBALS['config']['modules'][$this->modules[$key]['dir']]['operator'].'&type=operator';
break;
case 'admin':
$this->array['url'] = $GLOBALS['config']['url'].'/admin/module.php?module='.$this->modules[$key]['dir'].'&file='.$GLOBALS['config']['modules'][$this->modules[$key]['dir']]['admin'].'&type=admin';
break;
case 'conf':
$this->array['url'] = $GLOBALS['config']['url'].'/admin/module.php?module='.$this->modules[$key]['dir'].'&file='.$GLOBALS['config']['modules'][$this->modules[$key]['dir']]['conf'].'&type=conf';
break;
}
$this->links[] = $this->array;
}
}
}
}
return $this->links;
}
function get_all()
{
$this->modules = $GLOBALS['file']->dirlist(dirname(__FILE__).'/../modules/');
return $this->modules;
}
function get_config($module = '')
{
if ($module !== '') {
if ($this->exists($module)) {
include_once(dirname(__FILE__).'/../modules/'.$module.'/config.php');
return true;
}else {
return false;
}
}else {
$this->get_all();
foreach ($this->modules as $key =>$val) {
$this->get_config($this->modules[$key]['dir']);
}
}
}
}

?>