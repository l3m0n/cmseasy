<div class="blank20"></div>


<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<?php
$data=category::getcategorydata();
?>
<div style="padding-left:10px;">
<input class="btn_c" type="button" value=" 添加栏目 " onclick="javascript:window.location.href='index.php?case=table&act=add&table=category&admin_dir={get('admin_dir')}'" />
</div>
<div class="blank5"></div>
<div id="tagscontent" class="right_box">

<table border="0" cellspacing="0" cellpadding="0" id="table1" width="100%">
<thead>
<tr class="th">
<th><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall"> </th>
<th>排序</th>
<th><!--catid-->ID</th>
<th><!--catname-->栏目名称</th>
<th><!--htmldir-->目录名称</th>
<th><!--isnav-->导航</th>
<th>操作</th>
</tr>
</thead>
<tbody id="listtable">
{loop $data $d}

<tr class="s_out" onmouseover="m_over(this)" onmouseout="m_out(this)" lang="{$d['level']}" {if $d['level']>0}style="display:none"{/if}>
<td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d[$primary_key]}" name="select[]"> </td>
<td align="center"  class="table_input_c"><span class="hotspot" onmouseover="tooltip.show('填写排序号，<br />数字越小，排序越靠前！');" onmouseout="tooltip.hide();">{form::input("listorder[$d[$primary_key]]",$d['listorder'],'class="input_c"')}</span></td>
<td align="center" >
{$d['catid']}
</td>
<td align="left" style="width:240px;padding-left:10px;line-height:28px;"><span class="hotspot" onmouseover="tooltip.show('点击编辑栏目设置，<br />可方便的修改栏目的各项设置');" onmouseout="tooltip.hide();"><a style="float:left;" href="<?php echo modify("/act/edit/table/$table/id/$d[$primary_key]");?>">{$d['catname']}</a></span>
<?php if(category::hasson($d['catid'])) { ?>
{if $d['level']==0}<a style="float:right;cursor:pointer" onclick="child(this)" title="点击展开/收起" class="child"></a>{/if}
<?php } ?>
</td>

<td align="center" style="width:120px;">
<span class="hotspot" onmouseover="tooltip.show('栏目文件存放目录，目录必须为英文或拼音，中间不可有空格！');" onmouseout="tooltip.hide();">{$d['htmldir']}</span>
</td>

<td align="center" >
<span class="hotspot" onmouseover="tooltip.show('选择栏目是否在导航显示，只对顶级栏目有效！');" onmouseout="tooltip.hide();">{helper::yes($d['isnav'],false)} </span></td>

<td align="center" >
<span class="hotspot" onmouseover="tooltip.show('查看网站前台动态页面，<br />可方便的观察修改后的效果！');" onmouseout="tooltip.hide();"><a href="<?php echo url("archive/list/catid/$d[$primary_key]",false);?>" target="_blank" class="a_view"></a></span>

<span class="hotspot" onmouseover="tooltip.show('点击编辑栏目设置！');" onmouseout="tooltip.hide();"><a  href="<?php echo modify("/act/edit/table/$table/id/$d[$primary_key]");?>" class="a_edit"></a></span>

<span class="hotspot" onmouseover="tooltip.show('添加子栏目！');" onmouseout="tooltip.hide();"><a href="<?php echo modify("/act/add/table/category/parentid/$d[$primary_key]");?>" class="a_add_category"></a></span>

<span class="hotspot" onmouseover="tooltip.show('添加栏目下属内容！');" onmouseout="tooltip.hide();"><a href="<?php echo modify("/act/add/table/archive/catid/$d[$primary_key]");?>" class="a_add_content"></a></span>

<span class="hotspot" onmouseover="tooltip.show('管理本栏目下内容！');" onmouseout="tooltip.hide();"><a href="<?php echo modify("/act/list/table/archive/catid/$d[$primary_key]");?>" class="a_management"></a></span>	

<span class="hotspot" onmouseover="tooltip.show('确定要删除吗？');" onmouseout="tooltip.hide();"><a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>" class="a_del"></a></span>

</td>
            </tr>




            {/loop}

        </tbody>
    </table>


<div class="page"><?php echo pagination::html($record_count); ?></div>
<div class="blank10"></div>
</div>

    <div class="blank10"></div>
    <input type="hidden" name="batch" value="">

    <input class="btn_d" type="button" value=" 排序 " name="order" onclick="this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='listorder'; this.form.submit();"/>
    <input class="btn_e" type="button" value=" 移动到 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要移动ID为('+getSelect(this.form)+')的栏目吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='move'; this.form.submit();}"/>
    <?php echo form::select('catid',0,category::option());?>
</form>
