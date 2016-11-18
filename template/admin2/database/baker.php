<div class="blank20"></div>
<div id="message_a">欢迎来到数据库备份页面。您可以对网站数据备份，数据将保存在<strong style="color:red;">data</strong>文件夹中。<a href="#" onclick="javascript:turnoff('message_a')">&nbsp;(×)</a>
</div>
<div class="blank10"></div>


<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<div id="tagscontent" class="right_box">
<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
        <thead>
            <tr class="th">
           <th style="width:60px;"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /></th>
          <th>表名</th>
           <th>记录数</th>
           <th>大小</th>
        </tr>
</thead>
<tbody>
        {loop tdatabase::getInstance()->getTables() $table}
      <tr class="s_out">
           <td style="width:60px;" align="center"><input onclick="c_chang(this)" type="checkbox" value="{$table.name}" name="select[]" class="checkbox" /></td>
          <td align="left" style="padding-left:10px;">{$table.name}</td>
          <td align="left" style="padding-left:10px;">{$table.count}</td>
          <td align="left" style="padding-left:10px;">{=ceil($table['size']/1024)}K</td>
        </tr>
       {/loop}

      </tbody>
    </table>
</div>

<div class="blank20"></div>
    <?php /*兼容MySQL4<input type="checkbox" name="mysql4" value="1"> */ ?>
    &nbsp;{form::select('bagsize',0,array(0=>'请选择分卷大小...',1=>'1M',2=>'2M',5=>'5M',10=>'10M'))}
    <input type="submit" name="submit" value=" 备份 " class="btn_a" />
</form>
