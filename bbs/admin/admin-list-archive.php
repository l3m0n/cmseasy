<?php
 require_once('admin_public.php');
 $category = db_bbs_category::getInstance();
 $category_data = $category->getAll();

 $archive = db_bbs_archive::getInstance();

 if(isset($_POST['select'])){
 	$archive = db_bbs_archive::getInstance();
    unset($_POST['select']);
 	$archive_data = $archive->getDataBySelect($_POST);
 }
 if(isset($_POST['edit'])){
 	if(!$roles['bbs_archive_check']){
 		action_public::turnPageAdmin($_SERVER['REQUEST_URI'],'无操作权限！!');
 	}
 	foreach($_POST['aid'] as $v){
       $archive->updateStop($v);
 	}
 	action_public::turnPageAdmin($_SERVER['REQUEST_URI'],'操作成功！');
 }
 if(!$roles['bbs_archive_list']){
 	action_public::turnPageAdmin($_SERVER['REQUEST_URI'],'无操作权限！!');
 }
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






<form name="select" action="" method="post">
<div class="blank5"></div>
<div id="tagscontent" class="right_box">

<table border="0" cellspacing="0" cellpadding="0" name="table" id="table" width="100%">
<thead>
<tr class="th">
<th>状态</th>
<th>所属专题</th>
<th>起始时间</th>
<th>结束时间</th>
</tr>
</thead>
        <tbody>
<tr onmouseover="this.bgColor='#FFFFF0';" onmouseout="this.bgColor='';" bgcolor="">

     <td>
       <select name="isstop">
          <option value="1">未审核</option>
          <option value="0"<?php if(isset($_POST['isstop']) && $_POST['isstop'] == 0) echo 'selected'?>>已审核</option>
       </select>
     </td>
     <td>
       <select name="cid">
          <option value="0">全部专题</option>
          <?php foreach($category_data as $v){?>
          <option value="<?php echo $v['cid']?>" <?php if(isset($_POST['cid']) && $_POST['cid'] == $v['cid']) echo 'selected';?>><?php echo $v['typename']?></option>
          <?php }?>
       </select>
     </td>
     <td width="">
       <input type="text" name="start_time" id="start_time"  readonly="readonly" value="<?php if(isset($_POST['start_time'])) echo $_POST['start_time'];?>" />
     </td>
     <td>
       <input type="text" name="end_time" id="end_time"  readonly="readonly" value="<?php if(isset($_POST['end_time'])) echo $_POST['end_time'];?>" />
     </td>
  </tr>
</table>
<div class="blank20"></div>
<input type="submit" name="select" value="查询" class="btn_d" />
<div class="blank20"></div>
</form>
<?php if(isset($_POST['cid'])){?><div class="blank20"></div>
<form name="edit" action="" method="post">

<table border="0" cellspacing="0" cellpadding="0" name="table" id="table" width="100%">
<thead>


  <?php if(!empty($archive_data)){?>
<tr class="th">
    <th><input type="checkbox" name="check_all" value="" id="checkall"/></th>
	<th>状态</th>
	<th>标题</th>
	<th>时间</th>
	<th>作者</th>
	<th width="20">操作</th>
  </tr>
  <?php foreach($archive_data as $v){?>
</thead>
        <tbody>
<tr onmouseover="this.bgColor='#FFFFF0';" onmouseout="this.bgColor='';" bgcolor="">
     <td align="center"><input type="checkbox" class="checkbox" name="aid[]" value="<?php echo $v['aid']?>"/></td>
     <td align="center"><?php echo $v['isstop']==0 ? '已审核':'未审核' ;?></td>
     <td><a href="#"><?php echo $v['title']?></a></td>
     <td align="center"><?php echo date('Y-m-d H:i:s',$v['addtime'])?></td>
     <td align="center"><?php echo $v['username']?></td>
     <td align="center" width="70">
		<span class="hotspot" onmouseover="tooltip.show('编辑内容！');" onmouseout="tooltip.hide();">
        <a href="admin-edit-archive.php?action=edit&aid=<?php echo $v['aid']?>" class="a_edit"></a></span>
		<span class="hotspot" onmouseover="tooltip.show('确定要删除吗？');" onmouseout="tooltip.hide();">
        <a href="admin-edit-archive.php?action=del&aid=<?php echo $v['aid']?>" class="a_del"></a></span>
     </td>
  </tr>
  <?php }?>
</table>
</div>

<div class="blank20"></div>

<input type="submit" name="edit" class="btn_d" value="审核通过/审核未通过" />

 <?php }else{?>
<div class="blank20"></div>
<a class="btn_d">暂未相关主题帖子！请重新选择！</a>

  <?php }?>

</form>
<?php }?>



<script type="text/javascript">
	$(document).ready(function(){
		var cal = Calendar.setup({
			onSelect: function(cal){cal.hide();},
		    showTime: true
		});
		cal.manageFields("start_time", "start_time", "%Y-%m-%d %H:%M:%S");
		cal.manageFields("end_time", "end_time", "%Y-%m-%d %H:%M:%S");

        $("#checkall").click(function(){
        	var all = ($(this).attr('checked'));
        	$(".checkbox").each(function(){
        		$(this).attr('checked',all);
        	});
        });


    });
</script>
<?php include_once("admin-bottom.php");?>
