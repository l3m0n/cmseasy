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
    <script type="text/javascript" src="{$base_url}/common/swfupload/swfupload.js"></script>
    <script type="text/javascript" src="{$base_url}/common/swfupload/swfupload.queue.js"></script>
    <script type="text/javascript" src="{$base_url}/common/swfupload/fileprogress.js"></script>
    <script type="text/javascript" src="{$base_url}/common/swfupload/system_handlers.js"></script>

<script>
var base_url = '{$base_url}';
function attachment_delect(id) {
$.ajax({
url: '<?php echo url('tool/deleteattachment/site/'.front::get('site'),false)?>&id='+id,
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
<script type="text/javascript">
function stob(type){
if(type == 'single'){
$("#batch").css('display','none');
$("#single").css('display','block');
return;
}
if(type == 'batch'){
$("#single").css('display','none');
$("#batch").css('display','block');
return;
}
}
</script>

<script type="text/javascript" src="{$base_url}/js/upimg/dialog.js"></script>
    <link href="{$base_url}/images/dialog.css" rel="stylesheet" type="text/css" />
<div class="tags">
<div id="tagstitle">
<a href="#" id="one1" onclick="setTab('one',1,6)" class="hover">基本信息</a>
<a href="#" id="one2" onclick="setTab('one',2,6)">SEO信息</a>
<a href="#" id="one3" onclick="setTab('one',3,6)">属性设置</a>
<a href="#" id="one4" onclick="setTab('one',4,6)">扩展信息</a>
<a href="#" id="one5" onclick="setTab('one',5,6)">权限审核</a>
</div>
<div id="tagscontent" class="right_box">
<div id="con_one_1">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">
<tr>
    <td align="right">添加方式</td>
    <td width="1%">&nbsp;</td>
    <td><input name="addtype" value="single"  type="radio" checked="checked" onclick="stob(this.value)" /> 
      单条添加&nbsp;&nbsp;&nbsp;&nbsp;
  <input name="addtype" value="batch" type="radio" onclick="stob(this.value)"  > 
  批量添加</td>
  </tr>     

<tr>
<td width="149" height="25" align="right">所属栏目</td>
<td width="1%">&nbsp;</td>
<td align="left">{form::getform('parentid',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('如果为一级栏目，不需选择！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span
></td>
</tr>
</td>
    </tr>
  </tbody>
</table>


<table width="100%" align="center" cellpadding="0" cellspacing="0" id="table2">
  <tbody id="single" style="display:block;">
    <tr>
      <td width="149" height="25" align="right">栏目名称</th>
      <td width="1%">&nbsp;</td>
      <td align="left"><input type="text" class="input" name="catname" id="catname" /><span class="hotspot" onmouseover="tooltip.show('请填写栏目名称！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:5px; margin-right:5px;"></span></td>
    </tr>
	 <tr>
      <td width="149" height="25" align="right">栏目副标题</th>
      <td width="1%">&nbsp;</td>
      <td align="left"><input type="text" class="input" name="subtitle" id="subtitle" /><span class="hotspot" onmouseover="tooltip.show('栏目自定义副标题！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:5px; margin-right:5px;"></span></td>
    </tr>
    <tr>
      <td width="149" height="25" align="right">目录名称</th>
      <td width="1%">&nbsp;</td>
      <td align="left"><input type="text" class="input" name="htmldir" id="htmldir" /><span class="hotspot" onmouseover="tooltip.show('目录必须是英文名，留空则自动使用拼音名，请勿夹杂符号！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:5px; margin-right:5px;"></span></td>
    </tr>
  </tbody>
  <tbody id="batch" style="display:none;">
    <tr>
      <td width="149" height="25" align="right">栏目名称</th>
      <td width="1%">&nbsp;</td>
      <td><table cellspacing="0" cellpadding="0">
        <tr>
          <td width="214"><textarea name="batch_add" maxlength="255" class="textarea"></textarea></td>
          <td width="132" align="left" style="line-height:18px;">栏目1|lanmu1<br />
栏目2|lanmu2</td>
        </tr>
      </table></td>
    </tr>
  </tbody>
</table>


<table width="100%" align="center" cellpadding="0" cellspacing="0" id="table3">
<tr>
<td width="149" align="right">在导航中显示</td>
<td width="1%">&nbsp;</td>
<td>{form::getform('isnav',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('如果是一级目录，可选择是否在导航中显示栏目名称和链接！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
</td>
</tr>

<tr>
<td width="149" align="right">在手机版中显示</td>
<td width="1%">&nbsp;</td>
<td>{form::getform('ismobilenav',$form,$field,$data)}  <span class="hotspot" onmouseover="tooltip.show('如果是一级目录，可选择是否在导航中显示栏目名称和链接！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></td>
</tr>

</table>
</div>

<div id="con_one_2" style="display:none">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table4">
<tr>
<td width="149" align="right">网页标题</td>
<td width="1%">&nbsp;</td>
<td>	
{form::getform('meta_title',$form,$field,$data,'class="input"')}
<span class="hotspot" onmouseover="tooltip.show('可填写不同于内容名称的关键词，有利于搜索优化！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
</td>
</tr>

<tr>
<td width="149" align="right">关键词</td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('keyword',$form,$field,$data,'class="input"')}
<span class="hotspot" onmouseover="tooltip.show('网页META信息中的keywords信息，可填写与内容相关的关键词，以英文逗号相隔，有利于搜索优化！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
</td>
</tr>

<tr>
<td width="149" align="right">页面描述</td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('description',$form,$field,$data,'')}
<span class="hotspot" onmouseover="tooltip.show('网页META信息中的description信息，可填写与内容相关的简介，有利于搜索优化！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
</td>
</tr>

<tr>
<td colspan="3" align="left">&nbsp;&nbsp;URL规则</td>
</tr>

<tr>
<td width="149" align="right">当前栏目列表</td>
<td width="1%">&nbsp;</td>
<td>

<input name="htmlrule1" type="text" class="input" value="{$data['htmlrule']}" />
<span class="hotspot" onmouseover="tooltip.show('<strong>默&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;认：</strong>&#123;$caturl&#125;/&#123;$page&#125;.html <br /><strong>短&nbsp;&nbsp;目&nbsp;&nbsp;录：</strong>&#123;$dir&#125/&#123;$page&#125;.html<br /><strong>自&nbsp;&nbsp;定&nbsp;&nbsp;义：</strong>自定义（英文或拼音）/&#123;$page&#125;.html<br /><strong>栏目目录：</strong>&#123;$caturl&#125;<br /><strong>当前目录：</strong>&#123;$dir&#125;<br /><strong>注&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;意：</strong>&#123;$page&#125;必须存在URL内且为最后！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"> </span>
		<div class="blank10"></div>
		<font color=gray>如有分页，请一定要在自定义名称后加入分页函数_<b>{</b>$page<b>}</b>！</font>
		<div class="blank30"></div>
{form::getform('htmlrule',$form,$field,$data,'')}
<span class="hotspot" onmouseover="tooltip.show('<strong>默&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;认：</strong>&#123;$caturl&#125;/&#123;$page&#125;.html <br /><strong>短&nbsp;&nbsp;目&nbsp;&nbsp;录：</strong>&#123;$dir&#125/&#123;$page&#125;.html<br /><strong>自&nbsp;&nbsp;定&nbsp;&nbsp;义：</strong>自定义（英文或拼音）/&#123;$page&#125;.html<br /><strong>栏目目录：</strong>&#123;$caturl&#125;<br /><strong>当前目录：</strong>&#123;$dir&#125;<br /><strong>注&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;意：</strong>&#123;$page&#125;必须存在URL内且为最后！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>		
</td>
</tr>

<tr>
<td width="149" align="right">所属子栏目</td>
<td width="1%">&nbsp;</td>
<td>

<input name="listhtmlrule1" type="text" class="input" value="{$data['listhtmlrule']}" />
<span class="hotspot" onmouseover="tooltip.show('<strong>默&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;认：</strong>&#123;$caturl&#125;/&#123;$page&#125;.html <br /><strong>短&nbsp;&nbsp;目&nbsp;&nbsp;录：</strong>&#123;$dir&#125/&#123;$page&#125;.html<br /><strong>自&nbsp;&nbsp;定&nbsp;&nbsp;义：</strong>自定义（英文或拼音）/&#123;$page&#125;.html<br /><strong>栏目目录：</strong>&#123;$caturl&#125;<br /><strong>当前目录：</strong>&#123;$dir&#125;<br /><strong>注&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;意：</strong>&#123;$page&#125;必须存在URL内且为最后！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"> </span>
		<div class="blank10"></div>
		<font color=gray>如有分页，请一定要在自定义名称后加入分页函数_<b>{</b>$page<b>}</b>！</font>
		<div class="blank30"></div>
{form::getform('listhtmlrule',$form,$field,$data,'')}
<span class="hotspot" onmouseover="tooltip.show('<strong>默&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;认：</strong>&#123;$caturl&#125;/&#123;$page&#125;.html <br /><strong>短&nbsp;&nbsp;目&nbsp;&nbsp;录：</strong>&#123;$dir&#125/&#123;$page&#125;.html<br /><strong>自&nbsp;&nbsp;定&nbsp;&nbsp;义：</strong>自定义（英文或拼音）/&#123;$page&#125;.html<br /><strong>栏目目录：</strong>&#123;$caturl&#125;<br /><strong>当前目录：</strong>&#123;$dir&#125;<br /><strong>注&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;意：</strong>&#123;$page&#125;必须存在URL内且为最后！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"> </span>
</td>
</tr>

<tr>
<td width="149" align="right">所属内容页</td>
<td width="1%">&nbsp;</td>
<td>

<input name="showhtmlrule1" type="text" class="input" value="{$data['showhtmlrule']}" />
<span class="hotspot" onmouseover="tooltip.show('<strong>默&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;认：</strong>&#123;$caturl&#125;/show_&#123;$aid&#125;(_&#123;$page&#125;).html<br /><strong>短&nbsp;&nbsp;目&nbsp;&nbsp;录：</strong>&#123;$dir&#125/show_&#123;$aid&#125;(_&#123;$page&#125;).html<br /><strong>自&nbsp;&nbsp;定&nbsp;&nbsp;义：</strong>自定义（英文或拼音）/&#123;$page&#125;.html<br /><strong>栏目目录：</strong>&#123;$caturl&#125;<br /><strong>当前目录：</strong>&#123;$dir&#125;<br /><strong>注&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;意：</strong>&#123;$page&#125;必须存在URL内且为最后！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
		<div class="blank10"></div>
		<font color=gray>如有分页，请一定要在自定义名称后加入分页函数_<b>{</b>$page<b>}</b>！</font>
		<div class="blank30"></div>

{form::getform('showhtmlrule',$form,$field,$data,'class=""')}
<span class="hotspot" onmouseover="tooltip.show('<strong>默&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;认：</strong>&#123;$caturl&#125;/show_&#123;$aid&#125;(_&#123;$page&#125;).html<br /><strong>短&nbsp;&nbsp;目&nbsp;&nbsp;录：</strong>&#123;$dir&#125/show_&#123;$aid&#125;(_&#123;$page&#125;).html<br /><strong>自&nbsp;&nbsp;定&nbsp;&nbsp;义：</strong>自定义（英文或拼音）/&#123;$page&#125;.html<br /><strong>栏目目录：</strong>&#123;$caturl&#125;<br /><strong>当前目录：</strong>&#123;$dir&#125;<br /><strong>注&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;意：</strong>&#123;$page&#125;必须存在URL内且为最后！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
</td>
</tr>
</table>
</div>

<div id="con_one_3" style="display:none">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table5">
<tr>
<td width="149" align="right">当前使用模板</td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('template',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('当前栏目应用的模板样式！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>

<tr>
<td width="149" align="right">所属列表模板</td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('listtemplate',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('栏目下属子级栏目应用模板样式！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>

<tr>
<td width="149" align="right">所属内容模板</td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('showtemplate',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('栏目下属内容页模板样式！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>

<tr>
<td width="149" align="right">手机版当前使用模板</td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('templatewap',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('当前栏目应用的模板样式！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>

<tr>
<td width="149" align="right">手机版所属列表模板</td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('listtemplatewap',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('栏目下属子级栏目应用模板样式！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>

<tr>
<td width="149" align="right">手机版所属内容模板</td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('showtemplatewap',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('栏目下属内容页模板样式！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>

<tr>
<td width="149" align="right">内容绑定表单</td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('showform',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('栏目下属内容页绑定表单！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>

<tr>
<td width="149" align="right">是否启用</td>
<td width="1%">&nbsp;</td>
<td>{form::getform('isshow',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('选择栏目是否启用！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>

<tr>
<td width="149" align="right">动静态设置</td>
<td width="1%">&nbsp;</td>
<td>{form::getform('ishtml',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('选择栏目是否生成静态，如设置了浏览与下载权限，栏目必须为动态显示！<br />默认为继承网站动静态设置！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>

<tr>
<td width="149" align="right">分页设置</td>
<td width="1%">&nbsp;</td>
<td>{form::getform('ispages',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('选择栏目是否分页显示！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>

<tr>
<td width="149" align="right">分页值</td>
<td width="1%">&nbsp;</td>
<td>{form::getform('attr3',$form,$field,$data,'class="input_c"')}
<span class="hotspot" onmouseover="tooltip.show('留空按全局设置数量显示！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>

<tr>
<td width="149" align="right">防伪码前缀</td>
<td width="1%">&nbsp;</td>
<td>{form::getform('ecoding',$form,$field,$data,'class="input"')}
<span class="hotspot" onmouseover="tooltip.show('防伪码前缀！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>

<tr>
<td width="149" align="right">子内容设置</td>
<td width="1%">&nbsp;</td>
<td>{form::getform('includecatarchives',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('选择栏目列表中是否包含下属栏目中的内容！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>

<tr>
<td width="149" align="right">外部链接</td>
<td width="1%">&nbsp;</td>
<td>{form::getform('linkto',$form,$field,$data,'class="input"')}
<span class="hotspot" onmouseover="tooltip.show('填写外部链接地址后，访问栏目将跳转到填写的地址！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>
</table>
</div>

<div id="con_one_4" style="display:none">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table6">
<tr>
<td width="149" align="right">封面内容</td>
<td width="1%">&nbsp;</td>
<td>
<script type="text/javascript" charset="utf-8" src="{$base_url}/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="{$base_url}/ueditor.all.js"> </script>
    <script type="text/javascript" charset="utf-8" src="{$base_url}/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" charset="utf-8" src="{$base_url}/addCustomizeButton.js"></script>
{form::getform('categorycontent',$form,$field,$data)} 
<span class="hotspot" onmouseover="tooltip.show('如使用设置栏目封面，请在模板处选择本栏目应用list_page.html模板！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
<div style="width: 575px;margin-top: 0px;">
<div class="fieldset flash" id="fsUploadProgress">
    <span class="legend"></span>
</div>
<div id="divStatus"></div>

            </div>
							<div class="blank30"></div>
</td>
</tr>

<tr>
<td width="149" align="right">栏目说明图片</td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('image',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('栏目banner功能,需在模板中调用显示！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>

<tr>
<td width="149" align="right">缩略图大小</td>
<td width="1%">&nbsp;</td>
<td>{form::input('thumb_width',$data['thumb_width'],'size="5" class="input_c"')} px × {form::input('thumb_height',$data['thumb_height'],'size="5" class="input_c"')} px
<span class="hotspot" onmouseover="tooltip.show('默认: {type::getwidthofthumb(get('id'))} px × {type::getheightofthumb(get('id'))} px！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>
</table>
</div>  

<div id="con_one_5" style="display:none">
<table border="0" cellspacing="0" cellpadding="0" id="table5" width="100%">
<thead>
<tr class="th">
<th width="38%">会员组</th>
<th  width="30%">浏览</th>
<th  width="30%">下载</th>
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
</tbody>
{/loop}
</table>
<div class="blank30"></div>
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"> &nbsp;注意：勾选为该用户组禁止浏览或下载
</div>
</div>
</div>

<input type="submit" name="submit" value=" 提交 " class="btn_a" />
</form>