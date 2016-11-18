<?php if (!defined('ADMIN')) exit('Can\'t Access !'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN" style="overflow-x:hidden;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<meta content="all" name="robots" />
<meta name="author" content="CmsEasy Team" />
<meta name="Copyright" content="2008-2010 CmsEasy Inc" />
<meta name="description" content="" />
<meta content="" name="keywords" />
<link rel="icon" href="{$skin_path}/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<title><?php echo get('sitename');?> - 后台管理中心 - Powered by CmsEasy</title>

<!-- 调用样式表 -->
<link rel="stylesheet" href="{$skin_path}/admin.css" type="text/css" media="all"  />
<link href="{get('site_url')}js/artDialog/skin/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{$base_url}/js/jquery.min.js"></script>
<script type="text/javascript" src="{get('site_url')}js/artDialog/artDialog.min.js"></script>
<script language="javascript" type="text/javascript" src="{$base_url}/js/admin.js"></script>
<script type="text/javascript">
function turnoff(id){
	$(id).remove();
}
function managemap(){
	art.dialog({
		id:'map',
		iframe:'{url::create('map/index/')}',
		title:'后台地图',
		width: 700,
		height: 500,
		lock:true
	});
}
function managehotsearch(){
	art.dialog({
		id:'hotsearch',
		iframe:'{url::create('index/hotsearch/')}',
		title:'热门关键词管理',
		width: 700,
		height: 500,
		lock:true
	});
}
function getcontent(type,id){
	if(type=='addballot'){
		var _url = '<?php echo modify("act/addballot/table/option/bid/'+id+'");?>';
		var _tiptext = '投票选项';
		var _height = 250;
		var _width = 700;
	}
	art.dialog({
		id:type,
		iframe:_url,
		title:_tiptext,
		width: _width,
		height: _height,
		lock:true
	});
}
function checkver(){
	art.dialog({
		id:'lastver',
		iframe:'http://info.cmseasy.cn/help/checkver.php?ver=<?php echo _VERNUM;?>',
		title:'最新程序',
		width: 400,
		height: 200,
		lock:true
	});
}
function tipsbox(tips){
	art.dialog({
		id:'tipsbox',
		content: tips,
		title:'操作提示'
	});
}
$(function(){
	$('#changewebsite').change(function(){
		var args =  $("#changewebsite").find("option:selected").val();
		if(args == 'default') return;
		window.open(args);
	});
});
</script>
<script type="text/javascript">
//省市区
$(document).ready(function() {
	$('#search_province_id').change(function(){
		$.ajax({
			url: '<?php echo url('area/city_option_search',false);?>',
			data:'province_id='+$(this).val(),
			type: 'POST',
			dataType: 'html',
			timeout: 1000,
			success: function(data){
				$('#search_city_id').html(data);
			}
		});
	});
	$('#search_city_id').change(function(){
		$.ajax({
			url: '<?php echo url('area/section_option_search',false);?>',
			data:'city_id='+$(this).val(),
			type: 'POST',
			dataType: 'html',
			timeout: 1000,
			success: function(data){
				$('#search_section_id').html(data);
			}
		});
	});
	$(document).ready(function() {
		$('#province_id').change(function(){
			$.ajax({
				url: '<?php echo url('area/city_option',false);?>',
				data:'province_id='+$(this).val(),
				type: 'POST',
				dataType: 'html',
				timeout: 1000,
				success: function(data){
					$('#city_id').html(data);
				}
			});
		});
		$('#city_id').change(function(){
			$.ajax({
				url: '<?php echo url('area/section_option',false);?>',
				data:'city_id='+$(this).val(),
				type: 'POST',
				dataType: 'html',
				timeout: 1000,
				success: function(data){
					$('#section_id').html(data);
				}
			});
		});
	});
});
</script>
<script language=javascript> 
<!-- 
if ((screen.height == 768 || screen.height == 720)) 
{ 
document.write('<style>#left {height:500px; overflow:auto;} </style>') 
} 
else {document.write('')} 
//--> 
</script>
</head>

<body>
<!-- 头部 -->

<div id="top">
<div style="background:#1b4070; width:100%; height:auto; display:block;">
<!-- 头部右侧 -->

<!-- 头部左侧 -->
<div id="logo"><a href="{$base_url}/" title="网站首页" target="_blank"><img src="{$skin_path}/logo.gif" /></a></div>

<span class="switch">
<select name="website" id="changewebsite">
  <option value="default">默认站点管理</option>
  {loop getwebsite() $d}
  <option value="{$d[addr]}">{$d[name]}管理</option>
  {/loop}
</select>
</span>

<div id="nav">
<p><span style="float:right"><a href="http://www.cmseasy.cn" target="_blank">官方网站</a> | <a href="http://www.cmseasy.cn/service_1.html" target="_blank">授权</a> | <a href="http://www.cmseasy.org" target="_blank">支持论坛</a> | <a href="http://chm.cmseasy.cn/" target="_blank">帮助？</a></span>您好，<strong>{$user.username}！</strong> [<a href="{$base_url}/index.php?case=index&act=logout&admin_dir={config::get('admin_dir')}">退出</a>]

</p>



<div class="nav">
<?php $menu=admin_menu::top(); ?>
{loop $menu $n $m}
<?php
preg_match('/mod=(\w+)&/is',$m,$m1);
$class = $m1[1] == session::get('mod')?'on':'no';
$m1[1] == session::get('mod')?session::set('modname',$n):'';
?>
<a href="{$m}" class="{$class}">{$n}</a>
{/loop}


<a href="{$base_url}/" class="home" target="_blank">网站首页</a>

</div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>

<div id="position">
<a href="javascript:managemap();">网站地图</a><a href="{url::create('index/index/mod/cache')}">生成静态</a><a href="index.php?case=table&act=add&table=archive&admin_dir={get('admin_dir')}">添加内容</a><a href="{url::create('config/remove')}">更新缓存</a><a href="http://pay.cmseasy.cn/reg.php" target="_blank">开通短信平台</a>当前位置：<?php echo session::get('modname');?>  <?php echo session::get('actname');?><?php if(front::get('deletestate')) echo ' > 回收站'; if(front::get('needcheck')) echo ' > 待审核内容'; ?>
</div>

<!-- 中部开始 -->
<div id="main">
<!-- 中部左侧开始 -->
<div id="left">
<!-- 左侧菜单 -->
<div id="menu">
<?php $menu=admin_menu::get(); $i=0; $class1 = '';?>
{loop $menu $ns $ms}
<dl>
{if $ns != '系统信息'}
<dt>{$ns}<!--<a href="javascript:opmenubox('#menubox<?php echo $i;?>','#opico<?php echo $i;?>');" title="展开与收缩" id="opico<?php echo $i;?>"><img src="{$skin_path}/jiantou.gif" /></a>--></dt>
<span id="menubox<?php echo $i;?>">
{loop $ms $n $m}
<?php
preg_match('/act=(\w+)&/is',$m,$m2);
preg_match('/table=(\w+)&/is',$m,$m3);
preg_match('/set=(\w+)&/is',$m,$m4);
preg_match('/tagfrom=(\w+)&/is',$m,$m5);
preg_match('/item=(\w+)&/is',$m,$m6);
preg_match('/needcheck=(\w+)&/is',$m,$m7);

if(front::get('case')=='config' && front::get('act')=='system' &&  $m4[1] == session::get('set')){
	session::set('actname',$n);
	$class1 = 'on';
	/*echo '<script>alert(\''.front::get('case').'|'.front::get('act').'|'.session::get('set').'\');</script>';*/
}elseif($m2[1] == session::get('act') && $m3[1] == session::get('table') && session::get('table')!=''){
	session::set('actname',$n);
	$class1 = 'on';
	/*echo '<script>alert(\'act|table|m3\');</script>';*/
}elseif(front::get('case')=='form' && $m2[1] == session::get('act')){
	session::set('actname',$n);
	$class1 = 'on';
	/*echo '<script>alert(\'case|act|m2\');</script>';*/
}elseif(front::get('case')=='template' && $m2[1] == session::get('act')){
	session::set('actname',$n);
	$class1 = 'on';
	/*echo '<script>alert(\'case|act|m2\');</script>';*/
}elseif(front::get('case')=='index' && front::get('act')=='index' && front::get('mod')==''){
	session::set('actname','首页面板');
	/*echo '<script>alert(\'case|act|mod\');</script>';*/
}elseif(front::get('case')=='cache'){
	session::set('actname','生成操作');
	/*echo '<script>alert(\'case|\');</script>';*/
}elseif(front::get('case')=='config' && $m4[1] == session::get('set')){
    session::set('actname',$n);
	$class1 = 'on';
	/*echo '<script>alert(\'case|set|m4\');</script>';*/
}elseif(front::get('item') && $m6[1] == session::get('item')){
	session::set('actname',$n);
	$class1 = 'on';
	/*echo '<script>alert(\'item|m6[1]\');</script>';*/
}elseif(front::get('case')=='language' && $m2[1] == session::get('act')){
	session::set('actname',$n);
	$class1 = 'on';
	/*echo '<script>alert(\'case|act|m2\');</script>';*/
}elseif(front::get('case')=='website' && $m2[1] == session::get('act')){
	session::set('actname',$n);
	$class1 = 'on';
	/*echo '<script>alert(\'case|act|m2\');</script>';*/
}elseif(front::get('case')=='database' && $m2[1] == session::get('act')){
	session::set('actname',$n);
	$class1 = 'on';
	/*echo '<script>alert(\'case|act|m2\');</script>';*/
}elseif(front::get('case')=='sms' && $m2[1] == session::get('act')){
	session::set('actname',$n);
	$class1 = 'on';
	/*echo '<script>alert(\'case|act|m2\');</script>';*/
}else{
	$class1 = '';
}


/*if(front::get('tagfrom')){
	session::set('actname','标签列表');
	$class1 = '';
}*/

if($m3[1] == 'templatetag' && !($m2[1] == front::get('act') && $m5[1] == front::get('tagfrom'))){
	$class1 = '';	
}

if(front::get('type')=='subscription' || session::get('act')=='send' ){
	$class1 = '';
}

if(front::get('case')=='index'){
	$class1 = '';
}

if(front::get('case') == 'table' && front::get('act') == 'list' && front::get('table') == 'archive')
{
	if($m7[1] == '1' && front::get('needcheck') != '1'){
		$class1 = '';
	}
	if($m7[1] != '1' && front::get('needcheck') == '1'){
		$class1 = '';
	}
}
/*if($class1=='on' && $i<>0){
	echo '<script type="text/javascript">
	opmenubox(\'#menubox\'+'.$i.',\'#opico\'+'.$i.');</script>';
}*/

?>
<dd class="{$class1}"><a href="{$m}" {if $n=='CNZZ站长统计'}target="_blank"{/if} class="{$class1}">{$n}</a></dd>
{/loop}
</span>
<?php $i++;?>
{/if}
</dl>
{/loop}
</div>

</div>
<!-- 中部右侧开始 -->

<div id="right">

<!-- 右侧 -->
<div class="right">
<div style="width:auto;">

<?php
if(hasflash()){
	$showmessage = showflash();
	if(strlen($showmessage)>200){
?>
<div id='message'><span style="color:red;float:left"><?php echo $showmessage; ?></span>
<span style="color:blue;float:right"><a href="#" onClick="javascript:turnoff('#message');">(×)</a></span></div><div class="blank20"></div>
<?php
    }else{
?>
<script type="text/javascript">
    $(document).ready(function(){

art.dialog({
		id:'messagebox',
		content:'<?php echo $showmessage; ?>',
		title:'系统提示',
		time: 2,
		lock:true
	});

    });
</script>
<?php
    }
}
?>

<?php
$this->render();
?>
<div class="blank20"></div>

</div>
<div class="clear"></div>

</div>

<div class="clear"></div>
</div>

</div>

<!-- 页底 -->
<div id="footer">
&copy&nbsp;{get(sitename)}&nbsp;<a href="http://www.cmseasy.cn" title="Powered by CmsEasy" target="_blank">Powered by CmsEasy</a>
</div>
</body>
</html>