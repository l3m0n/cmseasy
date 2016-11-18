<?php

if (!defined('ROOT')) exit('Can\'t Access !');
class table_option extends table_mode {
    function add_before(act $act) {
        front::$post['bid'] = front::$get['bid'];
    }
    function save_before() {
    }
}