<div class="blank20"></div>

<div id="message_a">表单链接调用格式：<font color="#FF0000"><strong>{</strong>myform("my_表单名称")<strong>}</strong></font><a href="#" onclick="javascript:turnoff('message_a')">&nbsp;(×)</a></div>

<div class="blank5"></div>

<div id="tagscontent" class="right_box">
<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<thead>
<tr class="th">
<th>名称(记录数)</th>
<th>表名</th>
<th>操作</th>
</tr>
</thead>
<tbody>
{loop $tables $t}
<tr>
<td>&nbsp;&nbsp;{=@setting::$var[$t]['myform']['cname']}&nbsp;
    (&nbsp;<span class="hotspot" onmouseover="tooltip.show('点击查看表单提交内容！');" onmouseout="tooltip.hide();"><a href="{url('table/list/table/'.$t)}" class="j"><font color="red"><?php  $_table=new defind($t); echo $_table->rec_count();?></font></a></span>&nbsp;)
</td>
<td>{$t}</td>
<td align="center" width="170">
<span class="hotspot" onmouseover="tooltip.show('点击查看前台页面效果，<br />可直观查看表单的显示样式');" onmouseout="tooltip.hide();">
<a  href="{url('form/add/form/'.$t,false)}" target="_blank" class="a_view"></a></span>
<span class="hotspot" onmouseover="tooltip.show('点击编辑表单');" onmouseout="tooltip.hide();">
<a  href="<?php echo modify("/act/editform/table/$t");?>" class="a_edit"></a></span>
<span class="hotspot" onmouseover="tooltip.show('管理表单字段');" onmouseout="tooltip.hide();">
<a href="<?php echo url::create('field/list/table/'.$t)?>" class="a_management"></a></span>
<span class="hotspot" onmouseover="tooltip.show('添加表单自定义字段');" onmouseout="tooltip.hide();">
<a href="<?php echo url::create('field/add/table/'.$t)?>" class="a_add_category"></a></span>
<span class="hotspot" onmouseover="tooltip.show('确定要删除吗？');" onmouseout="tooltip.hide();">
<a  onclick="javascript: return confirm('删除表单会删除表单中所有的记录！确认删除吗?');" href="<?php echo modify("/act/delete/table/$t");?>" class="a_del"></a></span>
</td>
</tr>
{/loop}

</tbody>
</table>

</div>
