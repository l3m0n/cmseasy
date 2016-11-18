
<script type="text/javascript">
jQuery(function($){
	$("#demo_btn").click(function(){
		$("#demo_div").attr("src",
			"demo.php?pattern="+$("#ifocus_pattern").val()+"&width="+$("#ifocus_width").val()+"&height="+$("#ifocus_height").val()+
			"&number="+$("#ifocus_number").val()+"&time="+$("#ifocus_time").val());
	});
});
var base_url = '{config::get('site_url')}';


</script>

    <script type="text/javascript" src="{$base_url}/common/js/ajaxfileupload.js"></script>
    <script type="text/javascript" src="{$base_url}/common/js/jquery.imgareaselect.min.js"></script>
    <script type="text/javascript" src="{$base_url}/common/js/ThumbAjaxFileUpload.js"></script>
    <script type="text/javascript" src="{$base_url}/common/swfupload/swfupload.js"></script>
    <script type="text/javascript" src="{$base_url}/common/swfupload/swfupload.queue.js"></script>
    <script type="text/javascript" src="{$base_url}/common/swfupload/fileprogress.js"></script>
    <script type="text/javascript" src="{$base_url}/common/swfupload/system_handlers.js"></script>

<form method="post" action="<?php echo uri();?>" name="config_form">
<div class="tags">
<div id="tagstitle">
      <?php $i=1;?>
      {loop $units $key $unit}
	  <a id="one{$i}" onclick="setTab('one',{$i},20)" class="{if $i==1}hover{/if}" href="#">{$unit}</a>
      <?php $i++;?>
      {/loop}

	 
  </div>
<?php unset($i);?>

   <div id="tagscontent" class="right_box">
     <?php $onei=1;?>
     {loop $units $key $unit}



     {if isset($items[$key])}


<div id="con_one_{$onei}" {if $onei>1}style="display:none"{/if} >
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table{=$key+1}">
{loop $items[$key] $item}

{if $item['name']=='cnzz_pass'}
<a href="{url('config/getcnzz')}" class="btn_d" style="display:block;float:right;margin:10px;">重新申请帐号</a>
{/if}

<tr>
<td width="21%" align="right">{$item.title}</td>
<td width="1%">&nbsp;</td>
<td width="70%">

{if $item['name']=='ditu_explain'}
使用说明：<br />
1、首先，点击	<a href="http://api.map.baidu.com/lbsapi/getpoint/index.html" style="height:22px;line-height:22px;background:#2D9607;font-weight:bold;color:white;border:1px solid #ccc;" target="_blank">&nbsp;按钮&nbsp;</a>	，获取地图数值；<br />
2、数据包含：当前层级、当前坐标点；<br />
3、坐标点逗号前为经度值；<br />
4、坐标点逗号后为纬度值；<br />
5、将经纬度值复制到后台中的经纬度输入框，提交即可。<br />
6、地图调用代码为 {&nbsp;template 'ditu.html'&nbsp;} ,复制后，请将里面空格删除 。<br />
<style>
#ditu_explain {display:none;}
</style>
{/if}


{if $item['name']=='template_dir'}
<div id="template">
{loop $item['select'] $key2 $val}
<div class="template_box">
<div class="t_box">
<div class="img-wrap">
<a><img src="{$base_url}/template/{$key2}/skin/thumbnails.jpg" /></a>
</div>
</div>
{$val}
&nbsp;<input name="template_dir_select[]" type="radio" value="{$key2}" {if get($item['name'])==$key2} checked="checked" {/if} onclick="this.form.template_dir.value=this.value" />&nbsp;选择
</div>
{/loop}
<div class="blank10"></div>
</div>


{form::hidden($item['name'],get($item['name']))}
{elseif $item['name']=='template_mobile_dir'}
    <div id="template">
        {loop $mobiletpllist $key2 $val}
        <div class="template_box">
            <div class="t_box">
                <div class="img-wrap">
                    <a><img src="{$base_url}/template/{$key2}/skin/thumbnails.jpg" /></a>
                </div>
            </div>
            {$val}
            &nbsp;<input name="template_mobile_dir" type="radio" value="{$key2}" {if get($item['name'])==$key2} checked="checked" {/if} />&nbsp;选择
        </div>
        {/loop}
        <div class="blank10"></div>

    </div>

{elseif $item['name']=='admin_template_dir'}

<div id="template" style="float:left;">
{form::select($item['name'],get($item['name']),$admintpllist,'class="select"')}

</div>
    {elseif $item['name']=='user_template_dir'}

    <div id="template" style="float:left;">
        {form::select($item['name'],get($item['name']),$usertpllist,'class="select"')}

    </div>
                         
			  {else}
                {if isset($item['select']) && is_array($item['select'])}
                {form::select($item['name'],get($item['name']),$item['select'],'class="select"')}
                {elseif strlen(get($item['name']))>50}
                {form::textarea($item['name'],get($item['name']),' class="textarea"')}
                {elseif isset($item['image'])}
                <script type="text/javascript">
                 $(document).ready(function(){
			        var swfu_{$item['name']};
			        var settings_{$item['name']} = {
			        	callback_data_des: '{$item['name']}',
			            flash_url : "{$base_url}/common/swfupload/swfupload.swf",
			            upload_url: "{url('tool/uploadimage/site/'.front::get('site'),false)}",
			            post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
			            file_size_limit : "{ini_get('upload_max_filesize')}B",
			            file_types : "*.jpg;*.gif;*.png;*.bmp",
			            file_types_description : "图片", //All Files
			            file_upload_limit : 100,
			            file_queue_limit : 0,
			            custom_settings : {
			                progressTarget : "fsUploadProgress",
			                cancelButtonId : "btnCancel"
			            },
			            debug: false,

			            // Button settings
			            //button_image_url: "{$base_url}/common/swfupload/botton.png",
			            button_width: "39",
			            button_height: "18",
			            button_placeholder_id: "spanButtonPlaceHolder_{$item['name']}",
			            //button_text: '<span class="theFont">上传</span>',
			            //button_text_style: ".theFont{float:left;display:block;color:#529fd0;font-size:14px;width:160px;height:40px;line-height:22px;font-weight:bold;}",
			            //button_text_left_padding: 7,
			            //button_text_top_padding: 5,
			            button_disabled : false,
			            button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
			            button_cursor: SWFUpload.CURSOR.HAND,

			            // The event handler functions are defined in handlers.js
			            file_queued_handler : fileQueued,
			            file_queue_error_handler : fileQueueError,
			            file_dialog_complete_handler : fileDialogComplete,
			            upload_start_handler : uploadStart,
			            upload_progress_handler : uploadProgress,
			            upload_error_handler : uploadError,
			            upload_success_handler : uploadSuccess,
			            upload_complete_handler : uploadComplete,
			            queue_complete_handler : queueComplete	// Queue plugin event


			        };
			        swfu_{$item['name']} = new SWFUpload(settings_{$item['name']});

                 });
                </script>
				<div id="img_upload">
                <input type="text" name="{$item['name']}" id="{$item['name']}" class="upload_text" value='{config::get($item['name'])}'/>
                <span style="float:left;" id="spanButtonPlaceHolder_{$item['name']}"></span>
                <input id="btnCancel" type="button" value="取消" disabled="disabled" style="display:none;" />
				</div>
                {else}
				{form::input($item['name'],get($item['name']),'class="input"')}
                {/if}
                {if $item['name']=='watermark_pos'}
                {template 'config/watermark_pos_select.php'}
                {/if}
           {/if}
          {if strlen($item['intro'])>1}<span class="tips">{$item['intro']}</span>{/if}{if $item['title']=='风格应用选择'}<button id="demo_btn" type="button" style="width:80px; height:30px; margin:4px;">演 示</button><br />
<iframe id="demo_div" width="100%" height="400" frameborder="0" scrolling="no" src="demo.php"></iframe>

{/if}


</td>
       </tr>
    {/loop}
    <?php $onei++;?>
   </table>
   </div>

  {/loop}
  {/if}
  </div>
</div>
<div class="blank10"></div>
<input name="submit" type="submit" value="提交" class="btn_a" />
</form>