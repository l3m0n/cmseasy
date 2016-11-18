<?php

if (!defined('ROOT'))
    exit('Can\'t Access !');

class install_act extends act {

    function init() {
        header('Cache-control: private, must-revalidate');
        if (self::installed())
            exit('系统已安装！若要再安装，请删除文件 /install/locked ! ');
        set_time_limit(0);
    }

    function index_action() {

        $this->view->mysql_pass = false;
        if (front::get('step') == 2) {
            $connect = @mysql_connect(front::post('hostname'), front::post('user'), front::post('password'));
            if (front::post('createdb') && !@mysql_select_db(front::post('database'))) {
                @mysql_query("CREATE DATABASE " . front::post('database'));
                @mysql_query("ALTER DATABASE `$_POST[database]` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");
            }
            front::$post['prefix'] = strtolower(front::$post['prefix']);
            if ($connect) {
                $ver = mysql_query('SELECT VERSION()  as ver');
                $ver = mysql_fetch_array($ver);
                $this->view->mysql_verion = $ver['ver'];
                $this->view->mysql_ver = (int) $ver['ver'];
                $db = @mysql_select_db(front::post('database'));
                if ($db)
                    $this->view->mysql_pass = true;
                else
                    $this->view->dberror = true;
                config::modify(front::$post);
                config::modify(array('cookie_password' => sha1(get_hash())));
                config::modify(array('install_admin' => front::post('admin_username')));
                if (!front::post('admin_password') || !front::post('admin_username') || front::post('admin_password') <> front::post('admin_password2')) {
                    $this->view->adminerror = true;
                }
                if ($this->view->mysql_pass && front::post('install')) {
                    $this->instalsqltype = front::post('testdata');
                    $this->smodarr = front::post('smod');
                    $this->install();
                    file_put_contents(ROOT . '/install/locked', 'install-locked !');
                    @unlink(ROOT . '/install/index.php');
                }
                mysql_close($connect);
            }else {
                //var_dump($_POST);
                //config::modify(front::$post);
            }
        }
        $this->render();
    }

    private function install() {
        set_time_limit(0);
        if ($this->instalsqltype) {
            $sqlquery = file_get_contents(ROOT . '/install/data/install_testdb.sql');
        } else {
            $sqlquery = file_get_contents(ROOT . '/install/data/install.sql');
        }
        $smods = '';
        if (!empty($this->smodarr)) {
            $smods = implode(',', $this->smodarr);
            foreach ($this->smodarr as $val) {
                $modsqlquery.=file_get_contents(ROOT . '/install/data/install_' . $val . '.sql');
                if (!$modsqlquery)
                    exit('模块数据库文件不存在！');
                config::modifymod(front::$post, $val);
                config::modifymod(array('url' => front::post('site_url') . $val), $val);
                config::modifymod(array('username' => front::post('user')), $val);
                config::modifymod(array('host' => front::post('hostname')), $val);
            }
        }
        config::modify(array('mods' => $smods));
        if (!$sqlquery)
            exit('数据库文件不存在！');
        $sqlquery = $sqlquery . $modsqlquery;
        $sqlquery = str_replace('cmseasy_', config::get('database', 'prefix'), $sqlquery);
        $sqlquery = str_replace('\'admin\'', '\'' . front::post('admin_username') . '\'', $sqlquery);
        $sqlquery = str_replace('\'21232f297a57a5a743894a0e4a801fc3\'', '\'' . md5(front::post('admin_password')) . '\'', $sqlquery);
        $mysql = new user();
        $sqlquery = str_replace("\r", "", $sqlquery);
        $sqls = preg_split("/;[ \t]{0,}\n/", $sqlquery);
        $nerrCode = "";
        $i = 0;
        foreach ($sqls as $q) {
            $q = trim($q);
            if ($q == "") {
                continue;
            }
            if ($mysql->query($q)) {
                usleep(100);
                $i++;
            } else {
                $nerrCode .= "执行： <font color='blue'>$q</font> 出错!</font><br>";
            }
        }
        //$user = new user();
        $this->gather();
        if (is_array($mysql->getrow("username='" . front::post('admin_username') . "'")))
            $this->view->install = true;
    }

    private function gather() {
        //$result = @file("http://www.cmseasy.cn/gather/gather.php?host=" . base64_encode($_SERVER['HTTP_HOST']) . '&uri=' . base64_encode($_SERVER['REQUEST_URI']));
    }

}