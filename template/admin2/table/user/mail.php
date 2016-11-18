
<form name="listform" id="listform"  action="?case=table&act=send&table=user&admin_dir={get('admin_dir')}&getSelect(this.form)" method="post">

<div class="blank20"></div>
<div id="tagscontent" class="right_box">

<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">
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
<tr>

<td align="center"><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>

<td align="center">{cut($d['userid'])}</td>
<td align="center">{cut($d['username'])}</td>
<td align="center">{cut($d['nickname'])}</td>
<td align="center">{usergroupname($d['groupid'])}</td>

<td align="center">
<a href="<?php echo modify("st/1/act/send/table/$table/id/$d[$primary_key]");?>" class="btn_d">发送邮件</a> 
</td>
</tr>
{/loop}

</tbody>
</table>

<div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?></div>

</div>

<div class="blank20"></div>

<input type="hidden" name="batch" value="" />
<input  class="btn_a" type="button" value=" 群发邮件(下一步) " name="sendall" onclick="if(getSelect(this.form) && confirm('确实要给ID为('+getSelect(this.form)+')的记录发送邮件吗?')){this.form.action='?case=table&act=send&table=user&admin_dir={get('admin_dir')}&st=1&id='+getSelect(this.form); this.form.submit();}"/> 

</form>