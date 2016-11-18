<?php

class ballot_act extends act {
    function init() {
        $this->table='ballot';
        $this->_table=new $this->table;
    }
    function index_action() {
        if (front::post('submit')) {
            if (!front::post('ballot')) {
                front::alert(lang('Please_select_vote'));
                return false;
            }
            if (config::get('checkip')) {
                $time=cookie::get('vttime');
                if (time() -$time <config::get('timer') * 60) {
                    front::alert(lang('You_have_voted'));
                    return false;
                }
            }
            front::check_type(front::$post['bid']);
            $bid = intval(front::$post['bid']);
            if (is_array(front::$post['ballot'])) {
                $ids=implode(',',front::$post['ballot']);
            }
            else {
                $ids=front::$post['ballot'];
            }
            if(preg_match('/(select|union|and|\'|"|\))/i',$ids)){
            	exit(lang('illegal_parameter'));
            }
            if(preg_match('/(select|union|and|\'|"|\))/i',$bid)){
            	exit(lang('illegal_parameter'));
            }
            $where="id in($ids)";
            $data='num=num+1';
            $option=new option();
            $option->rec_update($data,$where);
            $this->_table->rec_update($data,$bid);
            cookie::set('vttime',time(),time() +3600 * 24);
            front::alert(lang('Successful_vote'));
        }
    }
    function getjs_action() {
        $lang=include ROOT.'/lang/'.config::get('lang_type').'/system.php';
        $id=front::get('id');
        if(preg_match('/select/i',$id)){
        	exit(lang('illegal_parameter'));
        }
        $ballot=new ballot();
        $option=new option();
        $where=array('id'=>$id);
        $arr=$ballot->getrow($where);
        $row=$option->getrows(array('bid'=>$id),null,'num desc');
        $this->view->arr=$arr;
        $this->view->row=$row;
        $this->view->lang=$lang;
        /*$html='document.write(\'<form name="form1" method="post" action="'.url("ballot").'">\');';
        $html .= 'document.write(\'<input type="hidden" name="bid" id="bid" value="'.$arr['id'].'" />\');';
		$html .= 'document.write(\'<h5>\');';
        $html .= 'document.write(\''.$arr['title']."</h5>');";
        foreach ($row as $option) {
            if ($arr['type'] == 'radio') {
                $html .= 'document.write(\'<input type="radio" name="ballot" id="ballot" value="'.$option['id'].'" />\');';
            }
            else {
                $html .= 'document.write(\'<input type="checkbox" name="ballot[]" id="ballot" value="'.$option['id'].'" />\');';
            }
            $html .= 'document.write(\' '.$option['name'].' ('.$option['num'].')<br>\');';
        }
        $html .= 'document.write(\'<input type="submit" name="submit" id="button" value=" '.$lang['vote'].'" /></form>\');';
        echo $html;*/
    }
    
    function end() {
    	if(!isset($this->_view_table['data']) &&isset($this->_view_table))
    		$this->_view_table['data']=$this->_view_table;
    	if(isset($this->_view_table))
    		$this->view($this->_view_table);
    	$this->render();
    }
}