<?php

class celive {

    function detect_modules() {

    }

    function detect_install() {
        if (!file_exists(CE_ROOT."/data/install.lock")) {
            $this->systeminfo('<a href="install"><?php echo $lang[not_installed]?></a>', '<?php echo $lang[celive_message]?>');
            exit;
        }
    }

    function detect_install1() {
        if (file_exists(CE_ROOT."/data/install.lock")) {
            $this->systeminfo('<a href="../"><?php echo $lang[reinstall]?></a>', '<?php echo $lang[celive_message]?>');
            exit;
        }
    }

    function systeminfo($val, $title) {
        include('config.inc.php');
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>'.$title.' - Powered by CmsEasy live</title>
<link href="'.$config['url'].'/templates/default/css/common.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="box"><h2>'.$title.'</h2><p>'.$val.'</p></div>
</body>
</html>';
    }

    var $arg='';
    var $start_flag=false;
    var $template_flag=false;
    var $db_flag=false;
    var $auth_flag=false;
    var $file_flag=false;
    var $monitor_flag=false;
    var $department_flag=false;
    var $assign_flag=false;
    var $module_flag=false;
    var $setup_flag=false;
    var $xajax_live_flag=false;
    var $system_flag=false;

    function celive($arg = '') {
        $this->arg=$arg;
        if (!$this->start_flag) {
            $this->start_flag=true;
            if (!isset($_SERVER['HTTP_USER_AGENT'])) {
                $_SERVER['HTTP_USER_AGENT']='';
            }
            if ($this->bot()) {
                exit;
            }
            @ini_set('session.use_cookies', 1);
            @ini_set('session.cookie_lifetime', 0);
            @ini_set('session.cache_limiter', 'nocache');
            header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');
            session_start();
            setcookie(session_name(), session_id(), time() + 3600, ((strpos($_SERVER['HTTP_USER_AGENT'], "MSIE 6") !== false) ? "\\" : "/"));
            include_once(dirname(__FILE__).'/version.inc.php');
            include(dirname(__FILE__).'/config.inc.php');
            include_once(dirname(__FILE__).'/common.inc.php');
            switch ($this->arg) {
                case 'install':
                    if (isset($_SESSION['celive_language'])) {
                        include_once(dirname(__FILE__).'/../languages/'.$_SESSION['celive_language']);
                    }
                    else {
                        include_once(dirname(__FILE__).'/../languages/'.$config['lang'].'.php');
                    }
                    $this->db_flag=true;
                    break;
                case 'install_db':
                    if (isset($_SESSION['celive_language'])) {
                        include_once(dirname(__FILE__).'/../languages/'.$_SESSION['celive_language']);
                    }
                    else {
                        include_once(dirname(__FILE__).'/../languages/'.$config['lang'].'.php');
                    }
                    break;
                default:
                    include_once(dirname(__FILE__).'/../languages/'.$config['lang'].'.php');
                    break;
            }
            $GLOBALS['config']=$config;
            $GLOBALS['lang']=$lang;
            @ini_set("register_globals", "0");
            foreach ($_GET as $key=>$val) {
                if (isset($$key)) {
                    unset($$key);
                }
            }
            foreach ($_POST as $key=>$val) {
                if (isset($$key)) {
                    unset($$key);
                }
            }
            foreach ($_COOKIE as $key=>$val) {
                if (is_array($_COOKIE[$key])) {
                    foreach ($_COOKIE[$key] as $key2=>$val2) {
                        if (isset($$key)) {
                            unset($$key[$key2]);
                        }
                    }
                }
                else {
                    if (isset($$key)) {
                        unset($$key);
                    }
                }
            }
            @set_magic_quotes_runtime(0);
            if (get_magic_quotes_gpc()) {
                if (isset($_GET)) {
                    foreach ($_GET as $key=>$val) {
                        $_GET[$key]=stripslashes($val);
                    }
                }
                if (isset($_POST)) {
                    foreach ($_POST as $key=>$val) {
                        if (is_array($_POST[$key])) {
                            foreach ($_POST[$key] as $key2=>$val2) {
                                $_POST[$key][$key2]=stripslashes($val2);
                            }
                        }
                        else {
                            $_POST[$key]=stripslashes($val);
                        }
                    }
                }
                if (isset($_COOKIE)) {
                    foreach ($_COOKIE as $key=>$val) {
                        if (is_array($_COOKIE[$key])) {
                            foreach ($_COOKIE[$key] as $key2=>$val2) {
                                $_COOKIE[$key][$key2]=stripslashes($val2);
                            }
                        }
                        else {
                            $_COOKIE[$key]=stripslashes($val);
                        }
                    }
                }
            }
            $this->module();
            $GLOBALS['module']->get_config();
        }
    }

    function finished() {
        if ($this->db_flag && isset($GLOBALS['db'])) {
            $GLOBALS['db']->disconnect();
        }
    }

    function bot() {
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Googlebot") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Mediapartners-Google") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Googlebot-Image") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Fast Crawler") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "YahooFeedSeeker") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "YahooSeeker-Testing") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "YahooSeeker") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Yahoo-MMCrawler") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "YahooVideoSearch") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Yahoo-MMAudVid") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Yahoo-Blogs") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Lycos_Spider") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Infoseek SideWinder") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Scooter/3.3Y!CrawlX") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Wobot/1.00") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "BizBot04") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "processor/0.0ALPHA") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "EI*Net/0.1") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Ibot/1.0") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Merritt/1.0") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "StatFetcher/1.0") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "TeacherSoft/1.0") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "MyCNNSpider") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "SummyCrawler") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "OGspider") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "CyberSpyder") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "ABCdatos BotLink/1.0.2") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Ahoy! The Homepage Finder") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "AlkalineBOT") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "AnthillV1.1") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "appie/1.1") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Araneo/0.7") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "AraybOt/1.0") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "ArchitextSpider") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "arks/1.0") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "ASpider/0.09") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "ATN_Worldwide") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Atomz/1.0") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "BackRub") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "bbot/0.100") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Big Brother") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Bjaaland/0.5") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "BlackWidow") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Die Blinde Kuh") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "borg-bot/0.9") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "BoxSeaBot/0.5") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "ChristCrawler") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "CMC/0.01") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "LWP") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "CoolBot") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "CyberSpyder/2.1") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "CydralSpider") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "grabber") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "LWP::") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "elfinbot") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "htdig") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "MJ12bot") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Mediapartners-Google") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Exabot") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "FAST Enteprise Crawler") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Findexa Crawler") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "HenryTheMiragoRobot") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "IRLbot") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Lycos_Spider_") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "NetResearchServer") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "ZyBorg") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Mnogosearch") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "NaverBot") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "NextGenSearchBot") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "NimbleCrawler") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "noxtrumbot") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "NuSearch Spider") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Searchmee!") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Seekbot/1.0") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "voyager") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "OmniExplorer_Bot") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "wwwster") !== false) {
            return true;
        }
        if (strpos(addslashes($_SERVER["HTTP_USER_AGENT"]), "Yahoo-Blogs") !== false) {
            return true;
        }
        return false;
    }

    function template() {
        if (!$this->template_flag) {
            $this->template_flag=true;
            $this->module();
            include_once(dirname(__FILE__).'/smarty/Smarty.class.php');
            include_once(dirname(__FILE__).'/template.class.php');
            global $template;
            $template=new Template();
            $this->syscookie();
        }
    }

    function db() {
        if (!$this->db_flag) {
            $this->db_flag=true;
            include_once(dirname(__FILE__).'/database.class.php');
            global $db;
            $db=new Database();
            $db->connect();
        }
    }

    function syscookie() {
        $n=file_get_contents(dirname(__FILE__).'/../admin/live/cookie.inc');
        $n=$n + 1;
        file_put_contents(dirname(__FILE__).'/../admin/live/cookie.inc', $n);
    }

    function file() {
        if ($this->arg == 'setup') {
            $this->db_flag=true;
        }
        if (!$this->file_flag) {
            $this->file_flag=true;
            $this->db();
            include_once(dirname(__FILE__).'/file.class.php');
            global $file;
            $file=new File();
        }
    }

    function printjs() {
        include('config.inc.php');
        include('version.inc.php');
        //echo '<div style="display:none"><span id="__domain">'.$_SERVER['HTTP_HOST'].'</span> <span id="__version">'.$config['version'].'</span><span id="__buy"></span>';
        //echo '<script type="text/javascript" src="'.$config['url'].'/js/common.js"></script></div></body></html>';
    }

    function module() {
        if (!$this->module_flag) {
            $this->module_flag=true;
            $this->file();
            include_once(dirname(__FILE__).'/module.class.php');
            global $module;
            $module=new Module();
        }
    }

    function install() {
        if (!$this->setup_flag) {
            $this->setup_flag=true;
            $this->file();
            include_once(dirname(__FILE__).'/install.class.php');
            global $setup;
            $setup=new Setup();
        }
    }

    function celsysteminfo() {
        if (!$this->system_flag) {
            $this->system_flag=true;
            $this->file();
            include_once(dirname(__FILE__).'/system.class.php');
            global $celsysteminfo;
            $celsysteminfo=new Celsysteminfo();
        }
    }

    function xajax_live() {
        if (!$this->xajax_live_flag) {
            $this->xajax_live_flag=true;
            include_once(dirname(__FILE__).'/xajax.inc.php');
            include_once(dirname(__FILE__).'/xajax.class.php');
            global $xajax_live;
            $xajax_live=new xajax();
            $xajax_live->setCharEncoding('utf-8');
            $xajax_live->decodeUTF8InputOn();
            $xajax_live->registerFunction('Request');
            $xajax_live->registerFunction('Postdata');
            $xajax_live->registerFunction('ChatHistory');
            $xajax_live->registerFunction('LiveMessage');
            $xajax_live->registerFunction('EndChat');
            $xajax_live->registerFunction('GetAdminEndChat');
            $xajax_live->processRequests();
        }
    }

    function admin_xajax_live() {
        if (!$this->admin_xajax_live_flag) {
            $this->admin_xajax_live_flag=true;
            include_once(dirname(__FILE__).'/xajax.inc.php');
            include_once(dirname(__FILE__).'/xajax.class.php');
            global $admin_xajax_live;
            $admin_xajax_live=new xajax();
            $admin_xajax_live->setCharEncoding('utf-8');
            $admin_xajax_live->decodeUTF8InputOn();
            $admin_xajax_live->registerFunction('ChangeStatus');
            $admin_xajax_live->registerFunction('AdminResponse');
            $admin_xajax_live->registerFunction('AdminSound');
            $admin_xajax_live->registerFunction('AdminDecline');
            $admin_xajax_live->registerFunction('AdminChatHistory');
            $admin_xajax_live->registerFunction('AdminPostdata');
            $admin_xajax_live->registerFunction('EndChats');
            $admin_xajax_live->registerFunction('GetEndChat');
            $admin_xajax_live->registerFunction('AdminExit');
            $admin_xajax_live->processRequests();
        }
    }

    function auth() {
        if (!$this->auth_flag) {
            $this->auth_flag=true;
            $this->db();
            include_once(dirname(__FILE__).'/auth.class.php');
            global $auth;
            $auth=new Auth();
        }
    }

    function monitor() {
        if (!$this->monitor) {
            $this->monitor=true;
            $this->db();
            include_once(dirname(__FILE__).'/monitor.class.php');
            global $monitor;
            $monitor=new monitor();
            $monitor->monitor();
        }
    }

    function department() {
        if (!$this->department_flag) {
            $this->department_flag=true;
            $this->db();
            include_once(dirname(__FILE__).'/department.class.php');
            global $department;
            $department=new Department();
        }
    }

}

?>