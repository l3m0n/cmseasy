<div class="blank20"></div>
<div id="message_a">您可以编辑模板注释，这样在分类和内容选择模板时会更方便。<a href="#" onclick="javascript:turnoff('message_a')">&nbsp;(×)</a></div>

<div class="blank10"></div>
<div id="tagscontent" class="right_box">
<script type="text/javascript" src="{$base_url}/js/list.js"></script>
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">

<div class="blank10"></div>

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<div class="page">{$link_str}</div><div class="blank10"></div>
<thead>
        <tr class="th">
          <th align="center">档案</th>
          <th align="center">名称</th>
          <th align="center">简短描述</th>
        </tr>
</thead>
<tbody>
        {loop $tps $tpl $tp}
        {php $_tp=str_replace('_html','.html',$tp);}
        {php $_tp=str_replace('_css','.css',$_tp);}
        {php $_tp=str_replace('_js','.js',$_tp);}
      <tr class="s_out">
          <td align="left" style="padding-left:10px;">{$_tp}</td>
           <td align="left" style="padding-left:10px;">
           <input type="text" name="{$tpl}_name" class="input_d" value="{=@help::$var['template_note'][$tpl.'_name']}">
           </td>
           <td align="left" style="padding-left:10px;">
           <input type="text" name="{$tpl}_note" class="input_d" value="{=@help::$var['template_note'][$tpl.'_note']}">
           </td>
        </tr>
       {/loop}

      </tbody>
    </table>
<div class="page">{$link_str}</div>
<div class="blank10"></div>
</div>

<div class="blank20"></div>
<input type="submit" value=" 修改 " name="submit" class="btn_a" />

</form>