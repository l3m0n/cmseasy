
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">

    <?php
    //$data=type::gettypedata();
    ?>
<div class="blank10"></div>
<input class="btn_c" type="button" value=" 添加分类 " onclick="javascript:window.location.href='index.php?case=table&act=add&table=type&admin_dir={get('admin_dir')}'" />
  
<div class="blank30"></div>
<div class="clear"></div>
<div id="tagscontent" class="right_box">

<table border="0" cellspacing="0" cellpadding="0" id="table1" width="100%">
<thead>
<tr class="th">
<th align="center"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall"> </th>
<!--<th>排序</th>-->
<th><!--typeid-->分类</th>
<th><!--typename-->分类名称</th>
<th>操作</th>
</tr>
</thead>
<tbody>
{loop $data $d}
<tr class="s_out">
<td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d[$primary_key]}" name="select[]"> </td>
<!--<td>{form::input("listorder[$d[$primary_key]]",$d['listorder'],'size=3')}</td>-->
<td align="center">{$d['typeid']} </td>
<td align="left" style="padding-left:10px;">{$d['typename']}</td>
<td align="center" width="200">

<span class="hotspot" onmouseover="tooltip.show('查看网站前台分类动态页面，<br />可方便的观察修改后的效果');" onmouseout="tooltip.hide();"><a href="<?php echo url("type/list/typeid/$d[$primary_key]",false);?>" target="_blank" class="a_view"></a></span>

<span class="hotspot" onmouseover="tooltip.show('点击编辑分类设置');" onmouseout="tooltip.hide();"><a href="<?php echo modify("/act/edit/table/$table/id/$d[$primary_key]");?>" class="a_edit"></a></span>

<span class="hotspot" onmouseover="tooltip.show('添加子分类');" onmouseout="tooltip.hide();"><a href="<?php echo modify("/act/add/table/type/parentid/$d[$primary_key]");?>" class="a_add_category"></a></span>

<span class="hotspot" onmouseover="tooltip.show('添加分类下属内容');" onmouseout="tooltip.hide();"><a href="<?php echo modify("/act/add/table/archive/typeid/$d1[$primary_key]");?>" class="a_add_content"></a></span>

<span class="hotspot" onmouseover="tooltip.show('管理本分类下内容');" onmouseout="tooltip.hide();"><a href="<?php echo modify("/act/list/table/archive/typeid/$d[$primary_key]");?>" class="a_management"></a></span>	

<span class="hotspot" onmouseover="tooltip.show('确定要删除吗？');" onmouseout="tooltip.hide();"><a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>" class="a_del"></a></span>

</td>
</tr>
            
<?php
$data1=type::gettypedata($d['typeid'],$data11,$l=1);
if(isset($data1)){
?>
{loop $data1 $d1}

<tr class="s_out">
<td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d1[$primary_key]}" name="select[]"> </td>
<!--<td>{form::input("listorder[$d1[$primary_key]]",$d1['listorder'],'size=3')}</td>-->
<td align="center">{$d1['typeid']}</td>
<td align="left" style="padding-left:10px;">{$d1['typename']}</td>
  
<td align="center">

<span class="hotspot" onmouseover="tooltip.show('查看网站前台分类动态页面，<br />可方便的观察修改后的效果');" onmouseout="tooltip.hide();"><a href="<?php echo url("type/list/typeid/$d1[$primary_key]",false);?>" target="_blank" class="a_view"></a></span>

<span class="hotspot" onmouseover="tooltip.show('点击编辑分类设置');" onmouseout="tooltip.hide();"><a href="<?php echo modify("/act/edit/table/$table/id/$d1[$primary_key]");?>" class="a_edit"></a></span>

<span class="hotspot" onmouseover="tooltip.show('添加子分类');" onmouseout="tooltip.hide();"><a href="<?php echo modify("/act/add/table/type/parentid/$d1[$primary_key]");?>" class="a_add_category"></a></span>

<span class="hotspot" onmouseover="tooltip.show('添加分类下属内容');" onmouseout="tooltip.hide();"><a href="<?php echo modify("/act/add/table/archive/typeid/$d1[$primary_key]");?>" class="a_add_content"></a></span>

<span class="hotspot" onmouseover="tooltip.show('管理本分类下内容');" onmouseout="tooltip.hide();"><a href="<?php echo modify("/act/list/table/archive/typeid/$d1[$primary_key]");?>" class="a_management"></a></span>	

<span class="hotspot" onmouseover="tooltip.show('确定要删除吗？');" onmouseout="tooltip.hide();"><a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d1[$primary_key]/token/$token");?>" class="a_del"></a></span>
</td>
</tr>

{/loop}  
              
<?php } unset($d1);unset($data1);unset($data11);?>
            
{/loop}

</tbody>
</table>
<div class="blank10"></div>
<div class="page"><?php echo pagination::html($record_count); ?></div>
<div class="blank10"></div>
</div>

<div class="blank10"></div>


<input type="hidden" name="batch" value="">

<input  class="btn_a" type="button" value=" 排序 " name="order" onclick="this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='order'; this.form.submit();"/>
&nbsp;&nbsp;
移动分类：<?php echo form::select('typeid',0,type::option());?>&nbsp;
<input  class="btn_b" type="button" value=" 移动 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要移动ID为('+getSelect(this.form)+')的类吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='move'; this.form.submit();}"/>
</form>





