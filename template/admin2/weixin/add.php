<div class="tags">
<div id="tagstitle"> <a class="hover">添加公众号</a> </div>
<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
  <div id="tagscontent" class="right_box">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">
      <tr class="s_out" >
        <td width="19%" align="right">名称</td>
        <td width="1%">&nbsp;</td>
        <td width="70%"><input type="text" name="name" id="name" value="" class="input" /></td>
      </tr>
      <tr class="s_out" >
        <td width="19%" align="right">原始ID</td>
        <td width="1%">&nbsp;</td>
        <td width="70%"><input type="text" name="oldid" id="oldid" value="" class="input" /></td>
      </tr>
      <tr class="s_out" >
        <td width="19%" align="right">微信号</td>
        <td width="1%">&nbsp;</td>
        <td width="70%"><input type="text" name="weixinid" id="weixinid" value="" class="input" /></td>
      </tr>
    </table>
  </div>
  </div>
  <input type="submit" name="submit" value="提交" class="btn_a" />
</form>
