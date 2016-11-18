<?php if (!defined('ADMIN')) exit('Can\'t Access !'); ?>
 
<style>
#nav li.nav1 { padding:0px 5px; background:white; border-right:2px solid #04243a; color:#04243a; }
#nav li.nav1 a {color:#04243a;}
#menu dl.l_1 dd.m0 { font-weight: bold; font-size:14px; background:#053555 url({$skin_path}/images/one_dd_hover.gif) right center no-repeat; color:white;  }


.i_box {
float:left;
border:1px solid #ccc;
border-radius: 5px;  
background:white;
text-align:left;
margin-right:30px;
}
.i_box ul {padding:20px 10px;}
.i_box ul li {
height:38px;line-height:38px;
}

#table9 tr th {
height:38px;
line-height:38px;
padding:0px 20px;
background:#eee;
color:#00bfff;
}

#table9 {width:100%;}
#table9 tr td {height:38px;line-height:38px;padding:0px 15px;border:1px solid #eee;color:#888;}
#table9 tr td a {color:#888;}

.i_box strong {color:#ff8c00;}

.i_box span {color:#00bfff;}

.q-btn {
	float:left; width:147px; height:75px; margin-right:15px;line-height:115px;text-align:center;overflow:hidden;
	border-radius: 5px 5px 5px 5px;
	border:1px solid #ccc;
	background: -moz-linear-gradient(top, #fff, #d4d4d4);
background: -webkit-linear-gradient(top,#fff,#e4e4e4);
background: -o-linear-gradient(top, #fff, #d4d4d4);

}

.btn:hover,.i_box:hover,.q-btn:hover {
border:1px solid #A5C7FE;
-moz-box-shadow:0px 0px 10px #A5C7FE;
-webkit-box-shadow:0px 0px 10px #A5C7FE;
box-shadow:0px 0px 10px #A5C7FE;
}

.q-btn a {
	display:block;
	width:147px; height:75px;
	background:url({$skin_path}/images/i_box/q-1.png) center 8px no-repeat;
}
.q-btn a.q2 {background:url({$skin_path}/images/i_box/q-2.png) center 8px no-repeat;
}
.q-btn a.q3 {background:url({$skin_path}/images/i_box/q-3.png) center 8px no-repeat;
}
.q-btn a.q4 {background:url({$skin_path}/images/i_box/q-4.png) center 8px no-repeat;
}
.q-btn a.q5 {background:url({$skin_path}/images/i_box/q-5.png) center 8px no-repeat;
}

#table9 tr td span {float:left;}
a.btn { background:#8bb9dc;line-height:24px;
padding:3px 20px;
	color:#FFF;
	font-size:1.0em;
border-radius: 3px 3px 3px 3px;
	color:white;
	text-align:center; 
	border:1px solid #A5C7FE;
	}
	#table9 tr td a.btn {color:white;}


.i_links_bg {line-height:200%; border-top:5px solid #fffbc1; padding:15px 20px;background:#fffcdf url({$skin_path}/images/i_box/vip.png) 380px 20px no-repeat;}

#information {padding:10px 20px; }
#information li {line-height:28px; padding-left:20px; background:url({$skin_path}/images/i_box/d.png) left center no-repeat;}
#information li.important {background:url({$skin_path}/images/i_box/d2.png) left center no-repeat;}

#table9 tr td a.website-a span {padding-right:10px;}

</style>

<div style="padding:30px;">




<div class="i_box" style="width:250px;">

<table border="0" cellspacing="0" cellpadding="0" name="table9" id="table9" width="100%">
<thead>
<tr>
<th colspan="2"><span>您好，<strong>{$user.username}！</strong></th>
</tr>
<tr>
<td width="40%" align="center"><a href="{$base_url}/index.php?case=table&act=list&table=archive&admin_dir={get('admin_dir')}&site=default">[ 文章 ]</a></td>
<td width="60%"><strong>{$archivenum}</strong></td>
</tr>

<tr>
<td align="center"><a href="{$base_url}/index.php?case=table&act=list&table=archive&needcheck=1&admin_dir={get('admin_dir')}&site=default">[ 待审 ]</a></td>
<td>{$unchecknum}</td>
</tr>


<tr>
<td align="center"><a href="{$base_url}/index.php?case=table&act=list&table=comment&admin_dir={get('admin_dir')}&site=default">[ 评论 ]</a></td>
<td>{$commentnum}</td>
</tr>


<tr>
<td align="center"><a href="{$base_url}/index.php?case=table&act=list&table=guestbook&admin_dir={get('admin_dir')}&site=default">[ 留言 ]</a></td>
<td>{$guestbooknum}</td>
</tr>

<tr>
<td align="center"><a href="{$base_url}/index.php?case=table&act=list&table=orders&admin_dir={get('admin_dir')}&site=default">[ 订单 ]</a></td>
<td><strong>{$ordernum}</strong></td>
</tr>

</table>

</div>


<div class="i_box" style="width:520px;">

<table border="0" cellspacing="0" cellpadding="0" name="table9" id="table9" width="100%">
<thead>
<tr>
<th colspan="2">系统环境</th>
</tr>
<tr>
<td width="25%" align="right">服务器环境：</td>
<td width="75%"><?php echo $_SERVER['SERVER_SOFTWARE'];?></td>
</tr>

<tr>
<td align="right">服务器IP：</td>
<td><?php echo $_SERVER[SERVER_ADDR];?></td>
</tr>

<tr>
<td align="right">当前网站语言：</td>
<td><?php echo config::get('lang_type');?></td>
</tr>

<tr>
<td align="right">集团网站：</td>
<td>
{loop getwebsite() $d}<a href="{$d[addr]}" target="_blank" class="website-a"><span>{$d[name]}</span></a>{/loop}
</td>
</tr>

<tr>
<td align="right">系统版本：</td>
<td><span><?php echo _VERSION;?></span>&nbsp;
&nbsp;<a href="http://info.cmseasy.cn/help/checkver.php?ver=<?php echo _VERNUM;?>" target="_blank" class="btn">检查更新</a></td>
</tr>



</table>

</div>



<div class="clear"></div>
<div class="blank30"></div>
<div class="clear"></div>

<?php $menu=admin_menu::get(); ?>
{if $menu}
{loop $menu $ns $ms}
{loop $ms $n $m}
{if $m}<div class="q-btn"><a href="{$m}" class="q{=$i+1}">{$n}</a></div>{else}{$n}{/if}
<?php $i++;?>
{/loop}
{/loop}
{/if}


<div class="clear"></div>
<div class="blank30"></div>
<div class="clear"></div>


<div class="i_box" style="width:385px;">
<table border="0" cellspacing="0" cellpadding="0" name="table9" id="table9" width="100%">
<thead>
<tr>
<th colspan="2">官方信息，以及优惠活动！</th>
</tr>
</table>
<div id="information">
</div>

<div class="i_links_bg">
[ 授权版本：<a>{htmlspecialchars_decode(stripslashes(cookie::get('passinfo')))}</a> ]<br />
[ 授权信息： <span id="__buy"><a href="http://vip.cmseasy.cn" target="_blank"><span style="color:green;">自助查询</span></a></span> ]<br />
[ 开发团队：CmsEasy Team ]<br />

</div>

</div>

<div class="i_box" style="width:385px;height:277px;">
<table border="0" cellspacing="0" cellpadding="0" name="table9" id="table9" width="100%">
<thead>
<tr>
<th colspan="2">使用指南</th>
</tr>
</table>
<div class="i_table_b">
<ul>
<li><a class="btn">设置</a>&nbsp;&nbsp;设置基本信息、网站语言、底部信息等 </li>
<li><a class="btn">模板</a>&nbsp;&nbsp;选择网站模板风格</li>
<li><a class="btn">栏目</a>&nbsp;&nbsp;配置中设置网站栏目及相关参数</li>
<li><a class="btn">营销</a>&nbsp;&nbsp;设置优化推广及其他信息</li>
<li><a class="btn">内容</a>&nbsp;&nbsp;中添加网站内容</li>
</ul>
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