<?php

class area_act extends act {
    function list_action() {
        $this->view->page=front::get('page') ?front::get('page') : 1;
        $this->pagesize=config::get('list_pagesize');
        $limit=(($this->view->page -1) * $this->pagesize).','.$this->pagesize;
        $area=new area();
        $where='1';
        if (front::get('province_id')) $where.=' and id='.front::get('province_id');
        if (front::get('city_id')) $where.=' and id='.front::get('city_id');
        if (front::get('section_id')) $where.=' and id='.front::get('section_id');
        if (front::get('id')) $where.=' and id='.front::get('id');
        $this->view->area=$area->getrow($where);
        $archive=new archive();
        $where='1';
        if (front::get('province_id')) $where.=' and province_id='.front::get('province_id');
        if (front::get('city_id')) $where.=' and city_id='.front::get('city_id');
        if (front::get('section_id')) $where.=' and section_id='.front::get('section_id');
        if (front::get('id')) $where.=' and section_id='.front::get('id').' or city_id='.front::get('id').' or province_id='.front::get('id');
        $archives=$archive->getrows($where,$limit,'listorder,aid desc');
        foreach ($archives as $order=>$arc) {
            $archives[$order]['url']=archive::url($arc);
            $archives[$order]['catname']=category::name($arc['catid']);
            $archives[$order]['caturl']=category::url($arc['catid']);
            $archives[$order]['adddate']=sdate($arc['adddate']);
            $archives[$order]['stitle']=strip_tags($arc['title']);
        }
        $this->view->pages=true;
        if(front::get('id')!='') {
            $this->view->areaid=front::get('id');
        }elseif(front::get('province_id')!='') {
            $this->view->areaid=front::get('province_id');
        }elseif(front::get('city_id')!='') {
            $this->view->areaid=front::get('city_id');
        }elseif(front::get('section_id')!='') {
            $this->view->areaid=front::get('section_id');
        }
        $this->view->archive['title'] = area::name($this->view->areaid);
        $this->view->archives=$archives;
        $this->view->record_count=$archive->rec_count($where);
        front::$record_count=$this->view->record_count;

        
        $this->render();
    }
    
    function out($tpl) {
    	if (front::$debug) return;
    	$this->render($tpl);
    	$this->out=true;
    	exit;
    }
    
    function city_option_search_action() {
        $select=form::select('search_city_id',0,area::city_option());
        echo preg_replace('%(^<select.+?\>)|(<\/select>$)%','',trim($select));
    }
    function section_option_search_action() {
        $select=form::select('search_section_id',0,area::section_option());
        echo preg_replace('%(^<select.+?\>)|(<\/select>$)%','',trim($select));
    }
    function city_option_action() {
        $select=form::select('city_id',0,area::city_option());
        echo preg_replace('%(^<select.+?\>)|(<\/select>$)%','',trim($select));
    }
    function section_option_action() {
        $select=form::select('section_id',0,area::section_option());
        echo preg_replace('%(^<select.+?\>)|(<\/select>$)%','',trim($select));
    }
}