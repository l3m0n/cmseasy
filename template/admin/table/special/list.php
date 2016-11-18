
<div class="blank10"></div>
<form name="listform" id="listform"  action="<?php echo uri(); ?>" method="post">

<input class="btn_c" type="button" value=" 添加专题 " onclick="javascript:window.location.href='<?php echo url('table/add/table/special') ?>'" />

<div class="blank5"></div>
<div id="tagscontent" class="right_box">


<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<thead>
<tr class="th">
<th align="center"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall"> </th>
<!--<th>排序</th>-->
<th><!--spid-->专题ID</th>
<th><!--catname-->专题名称</th>
<th>操作</th>
</tr>

{loop $data $d}
<?php $spid=$d['spid']; ?>
<tr class="s_out">
<td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$spid}" name="select[]"></td>
<!--<td>{form::input("listorder[$d[$primary_key]]",$d['listorder'],'size=3')}</td>-->
<td align="center">{$d['spid']}</td>
<td align="center">{$d['title']}</td>

<td align="center" width="140">
<span class="hotspot" onmouseover="tooltip.show('点击查看!');" onmouseout="tooltip.hide();"><a href="<?php echo url("special/show/spid/$spid", false); ?>" class="a_view" target="_blank"></a></span>

<span class="hotspot" onmouseover="tooltip.show('点击编辑!');" onmouseout="tooltip.hide();"><a href="<?php echo modify("/act/edit/table/$table/id/$spid"); ?>" class="a_edit"></a></span>

<span class="hotspot" onmouseover="tooltip.show('管理专题内容');" onmouseout="tooltip.hide();"><a href="<?php echo modify("/act/list/table/archive/spid/$spid"); ?>" class="a_management"></a></span>	

<span class="hotspot" onmouseover="tooltip.show('确定要删除吗？');" onmouseout="tooltip.hide();"><a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/special/id/$spid/token/$token"); ?>" class="a_del"></a></span>

</td>
</tr>

{/loop}

</tbody>
</table>

<div class="page"><?php echo pagination::html($record_count); ?></div>
<div class="blank20"></div>
</div>
<div class="blank20"></div>
<input type="hidden" name="batch" value=" " class="btn_a" />

</form>