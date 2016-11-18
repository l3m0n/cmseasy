<div class="tags" style="margin-bottom:20px;">
<div id="tagstitle"> <a class="hover">添加公众号</a> </div>
<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
  <div id="tagscontent" class="right_box" style="height:383px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">
    <tr class="s_out" >
        <td align="left">登录微信公众平台配置接口信息，配置成功后会自动跳转。</td>
      </tr>
      <tr class="s_out" >
        <td align="left">URL: <?php echo config::get('site_url');?>index.php?case=weixin&act=interface&wid={$data['oldid']}</td>
      </tr>
      <tr class="s_out" >
        <td align="left">TOKEN: {$data['token']}</td>
      </tr>
    </table>
  </div>
  </div>
</form>
<script type="text/javascript">
$(document).ready(function () { 
	setInterval("startRequest()",1000); 
}); 

function startRequest() 
{ 
	$.ajax({
		url: '<?php echo url('weixin/chktest/id/'.$data['id']);?>',
		type: 'GET',
		cache: false,
		success: function(data) {
			if(data==2){
				//alert('验证成功');
				location.href="<?php echo url('weixin/add3/id/'.$data['id']);?>";
			}
		}
	});
} 
</script>