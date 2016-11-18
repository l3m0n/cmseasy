<?php

  require_once 'bbs_public.php';
  //验证用户登陆相关操作
  $admin = new action_admin();
  $admin->check_login();

  $category = db_bbs_category::getInstance();
  $category_data = $category->getAll();

  $cid = isset($_GET['cid']) ? intval($_GET['cid']) : 1 ;

  $label = db_bbs_label::getInstance();
  $lable_data = $label->getAll();

  if(isset($_POST['submit'])){
  	  if(strtolower(trim($_POST['verify'])) != strtolower($_SESSION['verify'])){
          action_public::turnPage('index.php','验证码输入错误！');
  	  }
      $archive = db_bbs_archive::getInstance();
      
      unset($_POST['submit']);
      unset($_POST['verify']);

      $_POST['username'] = $_COOKIE['login_username'];
      $_POST['userid'] = $admin->userid;
      $_POST['ip'] = $_SERVER['REMOTE_ADDR'];
      $_POST['addtime'] = mktime();

      if($id = $archive->inserData($_POST)){
          action_public::turnPage('archive-display.php?aid='.$id,'文章添加成功');
      }else{
      	  action_public::turnPage('index.php','添加失败，请联系我们！');
      }
  }
?>
<?php include 'header.php';?>

<style type="text/css">
#table tr td {line-height:38px;}
</style>



<div class="title">
<h3>
<a>请填写帖子相关内容</a>/<span>Release</span></h3>
</div>

<form name="form" action="" method="post" onsubmit="return check_form();">

<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table">

<tr onmouseover="this.bgColor='#FFFFF0';" onmouseout="this.bgColor='';" bgcolor="">
<td width="19%" align="right">主题</td>
<td width="1%">&nbsp;</td>
<td width="80%">
<input name="title"  value="" style="width:220px;height:25px;" />
</td>
</tr>

<tr onmouseover="this.bgColor='#FFFFF0';" onmouseout="this.bgColor='';" bgcolor="">
<td width="19%" align="right">讨论区</td>
<td width="1%">&nbsp;</td>
<td width="80%">
<select name="cid">
<?php foreach ($category_data as $k => $v){ ?>
<option value="<?php echo $v['cid']?>" <?php if($v['cid'] == $cid){?>selected="selected"<?php }?>><?php echo $v['typename']?></option>
<?php }?>
</select>
</td>
</tr>

<tr onmouseover="this.bgColor='#FFFFF0';" onmouseout="this.bgColor='';" bgcolor="">
<td width="19%" align="right">话题类型</td>
<td width="1%">&nbsp;</td>
<td width="80%">
<?php foreach ($lable_data as $k => $v){ ?>
<input type="radio" name="lid" value="<?php echo $v['lid']?>" <?php if(!isset($t)){?>checked=""<?php $t=1;}?> />&nbsp;<?php echo $v['labelname']?>&nbsp;
<?php }?>
</td>
</tr>

<tr onmouseover="this.bgColor='#FFFFF0';" onmouseout="this.bgColor='';" bgcolor="">
<td width="19%" align="right">是否允许回复</td>
<td width="1%">&nbsp;</td>
<td width="80%">
<input type="radio" name="noreply" value="0" checked=""/>&nbsp;是&nbsp;
<input type="radio" name="noreply" value="1" />&nbsp;否
</td>
</tr>

<tr onmouseover="this.bgColor='#FFFFF0';" onmouseout="this.bgColor='';" bgcolor="">
<td width="19%" align="right">内容</td>
<td width="1%">&nbsp;</td>
<td width="80%">
<div class="blank10"></div>
<?php echo umeditor('content');?>
<div class="blank10"></div>
</td>
</tr>
</table>

<div class="blank30"></div>
请输入验证码：<input name="verify" id="verify" value="" style="width:190px;" />
<img id="verify_img" src="<?php echo $GLOBALS['config']['site_url']?>/index.php?case=tool&act=verify" onclick="this.src='<?php echo $GLOBALS['config']['site_url']?>index.php?case=tool&act=verify&tmp='+Math.random();"/>


<div class="blank10"></div>
<input type="submit" class="bottun" name="submit" id="submit" value="提交评论"/>
</div>
<div class="blank30"></div>
</form>


 <script>
    function check_form(){
    	var title = document.form.title.value;
        var content = getContent('content');
        var verify = document.form.verify.value;
        if(title.length < 4 || content.length < 4){
            alert('验标题或内容长度不符合要求！');
         	return false;
        }
        var tag = false;
        $.ajax({
            async : false,
        	type : "GET",
        	url : 'ajax.php',
        	data : 'verify='+verify,
		    beforeSend: function(){
		    },
        	success : function(msg){
                if(msg != '1' ){
                	tag = true;
		            alert('验证码输入有误！');
                }
        	}
        });
        if(tag)return false;
        return true;
    }
 </script>
<?php include 'bottom.php';?>
