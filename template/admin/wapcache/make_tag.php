<div id="tagscontent" class="right_box">

<form name="typeform" method="post" action="<?php echo front::$uri;?>">
<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<tbody>
<tr>
	<td width="19%" align="right">标签</span></td>
	<td width="1%">&nbsp;</td>
                        <td width="70%"><?php
	echo form::select('tag',get('tag'),$hottags);
	?>
	&nbsp;&nbsp;
	<?php echo form::submit('更新');
	?>
    </td></tr></tbody>
</table>
</form>
</div>