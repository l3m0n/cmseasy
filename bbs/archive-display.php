<?php
  require_once 'bbs_public.php';
  $aid = isset($_GET['aid']) ? intval($_GET['aid']) : action_public::turnPage('index.php','参数错误，即将跳回主页！');
  $archive = db_bbs_archive::getInstance();
  $archive->updateClickReply($aid,'click');
  $archive_info = $archive->getDataLimit('*',"aid = '{$aid}' AND isstop='0'");
  if(empty($archive_info))
      action_public::turnPage('index.php','该帖子不存在，或已被删除！');
  $label = db_bbs_label::getInstance();
  $lable_data = $label->getAll();
  $lable_data_arr = action_public::formatToIndex('lid',$lable_data);

  $reply = db_bbs_reply::getInstance();
  $reply_data = $reply->getReply('id,tid,username,content,addtime',$aid,10);

  $admin = new action_admin();
?>
<?php include 'header.php';?>



<table border="0" cellspacing="0" cellpadding="0" name="table" id="table" width="100%">
<thead>
<tr class="th">
<th>
主题&nbsp;[<?php echo $lable_data_arr[$archive_info[0]['cid']]['labelname']?>]：</th>
<th width="60%" align="left">&nbsp;&nbsp;<strong><?php echo htmlspecialchars($archive_info[0]['title'])?></strong></th>
<th>阅读：<?php echo $archive_info[0]['click']?></th>
<th>回复：<?php echo $archive_info[0]['replynum']?></th>
</th>
</tr>
</thead>
</table>
<div><tbody>
<div style="padding:20px;font-size:15px;min-height:100px;"><?php echo stripslashes($archive_info[0]['content']);?></div>
<div class="blank10"></div>
<div class="pages">
<?php echo $reply_data[1];?>
</div>
<div class="blank10"></div>

<?php if(!empty($reply_data[0])){foreach($reply_data[0] as $K=>$V){?>

<div class="comment_list" id="reply_table">
<?php foreach($V as $k=>$v){?>
<dl style="margin-left:<?php echo $k*5;?>px;">
<dt><?php if($k)echo '<strong>'.$k.'</strong>楼&nbsp;&nbsp;';?><span>回复作者：<?php if($v['username']) echo $v['username'];else echo '匿名';?></span><span>回复时间：<?php echo date('Y年m月d日 H:i:s',$v['addtime']);?></span></dt>
<dd><?php echo stripslashes($v['content']);?></dd>
</dl>
<?php }?>

<div class="blank10"></div>
<input type="button" id="<?php echo count($V)?>" name="<?php echo $K?>" value="" class="child_reply" />

<div class="blank10"></div>
</div>

<?php } }else{?>
<div>暂无人发表评论！</div>
<?php }?>


<div class="blank10"></div>
<div class="pages">
<?php echo $reply_data[1];?>
</div>
<div class="blank10"></div>


<div class="title">
<h3>
<a>请填写下面的回复信息</a>/<span>Action</span></h3>
</div>

<div class="blank10"></div>
<?php echo umeditor('content');?>
<div class="blank10"></div>

请输入验证码：<input name="verify" id="verify" value=""/>
<img id="verify_img" src="<?php echo $GLOBALS['config']['site_url']?>/index.php?case=tool&act=verify" onclick="this.src='<?php echo $GLOBALS['config']['site_url']?>index.php?case=tool&act=verify&tmp='+Math.random();"/>

<div class="blank10"></div>
<input type="button" class="bottun" id="submit" value="提交评论"/>
</div>
<div class="blank30"></div>

 <script>
  var username = <?php echo isset($_COOKIE['login_username']) ? "'".$_COOKIE['login_username']."'" : "' '";?>;

  $("#submit").click(function(){
     var content = escape(um_content.getContent());
     var verify = $("#verify").val();
     if(content.length < 4){
        alert('您评论的内容过短，请重新填写！');
         UM.getEditor('content').focus();
         return false;
     }else if(verify.length <1){
     	alert('请填写验证码！');
         $('#verify').focus();
     	return false;
     }else{
		 $.ajax({
		   type: "POST",
		   url: "ajax.php",
		   data: "reply=1"+ "&verify="+ verify + "&content=" + content + "&aid=" + <?php echo $aid?>,
	       beforeSend: function(){
	       },
		   success: function(msg){
		      var show;
		      switch(msg){
		      	case '0':
		      	   show = '网络繁忙，请稍后再试！';break;
		      	case '1':
		      	   show = '您的评论已成功提交！';break;
		      	case '-1':
		      	   show = '验证码输入错误！';break;
		      	  default:
		      	   show = '未知错误！';
		      }
              alert(show);
              if(msg<1)return false;
	          //var date = new Date();
		      //var now = date.toLocaleString( );
		      //var reply_con = '<tr><td><div><span>回复作者：'+username+'</span><span>回复时间：'+now+'</span></div><div>'+content+'</div></td></tr>';
		      //$("#reply_table").append(reply_con);
		      //getEditor('content').EditorDocument.body.innerHTML="";
               //um_content.execCommand('insertHtml', '');
               location.reload();
		   }
		});
     }
  });
  var last_place=0;//记录是否连续点击同一个按钮
  $(".child_reply").click(function(){
  	    var id = $(this).attr('name');
  	    var floor = $(this).attr('id');
        if(id == last_place)
            return false;
        else
            last_place = id;
        $(".child_edit_place").remove();
        $(this).after('<div class="child_edit_place"><div class="blank10"></div><textarea name="r_content" id="r_content"></textarea><div class="blank10"></div>请输入验证码：<input type="text" name="r_verify" id="r_verify" value=""/><img src="<?php echo $GLOBALS['config']['site_url']?>/index.php?case=tool&act=verify&tmp="'+ Math.random() +' onclick="this.src=\'<?php echo $GLOBALS['config']['site_url']?>index.php?case=tool&act=verify&tmp=\'+Math.random();"/><div class="blank10"></div><input type="button" value="提交" onclick="submit_reply_content('+ id +','+ floor +');" class="btn_d" /><span class="hotspot" onmouseover="tooltip.show(\'关闭回复！\');" onmouseout="tooltip.hide();"><input type="button" value="" onclick="close_edit_window();" class="a_del" /></span></div>');
  });

  function close_edit_window(){
  	 $(".child_edit_place").remove();
  	 last_place = 0;
  	 tooltip.hide();
  }

  function submit_reply_content(tid,floor){
    var content = $("#r_content").val();
    var verify = $("#r_verify").val();
    if(content.length < 1){
        alert('您提交的评论内容过短 ！');
     	return false;
    }
 	$.ajax({
	   type: "POST",
	   url: "ajax.php",
	   data: "reply=1" + "&verify="+ verify + "&content="+ content + "&tid=" + tid + "&aid=" + <?php echo $aid?>,
       beforeSend: function(){
       },
	   success: function(msg){
	      var show;
	      switch(msg){
	      	case '0':
	      	   show = '网络繁忙，请稍后再试！';break;
	      	case '1':
	      	   show = '您的评论已成功提交！';break;
	      	case '-1':
	      	   show = '验证码输入错误！';break;
	      	  default:
	      	   show = '未知错误！';
	      }
          alert(show);
          if(msg<1)return false;
          location.reload();
         // var date = new Date();
	      //var now = date.toLocaleString();
	      //var reply_con = '<div style="margin-left:'+ floor*20 +'px;border:1px solid red;"><div><span>回复作者：'+username+'</span><span>回复时间：'+now+'</span></div><div>'+content+'</div></div>';
	      //$("#reply_floor_"+tid).append(reply_con);
	      //close//_edit_window();
	      //同时更新最下面验证码的信息
	      //$("#verify_img").attr('src','<?php echo $GLOBALS['config']['site_url']?>index.php?case=tool&act=verify&tmp='+Math.random());
	   }
	});

  }

 </script>
<?php include 'bottom.php';?>

