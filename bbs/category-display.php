<?php
  require_once 'bbs_public.php';
  $cid = isset($_GET['cid']) ? intval($_GET['cid']) : action_public::turnPage('index.php','参数错误，即将跳回主页！');
  $category = db_bbs_category::getInstance();
  $category_data = $category->getDataLimit('*','cid='.$cid);
  $archive = db_bbs_archive::getInstance();
  $archive_data = $archive->getArchive('aid,cid,lid,title,username,replynum,click,addtime',$cid,20);
?>
<?php include 'header.php';?>


<div class="title">
<h3>
<a><?php echo $category_data[0]['typename']?></a>/<span>Type</span></h3>
<a href="add-archive.php?cid=<?php echo $cid?>" class="action"></a>
</div>



<table border="0" cellspacing="0" cellpadding="0" name="table" id="table" width="100%">
<thead>
<tr class="th">
<th width="8"></th>
<th width="50%">版块主题</th>
<th width="25">作者/时间</th>
<th width="15">查看/回复</th>
</tr>
</thead>
<tbody>


<?php if(!empty($archive_data[0])){foreach($archive_data[0] as $v){?>
<tr>
<td align="center">
<img src="../images/admin/dot_gray.gif" />
</td>

<td>
<a href="archive-display.php?aid=<?php echo $v['aid']?>"><?php echo $v['title']?></td>

<td>
<?php echo $v['username']?>发布于 - <?php echo date('Y年m月d日 H:i',$v['addtime'])?>
</td>

<td>
<?php echo $v['replynum'].'回复/'.$v['click'].'阅读'?>
</td>
</tr>
<?php }}else{?>
<tr><td colspan="4">本专题暂无帖子！</td></tr>
<?php }?>


       </tbody>
    </table>


<div class="blank10"></div>
<div class="pages">
<?php echo $archive_data[1]?>
</div>
<div class="blank10"></div>



<?php include 'bottom.php';?>

