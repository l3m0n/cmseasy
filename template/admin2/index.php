<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<link rel="icon" href="{$base_url}/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="{$base_url}/favicon.ico" type="image/x-icon" />
<title><?php echo get('sitename');?> - 后台管理中心 - Powered by CmsEasy</title>
<!-- 调用样式表 -->
<script type="text/javascript" src="{$skin_path}/js/jquery-1.8.3.min.js"></script>
<link href="{$skin_path}/css/admin.css" rel="stylesheet" type="text/css" />
<link title="skin1" href="{$skin_path}/css/admin_style_a.css" type="text/css" rel="alternate stylesheet" disabled />
<link title="skin2" href="{$skin_path}/css/admin_style_b.css" type="text/css" rel="stylesheet"/>
<link title="skin3" href="{$skin_path}/css/admin_style_c.css" type="text/css" rel="stylesheet"/>


<script language="javascript" type="text/javascript">
function killerrors()
{
return true;
}
window.onerror = killerrors;
</script>
</head>
<body class="slide slide3 s1">
<!-- 头部 -->
<div class="icons">
<a onclick="setActiveStyleSheet('skin1'); return false;" href="#"><img src="{$skin_path}/images/bg_1.gif" /></a>
<a onclick="setActiveStyleSheet('skin2'); return false;" href="#"><img src="{$skin_path}/images/bg_2.gif" /></a>
<a onclick="setActiveStyleSheet('skin3'); return false;" href="#"><img src="{$skin_path}/images/bg_3.gif" /></a>

</div> 

<div class="box">
<div id="header">
<a href="{$base_url}/"><img src="{$skin_path}/images/logo.png" class="logo" /></a>
<div class="top_right">
<ul>
<li><span>您好，<strong>{$user.username}！</strong> [<a href="{$base_url}/index.php?case=index&act=logout&admin_dir={config::get('admin_dir')}">退出</a>]</span></li>
<li><a href="http://www.cmseasy.cn/" target="_blank">官方网站</a> | <a href="http://www.cmseasy.cn/service/" target="_blank">商业授权</a> | <a href="http://www.cmseasy.org" target="_blank">问题交流</a> | <a href="http://www.cmseasy.cn/chm/" target="_blank">在线教程？</a></li>
</ul>
</div>
</div>

<div id="nav">
<div class="nav_bg">
<div class="nav">
<ul>
<?php $menu=admin_menu::top(); ?>
{loop $menu $n $m}
<?php
preg_match('/mod=(\w+)&/is',$m,$m1);
$class = $m1[1] == session::get('mod')?'on':'no';
$m1[1] == session::get('mod')?session::set('modname',$n):'';
?>
<li class="{$class}"><a href="{$m}">{$n}</a></li>
{/loop}
</ul>

<select id="website" name="website" onchange="javascript:window.open(this.options[this.selectedIndex].value)">
<option value="default">默认站点管理</option>
{loop getwebsite() $d}
<option value="{$d[addr]}">{$d[name]}管理</option>
{/loop}
</select>
</div>
</div>
</div>

<div id="c">
<div id="left">
<div id="menu">
<?php $menu=admin_menu::get(); $i=$j=$k=0; $class1 = '';?>
{if $menu}
{loop $menu $ns $ms}
<?php
if($ns == '网站设置' && !chkpower('sitesystem')){
	continue;
}
if($ns == '多站点设置' && !chkpower('website')){
	continue;
}
if($ns == '栏目管理' && !chkpower('category')){
	continue;
}
if($ns == '内容管理' && !chkpower('archive')){
	continue;
}
if($ns == '分类管理' && !chkpower('mtype')){
	continue;
}
if($ns == '专题管理' && !chkpower('special')){
	continue;
}
if($ns == '用户管理' && !chkpower('user_manage')){
	continue;
}
if($ns == '用户组管理' && !chkpower('user_group')){
	continue;
}
if($ns == '推广联盟' && !chkpower('user_union')){
	continue;
}
if($ns == '生成管理' && !chkpower('cache_manage')){
	continue;
}
if($ns == '订单管理' && !chkpower('order_manage')){
	continue;
}
if($ns == '数据管理' && !chkpower('func_data')){
	continue;
}
if($ns == '投票管理' && !chkpower('func_ballot')){
	continue;
}
if($ns == '留言评论' && !chkpower('func_book')){
	continue;
}
if($ns == '公告管理' && !chkpower('func_announc')){
	continue;
}

if($ns == '标签列表' && !chkpower('templatetag_list')){
	continue;
}
if($ns == '添加标签' && !chkpower('templatetag_add')){
	continue;
}
if($ns == '模板管理' && !chkpower('template_manage')){
	continue;
}
if($ns == '数据统计' && !chkpower('seo_status')){
	continue;
}
if($ns == '内容链接管理' && !chkpower('seo_linkword')){
	continue;
}
if($ns == '友情链接管理' && !chkpower('seo_friendlink')){
	continue;
}
if($ns == '邮件管理' && !chkpower('seo_mail')){
	continue;
}
if($ns == '自定义表单' && !chkpower('defined_form')){
	continue;
}
if($ns == '自定义字段' && !chkpower('defined_field')){
	continue;
}
if($ns == '论坛专题' && !chkpower('bbs_category')){
	continue;
}
if($ns == '帖子管理' && !chkpower('bbs_archive')){
	continue;
}
?>
<h5 class="h5_{=$i+1}">{$ns}</h5>
<dl class="l_{=$j+1}">
{if $ns != '系统信息'}
{loop $ms $n $m}
<?php
	if($n == '网站配置' && !chkpower('system')){
	   continue;
	}
	if($n == '水印设置' && !chkpower('system')){
	   continue;
	}
	if($n == '附件设置' && !chkpower('system')){
	   continue;
	}
	if($n == '字符过滤' && !chkpower('system')){
	   continue;
	}
	if($n == '邮件发送' && !chkpower('system')){
	   continue;
	}
	if($n == '统计配置' && !chkpower('system')){
	   continue;
	}
	if($n == '内容推荐' && !chkpower('setting_archive')){
	   continue;
	}
	if($n == '热门标签' && !chkpower('system')){
	   continue;
	}
	if($n == '语言包编辑' && !chkpower('language')){
	   continue;
	}
	if($n == '幻灯片设置' && !chkpower('system')){
	   continue;
	}
	if($n == '内页切换图片' && !chkpower('system')){
	   continue;
	}
	if($n == '焦点图设置' && !chkpower('system')){
	   continue;
	}
	if($n == '短信设置' && !chkpower('sms')){
	   continue;
	}
	if($n == '短信管理' && !chkpower('sms')){
	   continue;
	}
	if($n == '地图设置' && !chkpower('system')){
	   continue;
	}
	if($n == '站点列表' && !chkpower('website_list')){
		continue;
	}
	if($n == '增加站点' && !chkpower('website_add')){
		continue;
	}
	
	if($n == '栏目管理' && !chkpower('category_list')){
		continue;
	}
	if($n == '添加栏目' && !chkpower('category_add')){
		continue;
	}
	if($n == '栏目URL规则' && !chkpower('category_htmlrule')){
		continue;
	}
	
	if($n == '图片管理' && !chkpower('archive_image')){
		continue;
	}
	if($n == '热门关键词' && !chkpower('archive_hotsearch')){
		continue;
	}
	if($n == '推荐位设置' && !chkpower('archive_setting')){
		continue;
	}
	if($n == '审核内容' && !chkpower('archive_check')){
		continue;
	}
	if($n == '添加内容' && !chkpower('archive_add')){
		continue;
	}
	if($n == '内容列表' && !chkpower('archive_list')){
		continue;
	}
	
	if($n == '添加分类' && !chkpower('type_add')){
		continue;
	}
	if($n == '分类管理' && !chkpower('type_list')){
		continue;
	}
	
	if($n == '添加专题' && !chkpower('special_add')){
		continue;
	}
	if($n == '专题管理' && !chkpower('special_list')){
		continue;
	}
	if($n == '用户管理' && !chkpower('user_list')){
		continue;
	}
	if($n == '添加用户' && !chkpower('user_add')){
		continue;
	}
	if($n == '登录配置' && !chkpower('user_ologin')){
		continue;
	}
	
	if($n == '用户组管理' && !chkpower('usergroup_list')){
		continue;
	}
	if($n == '添加用户组' && !chkpower('usergroup_add')){
		continue;
	}
	
	if($n == '联盟用户' && !chkpower('union_list')){
		continue;
	}
	if($n == '结算记录' && !chkpower('union_pay')){
		continue;
	}
	if($n == '访问统计' && !chkpower('union_visit')){
		continue;
	}
	if($n == '注册统计' && !chkpower('union_reguser')){
		continue;
	}
	if($n == '联盟配置' && !chkpower('union_config')){
		continue;
	}
	
	if($n == '内容Html生成' && !chkpower('cache_content')){
		continue;
	}
	if($n == '栏目Html生成' && !chkpower('cache_category')){
		continue;
	}
	if($n == '首页Html生成' && !chkpower('cache_index')){
		continue;
	}
	if($n == '分类Html生成' && !chkpower('cache_type')){
		continue;
	}
	if($n == '专题Html生成' && !chkpower('cache_special')){
		continue;
	}
	if($n == '地区Html生成' && !chkpower('cache_area')){
		continue;
	}
	if($n == '标签Html生成' && !chkpower('cache_tag')){
		continue;
	}
	if($n == 'Baidu地图生成' && !chkpower('cache_baidu')){
		continue;
	}
	if($n == 'Google地图生成' && !chkpower('cache_google')){
		continue;
	}
	
	if($n == '订单列表' && !chkpower('order_list')){
		continue;
	}
	if($n == '支付配置' && !chkpower('order_pay')){
		continue;
	}
	if($n == '配货配置' && !chkpower('order_logistics')){
		continue;
	}

	if($n == '备份数据库' && !chkpower('func_data_baker')){
		continue;	
	}
	if($n == '还原数据库' && !chkpower('func_data_restore')){
		continue;	
	}
	if($n == '导入PHPweb数据' && !chkpower('func_data_phpweb')){
		continue;	
	}
	if($n == '替换字符串' && !chkpower('func_data_replace')){
		continue;	
	}
	if($n == '日志管理' && !chkpower('func_data_adminlogs')){
		continue;	
	}
	if($n == '网站安全' && !chkpower('func_data_safe')){
		continue;	
	}
	if($n == '添加投票' && !chkpower('func_ballot_add')){
		continue;	
	}
	if($n == '投票管理' && !chkpower('func_ballot_list')){
		continue;	
	}
	if($n == '留言管理' && !chkpower('func_book_list')){
		continue;	
	}
	if($n == '评论管理' && !chkpower('func_book_pllist')){
		continue;	
	}
	if($n == '公告管理' && !chkpower('func_announc_list')){
		continue;	
	}
	if($n == '添加公告' && !chkpower('func_announc_add')){
		continue;	
	}
	
	if($n == '函数标签' && !chkpower('templatetag_list_function')){
		continue;
	}
	if($n == '系统标签' && !chkpower('templatetag_list_system')){
		continue;
	}
	if($n == '内容标签' && !chkpower('templatetag_list_content')){
		continue;
	}
	if($n == '栏目标签' && !chkpower('templatetag_list_category')){
		continue;
	}
	if($n == '自定义标签' && !chkpower('templatetag_list_define')){
		continue;
	}
	if($n == '添加内容标签' && !chkpower('templatetag_add_content')){
		continue;
	}
	if($n == '添加栏目标签' && !chkpower('templatetag_add_category')){
		continue;
	}
	if($n == '添加自定义标签' && !chkpower('templatetag_add_define')){
		continue;
	}
	if($n == '模板选择' && !chkpower('template_set')){
		continue;
	}
	if($n == '模板结构' && !chkpower('template_note')){
		continue;
	}
	if($n == '当前模板编辑' && !chkpower('template_edit')){
		continue;
	}
	if($n == '蜘蛛统计' && !chkpower('seo_status_spider')){
		continue;
	}
	if($n == 'CNZZ全景统计' && !chkpower('seo_status_cnzz')){
		continue;
	}
	if($n == '添加链接' && !chkpower('seo_linkword_add')){
		continue;
	}
	if($n == '链接管理' && !chkpower('seo_linkword_list')){
		continue;
	}
	if($n == '添加友情链接' && !chkpower('seo_friendlink_add')){
		continue;
	}
	if($n == '友情链接管理' && !chkpower('seo_friendlink_list')){
		continue;
	}
	if($n == '友情链接配置' && !chkpower('seo_friendlink_setting')){
		continue;
	}
	if($n == '会员邮件群发' && !chkpower('seo_mail_usersend')){
		continue;
	}
	if($n == '发送邮件' && !chkpower('seo_mail_send')){
		continue;
	}
	if($n == '订阅邮件群发' && !chkpower('seo_mail_subscription')){
		continue;
	}
	
	if($n == '添加表单' && !chkpower('defined_form_add')){
		continue;
	}
	if($n == '管理表单' && !chkpower('defined_form_list')){
		continue;
	}
	if($n == '添加内容字段' && !chkpower('defined_field_content_add')){
		continue;
	}
	if($n == '内容字段' && !chkpower('defined_field_content')){
		continue;
	}
	if($n == '添加用户字段' && !chkpower('defined_field_user_add')){
		continue;
	}
	if($n == '用户字段' && !chkpower('defined_field_user')){
		continue;
	}
	if($n == '专题管理' && !chkpower('bbs_category_list')){
		continue;
	}
	if($n == '批量删帖' && !chkpower('bbs_archive_batdel')){
		continue;
	}
preg_match('/act=(\w+)&/is',$m,$m2);
preg_match('/table=(\w+)&/is',$m,$m3);
preg_match('/set=(\w+)&/is',$m,$m4);
preg_match('/tagfrom=(\w+)&/is',$m,$m5);
preg_match('/item=(\w+)&/is',$m,$m6);
preg_match('/needcheck=(\w+)&/is',$m,$m7);
if(front::get('case')=='config' && front::get('act')=='system' &&  $m4[1] == session::get('set')){
	session::set('actname',$n);
	$class1 = 'on';
}elseif(front::get('case')=='config' && front::get('act')==$m2[1] && $m2[1] == 'hottag'){
	session::set('actname',$n);
	$class1 = 'on';
}elseif($m2[1] == session::get('act') && $m3[1] == session::get('table') && session::get('table')!=''){
	session::set('actname',$n);
	$class1 = 'on';
}elseif(front::get('case')=='form' && $m2[1] == session::get('act')){
	session::set('actname',$n);
	$class1 = 'on';
}elseif(front::get('case')=='template' && $m2[1] == session::get('act')){
	session::set('actname',$n);
	$class1 = 'on';
}elseif(front::get('case')=='index' && front::get('act')=='index' && front::get('mod')==''){
	session::set('actname','首页面板');
}elseif(front::get('case')=='cache'){
	session::set('actname','生成操作');
}elseif(front::get('case')=='config' && $m4[1] == session::get('set')){
    session::set('actname',$n);
	$class1 = 'on';
}elseif(front::get('item') && $m6[1] == session::get('item')){
	session::set('actname',$n);
	$class1 = 'on';
}elseif(front::get('case')=='language' && $m2[1] == session::get('act')){
	session::set('actname',$n);
	$class1 = 'on';
}elseif(front::get('case')=='website' && $m2[1] == session::get('act')){
	session::set('actname',$n);
	$class1 = 'on';
}elseif(front::get('case')=='database' && $m2[1] == session::get('act')){
	session::set('actname',$n);
	$class1 = 'on';
}elseif(front::get('case')=='sms' && $m2[1] == session::get('act')){
	session::set('actname',$n);
	$class1 = 'on';
}elseif(front::get('case')=='safe' && $m2[1] == session::get('act')){
	session::set('actname',$n);
	$class1 = 'on';
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

if($m3[1] == 'templatetagwap' && !($m2[1] == front::get('act') && $m5[1] == front::get('tagfrom'))){
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
?>

<dd class="m{=$j++} {$class1}"><a href="{$m}" {if $n=='CNZZ站长统计' || $n=='网站安全'}target="_blank"{/if}><span class="d{=$k++}">{$n}</span></a></dd>
{/loop}
<?php $i++;?>
<?php $j++;?>
<?php $k++;?>
{/if}
</dl>
{/loop}
{else}
无可用操作
{/if}
</div>
</div>

<div id="right">
<div class="right">
<div id="position">
<div class="position">
<a href="{$base_url}/index.php?admin_dir={get('admin_dir')}&site=default" title="后台首页">首页</a>
<span><?php echo session::get('modname');?></span>
<span><?php echo session::get('actname');?></span>
<?php if(front::get('deletestate')) echo ' ><span>回收站</span>'; if(front::get('needcheck')) echo ' ><span>待审核内容</span>'; ?>
</div>
<div class="quick">

<a href="{$base_url}/"  target="_blank">网站首页</a>
<a href="{url::create('index/index/mod/cache')}">生成静态</a>
<a href="index.php?case=table&act=add&table=archive&admin_dir={get('admin_dir')}">添加内容</a>
<a href="{url::create('config/remove')}" class="on">更新缓存</a>
</div>
</div>


<div id="right_box">

<script type="text/javascript">
<!--
function table(o,a,b,c,d){
	if(!document.getElementById(o)){ return; }
 var t=document.getElementById(o).getElementsByTagName("tr");
 for(var i=0;i<t.length;i++){
  t[i].style.backgroundColor=(t[i].sectionRowIndex%2==0)?a:b;
  t[i].onclick=function(){
   if(this.x!="1"){
    this.x="1";
    this.style.backgroundColor=d;
   }else{
    this.x="0";
    this.style.backgroundColor=(this.sectionRowIndex%2==0)?a:b;
   }
  }
  t[i].onmouseover=function(){
   if(this.x!="1")this.style.backgroundColor=c;
  }
  t[i].onmouseout=function(){
   if(this.x!="1")this.style.backgroundColor=(this.sectionRowIndex%2==0)?a:b;
  }
 }
}
// -->
</script>

<?php
$this->render();
?>

<script type="text/javascript">
<!--
//table("表格名称","奇数行背景","偶数行背景","鼠标经过背景","点击后背景");
table("table1","#F5F5F5","#F9F9F9","#FFFFF0","#F5F5F5");
table("table2","#F5F5F5","#F9F9F9","#FFFFF0","#F5F5F5");
table("table3","#F5F5F5","#F9F9F9","#FFFFF0","#F5F5F5");
table("table4","#F5F5F5","#F9F9F9","#FFFFF0","#F5F5F5");
table("table5","#F5F5F5","#F9F9F9","#FFFFF0","#F5F5F5");
table("table6","#F5F5F5","#F9F9F9","#FFFFF0","#F5F5F5");
table("table7","#F5F5F5","#F9F9F9","#FFFFF0","#F5F5F5");
table("table8","#F5F5F5","#F9F9F9","#FFFFF0","#F5F5F5");
table("table9","#F5F5F5","#F9F9F9","#FFFFF0","#F5F5F5");
// -->
</script>

<div class="clear"></div>
</div>
</div>

<div class="right_bottom">
<span></span>
</div>
</div>

<div id="footer">
</div>
</div>
<div class="clear"></div>
</div>

<div class="blank30"></div>
<div class="copy">
Copyright ©  <?php echo date('Y'),'  ',get('sitename');?><div class="copyright">Powered by <a href="http://www.cmseasy.cn" title="CmsEasy企业网站系统" target="_blank">CmsEasy</a></div>
</div>
<div class="blank30"></div>
<?php if(hasflash()) { ?>
<div id='message'><div id='message_bg'><img src="{$skin_path}/images/ico_11.gif" />&nbsp;<?php echo showflash(); ?>
<a href="#" onclick="javascript:turnoff('message')">&nbsp;<span style='color:red;'>(×)</span></a> 
</div><div id='message_bt'></div>
</div><?php } ?>

<script type="text/javascript">
<!--
	function lick(){
	    $("#message").hide();
}
window.setTimeout("lick()",3000);
//-->
</script>

<script type="text/javascript" language="javascript" src="{$skin_path}/js/script.js"></script>
<script language="javascript" type="text/javascript" src="{$skin_path}/js/admin.js"></script>
<script language='JavaScript'>
//去掉虚线框
function bluring(){
if(event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG") document.body.focus();
}
document.onfocusin=bluring;
</script>
<script type="text/javascript">

//点击关闭提示信息层
function turnoff(obj){
document.getElementById(obj).style.display="none";
}
//省市区
$(document).ready(function() {
	$('#search_province_id').change(function(){
		$.ajax({
			url: '<?php echo url('area/city_option_search',false);?>',
			data:'province_id='+$(this).val(),
			type: 'POST',
			dataType: 'html',
			timeout: 10000,
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
			timeout: 10000,
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
				timeout: 10000,
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
				timeout: 10000,
				success: function(data){
					$('#section_id').html(data);
				}
			});
		});
	});
});
</script>

<script type="text/javascript" src="{$skin_path}/js/styleswitcher.js"></script>
</body>
</html>