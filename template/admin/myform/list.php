

<?php helper::filterField($field,$fieldlimit);?>

<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">

  <?php
  if(get('table')=='type')
  $this->render('_table/type/_list.php');
  else { ?>


<div class="blank20"></div>
<div id="tagscontent" class="right_box">
<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<thead>
<tr class="th">

<th width="60px"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
{loop $field $f}
          <th align="center"><!--{$f.name}-->{$f.name|lang}</th>
{/loop}
          <th align="center">操作</th>
		  <th align="center">关联</th>
        </tr>

</thead>
<tbody>
{loop $data $d}
<tr class="s_out">

<td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>

{loop $field $f}
<?php $name=$f['name']; ?>
<td align="center">{cut($d[$name])}</td>
{/loop}

<td align="center">
<span class="hotspot" onmouseover="tooltip.show('点击查看!');" onmouseout="tooltip.hide();">
<a href='<?php echo url("table/show/table/$table/id/$d[$primary_key]/aid/".$d[aid]);?>' class="a_view"></a></span>
<span class="hotspot" onmouseover="tooltip.show('确定要删除吗?');" onmouseout="tooltip.hide();">
<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]");?>"  class="a_del"></a></span>
</td>
<td align="center">
{if $d[aid]}<center>
<span class="hotspot" onmouseover="tooltip.show('查看表单关联内容页面！');" onmouseout="tooltip.hide();"><a href="index.php?case=archive&act=show&aid={$d[aid]}" target="_blank" class="a_view">{getArchiveTitle($d[aid])}</a></span></center>{else}无
{/if}
</td>
</tr>
{/loop}

</tbody>
</table>

<div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?></div>
</div>
<div class="blank20"></div>

<input type="hidden" name="batch" value="" />

<input class="btn_a" type="button" value=" 删除 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}" />

<?php } ?>


</form>




