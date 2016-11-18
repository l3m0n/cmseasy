
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<div class="blank20"></div>
<div id="tagscontent" class="right_box">

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<thead>
<tr class="th">
<th><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
<th align="center"><!--id-->编号</th>
<th align="center"><!--groupid-->用户组</th>
<th align="center"><!--name-->名称</th>
<th align="center">操作</th>
</tr>
</thead>
<tbody>

{loop $data $d}
<tr class="s_out">

<td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>

<td align="center">{cut($d['groupid'])}</td>
<td align="center">{cut($d['groupid'])}</td>
<td align="center">{cut($d['name'])}</td>

<td align="center" width="70">
<a title="点击编辑用户组！" href="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]");?>" class="a_edit"></a>

<a title="确定要删除吗？" onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>" class="a_del"></a>

</td>
</tr>
{/loop}

</tbody>
</table>

<div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?></div>
<div class="blank20"></div>
</div>

<div class="blank20"></div>

<input type="hidden" name="batch" value="">
<input  class="btn_a" type="button" value="删除" name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}" />

</form>