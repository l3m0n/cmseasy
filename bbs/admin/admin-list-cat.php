<?php
   require_once('admin_public.php');
   $category = db_bbs_category::getInstance();
   $category_data = $category->getAll();

   if(isset($_POST['update'])){
   	if(!$roles['bbs_category_add']){
   		action_public::turnPageAdmin($_SERVER['REQUEST_URI'],'无操作权限！!');
   	}
   	  foreach($_POST['listorder'] as $k=>$v){
   	  	 if($_POST['typename'][$k] == '新专题名称')continue;
         $category->insertOrUpdateCat(array('cid'=>isset($_POST['cid'][$k]) ? $_POST['cid'][$k] : '','listorder'=>$_POST['listorder'][$k],'typename'=>$_POST['typename'][$k]),array('listorder'=>$_POST['listorder'][$k],'typename'=>$_POST['typename'][$k]));
   	  }
   	  action_public::turnPageAdmin($_SERVER['REQUEST_URI'],'修改成功！！');
   }
   if(!$roles['bbs_category_list']){
   	action_public::turnPageAdmin($_SERVER['REQUEST_URI'],'无操作权限！!');
   }

?>
<?php include_once("admin-header.php");?>
<script type="text/javascript" language="javascript" src="<?php echo $GLOBALS['config']['site_url'];?>js/script.js"></script>
<style type="text/css">
* {font-size:12px;}

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
<form name="update" action="" method="post">

<div class="blank5"></div>
<div id="tagscontent" class="right_box">

    <table border="0" cellspacing="0" cellpadding="0" name="table" id="table" width="100%">
        <thead>
            <tr class="th">
      <th width="50">展示顺序</th>
	  <th>专题名称</th>
	  <th width="30">操作</th>
    </tr>

	</thead>
        <tbody id="category_table">


    <?php if(!empty($category_data)){foreach($category_data as $v){?>

<tr onmouseover="this.bgColor='#FFFFF0';" onmouseout="this.bgColor='';" bgcolor="">

      <td><input type="text" name="listorder[]" value="<?php echo $v['listorder']?>" class="input_c" /></td>
      <td>
          <input type="text" name="typename[]" value="<?php echo $v['typename']?>" class="input" />
          <input type="hidden" name="cid[]" value="<?php echo $v['cid']?>" />
      </td>
      <td width="70">
          <span class="hotspot" onmouseover="tooltip.show('编辑栏目内容！');" onmouseout="tooltip.hide();"><a href="admin-edit-cat.php?action=edit&cid=<?php echo $v['cid']?>" class="a_edit"></a></span>
          <span class="hotspot" onmouseover="tooltip.show('确定要删除吗？');" onmouseout="tooltip.hide();"><a href="admin-edit-cat.php?action=del&cid=<?php echo $v['cid']?>" class="a_del"></a></span>
      </td>
    </tr>
    <?php }}else{?>
     <tr><td>暂未添加任何专题</td></tr>
    <?php }?>

    </tbody>
</table>
</div>
<div class="blank20"></div>


<input type="submit" name="update" value="提交修改" class="btn_a" />
<input type="button" name="addcat" id="addcat" value="添加专题" class="btn_a" />

</form>
<script>
  $("#addcat").click(function(){
  	  var con = '<tr><td><input type="text" name="listorder[]" class="input_c" value="100"/></td><td><input type="text" class="input" name="typename[]" value="新专题名称"></td></tr>';
      $("#category_table").append(con);
  });

</script>


<?php include_once("admin-bottom.php");?>


