
<?php
$tagfrom = $_GET['tagfrom'];
if($tagfrom=='content'){
	$listname = '内容';
}elseif($tagfrom=='category'){
	$listname = '栏目';
}elseif($tagfrom=='function'){
	$listname = '函数';
}elseif($tagfrom=='system'){
	$listname = '系统';
}elseif($tagfrom=='define'){
	$listname = '自定义';
}
?>



<script type="text/javascript">
window.onload = function ()
{
	var aP = document.getElementsByTagName("table");
	var i = 0;
	for (i = 0; i < aP.length; i++)
	{
		aP[i].getElementsByTagName("a")[0].onclick = function ()
		{
			var aSpan = this.parentNode.getElementsByTagName("span");
			aSpan[0].innerHTML = aSpan[1].style.display == "block" ? "显示JS" : "隐藏";
			aSpan[1].style.display = aSpan[1].style.display == "block" ? "none" : "block";
		}	
	}	
}
</script>

<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<div class="blank20"></div>
<div style="padding-left:10px;">
<a href="{$base_url}/index.php?case=table&act=add&table=templatetag&tagfrom=content&admin_dir={get('admin_dir')}&site=default"  class="btn_d">添加内容标签</a>
<a href="{$base_url}/index.php?case=table&act=add&table=templatetag&tagfrom=category&admin_dir={get('admin_dir')}&site=default"  class="btn_d">添加栏目标签</a>
<a href="{$base_url}/index.php?case=table&act=add&table=templatetag&tagfrom=define&admin_dir={get('admin_dir')}&site=default"  class="btn_d">添加自定义标签</a>
<div class="blank30"></div>
<div class="blank30"></div>
<span class="hotspot" onmouseover="tooltip.show('一个中文标签代替一段代码。<br>标签调用方法：<b>{</b><b>tag_</b>标签名称<b>}</b><br>标签JS调用方法：<b>{</b><b>js_</b>标签名称<b>}</b><br>非中文标签调用直接放置代码，例如调用 [ICP备案号] 直接在模板插入<b>{</b>get(\'site_icp\')<b>}</b>！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin:-10px 10px 0px 10px;">标签调用说明</span>
</div>

<div class="blank5"></div>
<div id="tagscontent" class="right_box">

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<thead>
<tr class="th">
<th><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
<!-- <th><!--id--><!--编号</th> -->
<th><!--name-->名称</th>
<th>Js调用格式</th>
<th><!--tagcontent-->标签模板</th>
<th>操作</th>
</tr>
</thead>
<tbody>
{loop $data $d}
<tr class="s_out"  onmouseover=this.bgColor='#FFFFF0'; onmouseout=this.bgColor=''; bgcolor=''>

<td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>

<!-- <td align="center">{cut($d['id'])}</td> -->

<td>{cut($d['name'])}</td>
<td>
<table width="260" style="width:260px;">
<tr><td>站内调用：<span>{</span>tagwap_{cut($d['name'])}<span>}</span></td></tr>

<tr><td>站外调用：<a href="javascript:;"><span style="color:green;">显示JS</span></a><span style="display:none;margin-top:10px;">&lt;script src="{$base_url}/index.php?case=templatetag&act=get&id={cut($d['id'])}&="&gt;&lt;/script&gt;</span></td></tr>

</table>
</td>
<td><?php
if($d['tagcontent']=='null'){
	$id = $d['id'];
	$path=ROOT.'/config/tag/'.get('tagfrom').'_'.$id.'.php';
	$tag_config = array();
	$tag_config_content = @file_get_contents($path);
	$tag_config = unserialize($tag_config_content);
	echo $tag_config['tagtemplate'];
}else{
	?>
	{tool::cn_substr(htmlspecialchars($d['tagcontent']),20)}
<?php
}
?></td>

<td align="center" width="100">

<span class="hotspot" onmouseover="tooltip.show('预览标签效果！');" onmouseout="tooltip.hide();">
<a href='<?php echo url("templatetagwap/test/id/$d[$primary_key]",false);?>' target="_blank" class="a_view"></a>
</span>

<?php
if(($_GET['tagfrom']!='function')){
?>

<span class="hotspot" onmouseover="tooltip.show('点击编辑标签！');" onmouseout="tooltip.hide();"><a href="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]/tagfrom/$tagfrom");?>" class="a_edit"></a></span>
<span class="hotspot" onmouseover="tooltip.show('确定要删除吗？');" onmouseout="tooltip.hide();"><a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>" class="a_del"></a></span>

<?php
}
?>
</td>
</tr>
{/loop}

</tbody>
</table>

</div>

<div class="blank20"></div>

<input type="hidden" name="batch" value="" />
<input  class="btn_a" type="button" value="删除" name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}" />

</form>