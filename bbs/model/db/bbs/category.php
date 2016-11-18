<?php
class db_bbs_category extends db_base{
  	static function getInstance() {
        return parent::getInstance(__CLASS__);
	}
	protected function __construct($tblName = __CLASS__) {
		parent::__construct($tblName);
	}
    function insertOrUpdateCat($insert_arr,$update_arr){
         $r = $this->odb->insertOrUpdate($this->tblName,$insert_arr,$update_arr);
	     if(!$r){
	       	 action_public::turnPage('index.php','更新数据时，出错！请联系我们！');
	     }
    }
}
