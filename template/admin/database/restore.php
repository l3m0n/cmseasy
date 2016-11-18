<div class="blank20"></div>
<div id="message_a">欢迎来到数据库还原页面，您对网站数据还原。<a href="#" onclick="javascript:turnoff('message_a')">&nbsp;(×)</a></div>
<div class="blank10"></div>

<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
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
            <input type="button" onclick="javascript:if(confirm('确实要 【恢复】 备份档案 ( {$dir} ) 吗?' )) location.href='<?php echo url('database/dorestore/db_dir/'.$dir);?>';"  class="btn_d" value=" 还原 " />
           </td>
        </tr>
       {/loop}

      </tbody>
    </table>
</div>

    <div class="blank20"></div>
    <input type="submit" name="submit" value=" × 删除 " onclick="return getSelect(this.form) && confirm('确实要 【删除】 备份档案 ( '+getSelect(this.form)+' ) 吗?');" class="btn_b" />
 


</form>