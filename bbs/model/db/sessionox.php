<?php
class db_sessionox extends db_base {
	static function getInstance() {
        return parent::getInstance(__CLASS__);
	}
	protected function __construct($tblName = __CLASS__) {
		parent::__construct($tblName);
	}

}
