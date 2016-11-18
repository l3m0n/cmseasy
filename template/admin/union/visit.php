<div class="blank20"></div>
<div id="tagscontent" class="right_box">

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<thead>
<tr class="th">
<th align="center">来源地址</th>
<th align="center">访问IP</th>
<th align="center">访问时间</th>
<th align="center">注册用户</th>
<th align="center">注册时间</th>
</tr>
</thead>


<tbody>
{loop $data $d}
<tr>

<td>{if $d['referer']}{$d['referer']}{else}地址栏直接进入{/if}</td>
<td>{$d['visitip']}</td>
<td>{date('Y-m-d H:i:s',$d['visittime'])}</td>
<td>{$d['regusername']}</td>
<td>{if $d['regtime']}{date('Y-m-d H:i:s',$d['regtime'])}{/if}</td>

</tr>
{/loop}

</tbody>
</table>


<div class="blank10"></div>


<div class="page"><?php echo pagination::html($record_count); ?></div>
<div class="blank20"></div>
</div>
