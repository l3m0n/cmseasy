<div class="blank10"></div>
<div id="tagscontent" class="right_box">
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<div style="height:40px; line-height:40px;"> <input name="ctname" type="text" id="ctname" placeholder="请输入员工姓名" class="input" value="<?php echo front::$get['ctname'];?>" /> <input name="num" type="hidden" id="num" value="1" /> <input id="btn_add" type="button" value=" 获取邀请码 " class="btn_a" /></div>
<div class="blank30"></div>
    <table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
      <thead>
        <tr class="th">
          <th align="center"><!--id-->编号</th>
          <th align="center"><!--name-->邀请码</th>
          <th align="center">生成人</th>
          <th align="center"><!--url-->生成时间</th>
          <th align="center"><!--url-->注册人</th>
          <th align="center"><!--url-->注册时间</th>
          <th align="center"><!--url-->是否使用</th>
          <th align="center">操作</th>
        </tr>

</thead>
<tbody>
{loop $data $d}
<tr class="s_out" onmouseover="m_over(this)" onmouseout="m_out(this)" lang="0">

<td align="center" >{$d['inviteid']}</td>
<td align="center">{$d['invitecode']}</td>
<td align="center">{$d['ctname']}</td>
<td align="center">{$d['cttime']}</td>
<td align="center">{$d['regname']}</td>
<td align="center">{$d['regtime']}</td>
<td align="center"><?php echo $d['isuse']?'是':'否';?></td>
<td align="center"><span class="hotspot" onmouseover="tooltip.show('确定要删除吗？');" onmouseout="tooltip.hide();"><a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo url('invite/del/id/'.$d['inviteid']);?>" class="a_del"></a></td>
</tr>
{/loop}
      </tbody>
    </table>
</form>
</div>
<script>
$(function(){
	$('#btn_add').click(function(e) {
        $('#listform').attr('action','<?php echo url('invite/add',true);?>');
		$('#listform').submit();
    });
});
</script>