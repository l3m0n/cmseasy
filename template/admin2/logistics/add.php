<div class="blank20"></div>

<input class="btn_d" type="button" value=" 配货方式列表 " name="add" onclick="javascript:window.location.href='<?php echo modify("act/list/table/$table");?>'"/> 

<div class="blank5"></div>
<div id="tagscontent" class="right_box">


<form method="post" action="" name="form1" id="form1" onsubmit="checkform1()">
<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">

<tbody>

<tr>
<td width="19%" align="right">配货方式</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input type="text" name="title" id="title" value="{$data['title']}" class="input"  />
</td>
</tr>

<tr>
<td width="19%" align="right">配货方式描述</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::textarea('content',$data['content'],'class="textarea"')}</td>
</tr>

<tr>
<td width="19%" align="right">配送价格</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input type="text" name="price" id="price" value="{$data['price']}" class="input" />
</td>
</tr>

<tr>
<td width="19%" align="right">超重价格</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input type="text" name="overweight" id="overweight" value="{$data['overweight']}" class="input" />
</td>
</tr>

<tr>
<td width="19%" align="right">货到付款</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input type="radio" value="1" class="radio" name="cashondelivery"> 启用&nbsp;
<input type="radio" value="0" class="radio" name="cashondelivery" checked="checked"> 关闭&nbsp;
<span class="hotspot" onmouseover="tooltip.show('如果启用，则此配送方式费用不算入在线支付！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
</td>
</tr>

<tr>
<td width="19%" align="right">是否保价</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input type="radio" value="1" name="insure" class="radio" onclick="javascript:document.getElementById('insureproportion_box').style.display='';"> 启用&nbsp;
<input type="radio" value="0" name="insure" class="radio" checked="checked" onclick="javascript:document.getElementById('insureproportion_box').style.display='none';"> 关闭
</td>
</tr>

<tr>
<td width="19%" align="right">保价比例</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input type="text" name="insureproportion" id="insureproportion" value="{$data['overweight']}" class="input" />
</td>
</tr>


</tbody>
</table>
</div>

<input type="hidden"  name="pay_id"       value="{$data[pay][pay_id]}" />
<input type="hidden"  name="pay_code"     value="{$data[pay][pay_code]}" />
<input type="hidden"  name="is_cod"       value="{$data[pay][is_cod]}" />
<input type="hidden"  name="is_online"    value="{$data[pay][is_online]}" />

<div class="blank20"></div>
<input type="submit" name="submit" value=" 提交 " class="button" />

</form>

