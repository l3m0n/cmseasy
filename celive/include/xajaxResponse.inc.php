<?php

class xajaxResponse
{
var $aCommands;
var $xml;
var $sEncoding;
var $bOutputEntities;
function xajaxResponse($sEncoding=XAJAX_DEFAULT_CHAR_ENCODING,$bOutputEntities=false)
{
$this->setCharEncoding($sEncoding);
$this->bOutputEntities = $bOutputEntities;
$this->aCommands = array();
}
function setCharEncoding($sEncoding)
{
$this->sEncoding = $sEncoding;
}
function setOutputEntities($bOption)
{
$this->bOutputEntities = (boolean)$bOption;
return $this;
}
function outputEntitiesOn()
{
return ($this->setOutputEntities(true));
}
function outputEntitiesOff()
{
return ($this->setOutputEntities(false));
}
function addConfirmCommands($iCmdNumber,$sMessage)
{
$this->addCommand(array('n'=>'cc','t'=>$iCmdNumber),$sMessage);
return $this;
}
function confirmCommands($iCmdNumber,$sMessage)
{
return $this->addConfirmCommands($iCmdNumber,$sMessage);
}
function addAssign($sTarget,$sAttribute,$sData)
{
$this->addCommand(array('n'=>'as','t'=>$sTarget,'p'=>$sAttribute),$sData);
return $this;
}
function assign($sTarget,$sAttribute,$sData)
{
return $this->addAssign($sTarget,$sAttribute,$sData);
}
function addAppend($sTarget,$sAttribute,$sData)
{
$this->addCommand(array('n'=>'ap','t'=>$sTarget,'p'=>$sAttribute),$sData);
return $this;
}
function append($sTarget,$sAttribute,$sData)
{
return $this->addAppend($sTarget,$sAttribute,$sData);
}
function addPrepend($sTarget,$sAttribute,$sData)
{
$this->addCommand(array('n'=>'pp','t'=>$sTarget,'p'=>$sAttribute),$sData);
return $this;
}
function prepend($sTarget,$sAttribute,$sData)
{
return $this->addPrepend($sTarget,$sAttribute,$sData);
}
function addReplace($sTarget,$sAttribute,$sSearch,$sData)
{
$aData[] = array('k'=>'s','v'=>$sSearch);
$aData[] = array('k'=>'r','v'=>$sData);
$this->addCommand(array('n'=>'rp','t'=>$sTarget,'p'=>$sAttribute),$aData);
return $this;
}
function replace($sTarget,$sAttribute,$sSearch,$sData)
{
return $this->addReplace($sTarget,$sAttribute,$sSearch,$sData);
}
function addClear($sTarget,$sAttribute)
{
$this->assign($sTarget,$sAttribute,'');
return $this;
}
function clear($sTarget,$sAttribute)
{
return $this->addClear($sTarget,$sAttribute);
}
function addAlert($sMsg)
{
$this->addCommand(array('n'=>'al'),$sMsg);
return $this;
}
function alert($sMsg)
{
return $this->addAlert($sMsg);
}
function addRedirect($sURL,$iDelay=0)
{
$queryStart = strpos($sURL,'?',strrpos($sURL,'/'));
if ($queryStart !== FALSE)
{
$queryStart++;
$queryEnd = strpos($sURL,'#',$queryStart);
if ($queryEnd === FALSE)
$queryEnd = strlen($sURL);
$queryPart = substr($sURL,$queryStart,$queryEnd-$queryStart);
parse_str($queryPart,$queryParts);
$newQueryPart = "";
if ($queryParts)
{
$first = true;
foreach($queryParts as $key =>$value)
{
if ($first)
$first = false;
else
$newQueryPart .= ini_get('arg_separator.output');
$newQueryPart .= rawurlencode($key).'='.rawurlencode($value);
}
}else if ($_SERVER['QUERY_STRING']) {
$newQueryPart = rawurlencode($_SERVER['QUERY_STRING']);
}
$sURL = str_replace($queryPart,$newQueryPart,$sURL);
}
if ($iDelay)
$this->addScript('window.setTimeout("window.location = \''.$sURL.'\';",'.($iDelay*1000).');');
else
$this->addScript('window.location = "'.$sURL.'";');
return $this;
}
function redirect($sURL,$iDelay=0)
{
return $this->addRedirect($sURL,$iDelay);
}
function addScript($sJS)
{
$this->addCommand(array('n'=>'js'),$sJS);
return $this;
}
function script($sJS)
{
return $this->addScript($sJS);
}
function addScriptCall()
{
$aArgs = func_get_args();
$sFunc = array_shift($aArgs);
$aData = $this->_buildObj($aArgs);
$this->addCommand(array('n'=>'jc','t'=>$sFunc),$aData);
return $this;
}
function call()
{
$aArgs = func_get_args();
return call_user_func_array(array(&$this,'addScriptCall'),$aArgs);
}
function addRemove($sTarget)
{
$this->addCommand(array('n'=>'rm','t'=>$sTarget),'');
return $this;
}
function remove($sTarget)
{
return $this->addRemove($sTarget);
}
function addCreate($sParent,$sTag,$sId,$sType="")
{
if ($sType)
{
trigger_error("The \$sType parameter of addCreate has been deprecated.  Use the addCreateInput() method instead.",E_USER_WARNING);
return;
}
$this->addCommand(array('n'=>'ce','t'=>$sParent,'p'=>$sId),$sTag);
return $this;
}
function create($sParent,$sTag,$sId,$sType="")
{
return $this->addCreate($sParent,$sTag,$sId,$sType);
}
function addInsert($sBefore,$sTag,$sId)
{
$this->addCommand(array('n'=>'ie','t'=>$sBefore,'p'=>$sId),$sTag);
return $this;
}
function insert($sBefore,$sTag,$sId)
{
return $this->addInsert($sBefore,$sTag,$sId);
}
function addInsertAfter($sAfter,$sTag,$sId)
{
$this->addCommand(array('n'=>'ia','t'=>$sAfter,'p'=>$sId),$sTag);
return $this;
}
function insertAfter($sAfter,$sTag,$sId)
{
return $this->addInsertAfter($sAfter,$sTag,$sId);
}
function addCreateInput($sParent,$sType,$sName,$sId)
{
$this->addCommand(array('n'=>'ci','t'=>$sParent,'p'=>$sId,'c'=>$sType),$sName);
return $this;
}
function createInput($sParent,$sType,$sName,$sId)
{
return $this->addCreateInput($sParent,$sType,$sName,$sId);
}
function addInsertInput($sBefore,$sType,$sName,$sId)
{
$this->addCommand(array('n'=>'ii','t'=>$sBefore,'p'=>$sId,'c'=>$sType),$sName);
return $this;
}
function insertInput($sBefore,$sType,$sName,$sId)
{
return $this->addInsertInput($sBefore,$sType,$sName,$sId);
}
function addInsertInputAfter($sAfter,$sType,$sName,$sId)
{
$this->addCommand(array('n'=>'iia','t'=>$sAfter,'p'=>$sId,'c'=>$sType),$sName);
return $this;
}
function insertInputAfter($sAfter,$sType,$sName,$sId)
{
return $this->addInsertInputAfter($sAfter,$sType,$sName,$sId);
}
function addEvent($sTarget,$sEvent,$sScript)
{
$this->addCommand(array('n'=>'ev','t'=>$sTarget,'p'=>$sEvent),$sScript);
return $this;
}
function addHandler($sTarget,$sEvent,$sHandler)
{
$this->addCommand(array('n'=>'ah','t'=>$sTarget,'p'=>$sEvent),$sHandler);
return $this;
}
function addRemoveHandler($sTarget,$sEvent,$sHandler)
{
$this->addCommand(array('n'=>'rh','t'=>$sTarget,'p'=>$sEvent),$sHandler);
return $this;
}
function removeHandler($sTarget,$sEvent,$sHandler)
{
return $this->addRemoveHandler($sTarget,$sEvent,$sHandler);
}
function addIncludeScript($sFileName)
{
$this->addCommand(array('n'=>'in'),$sFileName);
return $this;
}
function includeScript($sFilename)
{
return $this->addIncludeScript($sFileName);
}
function getOutput()
{
$xml = "";
if (is_array($this->aCommands))
{
foreach($this->aCommands as $aCommand)
{
$sData = $aCommand['data'];
unset($aCommand['data']);
$xml .= $this->_getXMLForCommand($aCommand,$sData);
}
}
$charSet = '';
$encoding = '';
if (trim($this->sEncoding)) {
$charSet = '; charset="'.$this->sEncoding.'"';
$encoding = ' encoding="'.$this->sEncoding.'"';
}
@header('content-type: text/xml'.$charSet);
return '<?xml version="1.0"'.$encoding.' ?'.'><xjx>'.$xml.'</xjx>';
}
function getXML()
{
return $this;
}
function loadXML($mCommands)
{
if (is_a($mCommands,'xajaxResponse')) {
$this->aCommands = array_merge($this->aCommands,$mCommands->aCommands);
}
else if (is_array($mCommands)) {
$this->aCommands = array_merge($this->aCommands,$mCommands);
}
else if (is_string($mCommands) &&strpos($mXML,'<xjx>')!==false) {
trigger_error("Using xajaxResponse->loadXML doesn't work with raw XML any more",E_USER_ERROR);
}
else {
if (!empty($mCommands))
trigger_error("The xajax response output could not load other commands as data was not a valid array",E_USER_ERROR);
}
}
function loadCommands($mCommands)
{
return $this->loadXML($mCommands);
}
function _cmdXML($aAttributes,$sData)
{
if ($this->bOutputEntities) {
if (function_exists('mb_convert_encoding')) {
$sData = call_user_func_array('mb_convert_encoding',array(&$sData,'HTML-ENTITIES',$this->sEncoding));
}
else {
trigger_error("The xajax XML response output could not be converted to HTML entities because the mb_convert_encoding function is not available",E_USER_NOTICE);
}
}
$xml = "<cmd";
foreach($aAttributes as $sAttribute =>$sValue)
$xml .= " $sAttribute=\"$sValue\"";
if ($sData !== null &&!stristr($sData,'<![CDATA['))
$xml .= "><![CDATA[$sData]]></cmd>";
else if ($sData !== null)
$xml .= ">$sData</cmd>";
else
$xml .= "></cmd>";
return $xml;
}
function _getXMLForCommand($aAttributes,$mData)
{
$xml = '<cmd';
foreach($aAttributes as $sAttribute =>$sValue)
if ($sAttribute)
$xml .= " $sAttribute=\"$sValue\"";
if (is_array($mData)) 
$xml .= '>'.$this->_arrayToXML($mData).'</cmd>';
else 
$xml .= '>'.$this->_escape($mData).'</cmd>';
return $xml;
}
function _arrayToXML($mArray) {
if (!is_array($mArray))
return $this->_escape($mArray);
$xml = '<xjxobj>';
foreach ($mArray as $aKey=>$aKeyValues) {
if (is_array($aKeyValues)) {
$xml .= '<e>';
foreach($aKeyValues as $sKey =>$sValue) {
$xml .= '<'.htmlentities($sKey).'>';
$xml .= $this->_arrayToXML($sValue);
$xml .= '</'.htmlentities($sKey).'>';
}
$xml .= '</e>';
}else {
$xml .= '<e><k>';
$xml .= $this->_escape($aKey);
$xml .= '</k><v>';
$xml .= $this->_escape($aKeyValues);
$xml .= '</v></e>';
}
}
$xml .= '</xjxobj>';
return $xml;
}
function addCommand($aAttributes,$mData)
{
$aAttributes['data'] = $mData;
$this->aCommands[] = $aAttributes;
}
function _escape($sData)
{
if (!is_numeric($sData) &&!$sData)
return '';
$needCDATA = false;
if ($this->bOutputEntities) {
if (!function_exists('mb_convert_encoding'))
trigger_error('The xajax response output could not be converted to HTML entities because the mb_convert_encoding function is not available',E_USER_NOTICE);
$sData = call_user_func_array('mb_convert_encoding',array(&$sData,'HTML-ENTITIES',$this->sEncoding));
}else {
if ((strpos($sData,'<![CDATA[') !== false)
||(strpos($sData,']]>') !== false)
||(htmlentities($sData) != $sData))
$needCDATA = true;
$segments = explode('<![CDATA[',$sData);
$sData = '';
foreach ($segments as $key =>$segment) {
$fragments = explode(']]>',$segment);
$segment = '';
foreach ($fragments as $fragment) {
if ($segment != '')
$segment .= ']]]]><![CDATA[>';
$segment .= $fragment;
}
if ($sData != '')
$sData .= '<![]]><![CDATA[CDATA[';
$sData .= $segment;
}
}
if ($needCDATA)
$sData = '<![CDATA['.$sData.']]>';
return $sData;
}
function _buildObj($mData) {
if (gettype($mData) == 'object')
$mData = get_object_vars($mData);
if (is_array($mData)) {
$aData = array();
foreach ($mData as $key =>$value)
$aData[] = array(
'k'=>$this->_buildObj($key),
'v'=>$this->_buildObj($value)
);
return $aData;
}else
return $mData;
}
}
?>