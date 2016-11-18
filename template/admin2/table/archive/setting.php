<div class="blank20"></div>

<div id="tagscontent" class="right_box">

  <form name="settingform" id="settingform"  action="<?php echo uri();?>" method="post">
  

<table border="0" cellspacing="2" cellpadding="4" class="list" name="table1" id="table1" width="100%">
<tbody>
            <tr>
                <td> 
                <div  style="margin-left:10px; margin-top:10px;">                   {form::textarea('attr1',get('attr1')?get('attr1'):$settings['attr1'],'cols=50 rows=50 style="height:150px;"')}
				 <div class="blank20"></div>
                    <span>
                        <br/>每行一项，格式： (值)项，
						<br/><br/>
						<strong>如：</strong><br/>
						<br/>(0)无
                        <br/>(1)推荐位一
                        <br/>(2)推荐位二
                        <br/>(3)推荐位三
                        <br/>(4)推荐位四
                        <br/>(5)推荐位五
                    </span>
                  </div>
                </td>
            </tr>

        </tbody>
    </table>
</div>

<div class="blank20"></div>
<input type="submit" name="submit" value="提交" class="btn_a"/>
</form>


