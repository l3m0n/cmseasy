<?php
class action_admin {
	public $userid;
	public $groupid;
	public function __construct(){

	}

    public function check_login(){
        if(!isset($_COOKIE['login_username']) || !isset($_COOKIE['login_password'])){
            action_public::turnPage($GLOBALS['config']['site_url'].'index.php?case=user&act=login','您还未登陆');
        }else{
            $user = db_user::getInstance();
            $userinfo = $user->getDataLimit('password,userid,groupid',"username='{$_COOKIE['login_username']}'");
            if(empty($userinfo) || md5($userinfo[0]['password'].$GLOBALS['config']['cookie_password']) != $_COOKIE['login_password']){
            	action_public::turnPage($GLOBALS['config']['site_url'].'index.php?case=user&act=login','用户不存在！');
            }
        }
        $this->userid = $userinfo[0]['userid'];
        $this->groupid = $userinfo[0]['groupid'];
    }
    public function check_admin_login(){
    	$this->check_login();
    	$roles = $_SESSION['roles'];
        if(!$roles['bbs']){
        	action_public::turnPageAdmin($GLOBALS['config']['site_url'].'index.php?case=user&act=login','不存在该管理员！!');
        }
    }
    public function get_user_info(){
    	if(!isset($_COOKIE['login_username']) || !isset($_COOKIE['login_password'])){
             $this->userid = null;
             $this->groupid = null;
             return ;
        }else{
            $user = db_user::getInstance();
            $userinfo = $user->getDataLimit('password,userid,groupid',"username='{$_COOKIE['login_username']}'");
            if(empty($userinfo) || md5($userinfo[0]['password'].$GLOBALS['config']['cookie_password']) != $_COOKIE['login_password']){
            	action_public::turnPage($GLOBALS['config']['site_url'].'index.php?case=user&act=login','用户不存在！');
            }
        }
        $this->userid = $userinfo[0]['userid'];
        $this->groupid = $userinfo[0]['groupid'];
    }
    public function is_admin(){
    	$this->get_user_info();
    	if($this->groupid == '888')
    	     return true;
    	return false;
    }


}
?>