<div class="blank10"></div>
<div id="tagscontent" class="right_box">
  <form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
  <input type="hidden" name="wid" id="wid" value="<?php echo intval(front::get('id'));?>" />
    <table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
      <thead>
        <tr class="th">
          <th align="center">编号</th>
          <th align="center">排序</th>
          <th align="center">名称</th>
          <th align="center">类型</th>
          <th align="center">操作</th>
        </tr>
      </thead>
      <tbody>
      {loop $data $d}
      <tr class="s_out" onmouseover="m_over(this)" onmouseout="m_out(this)" lang="0">
        <td align="center" >{$d['id']}</td>
        <td align="center"><input type="text" name="sort[{$d['id']}]" value="{$d['sort']}" class="input_c" /></td>
        <td align="left"><input type="text" name="name[{$d['id']}]" value="{$d['name']}"class="input" /></td>
        <td align="left">{weixinmenu::getTypeName($d['typeid'])}</td>
        <td align="center"><span class="hotspot" onmouseover="tooltip.show('点击编辑设置！');" onmouseout="tooltip.hide();"><a  href="<?php echo url('weixinmenu/edit/id/'.$d['id']);?>" class="a_edit"></a></span>
		<span class="hotspot" onmouseover="tooltip.show('确定要删除吗？');" onmouseout="tooltip.hide();"><a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo url('weixinmenu/del/wid/'.intval(front::$get['id']).'/id/'.$d['id']);?>" class="a_del"></a></span>
		<span class="hotspot" onmouseover="tooltip.show('添加子菜单！');" onmouseout="tooltip.hide();"><a href="<?php echo url('weixinmenu/add/wid/'.intval(front::$get['id']).'/pid/'.$d['id']);?>" class="a_add_category"></a></span>
		</td>
      </tr>
      <?php
	  $weixinmenu = new weixinmenu();
	  $submenus = $weixinmenu->getsubmenu($d['id']);
	  if(is_array($submenus) && !empty($submenus)){
		  foreach($submenus as $submenu){
	  ?>
      <tr class="s_out" onmouseover="m_over(this)" onmouseout="m_out(this)" lang="0">
        <td align="center" >{$submenu['id']}</td>
        <td align="center"><input type="text" name="sort[{$submenu['id']}]" value="{$submenu['sort']}" class="input_c" /></td>
        <td align="left" style="padding-left:20px;">&nbsp;└&nbsp;<input type="text" name="name[{$submenu['id']}]" value="{$submenu['name']}" class="input" /></td>
        <td align="left">{weixinmenu::getTypeName($submenu['typeid'])}</td>
        <td align="center">
		<span class="hotspot" onmouseover="tooltip.show('点击编辑设置！');" onmouseout="tooltip.hide();"><a  href="<?php echo url('weixinmenu/edit/id/'.$submenu['id']);?>" class="a_edit"></a></span>
		<span class="hotspot" onmouseover="tooltip.show('确定要删除吗？');" onmouseout="tooltip.hide();"><a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo url('weixinmenu/del/wid/'.intval(front::$get['id']).'/id/'.$submenu['id']);?>" class="a_del"></a></span>
		</td>
      </tr>
      <?php
		  }
	  }
	  ?>
      {/loop}
        </tbody>
        </table>
		  </div>
          <input name="submit" value=" 保 存 " type="submit" class="btn_a" /> <input type="button" name="button" id="button" value=" 添加一级菜单 " onclick="window.location.href='<?php echo url('weixinmenu/add/wid/'.front::get('id').'/pid/0');?>';" class="btn_a" /> <input type="button" name="button" id="button" value=" 发 布 " class="btn_a" onclick="window.location.href='<?php echo url('weixinmenu/push/wid/'.intval(front::$get['id']));?>';" /> <span class="hotspot" onmouseover="tooltip.show('由于微信有缓存,发布后要先取消公众号的关注,然后再重新关注公众号才会立刻看到结果.');" onmouseout="tooltip.hide();"><img src="{$base_url}/images/admin/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
	<div class="blank30"></div>
  </form>

