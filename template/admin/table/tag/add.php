

<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
<input type="hidden" name="onlymodify" value=""/>


<div id="tagstitle">
<a href="#" id="one1" class="hover">添加标签</a>
</div>

<div id="tagscontent" class="right_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">
<thead>
<tr class="th">
<th colspan="4">添加标签</th>
</tr>
</thead>
<tbody>
<tr>
<td width="19%" align="right">标题</td>
<td width="1%">&nbsp;</td>
<td width="330">{form::getform('tagname',$form,$field,$data)} </td>
<td><input type="submit" name="submit" value="提交" class="btn_e"/></td>
</tr>
</tbody>
</table>

</div>
<div class="blank20"></div>

</form>
