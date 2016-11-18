<?php

final class SPSession {
	private $_path = null;
	private $_name = null;
	private $_db = null;
	private $_ip = null;
	private $_maxtime = 0;
	private $_prefix = '';
	private $_config = null;

	public function __construct($db,$config = null) {
		session_set_save_handler(
			array($this, 'open'),
			array($this, 'close'),
			array($this, 'read'),
			array($this, 'write'),
			array($this, 'destroy'),
			array($this, 'gc')
		);
		$this->_config = $config;
		$this->_db = $db;
		$this->_ip = $_SERVER['REMOTE_ADDR'];
		$this->_maxtime = ini_get('session.gc_maxlifetime');
		$config = $GLOBALS['config']['database']['database'];
		$this->_prefix = $GLOBALS['config']['database']['prefix'];
		@session_start();
		$this->refresh(session_id());
	}

	public function open($path,$name) {
		return true;
	}

	public function close(){
		return true;
	}

	public function read($id)
	{
		$sql = "SELECT * FROM {$this->_prefix}sessionox where PHPSESSID = '$id'";
		//echo $sql;
		$row = $this->_db->getDataLimit('*',"PHPSESSID = '$id'");
		$row = $row[0];
		//var_dump($row);var_dump($this->_ip);var_dump($row['client_ip']);exit;
		if (!$row) {
			return null;
		} elseif ($this->_ip != $row['client_ip']) {
			if($this->_config['session_ip']){
				return null;
			}else{ 
				return $row['data'];
			}
		} elseif ($row['update_time']+$this->_maxtime < time()){
			$this->destroy($id);
			return null;
		} else {
			return $row['data'];
		}
	}

	public function write($id,$data) {
		$row = $this->_db->getDataLimit('*',"PHPSESSID = '$id'");
		$row = $row[0];
		$time = time();
		if ($row) {
			if ($row['data'] != $data) {
				$ds['update_time'] = $time;
				$ds['data'] = $data;
				$this->_db->updateData($ds,"PHPSESSID = '$id'");
			}
		} else {
			if (!empty($data)) {
				$ds['PHPSESSID'] = $id;
				$ds['update_time'] = $time;
				$ds['client_ip'] = $this->_ip;
				$ds['data'] = $data;
				$this->_db->inserData($ds);
			}
		}
		return true;
	}

	public function destroy($id) {
		$this->_db->deleteData("PHPSESSID = '$id'");
		return true;
	}

	public function refresh($id){
		$time = time();
		$ds['update_time'] = $time;
		$this->_db->updateData($ds,"PHPSESSID = '$id'");
		$this->gc($this->_maxtime);
	}

	public function gc($maxtime){
		$time = time() - $maxtime;
		$this->_db->deleteData("update_time <= '$time'");
		return true;
	}
}