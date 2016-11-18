<?php if (!defined('ADMIN')) exit('Can\'t Access !'); ?>
 
<div class="blank20"></div>
 
<style type="text/css">
.i_box {
  width:100%;
  height:100%;
  background:url({$skin_path}/images/i_box/i_bg.jpg) left top no-repeat;
  border:1px solid #ccc;
}

/* 横向 */
.i_info {
	clear:both;
	width:686px;
	height:174px;
	padding:0px 20px;
}

.i_info ul {height:134px;}

.i_info li,#information li {
  line-height:22px;
  padding-left:15px;
  background:url({$skin_path}/images/i_box/icon06.gif) left 9px no-repeat;
}

#information {
  height:110px;
}

#information a {color:#333;}

#i_info {
	clear:both;
	width:684px;
	height:315px;
	margin:20px 0px 0px 0px;
    padding:0px 20px;
	line-height:24px;
}
 
.homecon_title { 
	line-height:34px; 
	height:34px; 
	color:#008901;
	font-weight:bold;
	
	padding:0px 0px 0px 20px;
	background:url({$skin_path}/images/i_box/ico_11.gif) left center no-repeat;
}

.homecon_title a,.homecon_title a:hover { color:#008901; }

#i_info .t1 {
  float:left;
  width:350px;
}

.i_table_a {
  height:160px;
}

#i_info .t2 {
  float:right;
  width:320px;
}

.ms{
  margin:50px 0px 0px 0px;
  line-height:28px;
  padding:10px 10px 10px 30px;
  border:1px dotted #98C700;
  background:#EFFEB9 url({$skin_path}/images/i_box/announ.gif) 10px 16px no-repeat;
}


.i_table_b li {
  padding-left:10px;
  background:url({$skin_path}/images/i_box/dot_r.gif) left center no-repeat;
}

.i_table_b span {color:#1650AB;}

.i_links_bg {
height:121px; width:270px; padding:10px 20px; 
}

.btn_a {
  display:block;
  float:left;
  width:102px;
  height:31px;
  line-height:28px;
  margin:5px;
  color:white;
  background:url({$skin_path}/images/i_box/btn_02.gif) left top no-repeat;
  border:none;
  text-align:center;
  cursor: pointer;
  font-weight:bold;
}

#right .btn_d {
  height:22px;
  line-height:22px;
  margin:0px 2px;
  padding:0px 6px;
  background:url({$skin_path}/images/i_box/btn_04.gif) left top repeat-x;
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
  background:url({$skin_path}/images/i_box/btn_05.gif) left top repeat-x;
  border:none;
  color:white;
  font-size:12px;
  border-right:1px solid #888;
  border-bottom:1px solid #888;
}

</style>
<div style="margin:0px 20px 5px 5px;">
 <div class="i_box">
<div style="padding:15px;">
<div class="i_info">
<ul>
<li>服务器环境：<?php echo $_SERVER['SERVER_SOFTWARE'];?></li>
<li>服务器IP：<?php echo $_SERVER[SERVER_ADDR];?></li>
<li>当前网站语言：<?php echo config::get('lang_type');?></li>
<li class="i_table_b">集团网站：{loop getwebsite() $d}
<a href="{$d[addr]}" target="_blank"><span>{$d[name]}</span></a>&nbsp;
{/loop}</li>
<li><span style="float:left;">系统版本：CmsEasy <span id="__version"><?php echo _VERSION;?></span> </span>
<a href="http://info.cmseasy.cn/help/checkver.php?ver=<?php echo _VERNUM;?>" target="_blank" class="btn_e">检查更新</a></li>
</ul>

<?php $menu=admin_menu::get(); ?>
{if $menu}
{loop $menu $ns $ms}
{loop $ms $n $m}
{if $m}<a href="{$m}" class="btn_a">{$n}</a>{else}{$n}{/if}
{/loop}
{/loop}
{/if}

</div>


<div id="i_info">


<div class="t1">

<h5 class="homecon_title" style="margin-bottom:10px;">官方信息，以及优惠活动。</h5>

<div id="information">
<ul>
</ul>
</div>


<div class="i_links_bg">
[ 授权版本：<a>{htmlspecialchars_decode(stripslashes(cookie::get('passinfo')))}</a> ]<br />
[ 授权信息： <span id="__buy"><a href="http://vip.cmseasy.cn" target="_blank"><span style="color:green;">自助查询</span></a></span> ]<br />
[ 开发团队：CmsEasy Team ]<br />

</div>

</div>


<div class="t2">
<div class="ms">
您好，<strong>{$user.username}！</strong><!-- &nbsp;&nbsp;&nbsp;<span class="hotspot" onmouseover="tooltip.show('抱歉，该功能目前不提供使用！');" onmouseout="tooltip.hide();"><a>[ 查看便签！ ]</a> -->
<br />
<a href="{$base_url}/index.php?case=table&act=list&table=archive&admin_dir={get('admin_dir')}&site=default">[{$archivenum} 文章]</a>
<a href="{$base_url}/index.php?case=table&act=list&table=archive&needcheck=1&admin_dir={get('admin_dir')}&site=default">[{$unchecknum} 待审]</a>
<a href="{$base_url}/index.php?case=table&act=list&table=comment&admin_dir={get('admin_dir')}&site=default">[{$commentnum} 评论]</a>
<a href="{$base_url}/index.php?case=table&act=list&table=guestbook&admin_dir={get('admin_dir')}&site=default">[{$guestbooknum} 留言]</a>
<a href="{$base_url}/index.php?case=table&act=list&table=orders&admin_dir={get('admin_dir')}&site=default">[{$ordernum} 订单]</a>
</div>

<div style="height:15px; background:url({$skin_path}/images/i_box/line-2.gif);"></div>
<h5 class="homecon_title">快速操作网站</h5>
<div class="i_table_b">
<ul>
<li>在 <span>[设置]</span> 中进行设置基本信息、网站语言、底部信息等 </li>
<li>在 <span>[模板]</span> 中选择网站模板风格</li>
<li>在栏目配置中设置网站栏目及相关参数</li>
<li>在 <span>[营销]</span> 设置优化推广及其他信息</li>
<li><span>[内容]</span> 中添加网站内容</li>
</ul>
</div>
</div>


</div>
 </div>
 </div>
 </div>
    <script>
	   $(document).ready(function(){
	      $.get('./lib/tool/getinf.php?type=officialinf',function(data){
	          $("#information").append(data);
	      });
	   });
   </script>