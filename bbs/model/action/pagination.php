<?php
/**
 * 分页类,支持: GET/POST/AJAX
 *  require_once(DROOT.'/class/class_pagination.php');
	//对数据库查询分页
    $o = new stdClass();
    $o->db = $oDb;
    $o->query = "SELECT * FROM diarys";
    $o->size = 10;             //每页条数
    $o->show = 10;             //显示链接数
    $o->total = 99999; //记录总数
    $o->method = 'get';
    $o->js = true;
    $oPager = new pagination( $o);
    //$result = $oPager->start( );
    $feeds = $oPager->fetchAll();
	$pagelink = $oPager->page_link();
    echo $oPager->page_link();
    
    //对数组分页
    $o = new stdClass();
    $o->isArray = true;
    $o->array = range(0,100);
    $o->size = 3;             //每页条数
    $o->show = 10;             //显示链接数
    $o->method = 'get';
    $oPager = new pagination( $o);
	$feeds = $oPager->fetchAll();
	$pagelink = $oPager->page_link();
 */
class action_pagination{
    public $total;
    public $max;  //取得的最大记录数
    private $pg;
    private $pt;
    private $db;
    private $method;
    private $pageNow;
    private $pageTotal;	
    private $signFirst; //首页
    private $signTail;	//尾页
    private $js;	//是否生成JS代码
    private $isArray; //是否是对数组分页
    private $array;   //对数组分页时的目标数组
    
    public function __construct( $o ){
        $this->db = $o->db;
        $this->pg = $o->pg ? $o->pg : 'pg'; //第几分页
        $this->pt = $o->pt ? $o->pt : 'pt'; //总记录数
        $this->query = $o->query;           //要分页的查询语句
        $this->tquery = $o->tquery;         //计算总数的查询语句
        $this->sflag = $o->sflag ? $o->start : '[';     //开始符号
        $this->eflag = $o->eflag ? $o->eflag : ']';     //结束符号
        $this->method = in_array(strtoupper($o->method), array('POST', 'GET')) ? $o->method : 'GET'; //参数获取方式
        $this->ajax = $o->ajax;             //是否打开ajax
        $this->size = $o->size;             //每页条数
        $this->show = $o->show;             //显示链接数
        $this->total = (int)$o->total;
        $this->js = $o->js ? true : false;
        $this->signFirst = $o->signFirst ? $o->signFirst : "首页";
        $this->signTail = $o->signTail ? $o->signTail : '尾页';
        $this->isArray = $o->isArray;
        $this->array = (array)$o->array;
        $this->max = (int)$o->max ? (int)$o->max : 999999;
        $this->pageNow = $this->gain_now();
    }
    public function start(){
		$this->gain_total();
		$this->pageTotal = ceil($this->total/$this->size); //总共有多少页
				
		$page = $this->gain_now();
		$offset = ($page - 1) * $this->size;
		$this->query .= " LIMIT {$offset},{$this->size}";
        //return $this->db->query( $this->query);
        return $this->query;
    }
    
    public  function fetchAll(){
    	if( $this->isArray){
    		$this->gain_total();
    		$this->pageTotal = ceil($this->total/$this->size); //总共有多少页
			$page = $this->gain_now();
			$offset = ($page - 1) * $this->size;
			$temp = array_slice($this->array, $offset, $this->size);
    	}else{
//	    	$result = $this->start();
//	    	while ($array = $this->db->fetchArray($result, MYSQL_ASSOC)){
//					$temp[] = $array;        		
//	       }
            return $this->db->getRows($this->start());
    	}
       return (array)$temp;
    }
    public  function gain_total(){
        if( $this->total > 0){ //设置了最大记录数
        	
        }else if( (int)$_REQUEST[$this->pt] > 0){
		    $this->total = (int)$_REQUEST[$this->pt];
		}else if($this->isArray){
			$this->total = count( $this->array);
		}else if( empty( $this->tquery)){
            $this->total = $this->db->getNumRows($this->query);
		}/*else{
			$array = $this->db->getOne( $this->tquery, MYSQL_NUM);
			$this->total = (int)array_shift($array);
		}*/
		$this->total = $this->total > $this->max ? $this->max : $this->total;
		return $this->total;
    }
    private function gain_now(){
        return max((int)$_REQUEST[$this->pg],1);
    }
    private function gain_php(){
        return './' . end(explode('/', $_SERVER['PHP_SELF'])); 
    }
    private function gain_form(){
        $string .= "<form name='pgForm' id='pgForm' action='".$this->gain_php()."' method='{$this->method}' >\r";
        $array = $this->method=='POST' ? (array)$_POST : (array)$_GET;
        foreach ( $array as $key => $value){
            if( in_array($key, array($this->pg, $this->pt))){
                continue;
            }
            $string .= "<input type='hidden' name='{$key}' value='{$value}' />\r";
        }
        $string .= "<input type='hidden' name='{$this->pg}' id='{$this->pg}' />\r";
        $string .= "<input type='hidden' name='{$this->pt}' id='{$this->pt}' />\r";
        $string .= '</form>';
        return $string;
    }
    private function gain_option(){
        $string .= "<select name='pgOption' id='pgOption' onchange='pgGo( this.value)'>";
        for($i=1; $i<=$this->pageTotal; $i++){
            $select = ( $i == $this->pageNow) ? "selected='selected'" : '';
            $string .= "<option value='{$i}' {$select}>第{$i}页</option>\r";
        }
        $string .= "</select>";
        return $string;
    }
    private function gain_left( $pg){
        $array = $this->method=='POST' ? (array)$_POST : (array)$_GET;
        $string = "{$this->pg}={$pg}&{$this->pt}={$this->total}";
        foreach ( $array as $key => $value){
            if( in_array($key, array($this->pg,$this->pt))){
                continue;
            }
            $string .= "&".$key."=".$value;
        }
        return ($this->is_now($pg)?'<span class="current">':"<a href='".$this->gain_php()."?{$string}' ".($this->js?"onclick='pgGo({$pg})'":'').">").$this->sflag; 
    }
    private function gain_right( $pg){
        return $this->eflag . ($this->is_now( $pg) ? "</span>" : "</a>"); 
    }
    private function gain_link( $pg){
        return  $this->gain_left( $pg) . $pg . $this->gain_right( $pg);
    }
    private function gain_first(){
        return $this->gain_left( 1) . $this->signFirst . $this->gain_right( 1);
    }
    private function gain_last(){
        return $this->gain_left( $this->pageTotal) . $this->signTail . $this->gain_right( $this->pageTotal);
    }
    private function gain_middle(){
        $middle = ceil($this->show / 2);
        $now = $this->gain_now();
        $min = ($this->pageTotal <= $this->show) ? 1 : min($this->pageTotal-$this->show, max($now-$middle, 1));
        $max = ($this->pageTotal <= $this->show) ? $this->pageTotal : min($min+$this->show, $this->pageTotal);
       
        for($i=$min; $i<=$max; $i++){
            $string .= $this->gain_link( $i);
        }
        return $string;
    }
    private function is_now( $pg){
        return $this->gain_now() == $pg;    
    }
    private function gain_js(){
        $string = "<script>\r";
        $string .= "var pgGo = function( pg){
	                   document.getElementById('{$this->pg}').value = pg;
	                   document.getElementById('{$this->pt}').value = {$this->total};
	                   document.getElementById('pgForm').submit();
                    }\r";
        $string .= "</script>\r";
        return $string;
    }
    public function page_link(){
        if( ! $this->total) return false;
        $string .= $this->gain_first();
        $string .= $this->gain_middle();
        $string .= $this->gain_last();
        $string .= $this->js ? $this->gain_option():'';
        $string .= $this->js ? $this->gain_form():'';        
        $string .= $this->js ? $this->gain_js() : '';        
        return $string;
    }
}