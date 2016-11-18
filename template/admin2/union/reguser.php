<div class="blank20"></div>
<div id="tagscontent" class="right_box">

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<thead>
<tr class="th">
<th align="center">用户名</th>
<th align="center">email</th>
<th align="center">注册IP</th>
<th align="center">联盟ID</th>
</tr>
</thead>

<tbody>
{loop $data $d}
<tr>

<td>{$d['username']}</td>
<td>{$d['e_mail']}</td>
<td>{$d['userip']}</td>
<td>{$d['introducer']}[{$d['introducerusername']}]</td>

</tr>
{/loop}


</tbody>
</table>


<div class="page"><?php echo pagination::html($record_count); ?></div>
</div>