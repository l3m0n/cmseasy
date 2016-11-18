<style type="text/css">
	#description {background:none;}
</style>

<?php $root = config::get('base_url').'/ueditor';?>
    <script type="text/javascript" charset="utf-8" src="{$root}/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="{$root}/ueditor.all.js"> </script>
    <script type="text/javascript" charset="utf-8" src="{$root}/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" charset="utf-8" src="{$root}/addCustomizeButton.js"></script>

<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>" enctype="multipart/form-data" onsubmit="return checkform();">
<input type="hidden" name="onlymodify" value=""/>

<script type="text/javascript" src="{$base_url}/common/js/ajaxfileupload.js"></script>
    <script type="text/javascript" src="{$base_url}/common/js/jquery.imgareaselect.min.js"></script>
    <script type="text/javascript" src="{$base_url}/common/js/ThumbAjaxFileUpload.js"></script>
<link rel="stylesheet" href="{$base_url}/common/js/jquery/ui/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
    <script language="javascript" src="{$base_url}/common/js/jquery/ui/ui.datepicker.js"></script>
    <script type="text/javascript" src="{$base_url}/js/colorpicker.js"></script>
    <script type="text/javascript" src="{$base_url}/js/upimg/dialog.js"></script>
    <link href="{$base_url}/images/dialog.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{$base_url}/common/swfupload/swfupload.js"></script>
    <script type="text/javascript" src="{$base_url}/common/swfupload/swfupload.queue.js"></script>
    <script type="text/javascript" src="{$base_url}/common/swfupload/fileprogress.js"></script>
    <script type="text/javascript" src="{$base_url}/common/swfupload/system_handlers.js"></script>
<script>
var base_url = '{$base_url}';
</script>
<div id="tagstitle">
   <a id="one1" onclick="setTab('one',1,6)" class="hover">添加专题</a>
   </div>

<div id="tagscontent" class="right_box">

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">

<tbody>

<tr>
<td width="149" align="right">标题</td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('title',$form,$field,$data)}
</td>
</tr>

 <tr>
      <td width="149" height="25" align="right">专题副标题</th>
      <td width="1%">&nbsp;</td>
      <td align="left"><input type="text" class="input" name="subtitle" id="subtitle" /><span class="hotspot" onmouseover="tooltip.show('专题自定义副标题！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:5px; margin-right:5px;"></span></td>
    </tr>

<tr>
<td width="149" align="right">是否生成</td>
<td width="1%">&nbsp;</td>
<td>
<div class="blank10"></div>
{form::getform('ishtml',$form,$field,$data)}
</td>
</tr>

<tr>
<td width="149" align="right">模板</td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('template',$form,$field,$data)}
</td>
</tr>

<tr>
<td width="149" align="right">横幅</td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('banner',$form,$field,$data)}
</td>
</tr>

<tr>
<td width="149" align="right">描述</td>
<td width="1%">&nbsp;</td>
<td>
<div class="blank10"></div>
{form::getform('description',$form,$field,$data)}
<div style="width: 575px;margin-top: 0px;">
<div class="fieldset flash" id="fsUploadProgress">
<span class="legend"></span>
</div>
<div id="divStatus"></div>
</div>
<div class="blank30"></div>
</td>
</tr>
</tbody>
</table>
    
    


<div class="blank20"></div>
<input type="submit" name="submit" value=" 提交 " class="btn_a" />
</form>

</div>