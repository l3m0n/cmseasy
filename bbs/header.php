<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>论坛</title>
<link href="<?php echo $GLOBALS['config']['site_url']?>bbs/css/bbs.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/admin.js"></script>
<script type="text/javascript" language="javascript" src="../js/script.js"></script>
</head>
<body>

<div class="header">
<div class="logo"><a title="<?php echo $GLOBALS['config']['sitename']?>" href="<?php echo $GLOBALS['config']['site_url']?>"><img src="<?php echo $GLOBALS['config']['site_url']?><?php echo $GLOBALS['config']['site_logo']?>" alt="<?php echo $GLOBALS['config']['sitename']?>" /></a></div>
<span class="subnav">
<!-- 页头导航 -->

<a href="<?php echo $GLOBALS['config']['site_url']?>bbs/" onclick="window.external.addFavorite(this.href,this.title);return false;" title='<?php echo $GLOBALS['config']['sitename']?>' rel="sidebar">加入收藏</a>  -  
<a title="留言板" href="<?php echo $GLOBALS['config']['site_url']?>/index.php?case=guestbook&act=index" target="_blank">留言板</a>  -  

<a id="StranLink" title="繁简转换">繁体</a>
</span>
</div>

<!-- 网站导航 -->
<div class="nav">
<ul id="nav">
<li class="one on"><a href="<?php echo $GLOBALS['config']['site_url']?>">网站首页</a></li>
<li class="one"><a href="<?php echo $GLOBALS['config']['site_url']?>bbs/">论坛首页</a></li>
</ul>
</div>
<div class="blank10"></div>

<!-- 幻灯开始 -->
<div class="banner">
<!-- 其它页图片切换 -->
<script language="JavaScript">
bg = new Array(5);
bg[0] = '<?php echo $GLOBALS['config']['cslide_pic1']?>'
bg[1] = '<?php echo $GLOBALS['config']['cslide_pic2']?>'
bg[2] = '<?php echo $GLOBALS['config']['cslide_pic3']?>'
bg[3] = '<?php echo $GLOBALS['config']['cslide_pic4']?>'
bg[4] = '<?php echo $GLOBALS['config']['cslide_pic5']?>'


index = Math.floor(Math.random() * bg.length);
document.write("<img src="+bg[index]+" width=990 />");
</script>
</div>

<div class="box">