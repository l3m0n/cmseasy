<div class="tags" style="margin-bottom:20px;">
<div id="tagstitle">
<a class="hover">短信充值</a>
<style>#tagstitle a.btn_e,#tagstitle a.btn_d {width:auto;padding:0px 8px;}</style>
<span style="float:right">
<a href="http://pay.cmseasy.cn/reg.php" target="_blank" class="btn_d">注册</a>
<a href="{$base_url}/index.php?case=config&act=system&set=sms&admin_dir={get('admin_dir')}&site=default" class="btn_d">设置</a>
<a target="_blank" href="http://pay.cmseasy.cn/list.php?username=<?php echo config::get('sms_username');?>&password=<?php echo md5(config::get('sms_password'));?>" class="btn_e">发送详情</a>
<a target="_blank" href="http://pay.cmseasy.cn/plist.php?username=<?php echo config::get('sms_username');?>&password=<?php echo md5(config::get('sms_password'));?>" class="btn_e">充值详情</a>
</span>

</div>

<div id="tagscontent" class="right_box">


<div class="blank10"></div>
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"> <span class="tips"><a href="http://pay.cmseasy.cn/rule.php" target="_blank" class="btn_e">查看许可协议</a></span>

<div class="blank10"></div>

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
        <thead>
		<tr><td colspan="3"><div class="blank10"></div></td></tr>
            <tr>
                <th colspan="3" style="text-align:left;padding-left:16%;height:32px;line-height:32px;">

<p>你已发送<font color="#009900"><strong>{$info[1]}</strong></font>条短信,还有<font color="#CC0000"><strong>{$info[0]}</strong></font>条短信未使用.</p>

				</th>
            </tr>

        </thead>
        <tbody>
		<form method="post" action="http://pay.cmseasy.cn/pay.php" target="_blank">
		<tr>
                        <td width="19%" align="right">
充值条数
				</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="70%">
 <select name="num" id="num" style="float:left;">
  	<option value="10">10条	=	1.0 元（人民币）</option>
    <option value="100" selected>100条	=	 10 元（人民币）</option>
    <option value="200">200条	=	20 元（人民币）</option>
    <option value="300">300条	=	30 元（人民币）</option>
    <option value="500">500条	=	50 元（人民币）</option>
    <option value="1000">1000条	=	100 元（人民币）</option>
    <option value="5000">5000条	=	500 元（人民币）</option>
  </select>

<input type="submit" name="submit" id="submit" value="充值" class="btn_d"  style="margin:3px 0px 0px 10px;" />
<input name="sms_username" type="hidden" value="<?php echo config::get('sms_username');?>">
&nbsp; <img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"><span style="color:red;font-weight:bold;"> 注意</span> 充值前请先<a href="http://pay.cmseasy.cn/reg.php" target="_blank" style="color:#009900">注册用户</a>！并将短信设置里面账户和密码修改为注册用户和密码！
				</td>

				 </tr>
				 </form>
<form method="post" action="">
				 <tr>
                        <td width="19%" align="right">
接收号码
</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="70%">
						
    <input type="text" name="mobile" id="mobile" class="input" style="float:left;margin-right:10px;" />
	<input type="submit" name="submit" id="submit" value="发送" class="btn_d" style="margin-top:3px;" />
  <input name="act" type="hidden" value="test"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"> <span class="tips">测试短信发送</span>
</td>

				 </tr>
</form>

<tr>
                        <td width="19%" align="right">
特别注意
</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="70%">
						1、由于运营商业务量巨大，短信发送可能会有延时；<br />
						2、每周日的短信将保存后由下周一同意发送；<br />
						3、短信每条0.10元，如有价格变动见CmsEasy官网通知。<br />
</td>

				 </tr>
				 </tbody>
				 <thead>
            <tr>
                <th colspan="3" style="text-align:left;padding-left:10px;">



				</th>
            </tr>

        </thead>


			<tr>
                        <td width="19%" align="right">
使用说明
</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="70%">


						1、首先，在网站后台的 [ 设置 ] － 填写好网站管理员的手机号码，随后<a href="http://pay.cmseasy.cn/reg.php" target="_blank" style="color:#009900">注册</a>短信平台用户；</br>
						2、注册用户后，将用户名和密码，填写在<a href="{$base_url}/index.php?case=config&act=system&set=sms&admin_dir={get('admin_dir')}&site=default" target="_blank" style="color:#009900">短信设置</a>的账户和密码里面；</br>
						3、然后进入<a href="{$base_url}/index.php?case=sms&act=manage&admin_dir={get('admin_dir')}&site=default" target="_blank" style="color:#009900">短信管理</a>界面，点击充值，可以按自己需要选择充值数量，最低充值人民币8角；</br>
						4、最后进入<a href="{$base_url}/index.php?case=config&act=system&set=sms&admin_dir={get('admin_dir')}&site=default" target="_blank" style="color:#009900">短信设置</a>，设置好短信发送的条件；</br>
						5、提交后，完成短信配置，网站可正常向访客发送短信。</br>
</td>

				 </tr>

        
    </table>


  </div>
</div>
