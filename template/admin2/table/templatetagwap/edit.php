<script language="javascript" src="{$base_url}/common/js/common.js"></script>

<form method="post" name="form1" action="<?php
if (front::$act == 'edit')
    $id="/id/".$data[$primary_key]."/tagfrom/".$_GET['tagfrom']; else
    $id=''; echo modify("/act/".front::$act."/table/".$table.$id);
?>"  onsubmit="return checkform();">
<input type="hidden" name="onlymodify" value=""/>
<div class="blank20"></div>
<div id="tagscontent" class="right_box">

<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">

<tr>
<td width="19%" align="right">标签名称</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('name',$form,$field,$data)} 标签名不能为纯数字
</td>
</tr>

<input type="hidden" name="tagfrom" value="{get('tagfrom')}" class="input" />

{if get('tagfrom')=='category'}

{template 'table/templatetagwap/listtag_helper_edit_cat.php'}

{elseif get('tagfrom')=='content'}

{template 'table/templatetagwap/listtag_helper_edit.php'}

{else}



<tr>
<td width="19%" align="right">标签内容</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('tagcontent',$form,$field,$data)}
</td>
</tr>

{/if}

</td>
</tr>

</tbody>
</table>
</div>    

<div class="blank20"></div>
<input type="submit" name="submit" value="提交" class="btn_a" />
</form>