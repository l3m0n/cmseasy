<?php

  require_once 'bbs_public.php';
  $category = db_bbs_category::getInstance();
  $category_data = $category->getAll('order by listorder asc');

  $archive = db_bbs_archive::getInstance();

  $label = db_bbs_label::getInstance();
  $lable_data = $label->getAll();
  $lable_data_arr = action_public::formatToIndex('lid',$lable_data);
?>
<?php
include 'header.php';
?>
<div class="main">

<?php foreach ($category_data as $v) {
         $archive_arr = $archive->getDataLimit('aid,cid,lid,title,username,replynum,click,addtime',"cid='{$v['cid']}' AND isstop='0' order by aid desc limit 10 ");
?>






<div class="title">
<h3>
<a href="category-display.php?cid=<?php echo $v['cid']?>"><?php echo $v['typename']?></a>/<span>Type</span></h3>
<a href="add-archive.php?cid=<?php echo $v['cid']?>" class="action"></a>
</div>



<table border="0" cellspacing="0" cellpadding="0" name="table" id="table" width="100%">
<thead>
<tr class="th">
<th width="8%"></th>
<th width="50%">版块主题</th>
<th width="20%">作者/时间</th>
<th width="20%">查看/回复</th>
</tr>
</thead>
<tbody>
<?php foreach($archive_arr as $j){?><tr onmouseover="this.bgColor='#FFFFF0';" onmouseout="this.bgColor='';" bgcolor="">
<td align="center">
<img src="../images/admin/dot_gray.gif" />
</td>
<td>
<a href="archive-display.php?aid=<?php echo $j['aid']?>">[<?php echo $lable_data_arr[$j['lid']]['labelname']?>]	<?php echo htmlspecialchars($j['title'])?></a>
</td>
<td align="center">
<?php echo $j['username']?> 发布于 - <?php echo date('Y-m-d',$j['addtime'])?>
</td>
<td align="center">
<?php echo $j['click'].'阅读/'.$j['replynum'].'评论'?>
</td>
</tr><?php }?>
</tbody>
</table>

<div class="blank30"></div>

<?php }?>



<?php include 'bottom.php';?>