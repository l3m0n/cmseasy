
<script type="text/javascript" src="{$base_url}/common/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="{$base_url}/common/js/ThumbAjaxFileUpload.js"></script>
<div class="blank20"></div>
<div id="message_a">您可以导入其他CMS内容，<strong style="color:red">此操作可能损坏原有数据，请务必备份数据后使用 ! </strong><a href="#" onclick="javascript:turnoff('message_a')">&nbsp;(×)</a>
</div>
<div class="blank10"></div>


<form name="form" id="listform"  action="<?php echo uri();?>" method="post">
<div id="tagscontent" class="right_box">
<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<tr>
<td width="19%" align="right">
数据库表前缀
</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::input('phpweb_prefix','','size="20"')}
<span class="hotspot" onmouseover="tooltip.show('PHPWEB表前缀，不需包含下划线 _！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
</td>
</tr>
<tr>
<td width="19%" align="right">
数据库文件
</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::upload_file('data','data')}

<span class="hotspot" onmouseover="tooltip.show('只支持.txt和.sql文件格式！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
</td>
</tr>

</table>
</div>

<div class="blank20"></div>
{form::submit('开始导入')}

</form>