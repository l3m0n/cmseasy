
<form method="post" action="" name="form1" id="form1" onsubmit="checkform1()">
<div class="blank20"></div>
<div id="tagscontent" class="right_box">

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<thead>

<tr class="th">
<th colspan="3">安装登录方式
</th>
</tr>
</thead>
<tbody>

<tr>
<td width="19%" align="right">登录方式</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input type="text" name="ologin_name" id="ologin_name" value="{$data[ologin]['ologin_name']}" class="input" /></td>
</tr>

<tr>
<td width="19%" align="right">登录方式描述</td>
<td width="1%">&nbsp;</td>
<td width="70%">{form::textarea('ologin_desc',$data[ologin]['ologin_desc'],'class="textarea"')}
</td>
</tr>

{loop $data[ologin][ologin_config] $ologin_config}

<tr>
<td width="19%" align="right">{$ologin_config.label}</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<?php if ($ologin_config[type] == "text") {?> 
<input name="cfg_value[]" type="{$ologin_config.type}" value="{$ologin_config.value}" size="40" />
<?php }elseif ($ologin_config[type] == "textarea") {?> 
<textarea name="cfg_value[]" cols="80" rows="5">{$ologin_config.value}</textarea>
<?php }elseif ($ologin_config[type] == "select") {?>
{form::select('cfg_value[]', $ologin_config[value], $ologin_config[range])}
<?php } ?>  
<input name="cfg_name[]" type="hidden" value="{$ologin_config.name}" />
<input name="cfg_type[]" type="hidden" value="{$ologin_config.type}" />
<input name="cfg_lang[]" type="hidden" value="{$ologin_config.lang}" />
</td>
</tr>

{/loop}

</tbody>
</table>
</div>

<input type="hidden"  name="ologin_id" value="{$data[ologin][ologin_id]}" />
<input type="hidden"  name="ologin_code"     value="{$data[ologin][ologin_code]}" />
<input type="hidden"  name="is_cod" value="{$data[ologin][is_cod]}" />
<input type="hidden"  name="is_online"    value="{$data[ologin][is_online]}" />

<div class="blank20"></div>
<input type="submit" name="submit" value=" 提交 " class="btn_a" />

</form>