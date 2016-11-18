<div id="tagscontent" class="right_box">

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1">
<form name="aidform" method="post" action="<?php echo front::$uri;?>">
<tbody>
<tr>
<td width="19%" align="right">按ID</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<?php
	$archive=new archive();
	$aid=$archive->rec_query_one("select min(aid) as min,max(aid) as max from ".$archive->name);
	echo "  ".form::input('aid_start',max($aid['max']-100,1));
	echo " 到 ".form::input('aid_end',$aid['max']);
	?>
	&nbsp;&nbsp;
	<?php echo form::submit('更新');
	?>
	&nbsp;&nbsp;(ID范围: {$aid['min']}~{$aid['max']} )
    </td></tr></tbody>
</form>
<form name="aidform2" method="post" action="<?php echo front::$uri;?>">
<tbody>
<tr>
<td width="19%" align="right">按栏目</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<?php
	//$archive=archive::getInstance();
	echo form::select('catid',get('catid'),category::option());
	?>
	&nbsp;&nbsp;
	<?php echo form::submit('更新');
	?>
    </td></tr></tbody>
    </form>
</table>

</div>
