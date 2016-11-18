<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
class DB
{
	/**
	 * 数据库机器ip
	 *
	 * @var string
	 */
	private $host;

	/**
	 * 数据库端口
	 *
	 * @var string
	 */
	private $port;

	/**
	 * 数据库名称
	 *
	 * @var string
	 */
	private $database;

	/**
	 * 用户名
	 *
	 * @var string
	 */
	private $user;

	/**
	 * 密码
	 *
	 * @var string
	 */
	private $password;

	/**
	 * db对象
	 *
	 * @var string
	 */
	private $db;
	/**
	 * 数据库名称
	 */
	private $db_name;

	/**
	 * 数据库连接
	 *
	 * @var object
	 */
	private $con;

	/**
	 * 错误编码
	 *
	 * @var int
	 */
	public $errCode = 0;
	
	public $tableName;
	
	/**
	 * 错误信息
	 *
	 * @var string
	 */
	public $errMsg = '';
	
	/**
	 * 表结构 防止sql注入
	 */
	
	public $structure=array();

	/**
	 * 清除错误标识，在每个函数调用前调用
	 */
	private function clearERR()
	{
		$this->errCode = 0;
		$this->errMsg  = '';
	}
	
		public function connect(){
			$this->link = mysql_connect($this->host,$this->user,$this->password,true);
			mysql_select_db($this->db_name);
			mysql_set_charset('utf8');
		}
	
	/**
	 *
	 * @param string host     机器ip
	 * @param int    port     端口
	 * @param string db_name  数据库名称
	 * @param string user     用户名称
	 * @param string password 密码
	 */
	public function __construct($host, $port, $db_name, $user, $password)
	{
		$this->host = $host;
		$this->port = $port;
		$this->db_name = $db_name;
		$this->user = $user;
		$this->password = $password;
		$this->magic_quotes = get_magic_quotes_gpc();
		$this->connect();
		$this->init();
		mysqli_query($this->con,'set names utf8');
		if($this->version() > '5.0.1') {
			mysqli_query($this->con,"SET sql_mode = ''");
		}
	}

	public function version() {
		return mysqli_get_server_info($this->con);
	}

	public function __destruct()
	{
		$this->closeDB();
	}

	/**
	 * 初始化对象
	 */
	private function init()
	{
		$this->con = mysqli_connect($this->host, $this->user, $this->password, $this->db_name, $this->port);
		if (!$this->con)
		{
			$this->errCode = 10301;
			$this->errMsg="db:{$this->host}:{$this->port}:{$this->db_name} error:".@mysqli_connect_error();
			return false;
		}
		return true;
	}

	/**
	 * 关闭数据库连接
	 */
	function closeDB()
	{
		if ($this->con) {
			return @mysqli_close($this->con);
		}
		return true;
	}

	/**
	 * 检查数据库连接,是否有效，无效则重新建立
	 */
	private function checkConnection()
	{
		if (!@mysqli_ping($this->con))
		{
			$this->closeDB();
			return $this->init();
		}
		return true;
	}
	
	
	
	
		private function getStructure($date){
			$arr = array();
			$sql = "desc {$this->tableName}";
			$result=@mysqli_query($this->con, $sql);
			$arr = array();
			while ($row = @mysqli_fetch_assoc($result))
			{
				$arr[] = $row['Field'];
			}
			$this->structure=$arr;
		}

	/**
	 * 拼装insert的sql语句
	 *
	 * @param string table    表名称
	 * @param array data    数据
	 *
	 * @return string
	 */
	public function getInsertString($table, $data)
	{
		$table = $this->filterString($table);
		$this->getStructure($talbe);
		$filed= '';
		$value= '';
		foreach($data as $key=>$item){
			if(!in_array($key,$this->structure)){
					continue;
			}
			//安全转义
			$item = mysql_real_escape_string($item,$this->link);
			$filed .= "`$key` ,";
			$value .= "'{$item}' ,";
		}
		$filed = rtrim($filed, ',');
		$value = rtrim($value, ',');
		$str = "insert into {$table} ({$filed}) values({$value})";
		return $str;
	}

	/**
	 * 拼装update的sql语句
	 *
	 * @param string  table    表名称
	 * @param array data    数据
	 * @param string condtion    条件
	 *
	 * @return string
	 */
	public function getUpdateString($table, $data, $condtion)
	{
		$str = '';
		$table = $this->filterString($table);
		foreach ($data as $k => $v)
		{
			$str .= $this->filterString($k)."='".$this->filterString($v)."',";
		}
		$str = preg_replace("/,$/", "", $str);
    	$sql = 'UPDATE '.$table.' SET '.$str;
    	if (!empty($condtion) && is_string($condtion))
    	{
    		$sql .= ' WHERE '.$condtion;
    	}
		return $sql;
	}

	/**
	 * 拼装insert or update的sql语句
	 *
	 * @param string  table    表名称
	 * @param array idata    插入数据
	 * @param array udata    更新数据
	 *
	 * @return string
	 */
	public function getInsertOrUpdateString($table, $idata, $udata)
	{
		$n_str = '';
		$v_str = '';
		$u_str = '';
		$table = $this->filterString($table);

		foreach ($idata as $k => $v)
		{
			$n_str .= $this->filterString($k).',';
			$v_str .= "'".$this->filterString($v)."',";
		}

		$n_str = preg_replace( "/,$/", "", $n_str );
		$v_str = preg_replace( "/,$/", "", $v_str );

		foreach ($udata as $k => $v)
		{
			$u_str .= $this->filterString($k)."='".$this->filterString($v)."',";
		}

		$u_str = preg_replace("/,$/", "", $u_str);


    	$sql = 'INSERT INTO '.$table.' ('.$n_str.') VALUES('.$v_str.') ON DUPLICATE KEY UPDATE '.$u_str;
		
	
		

		return $sql;
	}

	/**
	 * 新增数据,返回数组,格式:
	 * code:0为成功，其他为失败
	 * msg:错误消息
	 *
	 *
	 * @param string table   表名称
	 * @param array  data    数据
	 * @return 正确返回true，否则返回false
	 */
	public function insert($table, $data)
	{
		$this->tableName=$table;
		$sql = $this->getInsertString($table, $data);	
		return $this->execSql($sql);
	}

	/**
	 * ,更新数据,返回数组,格式:
	 * code:0为成功，其他为失败
	 * msg:错误消息
	 *
	 * @param string table    表名称
	 * @param array data    数据
	 * @param string condtion    查询条件
	 * @return 正确返回true，否则返回false
	 */
	public function update($table, $data, $condtion)
	{
		$sql = $this->getUpdateString($table, $data, $condtion);
		return $this->execSql($sql);
	}

	/**
	 * 插入或更新数据
	 *
	 */
	public function insertOrUpdate($table, $insert_array, $update_array)
	{
    	$sql = $this->getInsertOrUpdateString($table, $insert_array, $update_array);
    	return $this->execSql( $sql );
	}

	/**
	 * 删除指定条件的数据,,返回数组,格式:
	 * code:0为成功，其他为失败
	 * msg:错误消息
	 *
	 * @param  string table     表名称
	 * @param  string condtion  查询条件
	 * @return bool 正确返回true，否则返回false
	 *
	 */
	public function remove($table, $condtion)
	{
		$table = $this->filterString($table);
		$sql = 'DELETE FROM '.$table.' WHERE '.$condtion;
		return $this->execSql($sql);
	}

	/**
	 * 执行指定的sql语句,,返回数组,格式:
	 * code:0为成功，其他为失败
	 * msg:错误消息
	 * data:结果数据
	 *
	 * @param  string sql    	sql语句
	 * @return bool 正确返回true 否则返回false
	 */
	public function execSql($sql)
	{
		$this->clearERR();
		//是否是 SELECT SHOW DESCRIBE EXPLAIN
		if(preg_match("/^((SELECT)|(SHOW)|(DESCRIBE)|(EXPLAIN))\s/i", $sql))
		{
			$this->errCode = 10302;
			$this->errMsg = 'host:'.$this->host.',port:'.$this->port.',db:'.$this->db_name.',sql:'.$sql.',error:method cannot support SELECT SHOW DESCRIBE EXPLAIN';
			return false;
		}
		for ($i = 0; $i < 2; $i++)
		{
			$result = @mysqli_query($this->con, $sql);
			
			if($result === false){
				$errno = @mysqli_errno($this->con);
				if (($errno == 2013 || $errno == 2006) && $i < 1) {
					$r = $this->checkConnection();
					if ($r === true) continue;
				}
				$this->errCode = 10303;
				$this->errMsg  = 'host:'.$this->host.',port:'.$this->port.',db:'.$this->db_name.',sql:'.$sql.',errno:'.$errno.',error:'.@mysqli_error($this->con);
				return false;
			}
			break;
		}
		if ($result === true) return true;
		$this->errCode = 10304;
		$this->errMsg  = 'host:'.$this->host.',port:'.$this->port.',db:'.$this->db_name.',sql:'.$sql;//." affected_rows = {$n}";
		return false;
	}

	/**
	 * 获得满足条件的记录数量
	 *
	 * @param  string table     表名称
	 * @param  string condtion  查询条件
	 *
	 * @return  bool 正确返回true,否则返回false
	 */
	public function getRowsCount($table, $condtion)
	{
		$table = $this->filterString($table);
		$sql = 'SELECT count(*) as c FROM '.$table;
		if (!empty($condtion))
		{
			$sql .= ' WHERE '.$condtion;
		}
		$data = $this->getRows($sql);
		if ($data === false)
		{
			return false;
		}
		return ((count($data)<=0) ? 0 : $data[0]['c']);
	}
    /*
     *
     * 为了兼容老平台分页类而添加的一个获取查询记录总条数的方法
     */
	public function getNumRows($sql){
	    $query = mysqli_query($this->con,$sql);
	    return mysqli_num_rows($query);;
	}
	/**
	 * 返回自增字段值
	 *
	 */
	public function getInsertId()
	{
		$this->clearERR();
		$this->checkConnection();
		return mysqli_insert_id($this->con);
	}

	/**
	 * 根据查询sql语句获得指定的数据
	 *
	 * @param  string sql    sql语句
	 * @return bool 正确返回数据,错误返回false
	 */
	public function getRows($sql)
	{
		$this->clearERR();
		for ($i = 0; $i < 2; $i++)
		{
			$result = @mysqli_query($this->con, $sql);
			if($result === false){
				$errno = @mysqli_errno($this->con);
				if (($errno == 2013 || $errno == 2006) && $i < 1) {
					$r = $this->checkConnection();
					if ($r === true) continue;
				}
				$this->errCode = 10303;
				$this->errMsg  = 'host:'.$this->host.',port:'.$this->port.',db:'.$this->db_name.',sql:'.$sql.',errno:'.$errno.',error:'.@mysqli_error($this->con);
				return false;
			}
			break;
		}
		$data = array();
		while ($row = @mysqli_fetch_assoc($result))
		{
			$data[] = $row;
		}
		@mysqli_free_result($result);
		return $data;
	}

	/**
	 * 获得数据库表的指定行数
	 *
	 * @param   string table    表名称
	 * @param   array fields    需要获取的列名称
	 * @param   string condtion    查询条件
	 * @param   int startIndex    开始记录位置
	 * @param   int length    需要取得的条数量
	 *
	 * @return  bool 正确返回true，否则返回false
	 */
	public function getRows2($table, $fields, $condtion, $startIndex, $length)
	{
		$n_str = '';
		$table = $this->filterString($table);
		if (!empty($fields) && is_array($fields))
		{
			foreach ($fields as $v)
			{
				$n_str .= $this->filterString($v).',';
			}
			$n_str = preg_replace("/,$/", "", $n_str);
		}
		if (empty($n_str))
		{
			$n_str = '*';
		}
		$sql = 'SELECT '.$n_str.' FROM '.$table;
		if (!empty($condtion))
		{
			$sql .= ' WHERE '.$condtion;
		}
		if (is_int($startIndex) && is_int($length) && $startIndex >= 0 && $length > 0)
		{
			$sql .=' LIMIT '.$startIndex.','.$length;
		}
		return $this->getRows($sql);
	}

	/**
	 * 直接返回结果集, 以便在特殊应用场景下, 业务逻辑可自行处理返回结果集
	 *
	 * @param		string		$sql, sql语句
	 *
	 * @return		object/bool	正确返回数据,错误返回false
	 */
	public function getRS($sql) {
		$this->clearERR();
		for ($i = 0; $i < 2; $i++)
		{
			$result = @mysqli_query($this->con, $sql);
			if($result === false){
				$errno = @mysqli_errno($this->con);
				if (($errno == 2013 || $errno == 2006) && $i < 1) {
					$r = $this->checkConnection();
					if ($r === true) continue;
				}
				$this->errCode = 10303;
				$this->errMsg  = 'host:'.$this->host.',port:'.$this->port.',db:'.$this->db_name.',sql:'.$sql.',errno:'.$errno.',error:'.@mysqli_error($this->con);
				return false;
			}
			break;
		}
		return $result;
	}

	/**
	 * 过滤特殊字符
	 *
	 * @param string str    字符串
	 * @return string
	 */
	public function filterString($str)
	{
		if ($this->magic_quotes)
		{
			$str = stripslashes($str);
		}

		if ( is_numeric($str) ) {
			return $str;
		} else {
			$ret = @mysqli_real_escape_string($this->con, $str);

			if ( strlen($str) && !isset($ret) ) {
				$r = $this->checkConnection();
				if ($r !== true) {
					$this->closeDB();
					$ret = $str;
				}
			}

			return $ret;
		}
	}
}

//End of script

