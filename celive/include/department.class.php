<?php

class Department {
var $result;
var $result2;
var $array;
function name($id)
{
$this->result = $GLOBALS['db']->query('SELECT `name` FROM `departments` WHERE `id`="'.$id.'"');
return $this->result[0]['name'];
}
function visible($id)
{
$this->result = $GLOBALS['db']->query('SELECT `visible` FROM `departments` WHERE `id`="'.$id.'"');
return $this->result[0]['visible'];
}
function order($id)
{
$this->result = $GLOBALS['db']->query('SELECT `order` FROM `departments` WHERE `id`="'.$id.'"');
return $this->result[0]['order'];
}
function email($id)
{
$this->result = $GLOBALS['db']->query('SELECT `email` FROM `departments` WHERE `id`="'.$id.'"');
return $this->result[0]['email'];
}
function email_host($id)
{
$this->result = $GLOBALS['db']->query('SELECT `email_host` FROM `departments` WHERE `id`="'.$id.'"');
return $this->result[0]['email_host'];
}
function email_port($id)
{
$this->result = $GLOBALS['db']->query('SELECT `email_port` FROM `departments` WHERE `id`="'.$id.'"');
return $this->result[0]['email_port'];
}
function email_username($id)
{
$this->result = $GLOBALS['db']->query('SELECT `email_username` FROM `departments` WHERE `id`="'.$id.'"');
return $this->result[0]['email_username'];
}
function email_password($id)
{
$this->result = $GLOBALS['db']->query('SELECT `email_password` FROM `departments` WHERE `id`="'.$id.'"');
return $this->result[0]['email_password'];
}
function get($id)
{
if ($this->result = $GLOBALS['db']->query('SELECT * FROM `departments` WHERE `id`="'.$id.'"')) {
return $this->result[0];
}else {
return false;
}
}
function update($id,$name,$visible,$order,$email,$email_host,$email_port,$email_username,$email_password)
{
if ($name === '') $name = ' ';
if ($visible === '') $visible = ' ';
if ($order === '') $order='1';
if ($email === '') $email=' ';
if ($email_host === '') $email_host = ' ';
if ($email_port === '') $email_port = '25';
if ($email_username === '') $email_username = ' ';
if ($email_password === '') $email_password = ' ';
if ($GLOBALS['db']->query('UPDATE `departments` SET `name`="'.$name.'", `visible`="'.$visible.'", `order`="'.$order.'", `email`="'.$email.'", `email_host`="'.$email_host.'", `email_port`="'.$email_port.'", `email_username`="'.$email_username.'", `email_password`="'.$email_password.'" WHERE `id`="'.$id.'"')) {
return true;
}else {
return false;
}
}
function insert($name,$visible,$order,$email,$email_host,$email_port,$email_username,$email_password)
{
if ($name === '') $name = ' ';
if ($visible === '') $visible = ' ';
if ($order === '') $order='1';
if ($email === '') $email=' ';
if ($email_host === '') $email_host = ' ';
if ($email_port === '') $email_port = '25';
if ($email_username === '') $email_username = ' ';
if ($email_password === '') $email_password = ' ';
if ($GLOBALS['db']->query('INSERT INTO `departments` (`name`, `visible`, `order`, `email`, `email_host`, `email_port`, `email_username`, `email_password`) VALUES ("'.$name.'", "'.$visible.'", "'.$order.'", "'.$email.'", "'.$email_host.'", "'.$email_port.'", "'.$email_username.'", "'.$email_password.'")')) {
return true;
}else {
return false;
}
}
function delete($id)
{
if ($GLOBALS['db']->query('DELETE FROM `departments` WHERE `id`="'.$id.'"')) {
$GLOBALS['assign']->delete_department($id);
return true;
}else {
return false;
}
}
function listall($operatorid = '',$option = '')
{
$this->array = array();
if ($operatorid == '0'||$operatorid == '') {
if ($option == 'all') {
$this->array = $GLOBALS['db']->query('SELECT * FROM `departments` WHERE 1 ORDER BY `order` ASC');
}else {
$this->array = $GLOBALS['db']->query('SELECT * FROM `departments` WHERE `visible`="1" ORDER BY `order` ASC');
}
}else {
if ($option == 'all') {
$this->result = $GLOBALS['db']->query('SELECT * FROM `departments` WHERE 1 ORDER BY `order` ASC');
}else {
$this->result = $GLOBALS['db']->query('SELECT * FROM `departments` WHERE `visible`="1" ORDER BY `order` ASC');
}
if ($this->result) {
foreach ($this->result as $key =>$val) {
if ($this->result2 = $GLOBALS['db']->query('SELECT * FROM `assigns` WHERE `departmentid`="'.$this->result[$key]['id'].'" AND `operatorid`="'.$operatorid.'"')) {
foreach ($this->result2 as $key2 =>$val2) {
$this->array = array_merge($this->array,array(array('id'=>$this->result[$key]['id'],'name'=>$this->result[$key]['name'],'visible'=>$this->result[$key]['visible'],'email'=>$this->result[$key]['email'])));
}
}
}
}
}
return $this->array;
}
}

?>