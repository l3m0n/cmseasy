<div id="tagstitle">
<a href="#" id="one1" class="hover">热门标签管理</a>
</div>


<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<div id="tagscontent" class="right_box">
<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
        <thead>
            <tr class="th">
        <th width="60px"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" />
        </th>
        <th align="center">
          编号</th>
        <th align="center">
          标签名</th>
        <th align="center">操作</th>
      </tr>
	  </thead>
<tbody>
    {loop $data $d}
    <tr class="s_out">
      <td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /></td>
      <td align="center">{cut($d['tagid'])}</td>
      <td align="left" style="padding-left:10px;">{cut($d['tagname'])}</td>
      <td align="center" width="105">
        <span class="hotspot" onmouseover="tooltip.show('生成静态页！');" onmouseout="tooltip.hide();">
        <a href="<?php echo modify("case/cache/act/make_tag/submit/1/tag/".$d[tagid]);?>" class="a_add_category"></a></span>
        <span class="hotspot" onmouseover="tooltip.show('编辑标签！');" onmouseout="tooltip.hide();">
        <a href="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]");?>" class="a_edit"></a></span>
        <span class="hotspot" onmouseover="tooltip.show('删除标签！');" onmouseout="tooltip.hide();">
        <a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>" class="a_del"></a></span>
      </td>
    </tr>
    {/loop}
    </tbody>
    
  </table>


  <div class="blank20"></div>
  <div class="clear page">
  <?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?>
</div>

  <div class="blank20"></div>
  </div>
  <div class="blank20"></div>
  <input type="hidden" name="batch" value="" />
  
  <input class="btn_a" type="button" value=" 删除 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}"/>
    <div class="blank20"></div>
</form>
