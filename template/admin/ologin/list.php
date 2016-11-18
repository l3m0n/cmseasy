
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<div class="blank20"></div>
<div id="tagscontent" class="right_box">

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
      <thead>
        <tr class="th">          
          <th><!--name-->登录方式</th>
          <th><!--rate-->官方网站</th>
          <th><!--ver-->插件版本</th>
          <th>操作</th>
        </tr>

</thead>
<tbody>
{loop $data $d}

<tr class="s_out" onmouseover="m_over(this)" onmouseout="m_out(this)">


<td width="50%" style="padding-left:10px;"><strong>{$d['name']}</strong>
<span class="hotspot" onmouseover="tooltip.show('{$d['desc']}');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
</td>
<td align="center">{cut($d['website'])}</td>
<td align="center">{cut($d['version'])}</td>

<td align="center" width="70">
<?php if ($d['install']==0){?>
<span class="hotspot" onmouseover="tooltip.show('安装支付模块！');" onmouseout="tooltip.hide();">
<a href="<?php echo modify("act/install/table/$table/name/".$d['ologin_code']);?>" class="a_management"></a></span>

<?php }else{?>
<span class="hotspot" onmouseover="tooltip.show('编辑登录方式具体配置！');" onmouseout="tooltip.hide();">
<a href="<?php echo modify("act/edit/table/$table/id/".$d['id']);?>" class="a_edit"></a></span>
<span class="hotspot" onmouseover="tooltip.show('确定要删除吗？');" onmouseout="tooltip.hide();">
<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/".$d['id']);?>" class="a_del"></a></span>
<?php } ?>
</td>
</tr>
{/loop}


      </tbody>
    </table>
</div>

</form>