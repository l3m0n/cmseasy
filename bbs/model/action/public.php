<?php
class action_public{
	static function turnPage($des='index.php',$msg='操作成功',$time=3){
        include(ROOT.'/bbs/header.php');
        //输入在页面上显示的内容
        echo '<span style="color:red;">'.$msg.'</span>页面将在<span style="color:red;" id="time_zone">'.$time.'</span>秒钟后跳转';
        echo '<script>
        	 var time = '.$time.';
        	 var time_zone = document.getElementById("time_zone");
        	 function turn_page(){
                if(time <= 0){
                	window.location.href = "'.$des.'";
                }else{
                    time_zone.innerHTML = time;
                	setTimeout("turn_page();","1000");
                }
                time--;
        	 }
             window.onload = turn_page;
        	</script>';
          include(ROOT.'/bbs/bottom.php');
        exit();
	}
	static function turnPageAdmin($des='index.php',$msg='操作成功',$time=3){
        include(ROOT.'/bbs/admin/admin-header.php');
        //输入在页面上显示的内容
        echo '<span style="color:red;">'.$msg.'</span>页面将在<span style="color:red;" id="time_zone">'.$time.'</span>秒钟后跳转';
        echo '<script>
        	 var time = '.$time.';
        	 var time_zone = document.getElementById("time_zone");
        	 function turn_page(){
                if(time <= 0){
                	window.location.href = "'.$des.'";
                }else{
                    time_zone.innerHTML = time;
                	setTimeout("turn_page();","1000");
                }
                time--;
        	 }
             window.onload = turn_page;
        	</script>';
          include(ROOT.'/bbs/admin/admin-bottom.php');
        exit();
	}
	static function formatToIndex($key,$arr){
		$r = array();
		foreach($arr as $v){
			$r[$v[$key]] = $v;
		}
		return $r;
	}

	static function listPage($total_page,$num,$current){//依次传入，总数，每页显示条目，显示链接总数,当前所在页
	    $link = array();
	    $link_str = '';
        //$total_page = ceil($total/$num);
        if($total_page == 0){
        	return '';
        }
        if($total_page == 1){
        	return '<a>1</a>';
        }
        if($current < 1) $current = 1;
        if($current > $total_page) $current = $total_page;

        if($total_page <= 10){
        	$link = range(1,$total_page);
        }else{
        	if($current < 8){
            	$link = range(1,10);

            }elseif($current > $total_page-6){
            	$link = range($total_page-9,$total_page);
            }else{
            	$link = range($current-5,$current+4);
            }
        }
        $url = preg_replace('/&page=[0-9]*/','',$_SERVER['REQUEST_URI']);
    	foreach ($link as $v){
    		if($v == $current){
    			$link_str .= '<a href="'.$url.'&page='.$v.'" style="color:red">'.$v.'</a>';
    		}else{
    			$link_str .= '<a href="'.$url.'&page='.$v.'">'.$v.'</a>';
    		}
    	}
    	if($total_page > 10){
            if(!in_array(1,$link)) $link_str = '<a href="'.$url.'&page=1">1...</a>'.$link_str;
            if(!in_array($total_page,$link)) $link_str .= '<a href="'.$url.'&page='.$total_page.'">...'.$total_page.'</a>';
    	}
        return $link_str;

	}
}
