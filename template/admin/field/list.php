<div class="blank20"></div>

<a href="<?php echo modify("/act/add/table/".$table);?>" class="btn_d">添加字段</a>
<a href="<?php echo modify("/act/list/table/".$table);?>" class="btn_d">查看列表</a>
<div class="blank10"></div>
<div id="tagscontent" class="right_box">
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
        <tbody>
            <tr class="th">
            <th><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
          <th>字段名名</th>
          <th>类型</th>
          <th>长度</th>
          <th>字段中文名</th>
          <th>操作</th>
        </tr>
</thead>
 <tbody>
{loop $fields $f}
<tr>
<td align="center"><input onclick="c_chang(this)" type="checkbox" value="{$f.name}" name="select[]" class="checkbox" /> </td>
<td align="center">{$f.name}</td>
<td align="center"><?php
$tmp = setting::$var['archive'][$f['name']];
if($tmp['type'] == 'varchar'){ 
	$s = '单行文本';
}
if($tmp['type'] == 'text'){ 
	$s = '多行文本';
}
if($tmp['type'] == 'mediumtext'){ 
	$s = '超文本';
}
if($tmp['type'] == 'int'){ 
	$s = '整型';
}
if($tmp['type'] == 'datetime'){ 
	$s = '日期型';
}
if($tmp['selecttype'] == 'radio'){
	$s = '单选';
}
if($tmp['selecttype'] == 'checkbox'){
	$s = '多选';
}
if($tmp['selecttype'] == 'select'){
	$s = '下拉选择';
}
if($tmp['filetype'] == 'image'){
	$s = '图片';
}
if($tmp['filetype'] == 'file'){
	$s = '附件';
}
echo $s;
?></td>
<td align="center">{$f.len}</td>
<td align="left" style="padding-left:10px;"><?php echo @setting::$var[$table][$f['name']]['cname'];?></td>

<td align="center" width="70">
<span class="hotspot" onmouseover="tooltip.show('点击编辑自定义字段设置');" onmouseout="tooltip.hide();">
<a href="<?php echo modify("/act/edit/table/$table/name/".$f['name']);?>" class="a_edit"></a>
</span>



</td>
</tr>
{/loop}
<tr>
  <td colspan="8"><input type="hidden" name="batch" value=""><input type="button" value="删除" name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除名为('+getSelect(this.form)+')的字段吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}" class="btn_e" /></td>
</tr>
</tbody>
</table>
</form>
</div>