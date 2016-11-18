<div id="tagscontent" class="right_box">

<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">


<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<tbody>
<tr class="th">
<th>
<input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" />
</th>
<th align="center"><!--id-->编号</th>
<th align="center"><!--title-->选项名字</th>
<th align="center"><!--content-->票数</th>
<th align="center">操作</th>
</tr>
</thead>
<tbody>
    {loop $data $d}
    <tr class="s_out">
      <td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /></td>
      <td align="center">{cut($d['id'])}</td>
      <td align="left" style="padding-left:10px;">{cut($d['name'])}</td>
      <td align="center">{cut($d['num'])}</td>
      <td align="center" width="70">
	  <span class="hotspot" onmouseover="tooltip.show('编辑投票选项！');" onmouseout="tooltip.hide();">
	  <a href="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]/bid/".front::$get['bid']);?>" class="a_edit"></a>
	  </span>
	  <span class="hotspot" onmouseover="tooltip.show('删除投票选项！');" onmouseout="tooltip.hide();">
	  <a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token"."/bid/".$ballot['id']);?>" class="a_del"></a>
	  </span>
	  </td>
    </tr>
    {/loop}
    </tbody>
    
  </table>

<div class="page">
  <?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?>
</div>
  <div class="clear">&nbsp;</div>
  <div class="blank20"></div>
  <input type="hidden" name="batch" value="">
  <input class="clear btn_d" type="button" value="删除" name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}"/>
</form>


<div class="blank20"></div>

<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/add/table/".$table.$id."/bid/".$ballot['id']);?>"  onsubmit="return checkform();">
<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<tbody>
<tr class="th">
<th colspan="3" align="center">添加选项</th>
</tr>
</thead>
<tbody>
<tr>
<td width="19%" align="right">选项名字</td>
<td width="1%">&nbsp;</td>
<td width="70%">{form::getform('name',$form,$field,$data)} </td>
</tr>
</tbody>
</table>


<div class="blank20"></div>
<input type="submit" name="submit" value="提交" class="btn_d"/>
  
</form>


</div>