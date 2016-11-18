<?php
/**
* CmsEasy Live http://www.cmseasy.cn
* by CmsEasy Live Team
**
* Software Version: CmsEasy Live v 1.2.0
* Copyright 2009 by: CmsEasy, (http://www.cmseasy.cn)
* Support, News, Updates at: http://www.cmseasy.cn
**
* This program is not free software; you can't may redistribute it and modify it under
**
* This file contains configuration settings that need to altered
* in order for CE Live to work, and other settings that
**/
	error_reporting(0);

    define('CELIVE_DB_ALL', 1);
    define('CELIVE_DB_ROWS', 2);
    define('CELIVE_DB_HEADERS', 4);
    define('CELIVE_DB_CACHE', 8);
    define('CELIVE_DB_NOCACHE', 16);
    define('CELIVE_DB_CLEARCACHE', 32);

    class Database {

        var $id;
        var $connection;
        var $error;
        var $result;
        var $total_results;
        var $select_result;
        var $table;

        function connect()
        {
            //$this->id = mysql_connect($GLOBALS['config']['host'], $GLOBALS['config']['username'], $GLOBALS['config']['password']) or die(mysql_error());
			$this->id = mysql_connect($GLOBALS['config']['host'], $GLOBALS['config']['username'], $GLOBALS['config']['password']);
			mysql_query("SET NAMES 'utf8'");
            if ($this->id) {
                $this->connection = true;
                $this->select();
            } else {
                $this->connection = false;
                $this->error = mysql_error($this->id);
            }
        }

        function disconnect()
        {
            if ($this->connection) {
                mysql_close($this->id);
                $this->connection = false;
            }
        }


        function status($arg)
        {
            switch ($arg) {
                case 'die':
                    if ($this->connection = false) {
                        echo $this->error;
                        exit;
                    }
                    return false;
                    break;
                default:
                    return $this->connection;
            }
        }

        function select()
        {
            mysql_select_db($GLOBALS['config']['database'], $this->id) or die(mysql_error());
        }


        function prefix($sql)
        {
        	$matches = '';
            if (preg_match('/^SELECT/i', $sql)) {
                preg_match("/SELECT (.*) FROM (.*) WHERE (.*)/", $sql, $matches);
                $return = '';
                preg_match_all("|`[^`]+`|U", $matches[2], $return);
                foreach ($return as $a) {
                    foreach ($a as $from) {
                        $matches[2] = str_replace($from, '`'.$GLOBALS['config']['prefix'].substr($from, 1), $matches[2]);
                    }
                }
                $sql = 'SELECT '.$matches[1].' FROM '.$matches[2].' WHERE '.$matches[3];
            	$this->table = substr($matches[2], 1, (strlen($matches[2]) - 2));
            } elseif (preg_match('/^UPDATE/', $sql)) {
                preg_match("/UPDATE (.*) SET (.*) WHERE (.*)/", $sql, $matches);
                preg_match_all("|`[^`]+`|U", $matches[1], $return);
                foreach ($return as $a) {
                    foreach ($a as $from) {
                        $matches[1] = str_replace($from, '`'.$GLOBALS['config']['prefix'].substr($from, 1), $matches[1]);
                    }
                }
                $sql = 'UPDATE '.$matches[1].' SET '.$matches[2].' WHERE '.$matches[3];
            	$this->table = substr($matches[1], 1, (strlen($matches[1]) - 2));
            } elseif (preg_match('/^ALTER (.*) CHANGE/', $sql)) {
                preg_match("/ALTER TABLE (.*) CHANGE (.*)/", $sql, $matches);
                preg_match_all("|`[^`]+`|U", $matches[1], $return);
                foreach ($return as $a) {
                    foreach ($a as $from) {
                        $matches[1] = str_replace($from, '`'.$GLOBALS['config']['prefix'].substr($from, 1), $matches[1]);
                    }
                }
                $sql = 'ALTER TABLE '.$matches[1].' CHANGE '.$matches[2];
            	$this->table = substr($matches[1], 1, (strlen($matches[1]) - 2));
            } elseif (preg_match('/^ALTER (.*) ADD/', $sql)) {
                preg_match("/ALTER TABLE (.*) ADD (.*)/", $sql, $matches);
                preg_match_all("|`[^`]+`|U", $matches[1], $return);
                foreach ($return as $a) {
                    foreach ($a as $from) {
                        $matches[1] = str_replace($from, '`'.$GLOBALS['config']['prefix'].substr($from, 1), $matches[1]);
                    }
                }
                $sql = 'ALTER TABLE '.$matches[1].' ADD '.$matches[2];
            	$this->table = substr($matches[1], 1, (strlen($matches[1]) - 2));
            } else {
                $pos = strpos($sql, '`');
                $prefix = substr($sql, $pos, strlen($GLOBALS['config']['prefix']));
                if ($prefix !== $GLOBALS['config']['prefix']) {
                    $sql = str_replace(substr($sql, 0, ($pos + 1)), substr($sql, 0, ($pos + 1)).$GLOBALS['config']['prefix'], $sql);
                }
                $pos = strpos($sql, '`');
                $table = substr($sql, ($pos + 1));
                $pos = strpos($table, '`');
                $this->table = substr($table, 0, $pos);
            }
            return $sql;
        }

        function query($sql, $table = '', $cache = '', $arg = '')
        {
            $line = explode("\n", $sql);
            if (count($line) == 1) {
                $line[0] = $this->prefix($line[0]);
                if ($table == '') {
                	$table = $this->table;
                }
                return $this->raw_query($line[0], $table, $cache, $arg);
            }/* else {
                $plain_sql = '';
                foreach ($line as $val) {
                    if (!ereg('<*>', $val)) {
                        $tmp = trim(trim(stripslashes($val), '\t'));
                        if ($tmp !== '' && $tmp{0} !== '#' && $tmp{0} !== '-') {
                            if ($tmp[(strlen($tmp) - 1)] == ';') {
                                $plain_sql .= $tmp;
                                $plain_sql = $this->prefix($plain_sql);
				                if ($table == '') {
				                	$table = $this->table;
				                }
                                $this->raw_query($plain_sql, $table, $cache, $arg);
                                $plain_sql = '';
                            } else {
                                $plain_sql .= $tmp;
                            }
                        }
                    }
                }
                return true;
            }*/
        }

        function raw_query($sql, $table, $cache = '', $arg = '')
        {
            if ($sql == '') {
                return false;
            }
            if ($arg == '') {
                $arg = CELIVE_DB_ROWS;
            }
            if ($cache == '') {
            	$cache = CELIVE_DB_CACHE;
            }
			if ($cache == CELIVE_DB_CLEARCACHE) {
            	$this->clear_cache();
            }
            $this->select_result = '';
            if (preg_match('/^SELECT/i', $sql)) {
            	if ($cache == CELIVE_DB_CACHE) {
	            	$this->result = $this->get_cache($sql, $table);
            	} else {
            		$this->result = false;
            	}
	            if (!$this->result) {
	                $this->result = mysql_query($sql, $this->id);
	                $this->total_results = 0;
	                while ($current_row = mysql_fetch_row($this->result)) {
	                    if (($arg == CELIVE_DB_ALL || $arg == CELIVE_DB_HEADERS) && $this->total_results == 0) {
	                        foreach($current_row as $key => $val) {
	                            $this->select_result[$this->total_results][$key] = $this->field($this->result, $key);
	                        }
	                        $this->total_results++;
	                    }
	                    if ($arg == CELIVE_DB_ALL || $arg == CELIVE_DB_ROWS) {
	                        foreach($current_row as $key => $val) {
	                            $this->select_result[$this->total_results][$this->field($this->result, $key)] = $val;
	                        }
	                        $this->total_results++;
	                    }
	                }
	                if ($this->select_result !== '') {
	                	if ($cache !== CELIVE_DB_NOCACHE) {
	                		$this->set_cache($sql, $table, $this->select_result);
	                	}
	                    return $this->select_result;
	                } else {
	                	if ($cache !== CELIVE_DB_NOCACHE) {
	                		$this->set_cache($sql, $table, false);
	                	}
	                    return false;
	                }
	            } else {
                    return $this->result;
	            }
            } else {
	            $this->result = mysql_query($sql, $this->id);
                if ($this->result && !preg_match('/^SELECT/', $sql)) {
                    if (preg_match('/^INSERT INTO/', $sql)) {
                    	$this->clear_cache($table);
                        return $this->id();
                    } else {
                    	$this->clear_cache($table);
                        return $this->affected();
                    }
                } else {
                    $this->error = mysql_error($this->id);
                    //echo $this->error.'<br /><br />'.$sql;
					//屏蔽报错
                    //exit;
                }
            }
        }

        function set_cache($sql, $table, $sqlresult)
        {
            if ($GLOBALS['config']['safe_mode']) {
                return false;
            }
            $dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.$table;
        	$cache = $dir.DIRECTORY_SEPARATOR.md5($sql).'.dbc';
            $contents = serialize($sqlresult);
            if (!file_exists($dir)) {
            	mkdir($dir);
            }
            if ($fp = fopen($cache, 'w')) {
                fwrite($fp, $contents);
                fclose($fp);
            }
        }

        function get_cache($sql, $table)
        {
            if ($GLOBALS['config']['safe_mode']) {
                return false;
            }
            $cache = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.$table.DIRECTORY_SEPARATOR.md5($sql).'.dbc';
            if (file_exists($cache) && filemtime($cache) > (time() - $GLOBALS['config']['expire'])) {
                if ($fp = fopen($cache, 'r')) {
                    $contents = fread($fp, filesize($cache));
                    fclose($fp);
                    $sqlresult = unserialize($contents);
                    return $sqlresult;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        function clear_cache($table ='')
        {
            if ($GLOBALS['config']['safe_mode']) {
                return false;
            }
        	if ($table == '') {
    			$cache = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR.'database';
        	} else {
    			$cache = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.$table;
        	}
        	$GLOBALS['file']->rdelete($cache);
        }

        function id()
        {
            return mysql_insert_id($this->id);
        }

        function fetch($sql)
        {
            return mysql_fetch_array($sql, $this->id);
        }

        function num($sql)
        {
            return mysql_num_rows($sql, $this->id);
        }

        function affected()
        {
            return mysql_affected_rows($this->id);
        }

        function field($sql, $id)
        {
            return mysql_field_name($sql, $id);
        }
		function my_fetch_array($sql,$dbbase="",$type=0)
		{
			$query_id=$this->my_query($sql,$dbbase);
			$this->num_rows=mysql_num_rows($query_id);
			for($i=0;$i<$this->num_rows;$i++){
				if($type==0)
					$array[$i]=mysql_fetch_array($query_id);
				else
					$array[$i]=mysql_fetch_row($query_id);
				}
			$this->my_free_result($query_id);
			return $array;
        }

	    function my_query($sql,$dbbase="")
		{
			if($dbbase!="") $this->my_change_db($dbbase);
			$this->query_id=mysql_query($sql);
			if(!$this->query_id) $this->my_halt("SQL error: ".$sql);
			return $this->query_id;
        }
	    function my_free_result($query_id)
        {
            @mysql_free_result($query_id);
        }
		function my_change_db($dbbase="")
		{
			$this->my_connect($dbbase);
        }
	    function my_connect($dbbase="")
		{
		    global $usepconnect;
		    if ($usepconnect==1){
				  $this->dbLink=@mysql_pconnect($this->dbServer,$this->dbUser,$this->dbPwd);
								} else {
				  $this->dbLink=@mysql_connect($this->dbServer,$this->dbUser,$this->dbPwd);
				  }
			if(!$this->dbLink) $this->my_halt("Can't connect!");
			if ($dbbase=="") {
			  $dbbase=$this->dbDatabase;
            }
		    mysql_query("set names 'utf-8'");
			if(!mysql_select_db($dbbase, $this->dbLink))
			{
				$this->my_halt("Don't use this DB!");
			}
        }
		function my_halt($errmsg)
        {
            $msg="DB error - ";
            $msg.=$errmsg;
            echo $msg;
            die();
        }

    }