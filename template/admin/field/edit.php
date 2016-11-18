

<script>
    function checktovarchar() {
        if($("#selecttype").val()=='0') {
            $(".varchar2").show("slow");
            $(".select2").hide("slow");
            $("#type").attr('value','varchar');
        }
    }
    function checktoselect() {
        $("#issearch").attr('checked',false);
        if($("#type").val()=='varchar'){
            $("#issearch").attr('disabled',false);
        }
        else
        {
            $("#issearch").attr('disabled',true);
        }
        if($("#type").val()=='0') {
            $(".select2").show("slow");
            $(".varchar2").hide("slow");
            $("#selecttype").attr('value','select');
        }
    }

    function form_preview() {
        if($("#type").val()=='0') {
            //$('#form_preview').html(get('form1').cname.value+'：<input name="'+get('form1').name.value+'" size="'+get('form1').len.value+'">');

            if($("#selecttype").val()=='select') {
                select='<select name="'+get('form1').name.value+ '">';
                subject=get('form1').select.value;
                var myregexp = /\(([\d\w]+)\)(\S+)/mg;
                var match = myregexp.exec(subject);
                while (match != null) {
                    select += '<option value="'+match[1]+'">'+match[2]+'</option>';
                    match = myregexp.exec(subject);
                }
                select +='</select>';
            }
            else {
                select='';
                subject=get('form1').select.value;
                var myregexp = /\(([\d\w]+)\)(\S+)/mg;
                var match = myregexp.exec(subject);
                while (match != null) {

                    if($("#selecttype").val()=='checkbox')
                        select += match[2]+'<input type="checkbox" value="'+match[1]+'" name="'+get('form1').name.value+ '[]">&nbsp;&nbsp;';
                    else
                        select += match[2]+'<input type="radio" value="'+match[1]+'" name="'+get('form1').name.value+ '">&nbsp;&nbsp;';
                    match = myregexp.exec(subject);
                }
            }

            $('#form_preview').html(select);
            $('#form_preview_title').html(get('form1').cname.value);
            $('#form_preview_tips').html(get('form1').tips.value);
        }
    }

    function checkform1() {
        $('#select_preview').html('');
    }


</script>
<div class="blank20"></div>

<div style="padding-left:10px;">
<a href="<?php echo modify("/act/add/table/".$table);?>" class="btn_d">添加字段</a>
<a href="<?php echo modify("/act/list/table/".$table);?>" class="btn_d">查看列表</a>
</div>

<div class="blank10"></div>

<form method="post" action="" name="form1" id="form1" onsubmit="checkform1()">

<div id="tagscontent" class="right_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">

<tbody>
 <tr>
        <td width="19%" align="right">字段名</td>
        <td width="1%">&nbsp;</td>
        <td width="70%">
	{if front::$act=='edit'}
                    <b>{$field.name}</b>
                    <input type="hidden"  name="name" id="name" value="{$field.name}" />
	{else}
                    <input size="20" name="name" id="name" value="my_"   onblur="form_preview()"/>
<span class="hotspot" onmouseover="tooltip.show('必填！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
	{/if}
                </td>
				
            </tr>
			

            <tr>
        <td width="19%" align="right">字段中文名</td>
        <td width="1%">&nbsp;</td>
        <td width="70%"><input class="input" name="cname" id="cname" value="{$data['cname']}"   onblur="form_preview()"/>
<span class="hotspot" onmouseover="tooltip.show('必填！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
</td>
            </tr>

            <tr>
        <td width="19%" align="right">提示信息</td>
        <td width="1%">&nbsp;</td>
        <td width="70%"><input class="input" name="tips" id="tips" value="<?php echo @setting::$var[$table][$field['name']]['tips'];?>"   onblur="form_preview()"/>
		<span class="hotspot" onmouseover="tooltip.show('输入框右侧说明文字！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
		</td>
            </tr>
            <?php
//phpox1104 自定义表单 添加字段
            if($table == 'archive') {
                ?>
           <tr>
        <td width="19%" align="right">绑定栏目</td>
        <td width="1%">&nbsp;</td>
        <td width="70%">{form::getform('catid',$form,$field,$data)}</td>
            </tr>
                <?php } ?>
            <tr>
        <td width="19%" align="right">是否必填</td>
        <td width="1%">&nbsp;</td>
        <td width="70%"><input type="checkbox" size="10" name="isnotnull" id="isnotnull" value="1" <?php echo @setting::$var[$table][$field['name']]['isnotnull']=='1'?'checked':''?>  onblur="form_preview()"/>
		<span class="hotspot" onmouseover="tooltip.show('是否为必填项！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
		</td>
            </tr>
        </tbody>
    </table>


    <div  class="varchar2" >
        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">

            <tbody>
               <tr>
        <td width="19%" align="right">类型</td>
        <td width="1%">&nbsp;</td>
        <td width="70%"><select name="type" id="type" onchange="checktoselect(); form_preview();">
                            <option value="int" <?php echo @setting::$var[$table][$field['name']]['type']=='int'?'selected':''?>>整数</option>
                            <option value="varchar" <?php echo @setting::$var[$table][$field['name']]['type']=='varchar'?'selected':''?>>单行文本</option>
                            <option value="text" <?php echo @setting::$var[$table][$field['name']]['type']=='text'?'selected':''?>>多行文本</option>
                            <option value="mediumtext" <?php echo @setting::$var[$table][$field['name']]['type']=='mediumtext'?'selected':''?>>超文本</option>

                            <option value="datetime" <?php echo @setting::$var[$table][$field['name']]['type']=='datetime'?'selected':''?>>日期</option>

                            <option value="_image" <?php echo @setting::$var[$table][$field['name']]['filetype']=='image'?'selected':''?>>图片</option>
                            <option value="_file" <?php echo @setting::$var[$table][$field['name']]['filetype']=='file'?'selected':''?>>附件</option>

                            <option value="0">[选择类...]</option>

                        </select>
                    </td>
                </tr>


               <tr>
        <td width="19%" align="right">长度</td>
        <td width="1%">&nbsp;</td>
        <td width="70%"><input class="input" name="len" id="len" value="{=@$field[len]}"  onblur="form_preview()"/>
<span class="hotspot" onmouseover="tooltip.show('请输入数值！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
</td>
                </tr>
                <!--phpox 加入是否搜索 start -->
               <tr>
        <td width="19%" align="right">允许搜索</td>
        <td width="1%">&nbsp;</td>
        <td width="70%"><input <?php echo @setting::$var[$table][$field['name']]['type']!='varchar'?'disabled':''?> type="checkbox" size="10" name="issearch" id="issearch" value="1" <?php echo @setting::$var[$table][$field['name']]['issearch']=='1'?'checked':''?>  onblur="form_preview()"/>
		
		<span class="hotspot" onmouseover="tooltip.show('是否允许搜索关键词,<br />只在字段类型为单行文本时有效！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
		</td>
                </tr>
                <!--phpox 加入是否搜索 end -->
            </tbody>
        </table>
    </div>

    <div class="select2" style="display:none">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">
            <tbody>
               <tr>
        <td width="19%" align="right">类型</td>
        <td width="1%">&nbsp;</td>
        <td width="70%"><select name="selecttype"  id="selecttype" onchange="checktovarchar(); form_preview();">
                            <option value="radio" <?php echo @setting::$var[$table][$field['name']]['selecttype']=='radio'?'selected':''?>>单选</option>
                            <option value="checkbox" <?php echo @setting::$var[$table][$field['name']]['selecttype']=='checkbox'?'selected':''?>>多选</option>
                            <option value="select" <?php echo @setting::$var[$table][$field['name']]['selecttype']=='select'?'selected':''?>>下拉选择</option>
                            <option value="0">[非选择类...]</option>
                        </select>
                    </td>
                </tr>


     <tr>
        <td width="19%" align="right">选项 </td>
        <td width="1%">&nbsp;</td>
        <td width="70%">{form::textarea('select',@setting::$var[$table][$field['name']]['select'],' rows="6" cols="40" onblur="form_preview();" ')}
<div class="blank10"></div>
<img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /">每行一项，格式： (值)项，如：(1)非常好<div class="blank10"></div></td>
                </tr>
            </tbody>
        </table>
		
    </div>


    <div class="select2" style="display:none" id="select_preview">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">
         <tr>
        <td width="19%" align="right">预览</td>
        <td width="1%">&nbsp;</td>
        <td width="70%">
		<span id="form_preview_title">
        </span>&nbsp;
        <span id="form_preview">
        </span>
		<span id="form_preview_tips">&nbsp;&nbsp;
        </span>
        </td>
                </tr>
            </tbody>
			</table>
    </div>



    <script>
        {if @setting::$var[$table][$field['name']]['selecttype']}
        $(".select2").show("fast");
        $(".varchar2").hide("fast");
        $("#selecttype").attr('value','{=@setting::$var[$table][$field['name']]['selecttype']}');
        $("#type").val('0');
        form_preview();
        {else}
        $("#selecttype").val('0');
        {/if}
    </script>

  

    <?php if($table == 'user') { ?>
    <div>
        <table border="0" cellspacing="0" cellpadding="0" border="0" class="list" id="table1">
            <thead>
                <tr>
                    <th colspan="3">
                        选项
                    </th>
                </tr>
            </thead>
            <tbody>
            <tr>
        <td width="19%" align="right">是否注册页显示</td>
        <td width="1%">&nbsp;</td>
        <td width="70%">
					<?php echo form::checkbox('showinreg', 1,@setting::$var[$table][$field['name']]['showinreg']);?>
					<span class="hotspot" onmouseover="tooltip.show('用户自定义字段是否在注册页面显示！');" onmouseout="tooltip.hide();"><img src="{$skin_path}/images/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>
					</td>
                </tr>
            </tbody>
        </table>
    </div>
        <?php } ?>


</div>

<div class="blank20"></div>
<input type="submit" name="submit" value=" 提交 " class="btn_a" />

</form>


