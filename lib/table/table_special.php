<?php

if (!defined('ROOT')) exit('Can\'t Access !');
class table_special extends table_mode {
	function save_before() {
		front::$post['description'] = htmlspecialchars_decode(front::$post['description']);
	}
}