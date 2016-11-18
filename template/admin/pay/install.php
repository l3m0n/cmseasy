<style type="text/css">
#table1 input { width: 292px; height: 29px; line-height: 29px; padding-left: 10px; background: url({$skin_path}/images/input_bg.gif) left top no-repeat; border: none; font-size: 12px; }
#table1 select { height: 29px; margin: 0px; padding: 0px 0px 0px 10px; }
</style>
<form method="post" action="" name="form1" id="form1" onsubmit="checkform1()">
<div class="blank20"></div>
<div id="tagscontent" class="right_box">

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<thead>

<tr class="th">
<th colspan="3">安装支付方式
</th>
</tr>
</thead>
<tbody>

<tr>
<td width="19%" align="right">支付方式</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input type="text" name="pay_name" id="pay_name" value="{$data[pay]['pay_name']}" class="input" /></td>
</tr>

<tr>
<td width="19%" align="right">支付方式描述</td>
<td width="1%">&nbsp;</td>
<td width="70%">{form::textarea('pay_desc',$data[pay]['pay_desc'],'class="textarea"')}
</td>
</tr>

{loop $data[pay][pay_config] $pay_config}

<tr>
<td width="19%" align="right">{$pay_config.label}</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<?php if ($pay_config[type] == "text") {?> 
<input name="cfg_value[]" type="{$pay_config.type}" value="{$pay_config.value}" size="40" />
<?php }elseif ($pay_config[type] == "textarea") {?> 
<textarea name="cfg_value[]" cols="80" rows="5">{$pay_config.value}</textarea>
<?php }elseif ($pay_config[type] == "select") {?>
{form::select('cfg_value[]', $pay_config[value], $pay_config[range])}
<?php } ?>  
<input name="cfg_name[]" type="hidden" value="{$pay_config.name}" />
<input name="cfg_type[]" type="hidden" value="{$pay_config.type}" />
<input name="cfg_lang[]" type="hidden" value="{$pay_config.lang}" />
</td>
</tr>

{/loop}



<tr>
<td width="19%" align="right">支付费率</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input size="3" name="pay_fee" id="pay_fee" value="{$data[pay]['pay_fee']}" class="input_c" />&nbsp;%
</td>
</tr>

</tbody>
</table>
</div>

<input type="hidden"  name="pay_id" value="{$data[pay][pay_id]}" />
<input type="hidden"  name="pay_code"     value="{$data[pay][pay_code]}" />
<input type="hidden"  name="is_cod" value="{$data[pay][is_cod]}" />
<input type="hidden"  name="is_online"    value="{$data[pay][is_online]}" />

<div class="blank20"></div>
<input type="submit" name="submit" value=" 提交 " class="btn_a" />

</form>