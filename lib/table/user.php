<?php

class user extends table {
    function getcols($act) {
        switch($act) {
            case  'list':
                return 'userid,username,nickname,groupid'.$this->mycols();
            case 'modify':
                return 'userid,password,username,nickname,groupid,qq,e_mail,tel,address,checked'.$this->mycols();
            case 'manage':
                return 'userid,username,nickname,groupid,checked';
            default: return '1';
        }
    }
    function get_form() {
        return array(
                'groupid'=>array(
                        'selecttype'=>'select',
                        'select'=>form::arraytoselect(usergroup::option()),
                ),
                'checked'=>array(
                        'selecttype'=>'radio',
                        'select'=>form::arraytoselect(form::yesornotoarray('审核')),
                ),
        );
    }
    function get_form_field() {
        return array(
                'groupid'=>array(
                        'selecttype'=>'select',
                        'select'=>form::arraytoselect(usergroup::option()),
                ),
                'checked'=>array(
                        'selecttype'=>'radio',
                        'select'=>form::arraytoselect(form::yesornotoarray('审核')),
                ),
        );
    }
}