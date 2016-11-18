<form name='formxmlmap' method='post' action='<?php echo url('cache/make_google') ?>'>
<div id="tagscontent" class="right_box">

<div style="line-height:200%; padding:20px;">
提交sitemap一是有利于搜索抓取一些正常抓取过程中无法抓取的网址，比如动态网页，包含大量AJAX的网页或者flash的页面。二是为搜索蜘蛛指明“工作方向”。Sitemap就是你网站上页面的列表，googlebot就按照这个去一个个的抓取收录页面，显然比它自己去找会效率高，而且要全。
<div class="blank20"></div>
XML生成地址为 <a href="{get(site_url)}sitemaps.xml" target="_blank">{get(site_url)}sitemaps.xml</a>

<div class="blank20"></div>
<input name='submit' type='submit' id='submit' value='生成' class="btn_a">
</div>
</div>

</form>