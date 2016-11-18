<?php

class Celsysteminfo {
    var $result;
    var $sql;
    var $files;
    var $file;
    var $dirs;
    var $id;
    function conf($url,$template,$company,$companyinfos,$language ,$customer_info ,$tracker_refresh) {
        $this->file = $GLOBALS['file']->read(dirname(__FILE__).'/config.inc.php');
        $this->file = preg_replace("/\['url'\] = '.*';/",'[\'url\'] = \''.$url.'\';',$this->file);
        $this->file = preg_replace("/\['template'\] = '.*';/",'[\'template\'] = \''.$template.'\';',$this->file);
        $this->file = preg_replace("/\['lang'\] = '.*';/",'[\'lang\'] = \''.substr($language,0,-4).'\';',$this->file);
        $this->file = preg_replace("/\['company'\] = '.*';/",'[\'company\'] = \''.$company.'\';',$this->file);
        $this->file = preg_replace("/\['companyinfos'\] = '.*';/",'[\'companyinfos\'] = \''.$companyinfos.'\';',$this->file);
        $this->file = preg_replace("/\['language'\] = '.*';/",'[\'language\'] = \''.$language.'\';',$this->file);
        $this->file = preg_replace("/\['customer_info'\] = .*;/",'[\'customer_info\'] = '.$customer_info.';',$this->file);
        $this->file = preg_replace("/\['tracker_refresh'\] = '.*';/",'[\'tracker_refresh\'] = \''.$tracker_refresh.'\';',$this->file);
        $GLOBALS['file']->save(dirname(__FILE__).'/config.inc.php',$this->file);
    }
    function confcompanyinfos($companyinfos) {
        $this->file = $GLOBALS['file']->read(dirname(__FILE__).'/config.inc.php');
        $this->file = preg_replace("/\['companyinfos'\] = '.*';/",'[\'companyinfos\'] = \''.$companyinfos.'\';',$this->file);
        $GLOBALS['file']->save(dirname(__FILE__).'/config.inc.php',$this->file);
    }
    function language($language = '') {
        if ($language == '') {
            $results = array();
            $this->files = $GLOBALS['file']->filelist(dirname(__FILE__).'/../languages/','php');
            foreach ($this->files as $key =>$val) {
                $this->files[$key]['name'] = ucfirst(strtolower(substr($this->files[$key]['file'],0,-4)));
                if (substr($this->files[$key]['name'],0,5) !== 'Index') {
                    $results[] = $this->files[$key];
                }
            }
            return $results;
        }else {
            $_SESSION['cel_language'] = $language;
        }
    }
    function template() {
        $results = array();
        $this->dirs = $GLOBALS['file']->dirlist(dirname(__FILE__).'/../templates/');
        foreach ($this->dirs as $key =>$val) {
            $this->dirs[$key]['name'] = ucfirst(strtolower($this->dirs[$key]['dir']));
            if (substr($this->dirs[$key]['name'],0,5) !== 'Index' && !preg_match('/^\./', $this->dirs[$key]['name'])) {
                $results[] = $this->dirs[$key];
            }
        }
        return $results;
    }
}