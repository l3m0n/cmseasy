




<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">

<div class="blank20"></div>
<div id="tagscontent" class="right_box">

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<tbody>

<tr>
<td width="19%" align="right">推广联盟开关</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<select name="setting[enabled]"> 
<option value="1" {if $data['enabled']==1}selected{/if}>开</option> 
<option value="0" {if $data['enabled']==0}selected{/if}>关</option> 
</select> 
</td> 
</tr>  

<tr>
<td width="19%" align="right">Cookie保存时间</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<select name="setting[keeptime]"> 
<option value="86400" {if $data['keeptime']==86400}selected{/if}>一天</option> 
<option value="604800" {if $data['keeptime']==604800}selected{/if}>一周</option> 
<option value="2592000" {if $data['keeptime']==2592000}selected{/if}>一月</option> 
<option value="7776000" {if $data['keeptime']==7776000}selected{/if}>一季度</option> 
<option value="15552000" {if $data['keeptime']==15552000}selected{/if}>半年</option> 
<option value="31536000" {if $data['keeptime']==31536000}selected{/if}>一年</option> 
</select> 
</td> 
</tr> 

<tr>
<td width="19%" align="right">初始利润率</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input name='setting[profitmargin]' type='text' id='profitmargin' value='{$data['profitmargin']}' class="input_c" maxlength='3'>&nbsp;%
</td> 
</tr> 

<tr>
<td width="19%" align="right">访客默认跳转地址</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input name='setting[forward]' type='text' id='forward' value='{$data['forward']}' class="input" maxlength='100'>
</td> 
</tr> 

<tr>
<td width="19%" align="right">带来一个有效IP访问赠送</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input name='setting[rewardnumber]' type='text' id='rewardnumber' value='{$data['rewardnumber']}' class="input_c" maxlength='5'> 
<select name="setting[rewardtype]"> 
<option value="point" >点</option> 
</select> 
</td> 
</tr> 

<tr>
<td width="19%" align="right">带来一个注册用户赠送</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input name='setting[regrewardnumber]' type='text' value='{$data['regrewardnumber']}' class="input_c"> 
<select name="setting[regrewardtype]"> 
<option value="point" >点</option> 
</select> 
</td> 
</tr> 
</table> 
</div>

<div class="blank20"></div>
<input type="submit" name="submit" value="提交" class="btn_a" />

</form>
