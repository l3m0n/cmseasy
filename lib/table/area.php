<?php

class area extends table {
    public $name='b_area';
    static function province_option(&$option=array(0=>'请选择...')) {
        $area=new area();
        $provinces=$area->getrows('parentid=0',100,'1');
        foreach ($provinces as $province) {
            $option[$province['id']]=$province['name'];
        }
        return $option;
    }
    static function pagination() {
        return template('system/area_pagination.html');
    }
    static function city_option($city_id=0,&$option=array(0=>'请选择...')) {
        $area=new area();
        if ($city_id >0) {
            $city=$area->getrow('id='.intval($city_id));
            $province_id=$city['parentid'];
        }elseif (get('province_id')) {
        	$province_id=intval(get('province_id'));
        	if(preg_match('/(select|union|and|\'|"|\))/i',$province_id)){
        		exit('非法参数');
        	}
        }else {
        	return $option;
        }
        $citys=$area->getrows('parentid='.$province_id,100,'1');
        foreach ($citys as $city_id) {
            $option[$city_id['id']]=$city_id['name'];
        }
        return $option;
    }
    static function section_option($section_id=0,&$option=array(0=>'请选择...')) {
		$section_id = intval($section_id);
		$city_id = intval($city_id);
        $area=new area();
        if ($section_id >0) {
            $section=$area->getrow('id='.$section_id);
            $city_id=$section['parentid'];
        }
        elseif (get('city_id')) $city_id=get('city_id');
        else return $option;
        $sections=$area->getrows('parentid='.$city_id,100,'1');
        foreach ($sections as $section) {
            $option[$section['id']]=$section['name'];
        }
        return $option;
    }
    static function getparent($id,$name=null) {
        $area=new area();
        $area2=$area->getrow('id='.$id);
        $area=$area->getrow('id='.$area2['parentid']);
        if ($name) return $area[$name];
        else return $area;
    }
    static function getparentid($id) {
        return self::getparent($id,'id');
    }
    static function province_url($province_id,$page=null) {
    	/*if(front::$get['t'] == 'wap'){
    		return url('area/list/t/wap/province_id/'.$province_id.($page ?'/page/'.$page : ''));
    	}
        return url('area/list/province_id/'.$province_id.($page ?'/page/'.$page : ''));*/
		$province_id = intval($province_id);
    	
    	if(!$page) $page = 1;
    	if(front::$get['t'] == 'wap'){
    		if(!config::get('wap_area_html')){
    			return url('area/list/t/wap/province_id/'.$province_id.($page ?'/page/'.$page : ''));
    		}else{
    			return config::get('site_url').'area_wap/province/'.$province_id.'_list_'.$page.'.html';
    		}
    	}
    	if(!config::get('area_html') && !front::$rewrite){
    		return url('area/list/province_id/'.$province_id.($page ?'/page/'.$page : ''));
    	}else if(front::$rewrite){
    		return config::get('site_url').'arealist_province_'.$province_id.'_'.$page.'.htm';
    	}else{
    		return config::get('site_url').'area/province/'.$province_id.'_list_'.$page.'.html';
    	}
    	
    }
    static function city_url($city_id,$page=null) {       
        if(!$page) $page = 1;
        if(front::$get['t'] == 'wap'){
        	if(!config::get('wap_area_html')){
        		return url('area/list/t/wap/city_id/'.$city_id.($page ?'/page/'.$page : ''));
        	}else{
        		return config::get('site_url').'area_wap/city/'.$city_id.'_list_'.$page.'.html';
        	}
        }
        if(!config::get('area_html') && !front::$rewrite){
        	return url('area/list/city_id/'.$city_id.($page ?'/page/'.$page : ''));
        }else if(front::$rewrite){
    		return config::get('site_url').'arealist_city_'.$city_id.'_'.$page.'.htm';
    	}else{
        	return config::get('site_url').'area/city/'.$city_id.'_list_'.$page.'.html';
        }
    }
    static function section_url($section_id,$page=null) {
    	if(!$page) $page = 1;
    	if(front::$get['t'] == 'wap'){
    		if(!config::get('wap_area_html')){
    			return url('area/list/t/wap/section_id/'.$section_id.($page ?'/page/'.$page : ''));
    		}else{
    			return config::get('site_url').'area_wap/section/'.$section_id.'_list_'.$page.'.html';
    		}
    	}
    	if(!config::get('area_html') && !front::$rewrite){
        	return url('area/list/section_id/'.$section_id.($page ?'/page/'.$page : ''));
    	}else if(front::$rewrite){
    		return config::get('site_url').'arealist_section_'.$section_id.'_'.$page.'.htm';
    	}else{
    		return config::get('site_url').'area/section/'.$section_id.'_list_'.$page.'.html';
    	}
    }
    static function url($id,$page=null) {
    	/*if(front::$get['t'] == 'wap'){
    		
    		return url('area/list/t/wap/id/'.$id.($page ?'/page/'.$page : ''));
    	}*/
        return url('area/list/id/'.$id.($page ?'/page/'.$page : ''));
    }
    static function name($id) {
        $area=new area();
        $area=$area->getrow('id='.$id);
        if (isset($area['name'])) return $area['name'];
    }
    static function link($name,$url) {
        return "<a href=\"$url\">$name</a>";
    }
    static function getpositonhtml($province_id=0,$city_id=0,$section_id=0,$id=0,$level=3) {
        if ($id) return self::getpositonhtmlfromid($id,$level);
        if ($section_id) {
            $city_id=self::getparent($section_id,'id');
            $province_id=self::getparent($city_id,'id');
        }
        elseif ($city_id) {
            $province_id=self::getparent($city_id,'id');
        }
        $html='';
        $s=' ';
        if ($province_id) $province_name=self::name($province_id);
        if ($level >0) if ($province_id) $html.=self::link($province_name,self::province_url($province_id)).$s;
        if (!$province_id ||!strpos($province_name,'市')) if ($city_id) $html.=self::link(self::name($city_id),self::city_url($city_id)).$s;
        if ($level == 3) if ($section_id) $html.=self::link(self::name($section_id),self::section_url($section_id)).$s;
        return rtrim($html,$s);
    }
    static function getarea($id) {
        $area=new $area;
        $area=$area->getrow('id='.$id);
        return $area;
    }
    static function getprovincehtml($province_id) {
        return self::getpositonhtml($province_id,0,0,0,$level=1);
    }
    static function getpositonhtmlfromid($id,$level=2) {
        $parent_id=$parent_id2=0;
        if ($area['parentid']) $parent_id=self::getarea($area['parentid'],'id');
        if ($parent['parentid']) $parent2_id=self::getarea($parent['parentid'],'id');
        $province_id=$city_id=$section_id=0;
        if ($parent2_id) {
            $section_id=$id;
            $city_id=$parent_id;
            $province_id=$parent2_id;
        }
        elseif ($parent_id) {
            $city_id=$id;
            $province_id=$parent_id;
        }
        else $province_id=$id;
        return self::getpositonhtml($province_id,$city_id,$section_id,0,$level);
    }
    static function listdata($province_id=null,$limit=50,$order='id asc',$where2=null) {
        if ($province_id) $where='parentid='.$province_id;
        else $where='parentid=0';
        if(preg_match("/find_in_set\((\w+),'(.+?)'\)/",$order,$match))
            if(empty($where2)) $where2="$match[1] in ($match[2])";
        if ($where2) $where.=' and '.str_replace ('-',' ',$where2);
        $area=new area;
        $areas=$area->getrows($where,$limit,str_replace ('-',' ',$order));
        foreach ($areas as $order=>$area) {
            if ($province_id) $area['url']=self::city_url($area['id']);
            else $area['url']=self::province_url($area['id']);
            if(strlen($area['name'])==12 ||strlen($area['name'])==18) $area['shortname']=cut($area['name'],3);
            else $area['shortname']=cut($area['name'],2);
            $areas[$order]=$area;
        }
        return $areas;
    }
}