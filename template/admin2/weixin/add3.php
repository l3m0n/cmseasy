<div class="tags" style="margin-bottom:20px;">
<div id="tagstitle"> <a class="hover">添加公众号</a> </div>
<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
<input type="hidden" name="id" id="id" value="<?php echo $data['id'];?>" class="input" />
  <div id="tagscontent" class="right_box" style="height:383px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">
      <tr class="s_out" >
        <td width="19%" align="right">名称</td>
        <td width="1%">&nbsp;</td>
        <td width="70%"><input type="text" name="name" id="name" value="<?php echo $data['name']; ?>" class="input" /></td>
      </tr>
      <tr class="s_out" >
        <td width="19%" align="right">原始ID</td>
        <td width="1%">&nbsp;</td>
        <td width="70%"><input type="text" name="oldid" id="oldid" value="<?php echo $data['oldid']; ?>" class="input" /></td>
      </tr>
      <tr class="s_out" >
        <td width="19%" align="right">微信号</td>
        <td width="1%">&nbsp;</td>
        <td width="70%"><input type="text" name="weixinid" id="weixinid" value="<?php echo $data['weixinid']; ?>" class="input" /></td>
      </tr>
      <tr class="s_out" >
        <td width="19%" align="right">AppId</td>
        <td width="1%">&nbsp;</td>
        <td width="70%"><input type="text" name="appid" id="appid" value="<?php echo $data['appid']; ?>" class="input" /></td>
      </tr>
      <tr class="s_out" >
        <td width="19%" align="right">AppSecret</td>
        <td width="1%">&nbsp;</td>
        <td width="70%"><input type="text" name="appsecret" id="appsecret" value="<?php echo $data['appsecret']; ?>" class="input" /></td>
      </tr>
    </table>
  </div>
  </div>
  <input type="submit" name="submit" value="提交" class="btn_a" />
</form>
