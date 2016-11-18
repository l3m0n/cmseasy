<?php
  require_once 'bbs_public.php';
  if(!defined('ROOT')) exit('can\'t access!');
  //暂时允许用户未登录评论！
  //验证用户登陆相关操作
  //$admin = new action_admin();

  if(isset($_POST['reply'])){
  	  if(!isset($_POST['verify']) || strtolower(trim($_POST['verify'])) != strtolower($_SESSION['verify'])){
  	  	  echo -1; //输入-1表示验证码输入错误！
  	  	  exit();
  	  }
  	  $data = array();
      $data['aid'] = isset($_POST['aid']) ? intval($_POST['aid']) : exit(0);
      $data['tid'] = isset($_POST['tid']) ? intval($_POST['tid']) : 0;
      $data['content'] = isset($_POST['content']) ? unescape($_POST['content']) : exit(0);
      $data['username'] = isset($_COOKIE['username']) ? htmlspecialchars($_COOKIE['username']) : '';
      //$data['userid'] = $admin->userid;
      $data['addtime'] = mktime();
      $data['ip'] = $_SERVER['REMOTE_ADDR'];
      $reply = db_bbs_reply::getInstance();
      $r = $reply->inserData($data);
      if($r){
      	  $archive = db_bbs_archive::getInstance();
          $archive->updateClickReply($data['aid'],'replynum');
          $_SESSION['verify'] = '';
          echo 1;//输入1表示成功发表评论
          exit();
      }else{
      	  echo 0;//评论未能正确插入数据库
      	  exit();
      }
  }

  if(isset($_GET['verify'])){
      if(strtolower(trim($_GET['verify'])) == strtolower($_SESSION['verify']))
         echo 1;
      else
         echo -1;
  }






