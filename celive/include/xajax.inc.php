<?php

include('config.inc.php');
include_once('common.inc.php');

function Request() {
    global $db;
    $sessionid = $_SESSION['sessionid'];
    $departmentid = $_SESSION['departmentid'];
    $timestamp = $_SESSION['timestamp'];
    $objResponse = new xajaxResponse('utf-8');
    $sql = "SELECT * FROM `sessions` WHERE `departmentid`='" . $departmentid . "' AND `status`='0' AND `id`<'" . $sessionid . "'";
    @$result = $db->query($sql);
    $waiting_num = count($result);
    $sql = "SELECT `status` FROM `sessions` WHERE `id`='" . $sessionid . "'";
    @$result = $db->query($sql);
    $status = $result[0]['status'];
    $def = time() - $timestamp;
    if ($status == '0' and $def < '180') {
        $text = '<b>' . $waiting_num . '</b><?php echo $lang[users_waiting]?>';
        $objResponse->addAssign('content', 'innerHTML', '' . $text);
    }
    if ($status == '0' and $def >= '180') {
        $text = '<?php echo $lang[busy]?>';
        $objResponse->addAssign('content', 'innerHTML', '' . $text);
    }
    if ($status == '1') {
        $sql = "DELETE FROM `sessions` WHERE `id`='" . $sessionid . "'";
        $db->query($sql);
        $objResponse->redirect('?action=2&module=celive&thislive=' . $_SESSION['thislive'], 0);
        $objResponse->script('window.focus();');
    }
    if ($status == '2') {
        $text = '<?php echo $lang[not_connected]?>';
        $objResponse->redirect('../../index.php?case=guestbook&act=index', 0);
    }
    return $objResponse;
}

function Postdata($a) {
    global $db;
    $chatid = $_SESSION['chatid'];
    $name = $_SESSION['name'];
    $a['detail'] = htmlspecialchars($a['detail']);
    if (!get_magic_quotes_gpc()) {
        $a['detail'] = addslashes($a['detail']);
    }
    $detail = $a['detail'] . ' (' . date('Y-m-d H:i:s', time()) . ')';
    $sql = "INSERT INTO `detail` (`chatid`,`detail`,`who_witter`) VALUES('" . $chatid . "','" . $detail . "','2')";
    $db->query($sql);
    $input = "<span class=\"vschat\"><b>" . $name . ":</b> " . $detail . "</span><br />\n";
    $objResponse = new xajaxResponse('utf-8');
    $objResponse->append('ChatHistory', 'innerHTML', $input);
    return $objResponse;
}

function ChatHistory() {
    global $db, $config;
    $objResponse = new xajaxResponse('utf-8');
    $chatid = $_SESSION['chatid'];
    if (isset($_SESSION['detailid'])) {
        $detailid = $_SESSION['detailid'];
    } else {
        $detailid = '0';
    }
    $sql = "SELECT `id`,`detail` FROM `" . $config['prefix'] . "detail` WHERE `chatid`='" . $chatid . "' AND (`who_witter`='1' AND `id`>'" . $detailid . "') ORDER BY `id` ASC";
    @$result = $db->my_fetch_array($sql);
    $countResult = count($result);
    if ($countResult != '0') {
        $j = $countResult - 1;
        $detailid = $result[$j]['id'];
        $_SESSION['detailid'] = $detailid;
        $objResponse->script('window.focus();');
    }
    $operatorname = $_SESSION['operatorname'];
    $detail = '';
    for ($i = 0; $i < $countResult; $i++) {
        $times = substr($result[$i]['detail'], -10, 9);
        $result[$i]['detail'] = substr($result[$i]['detail'], 0, -21);
        $detail = $detail . "<font color=\"blue\"><b>" . $operatorname . "</b> " . $times . "</font><br /> " . $result[$i]['detail'] . "</span><br />\n";
    }
    $objResponse->append('ChatHistory', 'innerHTML', $detail);
    $objResponse->script('scolldown();');
    return $objResponse;
}

function ChangeStatus() {
    global $db, $config;
    $objResponse = new xajaxResponse('utf-8');
    $activeid = $_SESSION['cel_activeid'];
    $sql = "SELECT `status` FROM `activity` WHERE `id`='" . $activeid . "'";
    @$result = $db->query($sql);
    $status = $result[0]['status'];
    if ($status == '1') {
        $sql = "UPDATE `activity` SET `status`='2' WHERE `id`='" . $activeid . "'";
        $db->query($sql);
        $objResponse->addAssign('status', 'innerHTML', '(<?php echo $lang[current_state]?><?php echo $lang[status_online]?>)');
    } elseif ($status == '2') {
        $sql = "UPDATE `activity` SET `status`='1' WHERE `id`='" . $activeid . "'";
        $db->query($sql);
        $objResponse->addAssign('status', 'innerHTML', '(<?php echo $lang[current_state]?><?php echo $lang[status_offline]?>)');
    } else {
        $sql = '';
        $objResponse->addAssign('status', 'innerHTML', '(<?php echo $lang[current_state]?><?php echo $lang[status_online]?>)');
    }
    return $objResponse;
}

function AdminResponse() {
    global $db, $config,$lang;
    $objResponse = new xajaxResponse('utf-8');
    $departmentid = $_SESSION['cel_departmentid'];
    $sql = "SELECT `id`,`name`,`ip`,`timestamp` FROM `" . $config['prefix'] . "sessions` WHERE `departmentid`='" . $departmentid . "' AND `status`='0' ORDER BY `id` ASC";
    @$result = $db->my_fetch_array($sql);
    $text = '';
    for ($i = 0; $i < count($result); $i++) {
        $sessionid = $result[$i]['id'];
        $name = $result[$i]['name'];
        $ip = $result[$i]['ip'];
        $ip = convertip($ip);
        $time = date('Y-m-d H:i:s',$result[$i]['timestamp']);
        $_SESSION['adminthislive'] = md5(time() . $sessionid);
        $_SESSION['adminthislivetmp'] = $_SESSION['adminthislive'];
        $text = "<div class=\"response_t\">&nbsp;&nbsp;&nbsp;<input name='id' id='id' class='checkbox' type='checkbox' value='".$sessionid."' />&nbsp;" . $name . "&nbsp;&nbsp;&nbsp;&nbsp;" . $ip . "&nbsp;&nbsp;申请时间:".$time."&nbsp;&nbsp;<span1>[<a href=\"../admin/live/?action=1&module=celive&thislive=" . $_SESSION['adminthislive'] . "&sessionid=" . $sessionid . "\" target=\"_blank\">".$lang['accept']."</a>] [<a href=\"javascript:\" onclick=\"xajax_AdminDecline(" . $sessionid . ");\">".$lang['close']."</a></a>]</span1></div>" . $text;
    }
    if (isset($_SESSION['cel_r'])) {
        $r = $_SESSION['cel_r'];
    } else {
        $r = '0';
    }
    $sound = $_SESSION['cel_sound'];
    if ($sound == '1') {
        $soundR = 'true';
    } else {
        $soundR = 'false';
    }
    @$r = $_SESSION['cel_r'];
    $sql = "SELECT `id` FROM `" . $config['prefix'] . "sessions` WHERE `departmentid`='" . $departmentid . "' AND `id`>'" . $r . "' AND `status`='0' ORDER BY `id` ASC";
    @$result2 = $db->my_fetch_array($sql);
    if (count($result2) != '0') {
        $text = $text . "<embed src=\"" . $config['url'] . "/include/sound/request.mp3\" id=\"mp3\" autostart=\"" . $soundR . "\" hidden=\"true\">";
        $j = count($result2) - 1;
        $r = $result2[$j]['id'];
        $_SESSION['cel_r'] = $r;
        $objResponse->script('window.focus();');
    }
    $objResponse->addAssign('response', 'innerHTML', $text);
    return $objResponse;
}

function AdminSound() {
    global $config;
    $objResponse = new xajaxResponse('utf-8');
    $sound = $_SESSION['cel_sound'];
    if ($sound == '1') {
        $_SESSION['cel_sound'] = '0';
        $objResponse->addAssign('sounds', 'innerHTML', '(声音状态:关)');
    } else {
        $_SESSION['cel_sound'] = '1';
        $objResponse->addAssign('sounds', 'innerHTML', '(声音状态:开)');
    }
    return $objResponse;
}

function AdminDecline($sessionid) {
    global $db;
    $sql = "UPDATE `sessions` SET `status`='2' WHERE `id`='" . $sessionid . "'";
    $db->query($sql);
    $text = '';
    $objResponse = new xajaxResponse('utf-8');
    $objResponse->append('ChatHistory', 'innerHTML', $text);
    return $objResponse;
}

function LiveMessage($a) {
    global $db;
    $sessionid = $_SESSION['sessionid'];
    $name = addslashes(htmlspecialchars($a['name']));
    $email = addslashes(htmlspecialchars($a['email']));
    $country = addslashes(htmlspecialchars($a['country']));
    $phone = addslashes(htmlspecialchars($a['phone']));
    $departmentid = addslashes(htmlspecialchars($a['departmentid']));
    $message = addslashes(htmlspecialchars($a['message']));
    $timestamp = time();
    $ip = $_SERVER['REMOTE_ADDR'];
    $sql = "INSERT INTO `chat` (`sessionid`,`name`,`email`,`phone`,`departmentid`,`message`,`timestamp`,`ip`,`status`) VALUES('" . $sessionid . "','" . $name . "','" . $email . "','" . $phone . "','" . $departmentid . "','" . $message . "','" . $timestamp . "','" . $ip . "','2')";
    $db->query($sql);
    $sql = "DELETE FROM `sessions` WHERE `id`='" . $sessionid . "'";
    $db->query($sql);
    $text = "<?php echo $lang[shout_success]?>\n";
    $objResponse = new xajaxResponse('utf-8');
    $objResponse->addAssign('content', 'innerHTML', $text);
    $objResponse->redirect('../', 5);
    return $objResponse;
}

function AdminChatHistory($chatid) {
    global $db, $config;
    $objResponse = new xajaxResponse('utf-8');
    $d = "d" . $chatid;
    if (isset($_SESSION["$d"])) {
        ${$d} = $_SESSION["$d"];
    } else {
        ${$d} = 0;
    }
    $sql = "SELECT `id`,`detail` FROM `" . $config['prefix'] . "detail` WHERE `chatid`='" . $chatid . "' AND (`who_witter`='2' AND `id`>'" . ${$d} . "') ORDER BY `id` ASC";
    @$result = $db->my_fetch_array($sql);
    $countResult = count($result);
    if ($countResult != 0) {
        $j = $countResult - 1;
        ${$d} = $result[$j]['id'];
        $_SESSION["$d"] = ${$d};
        $objResponse->script('window.focus();');
    }
    $sql = "SELECT `name` FROM `chat` WHERE `id`='" . $chatid . "'";
    @$result2 = $db->query($sql);
    $detail = '';
    for ($i = 0; $i < $countResult; $i++) {
        $name = $result2[$i]['name'];
        $times = substr($result[$i]['detail'], -10, 9);
        $result[$i]['detail'] = substr($result[$i]['detail'], 0, -21);
        $detail = $detail . "<font color=\"blue\"><b>" . $name . "</b> " . $times . "</font><br /> " . $result[$i]['detail'] . "</span><br />\n";
    }
    $objResponse->append('ChatHistory', 'innerHTML', $detail);
    $objResponse->script('scolldown();');
    return $objResponse;
}

function AdminPostdata($a) {
    global $db;
    $chatid = htmlspecialchars($a['chatid']);
    $a['detail'] = htmlspecialchars($a['detail']);
    if (!get_magic_quotes_gpc()) {
        $a['detail'] = addslashes($a['detail']);
    }
    $detail = $a['detail'] . ' (' . date('Y-m-d H:i:s', time()) . ')';
    $sql = "INSERT INTO `detail` (`chatid`,`detail`,`who_witter`) VALUES('" . $chatid . "','" . $detail . "','1')";
    $db->query($sql);
    $name = '';
    $input = "<span class=\"vschat\"><b>" . $name . ":</b> " . $detail . "</span><br />\n";
    $objResponse = new xajaxResponse('utf-8');
    $objResponse->append('ChatHistory', 'innerHTML', $input);
    return $objResponse;
}

function EndChat() {
    global $db;
    $objResponse = new xajaxResponse('utf-8');
    $chatid = $_SESSION['chatid'];
    $sql = "UPDATE `chat` SET `status`='0' WHERE `id`='" . $chatid . "'";
    $db->query($sql);
    $objResponse->script('window.parent.close();');
    return $objResponse;
}

function EndChats($chatid) {
    global $db;
    $objResponse = new xajaxResponse('utf-8');
    $sql = "UPDATE `chat` SET `status`='0' WHERE `id`='" . $chatid . "'";
    $db->query($sql);
    $objResponse->script('window.parent.close();');
    return $objResponse;
}

function GetEndChat($chatid) {
    global $db,$lang;
    $objResponse = new xajaxResponse('utf-8');
    $sql = "SELECT `status` FROM `chat` WHERE `id`='" . $chatid . "'";
    @$result = $db->query($sql);
    if ($result[0]['status'] == 0) {
        $objResponse->script("alert('".$lang[reception]."');window.parent.close();");
    }
    return $objResponse;
}

function GetAdminEndChat($chatid) {
    global $db,$lang;
    $objResponse = new xajaxResponse('utf-8');
    $sql = "SELECT `status` FROM `chat` WHERE `id`='" . addslashes($chatid) . "'";
    //  echo $sql;
    @$result = $db->query($sql);
    if ($result[0]['status'] == 0) {
        $objResponse->script("alert('".$lang[connection]."');window.parent.close();");
    }
    return $objResponse;
}

function AdminExit() {
    global $db;
    $activeid = $_SESSION['cel_activeid'];
    $sql = "DELETE FROM `activity` WHERE `id`='" . $activeid . "'";
    $db->query($sql);
}

?>