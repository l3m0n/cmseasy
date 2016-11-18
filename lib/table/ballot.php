<?php

class ballot extends table {
    function getcols($act) {
        switch($act) {
            case  'list':
                return 'id,title,num,type'.$this->mycols();
            case 'modify':
                return 'id,title,num,type'.$this->mycols();
            case 'manage':
                return 'id,title,num,type';
            default: return '1';
        }
    }
    function get_form() {
        return array(
                'type'=>array(
                        'selecttype'=>'select',
                        'select'=>form::arraytoselect(array('radio'=>'单选','checkbox'=>'多选')),
                        'default'=>get('catid'),
                        'regex'=>'/\d+/',
                        'filter'=>'is_numeric',
                ),
        );
    }
    static function url($id) {
        return url::create('vote/show/id/'.$id);
    }
}