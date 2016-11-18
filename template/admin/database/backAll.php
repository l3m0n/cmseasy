<br>
<script>
$(function(){
	$('#btn_zip').click(function(){
		//$(this).attr('disabled',true);
		$(this).addClass("btn_b").removeClass("btn_c");
		$('#resinfo').html('<div class="blank30"></div><img src="images/admin/loading.gif" /> 正在压缩...'); 
		$.get("{url('database/dobackAll',true)}", function(data){
		  if(data == 'ok'){
			  $('#resinfo').html('压缩完成');
			  window.location.reload();
		  }else{
			  $('#resinfo').html(data);  
		  }
		});
	});	
});
</script>
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<input id="btn_zip" type="button" name="submit" value=" 开始压缩 " class="btn_c" /> <div id="resinfo"></div>
<div class="blank20"></div>
<br>
<div id="tagscontent" class="right_box">
<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
        <thead>
            <tr class="th">
           <th><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /></th>
          <th>档案</th>
          <th>操作</th>
        </tr>
		</thead>
<tbody>
        {loop $db_dirs $dir}
      <tr class="s_out">
           <td align="center"><input onclick="c_chang(this)" type="checkbox" value="{$dir}" name="select[]" class="checkbox" /> </td>
          <td align="left" style="padding-left:10px;">{$dir}</td>
           <td align="center">
            <a href="<?php echo 'data/backup/'.$dir;?>" target="_blank"  class="btn_d">下 载</a>
           </td>
        </tr>
       {/loop}

      </tbody>
    </table>
</div>

    <div class="blank20"></div>
    <input type="submit" name="submit" value=" × 删除 " onclick="return getSelect(this.form) && confirm('确实要 【删除】 备份档案 ( '+getSelect(this.form)+' ) 吗?');" class="btn_b" />
 


</form>