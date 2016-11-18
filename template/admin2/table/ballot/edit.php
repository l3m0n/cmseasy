<div id="tagscontent" class="right_box">

<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
<input type="hidden" name="onlymodify" value=""/>
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">
<thead>
<tr class="th">
<th colspan="3">编辑投票</th>
</tr>
</thead>
<tbody>
<tr>
<td width="19%" align="right">标题</td>
<td width="1%">&nbsp;</td>
<td width="70%">{form::getform('title',$form,$field,$data)} </td>
</tr>
<tr>
<td width="19%" align="right">类型</td>
<td width="1%">&nbsp;</td>
<td width="70%">{form::getform('type',$form,$field,$data)}</td>
</tr>
</tbody>
</table></div>
<div class="blank20"></div>
<input type="submit" name="submit" value="提交" class="btn_a"/>
</form>
