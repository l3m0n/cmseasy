<script type="text/javascript" src="{$base_url}/common/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="{$base_url}/common/js/ThumbAjaxFileUpload.js"></script>

<div class="tags" style="margin-bottom:20px;">
 <div id="tagstitle">
   <a id="one1" onclick="setTab('one',1,6)" class="hover">基本信息</a>
   <a id="one2" onclick="setTab('one',2,6)">自定义信息</a>
  </div> 

<div id="tagscontent" class="right_box">
<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
<input type="hidden" name="onlymodify" value=""/>
      
<div id="con_one_1">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">

<tbody>

<tr>
<td width="19%" align="right">用户名</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('username',$form,$field,$data)}
</td>
</tr>

<tr>
<td width="19%" align="right">密码</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input type="text" name="passwordnew" id="passwordnew" value="" class="input" />
</td>
</tr>

    
<tr>
<td width="19%" align="right">昵称</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('nickname',$form,$field,$data)} 
</td>
</tr>

<tr>
<td width="19%" align="right">安全问题</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('question',$form,$field,$data)}
</td>
</tr> 

<tr>
<td width="19%" align="right">您的答案</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('answer',$form,$field,$data)}
</td>
</tr>  

<tr>
<td width="19%" align="right">用户组</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('groupid',$form,$field,$data)}
</td>
</tr>

    
<tr>
<td width="19%" align="right">QQ号码</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('qq',$form,$field,$data)}
</td>
</tr>

    
<tr>
<td width="19%" align="right">E-Mail</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('e_mail',$form,$field,$data)}
</td>
</tr>

    
<tr>
<td width="19%" align="right">电话</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('tel',$form,$field,$data)}
</td>
</tr>

</tbody>
</table>
</div>

<div id="con_one_2" style="display:none">
    
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">
<tbody>
        
<tr class="th">
<th colspan="5">自定义字段</th></tr>
{loop $field $f}
<?php
$name=$f['name'];
if(!preg_match('/^my_/',$name)) {
unset($field[$name]);
continue;
}
if(!isset($data[$name])) $data[$name]='';
?>
<tr>
<td width="19%" align="right"><?php echo setting::$var['user'][$name]['cname']; ?></td>
<td width="1%">&nbsp;</td>
<td width="70%">
<?php echo form::getform($name,$form,$field,$data); ?>
</td>
</tr>
{/loop}
        
</tbody>
</table>

</div>
</div>
</div>
<input type="hidden" name="token" value="{$token}" />
<input type="submit" name="submit" value="提交" class="btn_a" />
</form>