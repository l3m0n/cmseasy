
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<style type="text/css">
#right .btn_a {padding:3px 5px;}
</style>
<div class="blank20"></div>
<div id="tagscontent" class="right_box">

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<thead>
<tr class="th">
<th><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
<th align="center"><!--userid-->编号</th>
<th align="center"><!--username-->用户名</th>
<th align="center"><!--nickname-->昵称</th>
<th align="center"><!--groupid-->用户组</th>
<th align="center">操作</th>
</tr>
</thead>
<tbody>

{loop $data $d}
<tr class="s_out">

<td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>

<td align="center">{cut($d['userid'])}</td>
<td align="center" style="padding-left:10px;">{cut($d['username'])}</td>
<td align="center" style="padding-left:10px;">{cut($d['nickname'])}</td>
<td align="center" style="padding-left:10px;">{usergroupname($d['groupid'])}</td>

<td align="left" width="40%">
<span class="hotspot" onmouseover="tooltip.show('点击编辑用户信息！');" onmouseout="tooltip.hide();"><a href="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]");?>" class="a_edit"></a></span>
{if $d['isblock']}<a href="<?php echo modify("act/block/table/$table/id/$d[$primary_key]");?>" class="btn_a">解冻</a>
{else}
<a href="<?php echo modify("act/block/table/$table/id/$d[$primary_key]");?>" class="btn_a">冻结</a>
{/if}
{if $d['isdelete']}
<a href="<?php echo modify("act/clean/table/$table/id/$d[$primary_key]");?>" class="btn_a">拉回</a>
{else}
<a href="<?php echo modify("act/clean/table/$table/id/$d[$primary_key]");?>" class="btn_a">清退</a>
{/if} 
<a href="<?php echo url("invite/list/ctname/".$d[username]);?>" class="btn_a">邀请</a>
<a href="<?php echo modify("act/list/table/comment/uid/$d[$primary_key]");?>" class="btn_a">互动</a>
<a href="<?php echo modify("act/list/table/zanlog/uid/$d[$primary_key]");?>" class="btn_a">点赞</a>
<span class="hotspot" onmouseover="tooltip.show('确定要删除吗？');" onmouseout="tooltip.hide();"><a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>" class="a_del"></a></span>
</td>
</tr>
{/loop}

</tbody>
</table>

<div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?></div>
<div class="blank20"></div>
</div>
<div class="blank20"></div>

<input type="hidden" name="batch" value="" />
<input  class="btn_a" type="button" value=" 删除 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}"/>

</form>