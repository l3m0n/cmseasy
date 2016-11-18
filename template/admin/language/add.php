{$tips}

<div class="tags" style="margin-bottom:20px;">
<div id="tagstitle">
<a class="hover"><strong>（{if config::get('lang_type')=='cn'}中文{elseif config::get('lang_type')=='en'}英文{else}{config::get('lang_type')}{/if}）包</strong></a>
</div>

<div id="tagscontent" class="right_box" style="height:383px;">


<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">


<div class="blank10"></div>

<table border="0" cellspacing="2" cellpadding="4" class="list" name="table1" id="table1" width="100%">
<thead>
 
        <tr>
          <th>中文备注</th>
          <th>调用项</th>
          <th>前台显示值</th>
        </tr>
        </thead>

<tbody id="myList" >
        

     <tr>
           <td align="center">
           <input type="text" name="cnnote" value="" class="input_d" />
           </td>
           <td align="center">
           <input type="text" name="key" value="" class="input_d" />
          </td>
           <td align="center">
           <input type="text" name="val" value="" class="input_d" />
           </td>
        </tr>
        
      </tbody>
    </table>





</div>

 
<div class="blank20"></div>
<input type="submit" value=" 增加 " name="submit" class="btn_a" />


</form></div>