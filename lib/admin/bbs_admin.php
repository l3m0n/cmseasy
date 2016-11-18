<?php
if (!defined('ROOT'))
    exit('Can\'t Access !');
class bbs_admin extends admin {
    public $archive;
    function init() {
        header('Cache-control: private, must-revalidate');
        front::$admin=false;
        front::$html=true;
    }
    function category_action() {
    }
    function archive_action() {
    }
    function user_action() {
    }
    function admin_action() {
        header('Location: bbs/admin/index.php');
    }
    function end() {
        front::$html=false;
        front::$admin=true;
        $this->render('index.php');
    }
}