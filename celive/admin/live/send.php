<?php
/**
* CmsEasy Live http://www.cmseasy.cn 				  			 
* by CmsEasy Live Team 							  						
**
* Software Version: CmsEasy Live v 1.2.0 					  				  	      
* Copyright 2009 by: CmsEasy, (http://www.cmseasy.cn) 	  
* Support, News, Updates at: http://www.cmseasy.cn 			  			  
**
* This program is not free software; you can't may redistribute it and modify it under	  
**
* This file contains configuration settings that need to altered                  
* in order for CE Live to work, and other settings that            
**/

include('../../include/config.inc.php');
include(CE_ROOT.'/include/admin/check.inc.php');
include(CE_ROOT.'/include/celive.class.php');
$admin_send = new celive();
$admin_send->template();
$admin_send->admin_xajax_live();


$chatid = addslashes($_GET['chatid']);

$name = $_SESSION['cel_username'];
$GLOBALS['template']->assign('name', $name);
$GLOBALS['template']->assign('chatid', $chatid);

$GLOBALS['template']->assign('ctrlenter', '<script type="text/javascript">
							 function isKeyTrigger(e,keyCode){
    var argv = isKeyTrigger.arguments;
    var argc = isKeyTrigger.arguments.length;
    var bCtrl = false;
    if(argc > 2){
        bCtrl = argv[2];
    }
    var bAlt = false;
    if(argc > 3){
        bAlt = argv[3];
    }

    var nav4 = window.Event ? true : false;

    if(typeof e == \'undefined\') {
        e = event;
    }

    if( bCtrl && 
        !((typeof e.ctrlKey != \'undefined\') ? 
            e.ctrlKey : e.modifiers & Event.CONTROL_MASK > 0)){
        return false;
    }
    if( bAlt && 
        !((typeof e.altKey != \'undefined\') ? 
            e.altKey : e.modifiers & Event.ALT_MASK > 0)){
        return false;
    }
    var whichCode = 0;
    if (nav4) whichCode = e.which;
    else if (e.type == "keypress" || e.type == "keydown")
        whichCode = e.keyCode;
    else whichCode = e.button;

    return (whichCode == keyCode);
}

function ctrlEnter(e){
    var ie =navigator.appName=="Microsoft Internet Explorer"?true:false; 
    if(ie){
        if(event.ctrlKey && window.event.keyCode==13){doSomething();}
    }else{
        if(isKeyTrigger(e,13,true)){doSomething();}
    }
}
function doSomething(){xajax_AdminPostdata(xajax.getFormValues(form1));putValue();document.form1.detail.focus();}
</script>
');


$GLOBALS['template']->assign('xajax_live',$admin_xajax_live->getJavascript('../'));
$GLOBALS['template']->display('admin/live/send.htm');
?>