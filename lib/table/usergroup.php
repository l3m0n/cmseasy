<?php
class usergroup extends table {
	function getcols($act) {
		return $this->getcolslist();
	}
	function init() {
		$this->group=$this->getrows(null,10,'1');
		$name=array();
		foreach ($this->group as $g) {
			$name[$g['groupid']]=$g['name'];
		}
		$this->names=$name;
	}
	public static function getInstance() {
		$class=new usergroup();
		$class->init();
		return $class;
	}
	static function name($groupid) {
		static $names;
		if (!isset($name)) {
			$group=usergroup::getInstance();
			$name=$group->names;
		}
		if (isset($name[$groupid]))
			return $name[$groupid];
		else
			return false;
	}
	static function option() {
		$group=usergroup::getInstance();
		return $group->names;
	}
	
	public static function getRoles($groupid){
		$group = usergroup::getInstance();
		$groups = $group->getrow("groupid='$groupid'");
		if($groups['powerlist'] != ''){
			return unserialize($groups['powerlist']);
		}
	}
}