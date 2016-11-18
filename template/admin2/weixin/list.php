<div class="blank10"></div>
<div id="tagscontent" class="right_box">
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">


    <table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
      <thead>
        <tr class="th">
          <th align="center"><!--id-->编号</th>
          <th align="center"><!--name-->公众号名称</th>
          <th align="center">原始ID</th>
          <th align="center"><!--url-->微信号</th>
          <th align="center">操作</th>
        </tr>

</thead>
<tbody>
{loop $data $d}
<tr class="s_out" onmouseover="m_over(this)" onmouseout="m_out(this)" lang="0">

<td align="center" >{$d['id']}</td>
<td align="left">{$d['name']}</td>
<td align="left">{$d['oldid']}</td>
<td align="left">{$d['weixinid']}</td>
<td align="center">
<span class="hotspot" onmouseover="tooltip.show('账号设置！');" onmouseout="tooltip.hide();"><a  href="<?php echo url('weixin/add2/id/'.$d['id']);?>" class="a_edit"></a></span>
		<span class="hotspot" onmouseover="tooltip.show('添加自定义菜单！');" onmouseout="tooltip.hide();"><a href="<?php echo url('weixinmenu/list/id/'.$d['id']);?>" class="a_add_category"></a></span>
		<span class="hotspot" onmouseover="tooltip.show('设置自动回复！');" onmouseout="tooltip.hide();"><a href="<?php echo url('weixinreply/list/id/'.$d['id']);?>" class="a_management"></a></span>
<span class="hotspot" onmouseover="tooltip.show('确定要删除吗？');" onmouseout="tooltip.hide();"><a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo url('weixin/del/id/'.$d['id']);?>" class="a_del"></a></span>
</td>
</tr>
{/loop}
      </tbody>
    </table>
</form>
</div>