<?php

/**
 * CmsEasy Live http://www.cmseasy.cn
 * by CmsEasy Live Team
 * *
 * Software Version: CmsEasy Live v 1.2.0
 * Copyright 2009 by: CmsEasy, (http://www.cmseasy.cn)
 * Support, News, Updates at: http://www.cmseasy.cn
 * *
 * This program is not free software; you can't may redistribute it and modify it under
 * *
 * This file contains configuration settings that need to altered
 * in order for CE Live to work, and other settings that
 * */
class Auth {

    var $username;
    var $password;
    var $result;
    var $operatorname;

    function operator($username = '', $password = '') {
        if ($username == '' && $password == '') {
            if (isset($_SESSION['cel_username']) && isset($_SESSION['cel_password'])) {
                if ($GLOBALS['db']->query('SELECT `id` FROM `operators` WHERE `username`="'.$_SESSION['cel_username'].'" AND `password`="'.$_SESSION['cel_password'].'"')) {
                    $this->username=$_SESSION['cel_username'];
                    $this->password=$_SESSION['cel_password'];
                    return true;
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }
        }
        else {
            if ($username !== '' && $password !== '') {
                if ($GLOBALS['db']->query('SELECT `id` FROM `operators` WHERE `username`="'.$username.'" AND `password`="'.md5($password).'"')) {
                    return true;
                }
                else {
                    return false;
                }
            }
            elseif ($username !== '' && $password == '') {
                if ($GLOBALS['db']->query('SELECT `id` FROM `operators` WHERE `username`="'.$username.'"')) {
                    return true;
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }
        }
    }

    function admin() {
        if (isset($_SESSION['cel_username']) && isset($_SESSION['cel_password'])) {
            if ($this->result=$GLOBALS['db']->query('SELECT `level` FROM `operators` WHERE `username`="'.$_SESSION['cel_username'].'" AND `password`="'.$_SESSION['cel_password'].'"')) {
                if ($this->result[0]['level'] == '0') {
                    return true;
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    function login($username, $password, $arg = '') {
        if ($arg == '') {
            if ($login=$GLOBALS['db']->query('SELECT `id` FROM `operators` WHERE `username`="'.$username.'" AND `password`="'.md5($password).'"')) {
                $_SESSION['cel_username']=$username;
                $_SESSION['cel_password']=md5($password);
                $_SESSION['cel_operatorid']=$login[0]['id'];
                return true;
            }
            else {
                return false;
            }
        }
        else {
            switch ($arg) {
                case 'no_md5':
                    if ($GLOBALS['db']->query('SELECT `id` FROM `operators` WHERE `username`="'.$username.'" AND `password`="'.$password.'"')) {
                        $_SESSION['cel_username']=$username;
                        $_SESSION['cel_password']=$password;
                        return true;
                    }
                    else {
                        return false;
                    }
                    break;
                default:
                    return false;
            }
        }
    }

    function remotelogin($username, $password, $arg = '') {
        if ($arg == '') {
            if ($login=$GLOBALS['db']->query('SELECT `id` FROM `operators` WHERE `username`="'.$username.'" AND `password`="'.$password.'"')) {
                $_SESSION['cel_username']=$username;
                $_SESSION['cel_password']=md5($password);
                $_SESSION['cel_operatorid']=$login[0]['id'];
                return true;
            }
            else {
                return false;
            }
        }
        else {
            switch ($arg) {
                case 'no_md5':
                    if ($GLOBALS['db']->query('SELECT `id` FROM `operators` WHERE `username`="'.$username.'" AND `password`="'.$password.'"')) {
                        $_SESSION['cel_username']=$username;
                        $_SESSION['cel_password']=$password;
                        return true;
                    }
                    else {
                        return false;
                    }
                    break;
                default:
                    return false;
            }
        }
    }

    function logout() {
        unset($_SESSION['cel_username']);
        unset($_SESSION['cel_password']);
        if (!isset($_SESSION['cel_username']) && !isset($_SESSION['cel_password'])) {
            return true;
        }
        else {
            return false;
        }
    }

    function check_login() {
        if ($this->operator()) {
            $this->do_login();
            //header('Location: '.$GLOBALS['conf']['url'].'/admin/index.php');
        }
    }

    function check_login1() {
        if ($this->operator()) {
            $this->do_login1();
            //header('Location: '.$GLOBALS['conf']['url'].'/admin/index.php');
        }
    }

    function check_logout() {
        if (!$this->operator()) {
            $activeid=$_SESSION['cel_activeid'];
            $sql="DELETE FROM `activity` WHERE `id`='".$activeid."'";
            $GLOBALS['db']->query($sql);
            //session_unset();
            header('Location: ../admin/');
            exit;
        }
    }

    function check_logout1() {
        if (!$this->operator()) {
            $activeid=$_SESSION['cel_activeid'];
            $sql="DELETE FROM `activity` WHERE `id`='".$activeid."'";
            $GLOBALS['db']->query($sql);
            //session_unset();
            //header('Location: ../admin/');
            //exit;
        }
    }

    function do_login() {
        $operatorid=$_SESSION['cel_operatorid'];
        $timestamp=time();
        $status='2';
        $sql="SELECT * FROM `assigns` WHERE `operatorid`='".$operatorid."'";
        @$result=$GLOBALS['db']->query($sql);
        $departmentid=$result[0]['departmentid'];
        if (empty($departmentid))
            $departmentid=0;
        $sql="DELETE FROM `activity` WHERE `operatorid`='".$operatorid."'";
        $GLOBALS['db']->query($sql);
        $sql="INSERT INTO `activity` (`timestamp`,`operatorid`,`departmentid`,`status`) values('".$timestamp."','".$operatorid."','".$departmentid."','".$status."')";
        $GLOBALS['db']->query($sql);
        $activeid=mysql_insert_id();
        $_SESSION['cel_activeid']=$activeid;
        $_SESSION['cel_operatorid']=$operatorid;
        $_SESSION['cel_departmentid']=$departmentid;
        $_SESSION['cel_sound']="1";
        header('Location: ../admin/index.php');
    }

    function do_login1() {
        $operatorid=$_SESSION['cel_operatorid'];
        $timestamp=time();
        $status='2';
        $sql="SELECT * FROM `assigns` WHERE `operatorid`='".$operatorid."'";
        @$result=$GLOBALS['db']->query($sql);
        $departmentid=$result[0]['departmentid'];
        if (empty($departmentid))
            $departmentid=0;




        $sql="SELECT * FROM `activity` WHERE `operatorid`='".$operatorid."'";
        @$result=$GLOBALS['db']->query($sql);
        if ($result[0]['operatorid']) {

            $sql="DELETE FROM `activity` WHERE `operatorid`='".$operatorid."'";
            $GLOBALS['db']->query($sql);
        }



        $sql="INSERT INTO `activity` (`timestamp`,`operatorid`,`departmentid`,`status`) values('".$timestamp."','".$operatorid."','".$departmentid."','".$status."')";
        $GLOBALS['db']->query($sql);
        $activeid=mysql_insert_id();
        $_SESSION['cel_activeid']=$activeid;
        $_SESSION['cel_operatorid']=$operatorid;
        $_SESSION['cel_departmentid']=$departmentid;
        $_SESSION['cel_sound']="1";
    }

}

?>