<?php

final class stsession {
	private $_path = null;
	private $_name = null;
	private $_db = null;
	private $_ip = null;
	private $_maxtime = 0;
	private $_prefix = '';

	public function __construct($db) {
		session_set_save_handler(
			array($this, 'open'),
			array($this, 'close'),
			array($this, 'read'),
			array($this, 'write'),
			array($this, 'destroy'),
			array($this, 'gc')
		);
		$this->_db = $db;
		$this->_ip = $_SERVER['REMOTE_ADDR'];
		$this->_maxtime = intval(ini_get('session.gc_maxlifetime'))?intval(ini_get('session.gc_maxlifetime')):1440;;
		$config = config::get('database');
		$this->_prefix = isset($config['prefix']) ? $config['prefix'] : '';
		session_start();
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
		//var_dump($sql);
		$res = $this->_db->query($sql);
		if (!$row = $this->_db->fetch_array($res)) {
			return null;
		} elseif ($this->_ip != $row['client_ip']) {
			if(config::get('session_ip')){
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
		$sql = "SELECT * FROM {$this->_prefix}sessionox where PHPSESSID = '$id'";
		//var_dump($sql);
		$res = $this->_db->query($sql);
		$time = time();
		$row = $this->_db->fetch_array($res);
		if ($row) {
			//if ($row['data'] != $data) {
			$sql = "UPDATE {$this->_prefix}sessionox SET update_time='$time',data='$data' WHERE PHPSESSID = '$id'";
			$this->_db->query($sql);
			//}
		} else {
			if (!empty($data)) {
				$sql = "INSERT INTO {$this->_prefix}sessionox (PHPSESSID, update_time, client_ip, data) VALUES ('$id','$time','$this->_ip','$data')";
				$this->_db->query($sql);
			}
		}
		return true;
	}

	public function destroy($id) {
		$sql = "DELETE FROM {$this->_prefix}sessionox WHERE PHPSESSID = '$id'";
		//var_dump($sql);
		$this->_db->query($sql);
		return true;
	}

	public function refresh($id){
		$time = time();
		$sql = "UPDATE {$this->_prefix}sessionox SET update_time='$time' WHERE PHPSESSID = '$id'";
		//var_dump($sql);
		$this->_db->query($sql);
		$this->gc($this->_maxtime);
	}

	public function gc($maxtime){
		$time = time() - $maxtime;
		$sql = "DELETE FROM {$this->_prefix}sessionox WHERE update_time <= '$time'";
		//var_dump($sql);
		$this->_db->query($sql);
		return true;
	}
}