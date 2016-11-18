
<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id."/bid/".front::$get['bid']);?>"  onsubmit="return checkform();">

<div class="blank20"></div>
<div id="tagscontent" class="right_box">

<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">
<tbody>
<tr class="th">
<th colspan="3" align="center">编辑选项</th>
</tr>
</thead>
<tbody>
<tr>
<td width="19%" align="right">选项名字</td>
<td width="1%">&nbsp;</td>
<td width="70%">{form::getform('name',$form,$field,$data,'class="input"')}</td>
</tr>
</tbody>
</table>
</div>
<div class="blank20"></div>
<input type="submit" name="submit" value="提交" class="btn_a"/>
</form>