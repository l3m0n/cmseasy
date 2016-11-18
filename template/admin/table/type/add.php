<?php $root = config::get('base_url').'/ueditor';?>
    <script type="text/javascript" charset="utf-8" src="{$root}/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="{$root}/ueditor.all.js"> </script>
    <script type="text/javascript" charset="utf-8" src="{$root}/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" charset="utf-8" src="{$root}/addCustomizeButton.js"></script>

<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
<input type="hidden" name="onlymodify" value=""/>

<script type="text/javascript" src="{$base_url}/common/js/ajaxfileupload.js"></script>
    <script type="text/javascript" src="{$base_url}/common/js/jquery.imgareaselect.min.js"></script>
    <script type="text/javascript" src="{$base_url}/common/js/ThumbAjaxFileUpload.js"></script>
<link rel="stylesheet" href="{$base_url}/common/js/jquery/ui/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
    <script language="javascript" src="{$base_url}/common/js/jquery/ui/ui.datepicker.js"></script>
    <script type="text/javascript" src="js/colorpicker.js"></script>
    <script type="text/javascript" src="js/upimg/dialog.js"></script>
    <link href="{$base_url}/images/dialog.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{$base_url}/common/swfupload/swfupload.js"></script>
    <script type="text/javascript" src="{$base_url}/common/swfupload/swfupload.queue.js"></script>
    <script type="text/javascript" src="{$base_url}/common/swfupload/fileprogress.js"></script>
    <script type="text/javascript" src="{$base_url}/common/swfupload/system_handlers.js"></script>
<script>
var base_url = '{$base_url}';
function attachment_delect(id) {
$.ajax({
url: '{url('tool/deleteattachment/site/'.front::get(site),false)}&id='+id,
type: 'GET',
dataType: 'text',
timeout: 1000,
error: function(){
//	alert('Error loading XML document');
},
success: function(data){
document.form1.attachment_id.value=0;
get('attachment_path').innerHTML='';
get('file_info').innerHTML='';
}
});
}
</script>




<div class="tags">
 <div id="tagstitle">
   <a id="one1" onclick="setTab('one',1,6)" class="hover">基本信息</a>
   <a id="one2" onclick="setTab('one',2,6)">SEO信息</a>
   <a id="one3" onclick="setTab('one',3,6)">属性设置</a>
   <a id="one4" onclick="setTab('one',4,6)">扩展信息</a>
   <a id="one5" onclick="setTab('one',5,6)">权限审核</a>
  </div> 

<div id="tagscontent" class="right_box">
<div id="con_one_1">

<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">

<tr>
<td width="149" align="right">
上级分类</span></td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('parentid',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('顶级分类可跳过！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>

</td>
</tr>


<tr>
<td width="149" align="right">分类名称</span></td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('typename',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('填写分类名称！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>

 <tr>
      <td width="149" height="25" align="right">分类副标题</th>
      <td width="1%">&nbsp;</td>
      <td align="left"><input type="text" class="input" name="subtitle" id="subtitle" /><span class="hotspot" onmouseover="tooltip.show('分类自定义副标题！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:5px; margin-right:5px;"></span></td>
    </tr>

<tr>
<td width="149" align="right">目录名称</span></td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('htmldir',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('目录必须是英文名，留空则自动使用拼音名！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>
</table>
    
</div>
<div id="con_one_2" style="display:none">
    
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table2">
<tr>
<td width="149" align="right">网页标题</span></td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('meta_title',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('可填写不同于内容名称的关键词，有利于搜索优化！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
</td>
</tr>

<tr>
<td width="149" align="right">关键词</span></td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('keyword',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('网页META信息中的keywords信息，可填写与内容相关的关键词，以英文逗号相隔，有利于搜索优化！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
</td>
</tr>

<tr>
<td width="149" align="right">页面描述</span></td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('description',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('网页META信息中的description信息，可填写与内容相关的简介，有利于搜索优化！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
</td>
</tr>

<tr>
<td colspan="3" align="left">&nbsp;&nbsp;URL规则</td>
</tr>

<tr>
<td width="149" align="right">当前分类</span></td>
<td width="1%">&nbsp;</td>
<td>
<input name="htmlrule1" type="text" class="input" value="{$data['htmlrule']}" />
<div class="blank30"></div>
{form::getform('htmlrule',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('默认：<b>{</b>$caturl<b>}</b>/type_<b>{</b>$page<b>}</b>.html！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
</td>
</tr>

<tr>
<td width="149" align="right">列表页</span></td>
<td width="1%">&nbsp;</td>
<td>
<input name="listhtmlrule1" type="text" class="input" value="{$data['listhtmlrule']}" />
<div class="blank30"></div>
{form::getform('listhtmlrule',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('默认：<b>{</b>$caturl<b>}</b>/type_<b>{</b>$page<b>}</b>.html！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
</td>
</tr><tr>
<td width="149" align="right">标记</span></td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('stype',$form,$field,$data)}

<span class="hotspot" onmouseover="tooltip.show('被调用的格式：type<b>(</b>$typeid,&prime;标记&prime;<b>)</b>;！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>

</td>
</tr>
</table>
    
</div>
<div id="con_one_3" style="display:none">
    
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table3">
<tr>
<td width="149" align="right">是否启用</span></td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('isshow',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('选择栏目是否启用！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>

 <tr>
<td width="149" align="right">当前使用模板</span></td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('template',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('当前栏目应用的模板样式！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>

<tr>
<td width="149" align="right">所属下级列表页模板</span></td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('listtemplate',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('栏目下属子级栏目应用模板样式！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>


<tr>
<td width="149" align="right">动静态设置</span></td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('ishtml',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('选择栏目是否生成静态，如设置了浏览与下载权限，栏目必须为动态显示！<br />默认为继承网站动静态设置！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>

</td>
</tr>


<tr>
<td width="149" align="right">分页设置</span></td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('ispages',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('选择栏目是否分页显示！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>

<tr>
<td width="149" align="right">子分类内容设置</span></td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('includecatarchives',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('选择栏目列表中是否包含下属栏目中的内容！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>


<tr>
<td width="149" align="right">外部链接</span></td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('linkto',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('填写外部链接地址后，访问栏目将跳转到填写的地址！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>
</table>

</div>
<div id="con_one_4" style="display:none">

<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table4">
<tr>
<td width="149" align="right">封面内容</span></td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('typecontent',$form,$field,$data)}
<div style="width: 575px;margin-top: 0px;">
<div class="fieldset flash" id="fsUploadProgress">
<span class="legend"></span>
</div>
<div id="divStatus"></div>
</div>
<div class="blank30"></div>
<span class="hotspot" onmouseover="tooltip.show('如使用设置栏目封面，请在模板处选择本栏目应用list_page.html模板！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>

<tr>
<td width="149" align="right">分类说明图片</span></td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('image',$form,$field,$data)} 
<span class="hotspot" onmouseover="tooltip.show('栏目banner功能,需在模板中调用显示！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>
</table>
    
</div>
<div id="con_one_5" style="display:none">
    
<div class="hid_box">
<div id=lm11 class="hbox">
<table border="0" cellspacing="0" cellpadding="0" id="table5" width="100%">
<thead>
<tr class="th">
<th align="center" width="20%">&nbsp;</th>
<th align="center"  width="35%">浏览</th>
<th align="center"  width="35%">下载附件</th>
</tr>
<thead>
<tbody>
{loop usergroup::getInstance()->group $group}
<?php if($group['groupid']=='888') continue; ?>
<tr>
<td align="center">{$group.name}</td>
<td align="center">{form::checkbox("_ranks[".$group['groupid']."][view]",-1, @$data['_ranks'][$group['groupid']]['view'])}</td>
<td align="center">{form::checkbox("_ranks[".$group['groupid']."][down]",-1, @$data['_ranks'][$group['groupid']]['down'])}</td>
</tr>
{/loop}
</tbody>
</table>
<div class="blank30"></div>
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"> &nbsp;注意：勾选为该用户组禁止浏览或下载
</div>
</div>
    
</div>
</div>
</div>
<div class="blank10"></div>
<input type="submit" name="submit" value=" 提交 " class="btn_a" />
</form>