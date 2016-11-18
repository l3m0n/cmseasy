<div class="blank20"></div>
<div id="tagscontent" class="right_box">

<form method="post" action="" name="form1" id="form1" onsubmit="checkform1()">

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">

<tbody>
<tr class="s_out" >
<td width="19%" align="right">表单名称</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input size="20" name="cname" id="cname" value="{get('cname')}" /></td>
</tr>


<tr class="s_out" >
<td width="19%" align="right">表名</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input size="20" name="name" id="name" value="{=get('name')?get('name'):'my_'}"  />
</td>
</tr>


<tr class="s_out" >
<td width="19%" align="right">模板</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::select('template','',front::$view->myform_tpl_list())}
</td>
</tr>

</tbody>
</table>
</div>

<div class="blank20"></div>
<input type="submit" name="submit" value=" 提交 " class="btn_a" />

</form>