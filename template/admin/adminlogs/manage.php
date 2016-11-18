
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<div class="blank20"></div>
<div id="tagscontent" class="right_box">

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<thead>
<tr class="th">
<th align="center">编号</th>
<th align="center">用户名</th>
<th align="center">操作时间</th>
<th align="center">IP</th>
<th align="center">操作方法</th>
<th align="center">说明</th>
</tr>
</thead>
<tbody>
{loop $data $d}
<tr>
<td align="center">{cut($d['id'])}</td>
<td align="center" style="padding-left:10px;">{cut($d['username'])}</td>
<td align="center">{date('Y-m-d H:i:s',$d['addtime'])}</td>
<td align="center">{$d['ip']}</td>
<td align="center">{cut($d['event'])}</td>
<td align="left">{$d['note']}</td>
</tr>
{/loop}
</table>

<div class="page"><?php echo pagination::html($record_count); ?></div>
<div class="blank10"></div>
</div>

<div class="blank20"></div>

<input type="hidden" name="batch" value="">
<input  class="btn_a" type="button" value=" 清空 " name="delete" onclick="if(confirm('确实要清空日志记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}"/>

</form>