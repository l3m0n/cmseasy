<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
<input type="hidden" name="onlymodify" value=""/>

<div class="blank20"></div>
<div id="tagscontent" class="right_box">
<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">

<tbody>

<tr>
<td width="19%" align="right">链接类型</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('linktype',$form,$field,$data)}
</td>
</tr>

<tr>
<td width="19%" align="right">所属类别</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('typeid',$form,$field,$data)}
</td>
</tr>
                           
<tr>
<td width="19%" align="right">名称</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('name',$form,$field,$data)}
</td>
</tr>

<tr>
<td width="19%" align="right">排序号</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('listorder',$form,$field,$data)}
</td>
</tr>

<tr>
<td width="19%" align="right">链接</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('url',$form,$field,$data)}
</td>
</tr>
                            
<tr>
<td width="19%" align="right">LOGO</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('logo',$form,$field,$data)}
</td>
</tr>
                            
<tr>
<td width="19%" align="right">简介</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('introduce',$form,$field,$data)}
</td>
</tr>
                            
<tr>
<td width="19%" align="right">用户名</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('username',$form,$field,$data)}
</td>
</tr>

<tr>
<td width="19%" align="right">状态</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('state',$form,$field,$data)}
</td>
</tr>

</tbody>
</table>
</div>

<div class="blank20"></div>
<input type="submit" name="submit" value=" 提交 " class="btn_a" />
</form>