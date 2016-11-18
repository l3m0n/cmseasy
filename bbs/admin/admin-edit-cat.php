<?php
   require_once('admin_public.php');
   $category = db_bbs_category::getInstance();
   $cid = isset($_GET['cid']) ? intval($_GET['cid']) : action_public::turnPageAdmin('index.php','参数错误，即将跳回主页！');
   if(isset($_GET['action']) && $_GET['action'] == 'del'){
   	if(!$roles['bbs_category_del']){
   		action_public::turnPageAdmin($_SERVER['REQUEST_URI'],'无操作权限！!');
   	}
   	   if($category->deleteData('cid='.$cid)){
   	   	  action_public::turnPageAdmin('admin-list-cat.php','删除成功！');
   	   }else{
   	   	  action_public::turnPageAdmin('admin-list-cat.php','操作未成功，请联系CMSEASY官方！！');
   	   }
   }
   if(isset($_POST['submit'])){
   	if(!$roles['bbs_category_edit']){
   		action_public::turnPageAdmin($_SERVER['REQUEST_URI'],'无操作权限！!');
   	}
   	   unset($_POST['submit']);
   	   if($category->updateData($_POST,'cid='.$cid))
   	      action_public::turnPageAdmin('admin-list-cat.php','修改成功！');
   	   else
   	      action_public::turnPageAdmin('admin-list-cat.php','操作未成功，请联系CMSEASY官方！！');
   }
   if(!isset($_GET['action']) && $_GET['action'] != 'edit')
       action_public::turnPageAdmin('admin-list-cat.php','参数错误！');
   $category_data = $category->getDataLimit('*','cid='.$cid);
?>
<?php include_once("admin-header.php");?>
<script type="text/javascript" language="javascript" src="<?php echo $GLOBALS['config']['site_url'];?>js/script.js"></script>
<style type="text/css">
* {font-size:12px;}
a {color:#435884;text-decoration:none;}
a:link {color:#333;text-decoration:none;}
a:hover{color:#3399FF;text-decoration:none;}
/* 提示框 */
.hotspot { cursor:pointer}
#tt {position:absolute; display:block; background:url(<?php echo $GLOBALS['config']['site_url'];?>images/admin/bbs/tt_left.gif) top left no-repeat}
#tttop {display:block; height:5px; margin-left:5px; background:url(<?php echo $GLOBALS['config']['site_url'];?>images/admin/bbs/tt_top.gif) top right no-repeat; overflow:hidden}
#ttcont {display:block; padding:2px 12px 3px 7px; margin-left:5px; background:#666; color:#FFF}
#ttbot {display:block; height:5px; margin-left:5px; background:url(<?php echo $GLOBALS['config']['site_url'];?>images/admin/bbs/tt_bottom.gif) top right no-repeat; overflow:hidden}
input.input {background:white;}
.right_box {
  width:710px;
  margin:10px 0px 0px 10px;
  padding:10px;
  border-top:1px solid #DDD;
  border-left:1px solid #DDD;
  background:url(<?php echo $GLOBALS['config']['site_url'];?>images/admin/bbs/tab_box_bg.png) right bottom no-repeat;
}

 .btn_a {
  width:102px;
  height:31px;
  line-height:28px;
  color:white;
  background:url(<?php echo $GLOBALS['config']['site_url'];?>images/admin/bbs/btn_01.gif) left top no-repeat;
  border:none;
  text-align:center;
  cursor: pointer;
}

.btn_d {
  float:left;
  height:22px;
  line-height:22px;
  margin:0px 2px;
  padding:0px 6px;
  background:url(<?php echo $GLOBALS['config']['site_url'];?>images/admin/bbs/btn_04.gif) left top repeat-x;
  border:none;
  border-right:1px solid #888;
  border-bottom:1px solid #888;
  color:white;
  font-size:12px;
}


.btn_e {
  height:22px;
  line-height:22px;
  margin:0px 2px;
  padding:0px 6px;
  background:url(<?php echo $GLOBALS['config']['site_url'];?>images/admin/bbs/btn_05.gif) left top repeat-x;
  border:none;
  color:white;
  font-size:12px;
  border-right:1px solid #888;
  border-bottom:1px solid #888;
}


#table {
  font-size:12px;
  _width:100%;
}


#table tr.th {
  width:706px;
  height:28px;
  line-height:28px;
  color:white;
  background:url(<?php echo $GLOBALS['config']['site_url'];?>images/admin/bbs/th_bg.gif) left top repeat-x;
  font-weight:normal;
}


#table td {
  background:url(<?php echo $GLOBALS['config']['site_url'];?>images/admin/bbs/tr_bg.gif) left bottom repeat-x;
}

#table td {
  padding:5px;
}

#table tr.th th {
  font-weight:normal;
  padding:0px 15px;
  background:url(<?php echo $GLOBALS['config']['site_url'];?>images/admin/bbs/th_line.gif) right top no-repeat;
}

.textarea {
  width:302px;
  height:150px;
  overflow:auto;
}

.input
{
  width:302px;
  height:29px;
  line-height:29px;
  padding:0px 10px;
  background:url(<?php echo $GLOBALS['config']['site_url'];?>images/admin/bbs/input_bg.gif) left top no-repeat;
  border:none;
  font-size:12px;
}

.input_d
{
  width:302px;
  height:29px;
  line-height:29px;
  padding:0px 10px;
  background:url(<?php echo $GLOBALS['config']['site_url'];?>images/admin/bbs/input_bg_d.gif) left top no-repeat;
  border:none;
  font-size:12px;
}

.input_c {
  width:59px;
  height:21px;
  line-height:21px;
  padding:0px 10px;
  background:url(<?php echo $GLOBALS['config']['site_url'];?>images/admin/bbs/input_bg_c.gif) left top no-repeat;
  border:none;
  font-size:12px;
}

.a_edit {
  display:block;
  float:left;
  width:31px;
  height:30px;
  background:url(<?php echo $GLOBALS['config']['site_url'];?>images/admin/bbs/edit_on.gif) center center no-repeat;
}

.a_edit:hover {
  background:url(<?php echo $GLOBALS['config']['site_url'];?>images/admin/bbs/edit_hover.gif) left top no-repeat;
}

.a_del {
  display:block;
  float:left;
  width:31px;
  height:30px;
  border:none;
  background:url(<?php echo $GLOBALS['config']['site_url'];?>images/admin/bbs/del_on.gif) center center no-repeat;
}


.a_del:hover {
  background:url(<?php echo $GLOBALS['config']['site_url'];?>images/admin/bbs/del_hover.gif) left top no-repeat;
}

.blank5,.blank10,blank20 {
  clear: both;
  height: 5px;
}

.blank10 {
  height:10px;
}

.blank20 {
  height:20px;
}

.blank30 {
  height: 30px;
}

</style>


<form name="form" action="" method="post">
<div id="tagscontent" class="right_box">

<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table">
<tr onmouseover="this.bgColor='#FFFFF0';" onmouseout="this.bgColor='';" bgcolor="">
<td width="19%" align="right">专题名称</td>
<td width="1%">&nbsp;</td>
<td width="80%">
<input type="text" name="typename" value="<?php echo $category_data[0]['typename']?>" class="input" />
</td>
</tr>

<tr onmouseover="this.bgColor='#FFFFF0';" onmouseout="this.bgColor='';" bgcolor="">
<td width="19%" align="right">专题简介</td>
<td width="1%">&nbsp;</td>
<td width="80%">
<textarea name="content" class="textarea"><?php echo $category_data[0]['content']?></textarea>
</td>
</tr>

<tr onmouseover="this.bgColor='#FFFFF0';" onmouseout="this.bgColor='';" bgcolor="">
<td width="19%" align="right">专题关键字</td>
<td width="1%">&nbsp;</td>
<td width="80%"><input type="text" name="keyword" value="<?php echo $category_data[0]['keyword']?>" class="input" />
</td>
</tr>
</table>
</div>

<div class="blank20"></div>
<input type="submit" name="submit" value="提交修改" class="btn_a" />
</form>
<?php include_once("admin-bottom.php");?>