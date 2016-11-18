<form name='formxmlmap' method='post' action='<?php echo url('cache/make_baidu') ?>'>
<div id="tagscontent" class="right_box">
<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1">
<tr>
<td width="19%" align="right">总输出数量</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input name='XmlOutNum' id='XmlOutNum' value='450' class="input" />
<span class="hotspot" onmouseover="tooltip.show('地图总输出数量！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>
<tr>
<td width="19%" align="right">每页连接数</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input name='XmlMaxPerPage' value='90' id='XmlMaxPerPage' class="input" />
<span class="hotspot" onmouseover="tooltip.show('每页连接数,百度规范要求不得大于100！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>
<tr>
<td width="19%" align="right">更新频率</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input name='frequency' id='frequency' value='1440' class="input" />
<span class="hotspot" onmouseover="tooltip.show('更新周期，以分钟为单位！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;">
</span>
</td>
</tr>
<tr>

</table>

<div class="blank20"></div>
<input name='submit' type='submit' id='submit' value='生成' class="btn_a">
</form>
</div>