<?php
define('ROOT',TRUE);
error_reporting(E_ALL&~E_NOTICE);
$config = include('config/config.php');
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>myFocus Demo</title>
<style type="text/css">
* { margin:0; padding:0; list-style:none; }
body { background:#fff; font:12px/22px Verdana, Geneva, sans-serif; margin:0px;}
img { border:0; }
.clear{clear:both;height:0;overflow:hidden;}
a { color:#333; text-decoration:none; }
a:hover { text-decoration:underline; }
.top, .bottom { height:38px; line-height:38px; background:#000; color:#999; }
.top a { color:#ccc; }
.top .tw { float:left; }
.top .join { float:left; padding-left:20px; }
.top .by { float:right; }
.main { width:800px; margin:0 auto; overflow:visible; }
.main .logo { text-align:center; }
.main .header { width:800px; }
.main .header img { float:left; }
.main .header .tip { float:left; width:500px; padding:20px 0; font-size:14px; }
.main .header .tip strong { color:red; }
.main .header .nav{clear:both;height:30px;line-height:30px;font-size:14px;padding-left:20px;}
.main .header .nav li{float:left;padding:0 16px;}
.main .header .nav li.cur{background:#888;}
.main .header .nav li a{color:#888;}
.main .header .nav li a:hover{color:#333; text-decoration:none;}
.main .header .nav li.cur a,.main .header .nav li.cur a:hover{color:#fff;}
.main .focus { width:800px;border:2px solid #888; border-left:0; border-right:0; padding:4px 0 26px; overflow:visible;}
.main .focus p { color:#999; }
.main .set { margin-top:10px; position:relative;}
.main .set .right{color:#999;position:absolute;right:0;top:-6px;z-index:9;}
.main .set div p{ margin-bottom:10px;height:26px;line-height:26px;float:left;margin-right:10px; white-space:nowrap;display:none;}
.main .set .base p,.main .set #adv p{display:inline;}
.main .set .style { float:none;font-size:14px; line-height:28px; padding:6px 0 16px; border-bottom:1px solid #ccc; position:relative; background:#FFF; }
.main .set .style input { width:70px; margin-right:10px; }
.main .set .style span{position:absolute;top:4px;right:180px;font-size:12px;color:red;}
.main .set .style button { height:30px; width:120px; line-height:24px; position:absolute; left:390px; top:2px; font-weight:bold; }
.main .set .h4,.main .set #adv .h4{ float:none; color:#666; margin:0 0 10px 0;}
.main .set .h4 span{color:red;}
.main .set span.tip { display:block; font-size:12px; line-height:20px; color:#666; padding:10px; background:#f1f1f1; margin:10px 0; }
.main .set input { width:60px; }
.main .set input.def { width:80px; }
.main .set .oth{clear:both;}
.main .set .oth *{color:blue;}
.main .set #adv { display:none; }
.main .set #adv-btn { line-height:18px; height:24px; padding:0 10px; }
.bottom { margin-top:30px; }

</style>
<script type="text/javascript" src="/js/myfocus-1.2.0.full.js"></script><!--引入myFocus库-->
</head>
<?php
if($_GET['pattern'] == ''){
	$_GET['pattern'] =$config['ifocus_pattern'];
}
if($_GET['width'] == ''){
	$_GET['width'] = $config['ifocus_width'];
}
if($_GET['height'] == ''){
	$_GET['height'] = $config['ifocus_height'];
}
if($_GET['time'] == ''){
	$_GET['time'] = $config['ifocus_time'];
}
if($_GET['number'] == ''){
	$_GET['number'] = $config['ifocus_number'];
}
$_GET['number'] = intval($_GET['number']);
if($_GET['number'] > 10){
    $_GET['number'] = 10;
}
?>
<body>
    <div id="myFocus-wrap">
    <div id="myFocus" style="visibility:hidden"><!--焦点图盒子-->
      <div class="loading"><span>请稍候...</span></div><!--载入画面-->
      <ul class="pic"><!--内容列表-->
       <?php for($i=1;$i<=$_GET['number'];$i++): ?>
        <li><a href="<?php echo $config['ifocus_pic'.$i.'_url'];?>"><img src="<?php echo $config['ifocus_pic'.$i];?>" thumb="" alt="<?php echo $config['ifocus_pic'.$i.'_title'];?>" text="<?php echo $config['ifocus_pic'.$i.'_title'];?>" /></a></li>
       <?php endfor; ?>
      </ul>
    </div>
    </div>
    <div class="clear"></div>
<script type="text/javascript">
var mf=myFocus;//简称
var html=mf.$('myFocus-wrap').innerHTML;//保存原html
function getParam(){//获取全部参数
	return {
		id:'myFocus',
		pattern:'<?php echo addslashes($_GET['pattern']); ?>',
		time:<?php echo "'".addslashes($_GET['time'])."'"; ?>,
		width:<?php echo "'".addslashes($_GET['width'])."'"; ?>,
		height:<?php echo "'".addslashes($_GET['height'])."'";?>
	};
}
function reHTML(){//还原
	mf.$('myFocus-wrap').innerHTML=html;
	var css=mf.$$('style')[0];
	css.parentNode.removeChild(css);
};
function displayParam(){//额外参数显示
	/*var s=mf.$('pattern');
	var st=mf.pattern[s.value]['cfg'];
	var ps=mf.$$('p','oth'),len=ps.length;
	for(var i=0;i<len;i++) ps[i].style.display='';
	if(st) for(var p in st) mf.$('p-'+p).style.display=mf.$('custom').style.display='inline';*/
}
function apply(){//应用
	reHTML();//还原
	var p=getParam();//获取参数
	p.waiting=false;//不等待图片加载
	myFocus.set(p,true,function(){
		displayParam();//显示额外参数
	});
}
//开始设置
myFocus.set(getParam(),true,function(){
	displayParam();//显示额外参数
});
</script>
</body>
</html>
