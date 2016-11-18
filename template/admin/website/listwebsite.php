
<div class="blank20"></div>
<a href="index.php?case=website&act=addwebsite&admin_dir={get('admin_dir')}&site=default"  class="btn_c">增加站点</a>
<div class="blank10"></div>
<div id="tagscontent" class="right_box">
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">


    <table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
      <thead>
        <tr class="th">
          <th align="center"><!--id-->编号</th>
          <th align="center"><!--name-->站点</th>
          <th align="center"><!--url-->地址</th>
          <th align="center">操作</th>
        </tr>

</thead>
<tbody>
{loop $data $d}
<tr class="s_out" onmouseover="m_over(this)" onmouseout="m_out(this)">

<td align="center" >{$d['id']}</td>
<td align="left" style="padding-left:10px;">{$d['name']}</td>
<td align="left" style="padding-left:10px;">{$d['url']}</td>

<td align="center">
<span class="hotspot" onmouseover="tooltip.show('切换管理网站内容');" onmouseout="tooltip.hide();"><a href="{$d['url']}index.php?case=admin&act=remotelogin&admin_dir={$d['admindir']}&args={$d['args']}&submit=1" target="_blank" class="a_management"></a></span>
<span class="hotspot" onmouseover="tooltip.show('点击编辑网站设置');" onmouseout="tooltip.hide();"><a href="<?php echo modify("act/editwebsite/id/".$d['path']);?>" class="a_edit"></a></span>
<span class="hotspot" onmouseover="tooltip.show('删除这个网站？');" onmouseout="tooltip.hide();"><a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/deletewebsite/id/".$d['path']);?>" class="a_del"></a></span>
</td>
</tr>
{/loop}


      </tbody>
    </table>



</form>
</div>