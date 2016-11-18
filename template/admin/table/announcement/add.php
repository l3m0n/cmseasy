<?php $root = config::get('base_url').'/ueditor';?>
    <script type="text/javascript" charset="utf-8" src="{$root}/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="{$root}/ueditor.all.js"> </script>
    <script type="text/javascript" charset="utf-8" src="{$root}/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" charset="utf-8" src="{$root}/addCustomizeButton.js"></script>
<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">


<script type="text/javascript" src="{$base_url}/common/js/ajaxfileupload.js"></script>
    <script type="text/javascript" src="{$base_url}/common/js/jquery.imgareaselect.min.js"></script>
    <script type="text/javascript" src="{$base_url}/common/js/ThumbAjaxFileUpload.js"></script>
<link rel="stylesheet" href="{$base_url}/common/js/jquery/ui/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
    <script language="javascript" src="{$base_url}/common/js/jquery/ui/ui.datepicker.js"></script>
    <script type="text/javascript" src="js/upimg/dialog.js"></script>
    <link href="{$base_url}/images/dialog.css" rel="stylesheet" type="text/css" />


<div class="blank20"></div>
<div id="tagscontent" class="right_box">

<input type="hidden" name="onlymodify" value=""/>

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">

<tbody>

<tr>
<td width="149" align="right">公告标题</td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('title',$form,$field,$data)} 
</td>
</tr>

<tr>
<td width="149" align="right">公告内容</td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('content',$form,$field,$data)}
</td>
</tr>
</table>
</div>

<div class="blank20"></div>
<input type="submit" name="submit" value="提交" class="btn_a"/>
</form>