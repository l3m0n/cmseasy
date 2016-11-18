<?php

if (!defined('ROOT'))
    exit('Can\'t Access !');
class index_admin extends admin {
    function init() {
    }
    function index_action() {
		$this->check_pw();
        session::del('mod');
        $tbpre = config::get('database','prefix');
        $user = new user();
        
        $sql = "SELECT count(1) as rec_sum FROM `{$tbpre}archive`";
        $row = $user->rec_query_one($sql);
        $this->view->archivenum = $row['rec_sum'];
        
        $sql = "SELECT value FROM `{$tbpre}settings` WHERE tag='table-hottag'";
        $row = $user->rec_query_one($sql);
        $tmp = unserialize($row['value']);
        $tmp = explode("\n", $tmp['hottag']);
        $this->view->tagnum = count($tmp);
        
        $sql = "SELECT count(1) as rec_sum FROM `{$tbpre}a_comment`";
        $row = $user->rec_query_one($sql);
        $this->view->commentnum = $row['rec_sum'];
        
        $sql = "SELECT count(1) as rec_sum FROM `{$tbpre}archive` WHERE checked = 0";
        $row = $user->rec_query_one($sql);
        $this->view->unchecknum = $row['rec_sum'];
        
        $sql = "SELECT count(1) as rec_sum FROM `{$tbpre}guestbook`";
        $row = $user->rec_query_one($sql);
        $this->view->guestbooknum = $row['rec_sum'];
        
        $sql = "SELECT count(1) as rec_sum FROM `{$tbpre}p_orders`";
        $row = $user->rec_query_one($sql);
        $this->view->ordernum = $row['rec_sum'];
    }
    
    function hotsearch_action() {
    	chkpw('archive_hotsearch');
    }
    
    function logout_action() {
        cookie::del('login_username');
        cookie::del('login_password');
        session::del('username');
        session::del('roles');
        require_once ROOT.'/celive/include/config.inc.php';
        require_once ROOT.'/celive/include/celive.class.php';
        $login=new celive();
        $login->auth();
        $GLOBALS['auth']->logout();
        $GLOBALS['auth']->check_logout1();
        front::redirect(url::create('index'));
    }
    function end() {
        $this->render('index.php');
    }
}