<script type="text/javascript">
    function checkform() {
        if(document.form1.catid.value=="0") {
            alert('请选择栏目');
            document.form1.catid.focus();
            return false;
        }
        if(!document.form1.title.value) {
            alert('请填写标题');
            document.form1.title.focus();
            return false;
        }
        {loop $field $f}
<?php
if (!preg_match('/^my_/', $f[name]) || !$f[notnull]) {
    //unset($field[$f[name]]);
    continue;
}

?>
        if(!document.form1.{$f[name]}.value){
            alert("请填写<?php echo setting::$var['archive'][$f['name']]['cname']; ?>");
            setTab('one',6,6);
            document.form1.{$f[name]}.focus();
            return false;
        }
        {/loop}
        return true;
    }
</script>
<form method="post" name="form1" action="<?php if (front::$act == 'edit')
    $id="/id/".$data[$primary_key]; else
    $id='';
echo modify("/act/".front::$act."/table/".$table.$id."/deletestate/".front::get('deletestate')); ?>" enctype="multipart/form-data" onsubmit="return checkform();">
    <input type="hidden" name="onlymodify" value=""/>
    <script type="text/javascript" src="{$base_url}/common/js/ajaxfileupload.js"></script>
    <script type="text/javascript" src="{$base_url}/common/js/jquery.imgareaselect.min.js"></script>
    <script type="text/javascript" src="{$base_url}/common/js/ThumbAjaxFileUpload.js"></script>
	<link rel="stylesheet" href="{$base_url}/common/js/jquery/ui/ui.datepicker.css" type="text/css" />
    <script language="javascript" src="{$base_url}/common/js/jquery/ui/ui.datepicker.js"></script>
    <script type="text/javascript" src="{$base_url}/js/jquery.colorpicker.js"></script> 
    
    <?php $root = config::get('base_url').'/ueditor';?>
    <script type="text/javascript" charset="utf-8" src="{$root}/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="{$root}/ueditor.all.js"> </script>
    <script type="text/javascript" charset="utf-8" src="{$root}/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" charset="utf-8" src="{$root}/addCustomizeButton.js"></script>
    
    <script>
        $(function(){
            $("#catid").change( function(){
				get_field($("#catid").val());
            });
			$("#tag_option").change( function(){
				if($("#tag_option").find('option:selected').val() != '0'){
					if($("#tag").val() != ''){
						var sp = ',';	
					}else{
						sp = '';	
					}
					$("#tag").val($("#tag").val()+sp+$("#tag_option").find('option:selected').text());
					//$("#tagids").val($("#tagids").val()+sp+$("#tagid").find('option:selected').val());
				}
            });
			  $("#color_btn").colorpicker({
				fillcolor:true,
				success:function(o,color){
					$("#title").css("color",color);
					$("#color").val(color);
				},
				reset:function(o,color){
					$("#title").css("color","");
					$("#color").val("");
				}
			});
			
        });
        function attachment_delect(id) {
            $.ajax({
url: '{url('tool/deleteattachment/site/'.front::get(site),false)}&id='+id,
type: 'GET',
dataType: 'text',
timeout: 10000,
error: function(){
    //	alert('Error loading XML document');
},
success: function(data){
    document.form1.attachment_id.value=0;
    get('attachment_path').value='';
	get('attachment_intro').value='';
	get('attachment_path_i').innerHTML='';
    get('file_info').innerHTML='';
}
            });
        }

        function get_field(catid) {
            $.ajax({
url: '{url('table/getfield/table/archive/',true)}&catid='+catid,
type: 'GET',
dataType: 'text',
timeout: 10000,
error: function(){
    //alert('Error loading XML document');
},
success: function(data){
    $("#con_one_6").html(data);
}
            });
        }
    </script>
    <script type="text/javascript" src="{$base_url}/js/upimg/dialog.js"></script>
    <link href="{$base_url}/images/admin/dialog.css" rel="stylesheet" type="text/css" />

<div class="tags" style="margin-bottom:20px;">
<div id="tagstitle">
<a href="#" id="one1" onclick="setTab('one',1,6)" class="hover">基本信息</a>
<a href="#" id="one2" onclick="setTab('one',2,6)">SEO信息</a>
<a href="#" id="one3" onclick="setTab('one',3,6)">属性设置</a>
<a href="#" id="one4" onclick="setTab('one',4,6)">扩展信息</a>
<a href="#" id="one5" onclick="setTab('one',5,6)">权限审核</a>
<a href="#" id="one6" onclick="setTab('one',6,6)">自定义字段</a>
</div>

<div id="tagscontent" class="right_box">
<div id="con_one_1">

<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">

<tr>
<td width="149" align="right">栏目</td>
<td width="1%">&nbsp;</td>
<td>
{form::getform('catid',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('选择内容所在栏目，如果栏目有子级栏目，请选择子级栏目！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
</td>
</tr>

    <tr>
        <td width="149" align="right">分类</td>
        <td width="1%">&nbsp;</td>
        <td>{form::getform('typeid',$form,$field,$data)}
		<span class="hotspot" onmouseover="tooltip.show('选择内容所在分类，如果分类有子级分类，请选择子级分类！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
		</td>
    </tr>
	<tr>
        <td width="149" align="right">专题</td>
        <td width="1%">&nbsp;</td>
        <td>
<?php echo form::select('spid',
        $data['spid'], special::option()); ?>
		<span class="hotspot" onmouseover="tooltip.show('将内容划分到不同专题内，可对不同内容进行区分！');" onmouseout="tooltip.hide();">
		<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
		</span>
        </td>
    </tr>
    <tr>
        <td width="149" align="right">置顶</td>
        <td width="1%">&nbsp;</td>
        <td>{form::getform('toppost',$form,$field,$data)}
		<span class="hotspot" onmouseover="tooltip.show('文章置顶,可按栏目或全站置顶！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
		</td>
    </tr>
    <tr>
        <td width="149" align="right">标题</td>
        <td width="1%">&nbsp;</td>
        <td>{form::getform('title',$form,$field,$data,'class="input"')}
		 <input id="color" name="color" type="hidden" /><span class="hotspot" onmouseover="tooltip.show('标题文字颜色！');" onmouseout="tooltip.hide();"><img id="color_btn" width="14" height="14" src="images/admin/colorpicker.png" style="cursor:pointer;" /></span>  <span class="hotspot" onmouseover="tooltip.show('标题加粗！');" onmouseout="tooltip.hide();"><input name="strong" type="checkbox" value="1" {if $data['strong']==1}checked{/if} /></span></td>
    </tr>
	 <tr>
        <td width="149" align="right">副标题</td>
        <td width="1%">&nbsp;</td>
        <td>{form::getform('subtitle',$form,$field,$data,'class="input"')}<span class="hotspot" onmouseover="tooltip.show('内容自定义副标题！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:5px; margin-right:5px;"></span>
		</td>
    </tr>
    <tr>
        <td width="149" align="right">正文</td>
        <td width="1%">&nbsp;</td>
        <td>
            {form::getform('content',$form,$field,$data)}
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
					    <td width="149" align="right"></td>
        <td width="1%">&nbsp;</td>
        <td><input name="savehttppic" type="checkbox" value="1" />&nbsp;保存远程图片&nbsp;&nbsp;<input name="autothumb" type="checkbox" value="1" />&nbsp;第一张图片自动保存为缩略图</td>
					</tr>
    <tr>
        <td width="149" align="right">内容简介</td>
        <td width="1%">&nbsp;</td>
        <td>{form::getform('introduce',$form,$field,$data)}
		<span class="hotspot" onmouseover="tooltip.show('填写内容简介，如留空将自动截取内容中字符作为简介！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
		</td>
    </tr>
    <tr>
        <td width="149" align="right">Tag标签</td>
        <td width="1%">&nbsp;</td>
        <td>{form::getform('tag',$form,$field,$data)}
		<span class="hotspot" onmouseover="tooltip.show('选择内容所属Tag标签！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
		</td>
    </tr>
    <tr>
        <td width="149" align="right"></td>
        <td width="1%">&nbsp;</td>
        <td>
          {form::getform('tag_option',$form,$field,$data)}
        </td>
    </tr>
    <tr>
        <td width="149" align="right">发布时间</td>
        <td width="1%">&nbsp;</td>
        <td><input type="text" name="adddate" id="adddate" value="<?php echo date('Y-m-d H:i:s'); ?>" class="skey" /><span class="hotspot" onmouseover="tooltip.show('内容发布时间，可自定义，格式：2010-08-08 08:08:08！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
		</td>
    </tr>
	<tr>
        <td width="149" align="right">过期时间</td>
        <td width="1%">&nbsp;</td>
        <td>
            {form::getform('outtime',$form,$field,$data)}
			<span class="hotspot" onmouseover="tooltip.show('过期内容会被删除到回收站！');" onmouseout="tooltip.hide();">
			<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
			</span>
        </td>
    </tr>
    <tr>
        <td width="149" align="right">发布作者</td>
        <td width="1%">&nbsp;</td>
        <td><input type="text" name="author" id="author" value="<?php echo $user['username'] ?>"   class="skey" /><span class="hotspot" onmouseover="tooltip.show('内容发布作者名，可自定义！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
		</td>
    </tr>
    <tr>
        <td width="149" align="right">来源</td>
        <td width="1%">&nbsp;</td>
        <td>{form::getform('attr3',$form,$field,$data)}<span class="hotspot" onmouseover="tooltip.show('内容发布来源，可自定义，默认为本站网址！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:5px; margin-right:5px;"></span>
		</td>
    </tr>
	<tr>
        <td width="149" align="right">地区</td>
        <td width="1%">&nbsp;</td>
        <td>
            <?php echo form::select('province_id',
    get('province_id') ? get('province_id') : 0, area::province_option()); ?>
<?php echo form::select('city_id', get('city_id') ? get('scity_id') : 0,
        area::city_option()); ?>
<?php echo form::select('section_id', get('section_id') ? get('section_id') : 0, area::section_option()); ?>
<span class="hotspot" onmouseover="tooltip.show('对内容进行地区划分，可区别不同内容！');" onmouseout="tooltip.hide();">
		<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
		</span>
        </td>
    </tr>
	<tr>
        <td width="149" align="right">审核</td>
        <td width="1%">&nbsp;</td>
        <td>{form::getform('checked',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('设置内容是否发布，勾选未审核，不在前台显示，内容在后台列表可继续编辑！<br />默认：为审核状态！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
		</td>
    </tr>
</table>
      </div>
            <div id="con_one_2" style="display:none">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table2">
    <tr>
        <td width="149" align="right">网页标题</td>
        <td width="1%">&nbsp;</td>
        <td>{form::getform('mtitle',$form,$field,$data)}
		<span class="hotspot" onmouseover="tooltip.show('可填写不同于内容名称的关键词，有利于搜索优化！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
		</td>
    </tr>
    <tr>
        <td width="149" align="right">关键词</td>
        <td width="1%">&nbsp;</td>
        <td>{form::getform('keyword',$form,$field,$data)}
		<span class="hotspot" onmouseover="tooltip.show('网页META信息中的keywords信息，可填写与内容相关的关键词，以英文逗号相隔，有利于搜索优化！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
		</td>
    </tr>
    <tr>
        <td width="149" align="right">页面描述</td>
        <td width="1%">&nbsp;</td>
        <td>{form::getform('description',$form,$field,$data)}
		<span class="hotspot" onmouseover="tooltip.show('网页META信息中的description信息，可填写与内容相关的简介，有利于搜索优化！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
		</td>
    </tr>
    <tr>
        <td width="149" align="right">URL规则</td>
        <td width="1%">&nbsp;</td>
        <td>
		<input name="htmlrule1" type="text" class="input" value="{$data['htmlrule']}" /><span class="hotspot" onmouseover="tooltip.show('你可以自定生成文件名称<br /><br />例如：abc.html<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>{</b>$caturl<b>}</b>/abc.html<br />默认：<b>{</b>$caturl<b>}</b>/show_<b>{</b>$aid<b>}</b>(_<b>{</b>$page<b>}</b>).html<br /><b>{</b>$caturl<b>}</b> = 栏目目录<br /><b>{</b>$aid<b>}</b> = 内容ID<br /><b>{</b>$page<b>}</b> = 内容分页值！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
		<div class="blank10"></div>
		<font color=gray>如有分页，请一定要在自定义名称后加入分页函数_<b>{</b>$page<b>}</b>！</font>
        <div class="blank30"></div>
        {form::getform('htmlrule',$form,$field,$data)}
		<span class="hotspot" onmouseover="tooltip.show('你可以选择系统默认的URL规则<br />例如：abc.html<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>{</b>$caturl<b>}</b>/abc.html<br />默认：<b>{</b>$caturl<b>}</b>/show_<b>{</b>$aid<b>}</b>(_<b>{</b>$page<b>}</b>).html<br /><b>{</b>$caturl<b>}</b> = 栏目目录<br /><b>{</b>$aid<b>}</b> = 内容ID<br /><b>{</b>$page<b>}</b> = 内容分页值！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
		</td>
    </tr>
    <tr>
        <td width="149" align="right">生成HTML</td>
        <td width="1%">&nbsp;</td>
        <td>{form::getform('ishtml',$form,$field,$data)}
		<span class="hotspot" onmouseover="tooltip.show('选择内容是否生成静态，如设置了浏览与下载权限，内容必须为动态显示！<br />默认为继承栏目动静态设置！');" onmouseout="tooltip.hide();">
		<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
		</span>
		</td>
    </tr>

</table>
            </div>
            <div id="con_one_3" style="display:none">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table3">
	
    <tr>
        <td width="149" align="right">内容页模板</td>
        <td width="1%">&nbsp;</td>
        <td>
            {form::getform('template',$form,$field,$data)}
			<span class="hotspot" onmouseover="tooltip.show('选择内容模板样式，可区别栏目设置的其他内容样式，以便拥有独立的外观！<br />默认为继承栏目模板设置！');" onmouseout="tooltip.hide();">
			<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
			</span>
        </td>
    </tr>
    
     <tr>
        <td width="149" align="right">手机内容页模板</td>
        <td width="1%">&nbsp;</td>
        <td>
            {form::getform('templatewap',$form,$field,$data)}
			<span class="hotspot" onmouseover="tooltip.show('选择内容模板样式，可区别栏目设置的其他内容样式，以便拥有独立的外观！<br />默认为继承栏目模板设置！');" onmouseout="tooltip.hide();">
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
        <td width="149" align="right">内容推荐位</td>
        <td width="1%">&nbsp;</td>
        <td id="content-recommend">{form::getform('attr1',$form,$field,$data)}
		<span class="hotspot" onmouseover="tooltip.show('勾选不同内容推荐位后，结合内容标签中的推荐位，可区分调用不同内容！');" onmouseout="tooltip.hide();">
		<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
		</span>
		</td>
    </tr>
	<tr>
        <td width="149" align="right">价格</td>
        <td width="1%">&nbsp;</td>
        <td>{form::getform('attr2',$form,$field,$data)}
		<span class="hotspot" onmouseover="tooltip.show('请填写大于0的数字型字符！');" onmouseout="tooltip.hide();">
		<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
		</span>
		</td>
    </tr>
    <tr>
        <td width="149" align="right">产品颜色</td>
        <td width="1%">&nbsp;</td>
        <td>{form::getform('pcolor',$form,$field,$data)}
		<span class="hotspot" onmouseover="tooltip.show('每行一个！');" onmouseout="tooltip.hide();">
		<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
		</span>
		</td>
    </tr>
    <tr>
        <td width="149" align="right">链接跳转到</td>
        <td width="1%">&nbsp;</td>
        <td>{form::getform('linkto',$form,$field,$data)}
		<span class="hotspot" onmouseover="tooltip.show('填写后，点击标题后，将连接到链接地址！');" onmouseout="tooltip.hide();">
		<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
		</span>
		</td>
    </tr>
    <tr>
        <td width="149" align="right">内容的评级</td>
        <td width="1%">&nbsp;</td>
        <td>
            <table width="90%">
	<tr>
	<td width="20%">{form::getform('grade',$form,$field,$data)}
		<span class="hotspot" onmouseover="tooltip.show('对内容进行评级，将以五角星显示级别！');" onmouseout="tooltip.hide();">
		<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
		</span>
	</td>
   </tr>
            </table>
        </td>
</tr>
 <tr>
<td width="149" align="right">防伪码</td>
<td width="1%">&nbsp;</td>
<td>{form::getform('isecoding',$form,$field,$data)}
<span class="hotspot" onmouseover="tooltip.show('此篇文章是否开启防伪码！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>
<tr>
        <td width="149" align="right">内容页多图</td>
        <td width="1%">&nbsp;</td>
        <td>
            <div id=uploadarea>
            <div id="pvpics"></div><input type="hidden" name="ic" id="ic" value="0" />
    <div class="blank10"></div>
<a title="选择文件" onclick="javascript:windowsdig('选择文件','iframe:index.php?case=file&act=updialog&fileinputid=pics&getbyid=pvpics&max=99&checkfrom=piclistshow','900px','480px','iframe')" href="#body"><p><img src="images/admin/add_pic.gif" style="float:left;" /></p></a><span class="hotspot" onmouseover="tooltip.show('当内容页模板选择：<br /> [ 图片内容页 - archive/show_pic.html ] <br />用于图片幻灯显示效果展示！');" onmouseout="tooltip.hide();">
			<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style=" margin-left:10px; margin-right:5px;">
			</span>
            </div>
        </td>
 
    </tr>
       
</table>
            </div>
            <div id="con_one_4" style="display:none">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table4">
    <tr>
        <td width="149" align="right">缩略图</td>
        <td width="1%">&nbsp;</td>
        <td>{form::getform('thumb',$form,$field,$data)}
		<span class="hotspot" onmouseover="tooltip.show('缩略图用于图片列表页显示！');" onmouseout="tooltip.hide();">
		<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="float:left; margin-left:10px; margin-right:5px;">
		</span>
		</td>
    </tr>
    <tr>
        <td width="149" align="right">附件</td>
        <td width="1%">&nbsp;</td>
        <td>
            <span id="file_info" style="color:red"></span><br>
            附件路径：<input type="text" name="attachment_path" class="input"  id="attachment_path" value="{$data[attachment_path]}" /><span class="hotspot" onmouseover="tooltip.show('填写此项无须再上传附件，请填写完整的url地址，例如：http://www.cmseasy.cn/upload/attachment.rar！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px;">
</span>
<div class="blank10"></div>

            <input type="hidden" name="attachment_id"  id="attachment_id" value="{=archive_attachment(@$data['aid'],'id')}"  class="input" />
            附件名称：<input type="text" name="attachment_intro"  id="attachment_intro" value="{=archive_attachment(@$data['aid'],'intro')}" class="input" /><span class="hotspot" onmouseover="tooltip.show('填附件的下载提示名称！');" onmouseout="tooltip.hide();">
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
			<div class="blank10"></div>

            <span style="float:left;">保存地址：<span id="attachment_path_i">{=archive_attachment(@$data['aid'],'path')}</span></span><input style="float:left;" type="button" name="delbutton"  class="a_del" onclick="attachment_delect(get('attachment_id').value)" />
<div class="blank10"></div>
<?php if (front::$act == 'edit' && $data['attachment_id']) { ?>
更改：<?php } ?>

            上传：<input type="file" name="fileupload" id="fileupload" style="width:400px" />
            <div class="blank30"></div>

			<input type="button"  name="filebuttonUpload"  id="filebuttonUpload" onclick="return ajaxFileUpload('fileupload','{url("tool/uploadfile",false)}','#uploading');" value="上传" class="btn_a" />
               <img id="uploading" src="{$base_url}/common/js/loading.gif" style="display:none;">
        </td>
    </tr>
    <tr>
        <td width="149" align="right">投票</td>
        <td width="1%">&nbsp;</td>
        <td>

		<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table">
    <?php for ($i=1; $i <= 8; $i++) { ?><tr>
	<td width="5%" align="center">{$i}</td>
        <td width="12%" align="right">
		投票标题
		<div class="blank5"></div>
		图片url
		</td>
        <td width="1%">&nbsp;</td>
        <td>
		{form::input("vote[$i]",vote::title(@$data['aid'],$i),'class="input" ')}
		<span class="hotspot" onmouseover="tooltip.show('填写内容中投票内容名称！');" onmouseout="tooltip.hide();">
		<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
		</span>
		<div class="blank5"></div>
		{form::input("vote_image[$i]",vote::img(@$data['aid'],$i),'class="input" ')}
		<span class="hotspot" onmouseover="tooltip.show('填写内容中投票内容图片地址！');" onmouseout="tooltip.hide();">
		<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
		</span>
		</td>
    </tr>
	<tr><td colspan="4" height="10">&nbsp;</td></tr>
<?php } ?>
</table>
        </td>
    </tr>
    
    
    
</table>
            </div>
            <div id="con_one_5" style="display:none">


<table border="0" cellspacing="0" cellpadding="0" id="table5" width="100%">
<thead>
<tr class="th">
<th align="center" width="38%">会员组</th>
<th align="center"  width="30%">浏览</th>
<th align="center"  width="30%">下载</th>
</tr>
{loop usergroup::getInstance()->group $group}
<?php if ($group['groupid'] == '888') continue; ?>
<tr>
<td align="center">{$group.name}</td>
<td align="center">{form::checkbox("_ranks[".$group['groupid']."][view]",-1, @$data['_ranks'][$group['groupid']]['view'])}</td>
<td align="center">{form::checkbox("_ranks[".$group['groupid']."][down]",-1, @$data['_ranks'][$group['groupid']]['down'])}</td>
</tr>
{/loop}
</table>
<div class="blank30"></div>
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"> &nbsp;注意：勾选为该用户组禁止浏览或下载


            </div>
            <div id="con_one_6" style="display:none">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table6">
    <tr>
        <td width="149" align="right">自定义字段</td>
        <td width="1%">&nbsp;</td>
        <td>
            <table>
{loop $field $f}
<?php
$name=$f['name'];
if (!preg_match('/^my_/', $name)) {
    unset($field[$name]);
    continue;
}
								if(setting::$var['archive'][$name]['catid'] != $data['catid'] && (setting::$var['archive'][$name]['catid'])){
									unset($field[$name]);
    continue;
								}
if (!isset($data[$name]))
    $data[$name]='';
?>
<tr>
    <td class="left" width="20%"><?php echo setting::$var['archive'][$name]['cname']; ?></td>
    <td><?php echo form::getform($name,$form, $field, $data); ?></td>
</tr>
{/loop}
            </table>
        </td>
    </tr>
</table>
</div>
</div>




{if front::get('catid')}<script type="text/javascript">get_field({front::get('catid')});</script>{/if}</div>
<input type="submit" name="submit" value=" 提交 " class="btn_a" />

</form>