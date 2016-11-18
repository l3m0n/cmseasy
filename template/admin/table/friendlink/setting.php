
<form name="settingform" id="settingform"  action="<?php echo uri();?>" method="post">
<div class="blank20"></div>
<div id="tagscontent" class="right_box">
<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<thead>
<tr class="th">
<th colspan="3">友情链接设置</th>
</tr>
</thead>
<tbody>

<tr>
<td width="19%" align="right">分类</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::textarea('types',get('types')?get('types'):$settings['types'],'class="textarea"')}
</td>
</tr>

<tr>
<td width="19%" align="right">例如</td>
<td width="1%">&nbsp;</td>
<td width="70%">
(1)网站首页<br />(2)链接首页
</td>
</tr>
</tbody>
</table>
</div>

<div class="blank20"></div>
<input type="submit" name="submit" value=" 提交 " class="btn_a" />
</form>