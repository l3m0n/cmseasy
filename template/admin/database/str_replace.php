<div class="blank20"></div>
<div id="message_a">您可以批量替换数据库中某字段的内容，<strong style="color:red">此操作非常危险，请谨慎使用 ! </strong><a href="#" onclick="javascript:turnoff('message_a')">&nbsp;(×)</a> </div>
<div class="blank10"></div>

<script>

    $(document).ready(function() {

        $('#stable').change(function() {
            showfield($('#stable').val());
        });

    });


    function showfield(table) {
        $.ajax({
            url: '<?php echo url('database/dbfield_select',true);?>',
            data:'&stable='+table,
            type: 'POST',
            dataType: 'json',
            timeout: 1000,
            error: function(){

            },
            success: function(data){
                $('#'+data.id).html(data.content);
            }
        });
    }
</script>

<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<div id="tagscontent" class="right_box">
<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
        <thead>
            <tr class="th">
			<th colspan="3">替换数据库字符</th>
</tr>
</thead>
<tbody>
<tr>
<td width="19%" align="right">数据表</td>
<td width="1%">&nbsp;</td>
<td width="70%">{form::select('stable',0,$tables,'style="font-size:12px"')}</td>
</tr>
<tr>
<td width="19%" align="right">把</td>
<td width="1%">&nbsp;</td>
<td width="70%">{form::textarea('replace1','','cols="50" rows="3"')}</td>
</tr>
<tr>
<td width="19%" align="right">替换成</td>
<td width="1%">&nbsp;</td>
<td width="70%">{form::textarea('replace2','','cols="50" rows="3"')}</td>
</tr>
<tr>
<td width="19%" align="right">条件</td>
<td width="1%">&nbsp;</td>
<td width="70%">{form::input('where','','size="60"')}</td>
</tr>
</table>
</div>
<div class="blank20"></div>

{form::submit()}
</form>