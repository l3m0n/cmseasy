<?php $this->render('field/edit.php'); return; /*?>

<div class="blank20"></div>

<div style="padding-left:10px;">
<a href="<?php echo modify("/act/add/table/".$table);?>" class="btn_d">添加字段</a>
<a href="<?php echo modify("/act/list/table/".$table);?>" class="btn_d">查看列表</a>
</div>

<div class="blank5"></div>


<form name="fieldform" method="post" action="<?php echo modify("case/field/act/".front::$act."/table/".$table);?>">

<div id="tagscontent" class="right_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">
<tbody>

<tr>
<td width="19%" align="right">名称</td>
<td width="1%">&nbsp;</td>
<td width="70%"><input size="20" name="name" value="my_" class="input"/></td>
</tr>

<tr>
<td width="19%" align="right">类型</td>
<td width="1%">&nbsp;</td>
<td width="70%"><select name="type">
<option value="int">整数</option>
<option value="varchar">单行文本</option>
<option value="text" onclick="document.fieldform.len.hidden='hidden'">多行文本</option>
<option value="mediumtext">超文本</option>
	
<option value="datetime">日期</option>
<option value="radio">[单选]</option>
<option value="checkbox">[多选]</option>
	
</select></td>
</tr>

<tr>
<td width="19%" align="right">长度</td>
<td width="1%">&nbsp;</td>
<td width="70%"><input size="10" name="len" value="" class="input"/></td>
</tr>


<tr>
<td width="19%" align="right">字段中文名</td>
<td width="1%">&nbsp;</td>
<td width="70%"><input size="20" name="cname" value="" class="input"/></td>
</tr>

<tr>
<td width="19%" align="right">单选/多选  选项</td>
<td width="1%">&nbsp;</td>
<td width="70%">{form::textarea('select','',' rows="6" cols="40" ')}</td>
</tr>


</tbody>
</table>
</div>

<div class="blank10"></div>
<input type="submit" name="submit" value=" 提交 " class="btn_a" />

</form>

*/ ?>
