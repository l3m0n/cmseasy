<?php

class Setup {
var $result;
var $sql;
var $files;
var $file;
var $dirs;
var $id;
function install_db()
{
$GLOBALS['inc']->db();
$this->sql = $GLOBALS['file']->read(dirname(__FILE__).'/../install/database.sql');
$GLOBALS['db']->query($this->sql);
$GLOBALS['db']->query('INSERT INTO `operators` (`username`, `password`, `firstname`, `lastname`, `email`, `level`) VALUES ("admin", "'.md5('admin').'", "CmsEasy Live", "CElive", "admin@cmseasy.cn", "0")');
$this->id = $GLOBALS['db']->id();
}
function upgrade_db()
{
$GLOBALS['inc']->db();
$this->sql = $GLOBALS['file']->read(dirname(__FILE__).'/../install/upgrade.sql');
if ($GLOBALS['db']->query($this->sql)) {
return true;
}else {
return false;
}
}
function conf($host,$database,$username,$password,$prefix,$url,$monitor_traffic,$template,$company,$language)
{
$this->file = $GLOBALS['file']->read(dirname(__FILE__).'/config.inc.php');
$this->file = preg_replace("/\['host'\] = '.*';/",'[\'host\'] = \''.$host.'\';',$this->file);
$this->file = preg_replace("/\['database'\] = '.*';/",'[\'database\'] = \''.$database.'\';',$this->file);
$this->file = preg_replace("/\['username'\] = '.*';/",'[\'username\'] = \''.$username.'\';',$this->file);
$this->file = preg_replace("/\['password'\] = '.*';/",'[\'password\'] = \''.$password.'\';',$this->file);
$this->file = preg_replace("/\['prefix'\] = '.*';/",'[\'prefix\'] = \''.$prefix.'\';',$this->file);
$this->file = preg_replace("/\['url'\] = '.*';/",'[\'url\'] = \''.$url.'\';',$this->file);
$this->file = preg_replace("/\['template'\] = '.*';/",'[\'template\'] = \''.$template.'\';',$this->file);
$this->file = preg_replace("/\['lang'\] = '.*';/",'[\'lang\'] = \''.substr($language,0,-4).'\';',$this->file);
$this->file = preg_replace("/\['company'\] = '.*';/",'[\'company\'] = \''.$company.'\';',$this->file);
$GLOBALS['file']->save(dirname(__FILE__).'/config.inc.php',$this->file);
}
function language($language = '')
{
if ($language == '') {
$results = array();
$this->files = $GLOBALS['file']->filelist(dirname(__FILE__).'/../languages/','php');
foreach ($this->files as $key =>$val) {
$this->files[$key]['name'] = ucfirst(strtolower(substr($this->files[$key]['file'],0,-4)));
if (substr($this->files[$key]['name'],0,5) !== 'Index') {
$results[] = $this->files[$key];
}
}
return $results;
}else {
$_SESSION['cel_language'] = $language;
}
}
function template()
{
$results = array();
$this->dirs = $GLOBALS['file']->dirlist(dirname(__FILE__).'/../templates/');
foreach ($this->dirs as $key =>$val) {
$this->dirs[$key]['name'] = ucfirst(strtolower($this->dirs[$key]['dir']));
if (substr($this->dirs[$key]['name'],0,5) !== 'Index') {
$results[] = $this->dirs[$key];
}
}
return $results;
}
}

?>