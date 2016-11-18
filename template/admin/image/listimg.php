

<style>
td {width:180px;}
a.j{padding:0px 8px;}

a.pic_view {
  margin:0 auto;
  width:90%;
  height:150px;
  /*非IE的主流浏览器识别的垂直居中的方法*/
  display: table-cell;
  vertical-align:middle;
  /*设置水平居中*/
  text-align:center;
  /* 针对IE的Hack */
  *display: block;
  *font-size: 139px;/*约为高度的0.873，200*0.873 约为175*/
  *font-family:Arial;/*防止非utf-8引起的hack失效问题，如gbk编码*/
}
a.pic_view img {
  display:block;
  width:80%;
  margin:0px auto;
  vertical-align:middle;
  padding:5px;
  border:1px solid #ccc;
border-radius: 5px 5px 5px 5px;
  }

</style>
<div id="tagscontent" class="right_box">

    <table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
        <thead>
            <tr class="th">
      <th colspan="4">图片列表</th>
    </tr>
</thead>

<tbody>
<tr><td colspan="4"><div class="page">{$link_str}</div></td></tr>
<tr >
<?php $i=0;?>
{loop $list_img_arr $t}
<td align="center" style="padding-bottom:5px;">
<span class="hotspot" onmouseover="tooltip.show('查看原图');" onmouseout="tooltip.hide();">
<div class="img-wrap"><a href="upload/images/{front::get('dir')}/{$t}" target="_blank" class="pic_view"><img src="upload/images/{front::get('dir')}/{$t}"  /></a></div>
</span>
   <div style="width:62px;margin:0px auto;padding:0px auto;">
<span class="hotspot" onmouseover="tooltip.show('查看原图');" onmouseout="tooltip.hide();"><a href="upload/images/{front::get('dir')}/{$t}" target="_blank" class="a_view"></a></span>
<span class="hotspot" onmouseover="tooltip.show('删除这个图片');" onmouseout="tooltip.hide();"><a href="{url('image/deleteimg/dir/'.front::get('dir').'/imgname/'.str_replace('.','___',$t))}" class="a_del"></a></span>
   </div>
</td>
{if ++$i%4==0}
   </tr>
   <tr>
{/if}
{/loop}
</tr>

<tr><td colspan="4"><div class="page">{$link_str}</div></td></tr>
 </tbody>
</table>

   </div>