<div class="blank20"></div>
<div id="tagscontent" class="right_box">

    
<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<thead>
    <tr class="th">
        <th>名称(记录数)</th>
        <th>表名</th>
        <th>操作</th>
    </tr>
</thead>
<tbody>
{loop $tables $t}
<tr class="s_out" >
<td>&nbsp;&nbsp;{=@setting::$var[$t]['myform']['cname']}
&nbsp;(&nbsp;<span class="hotspot" onmouseover="tooltip.show('点击查看内容！');" onmouseout="tooltip.hide();"><a href="{url('table/list/table/'.$t)}" class="j"><font color="red"><?php  $_table=new defind($t); echo $_table->rec_count();?></font></a></span>&nbsp;)
</td>
<td>{$t}</td>
<td align="center">
<span class="hotspot" onmouseover="tooltip.show('点击查看内容！');" onmouseout="tooltip.hide();">
<a  href="{url('table/list/table/'.$t)}"   class="a_view"></a></span>

<span class="hotspot" onmouseover="tooltip.show('添加内容！');" onmouseout="tooltip.hide();">
<a  href="{url('form/add/form/'.$t,false)}" class="a_add_category" target="_blank"></a></span>
</td>
</tr>
{/loop}

</tbody>
</table>
    
</div>