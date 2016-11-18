<?php

// 通用防护 过滤用户输入的数据，实现防注
//使用方法：
//将如下代码保存为 360_safe3.php 文件并上传到要包含的文件的目录
//在页面中引入上述 360_safe3.php 文件：require_once('360_safe3.php');
//如果想整站防注，就在网站的一个公用文件中，如数据库链接文件 config.inc.php 中引入！


function customError($errno, $errstr, $errfile, $errline) {
    echo "<b>Error number:</b> [$errno],error on line $errline in $errfile<br />";
    die();
}

set_error_handler("customError", E_ERROR);
$getfilter = "'|(and|or)\\b.+?(>|<|=|in|like)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
$postfilter = "\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
$cookiefilter = "\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";

function StopAttack($StrFiltKey, $StrFiltValue, $ArrFiltReq) {

    if (is_array($StrFiltValue)) {
        $StrFiltValue = implode($StrFiltValue);
    }

    if (preg_match("/" . $ArrFiltReq . "/is", $StrFiltKey) == 1) {
        slog("<br><br>操作IP: " . $_SERVER["REMOTE_ADDR"] . "<br>操作时间: " . strftime("%Y-%m-%d %H:%M:%S") . "<br>操作页面:" . $_SERVER["PHP_SELF"] . "<br>提交方式: " . $_SERVER["REQUEST_METHOD"] . "<br>提交参数: " . $StrFiltKey . "<br>提交数据: " . $StrFiltValue);
        //print "360websec notice:Illegal operation!";
        if (isAjax()) {
            exit;
        } else {
            Header('Location:/404');
        }
    }
    if (preg_match("/" . $ArrFiltReq . "/is", $StrFiltValue) == 1) {
        slog("<br><br>操作IP: " . $_SERVER["REMOTE_ADDR"] . "<br>操作时间: " . strftime("%Y-%m-%d %H:%M:%S") . "<br>操作页面:" . $_SERVER["PHP_SELF"] . "<br>提交方式: " . $_SERVER["REQUEST_METHOD"] . "<br>提交参数: " . $StrFiltKey . "<br>提交数据: " . $StrFiltValue);
        //print "360websec notice:Illegal operation!";      
        if (isAjax()) {
            exit;
        } else {
            Header('Location:/404');
        }
    }
}

//$ArrPGC=array_merge($_GET,$_POST,$_COOKIE);
if (count($_GET) > 0) {
    foreach ($_GET as $key => $value) {
        $_GET[$key] = $value;
        StopAttack($key, $value, $getfilter);
    }
}

if (count($_POST) > 0) {


    foreach ($_POST as $key => $value) {
        $_POST[$key] = $value;
        StopAttack($key, $value, $postfilter);
    }
}

if (count($_COOKIE) > 0) {
    foreach ($_COOKIE as $key => $value) {
        $_COOKIE[$key] = $value;
        StopAttack($key, $value, $postfilter);
    }
}

if (file_exists('update360.php')) {
    echo "请重命名文件update360.php，防止黑客利用<br/>";
    die();
}

function slog($logs) {
    if (!is_dir($_SERVER["DOCUMENT_ROOT"] . "/log/360")) {
        mkdir($_SERVER["DOCUMENT_ROOT"] . "/log/360", 0777, true);
    }
    $toppath = $_SERVER["DOCUMENT_ROOT"] . "/log/360/log.html";
    $Ts = fopen($toppath, "w+");
    fputs($Ts, $logs . "\r\n");
    fclose($Ts);
}

function isAjax() {

    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

        return true;
    } else {

        return false;
    }
}