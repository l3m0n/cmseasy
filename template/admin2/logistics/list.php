
<div class="blank20"></div>
<input class="btn_d" type="button" value=" 增加配货方式 " name="add" onclick="javascript:window.location.href='<?php echo modify("act/add/table/$table");?>'"/> 



<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<div class="blank5"></div>
<div id="tagscontent" class="right_box">
<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<thead>
<tr class="th">         
<th align="center"><!--name-->配货方式</th>
<th align="center"><!--rate-->配货费用</th>
<th align="center"><!--ver-->货到付款</th>
<th align="center">是否保价</th>
<th align="center">操作</th>
</tr>
</thead>
<tbody>
{loop $data $d}

<tr>


<td width="left" style="padding-left:10px;"><strong>{$d['title']}</strong><br /><font color="#666666">{$d['content']}</font></td>
<td align="center">{$d['price']}</td>
<td align="center">{if $d['cashondelivery'] == 0}<img src="{$skin_path}/images/no.gif" />{else}<img src="{$skin_path}/images/ok.gif" />{/if}</td>
<td align="center">{if $d['insure'] == 0}<img src="{$skin_path}/images/no.gif" />{else}<img src="{$skin_path}/images/ok.gif" />{/if}</td>

<td align="center">

<span class="hotspot" onmouseover="tooltip.show('管理本栏目下内容');" onmouseout="tooltip.hide();">
<a href="<?php echo modify("act/edit/table/$table/id/".$d['id']);?>" class="a_management"></a>
</span>	

<span class="hotspot" onmouseover="tooltip.show('确定要删除吗？');" onmouseout="tooltip.hide();">
<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/".$d['id']);?>" class="a_del"></a>
</span>

</td>
</tr>
{/loop}


</tbody>
</table>

</div>
<div class="blank20"></div>

<input type="hidden" name="batch" value="">
<input  class="btn_a" type="button" value=" 删除 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}"/>

</form>

