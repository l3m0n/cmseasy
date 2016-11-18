<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>图片上传</title>
<link href="js/upimg/dialog.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="js/upimg/jquery.js"></script>
<script type="text/javascript" src="js/upimg/dialog.js"></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript">
            var swfVersionStr = "10.0.0";
			var xiSwfUrlStr = "js/upimg/playerProductInstall.swf";
            var flashvars = {};
            var params = {};
            params.quality = "high";
            params.bgcolor = "#ffffff";
            params.allowscriptaccess = "sameDomain";
            params.allowfullscreen = "true";
            var attributes = {};
            attributes.id = "mpupload";
            attributes.name = "mpupload";
            attributes.align = "middle";
            swfobject.embedSWF("js/upimg/mpupload.swf", "flashContent", "570", "380", swfVersionStr, xiSwfUrlStr, flashvars, params, attributes);
 </script>
<script type="text/javascript" language="JavaScript">
	var filemanage_js_upfile_zoomsize  = "抱歉：图片尺寸无效或填写错误，请填写整数型";
	var filemanage_js_upfile_driname_err  = "抱歉：未选择上传文件，请返回重新选择！";
	var filemanage_js_upfile_ok = "恭喜：文件上传成功!";
	var filemanage_js_upfile_no = "抱歉：文件上传失败，请检查文件是否拥有可写权限或文件无效!";
	var fheight="auto";
	$(window).load(function(){
		var h = parseInt(fheight);
		$('#mainbodybottonauto').css({height:h-0});
		var options = {
			beforeSubmit: formverify,
			success:saveResponse
		}
		$('#upfile').submit(function() {
			$(this).ajaxSubmit(options);
			return false;
		});
	});

	function formverify(formData, jqForm, options) {
		var queryString = $.param(formData);
		var get=urlarray(queryString);
		if(get['upfilepath']=='') {
			document.upfile.upfilepath.focus();
			alert(filemanage_js_upfile_driname_err);
			return false;
		}
	}

	function saveResponse(options){
		//console.log(options);
		var inputstr='<td class="trtitle02" id="upfilepath"><input type="file" name="upfilepath" maxlength="200" size="50" class="infoInput"></td>';
		$("#upfilepath").replaceWith(inputstr);

		var strarray = options.split('|');
		if (strarray[1]!=undefined){
			$("#resulttable").removeClass('displaynone');
			if (strarray[1]=='img'){
				if (strarray[2]=='1'){
					var upresult='<td class="trtitle02" id="upresult"><a onclick="javascript:refile(\''+strarray[0]+'\',\''+strarray[2]+'\',\''+strarray[3]+'\',\''+strarray[4]+'\',\''+strarray[5]+'\');" href="#body" hidefocus="true"><img src="'+ strarray[0] + '" width="100"></a></td>';	
				}else{
					var upresult='<td class="trtitle02" id="upresult"><a onclick="javascript:refile(\''+strarray[0]+'\',\''+strarray[2]+'\',\''+strarray[3]+'\',\''+strarray[4]+'\',\''+strarray[5]+'\');" href="#body" hidefocus="true"><img src="'+ strarray[0] + '" height="100"></a></td>';		
				}
				$("#upresult").replaceWith(upresult);
			}else{
				var upresult='<td class="trtitle02" id="upresult"><a class="lnglist" onclick="javascript:refile(\''+strarray[0]+'\',\''+strarray[2]+'\',\''+strarray[3]+'\',\''+strarray[4]+'\',\''+strarray[5]+'\');" href="#body" hidefocus="true">' + strarray[0] + '</a></td>';
				$("#upresult").replaceWith(upresult);
			}
			$("#title").val("");
			alert(filemanage_js_upfile_ok);
		}else{
			alert(strarray[0]);
		}
	}
	function refile(filename,iswidth,alt,width,height){
		parent.refile(filename,iswidth,alt,width,height);
	}
	function refileswf(obj){
		var arr = obj.split('|');
		for(i=0;i<arr.length;i++){
			if(arr[i] != ''){
				parent.refileswf(arr[i],1,'',0,0);
			}
		}
		top.closeifram();
		//parent.refile(filename,iswidth,alt,width,height);
	}
	function getUploadAddress(){
		return "<?php echo 'http://'.$_SERVER['HTTP_HOST'].url('file/swfsave/'.session_name().'/'.session_id()); ?>";
	}
	
	function insertPics(){
		swfobject.getObjectById("mpupload").insertPic();
	}
</script>
</head>

<body class="bodyflow">
<div style="padding:5px 0px 0px 10px;">
<input type="submit" class="buttonface"  onclick="$('#single').css('display','block');$('#muti').css('display','none');" value="单文件上传"/> <input type="submit" class="buttonface2" onclick="$('#single').css('display','none');$('#muti').css('display','block');" value="多文件上传" />
</div>
<div id="muti" style="display:none;">
<div id="flashContent">
  <p> To view this page ensure that Adobe Flash Player version 
    10.0.0 or greater is installed. </p>
  <script type="text/javascript"> 
				var pageHost = ((document.location.protocol == "https:") ? "https://" :	"http://"); 
				document.write("<a href='http://www.adobe.com/go/getflashplayer'><img src='" 
								+ pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>" ); 
			</script> 
</div>
<div id="downbotton" style="clear:both;">
  <div id="subbotton">
    <table border="0" width="100%">
      <tr id="bottonsubmit">
        <td id="center"><table border="0" style="margin: 10px auto;">
            <tr >
              <td><input type="button" name="Submit" id="submitbotton" value="确认文件上传" class="buttonface" title="确认文件上传" onclick="insertPics()"/></td>
              <td class="padding-left5"><input type="reset" name="reset" onClick="javascript:parent.resetwindow();" id="release" value="返回编辑窗口" class="buttonface"  title="返回编辑窗口" /></td>
            </tr>
          </table></td>
      </tr>
    </table>
  </div>
</div>
</div>
<div id="single" style="display:block">
<form name="upfile" id="upfile" method="post" enctype="multipart/form-data" action="index.php?case=file&act=upfilesave&admin_dir=admin">
<div id="mainbodybottonauto" class="managebottonadd">
	<div class="maindobycontent">
		<div class="maneditcontent">
			<table class="formtablewin">
				<tr class="trstyle2">
					<td class="trtitle01">选择本地文件</td>
					<td class="trtitle02" id="upfilepath"><input type="file" name="upfilepath" maxlength="200" size="50" class="infoInput"></td>
				</tr>
                <tr class="trstyle2">
				  <td class="trtitle01">图片信息</td>
					<td class="trtitle02" id="upfilepath">说明
				    <input type="text" name="alt" id="alt" />
				    宽
				    <input name="width" type="text" id="width" size="10" />
				    高
				    <input name="height" type="text" id="height" size="10" /></td>
				</tr>
				<tr class="trstyle2">
					<td class="trtitle01"></td>
					<td class="trtitle02">1、选择的文件大小不超过1.0 MB，允许上传的文件格式有jpg、png、gif；<br>2、文件所保存的远程文件夹为：upload/images/上传年月</td>
				</tr>
			</table>
			<table class="formtablewin displaynone" id="resulttable">
				<tr class="trstyle3">

					<td class="trtitle01">上传成功</td>
					<td class="trtitle02" id="upresult"><img src="images/pic.png" width="100px" height="100px"></td>
				</tr>
				<tr class="trstyle2">
					<td class="trtitle01"></td>
					<td class="trtitle02">提示：点击以上结果，选择该文件并关闭此窗口！</td>
				</tr>
			</table>

		</div>
	</div>
</div>
<div id="downbotton">
	<div id="subbotton">
		<table border="0" width="100%">
			<tr id="bottonsubmit">
				<td id="center">
					<table border="0" style="margin: 10px auto;">
						<tr >
							<td><input type="submit" name="Submit" id="submitbotton" value="确认文件上传" class="buttonface" title="确认文件上传"/></td>
							
							<td class="padding-left5"><input type="reset" name="reset" onClick="javascript:parent.resetwindow();" id="release" value="返回编辑窗口" class="buttonface2"  title="返回编辑窗口" /></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
</div>
</form>
</div>
<!-- Powered by <a href="http://www.cmseasy.cn" title="CmsEasy企业网站系统" target="_blank">CmsEasy</a> -->
</body>
</html>