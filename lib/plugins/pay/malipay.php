<?php

if (!defined('ROOT')) exit('Can\'t Access !');
$payment_lang = ROOT . '/lang/' . config::get('lang_type') . '/pay/malipay.php';
if (file_exists($payment_lang)) {
    global $_LANG;
    include_once($payment_lang);
}
if (isset($set_modules) && $set_modules == TRUE) {
    $i = isset($modules) ? count($modules) : 0;
    $modules[$i]['code'] = basename(__FILE__, '.php');
    $modules[$i]['desc'] = 'alipay_desc';
    $modules[$i]['is_cod'] = '0';
    $modules[$i]['is_online'] = '1';
    $modules[$i]['author'] = 'CmsEasy';
    $modules[$i]['website'] = 'http://www.alipay.com';
    $modules[$i]['version'] = '1.0.0';
    $modules[$i]['config'] = array(
        array('name' => 'alipay_partner', 'type' => 'text', 'value' => ''),
        array('name' => 'alipay_private', 'type' => 'textarea', 'value' => ''),
        array('name' => 'alipay_public', 'type' => 'textarea', 'value' => ''),
    );
    return;
}
require_once(ROOT . "/lib/plugins/malipay/lib/alipay_submit.class.php");

class malipay
{

    function __construct()
    {

    }

    function get_code($order, $payment)
    {
        $SERVER_HTTP = $_SERVER['SERVER_PORT'] == '443'?'https://': 'http://';
        $SITE_URL = $SERVER_HTTP.$_SERVER['HTTP_HOST'];
        $link = $SITE_URL.config::get('base_url')."/index.php";
        $parameter = array(
            "service" => "alipay.wap.create.direct.pay.by.user",
            "partner" => $payment['alipay_partner'],
            "seller_id" => $payment['alipay_partner'],
            "payment_type" => 1,
            //"notify_url" => pay::url(basename(__FILE__, '.php')),
            "notify_url" => $link,
            "return_url" => pay::url(basename(__FILE__, '.php')),
            "out_trade_no" => $order['ordersn'] . $order['id'],
            "subject" => $order['ordersn'],
            "total_fee" => $order['orderamount'],
            "show_url" => $order['showurl'],
            "body" => $order['body'],
            "_input_charset" => $payment['input_charset'],
        );

        require_once(ROOT . "/lib/plugins/malipay/alipay.config.php");
        $alipay_config['private_key_path'] = $payment['alipay_private'];

        $alipaySubmit = new AlipaySubmit($alipay_config);
        //$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
        $arr = $alipaySubmit->buildRequestPara($parameter);

        $param = http_build_query($arr);
        $button = '<div style="text-align:center"><input type="button" onclick="window.open(\'https://mapi.alipay.com/gateway.do?' . $param . '&sign=' . $arr['sign'] . '&sign_type=' . $arr['sign_type'] . '\')" value="手机支付宝付款" /></div>';
        return $button;
    }

    function respond()
    {
        if (!empty($_POST)) {
            foreach ($_POST as $key => $data) {
                $_GET[$key] = $data;
            }
        }

        //file_put_contents('qlog.txt',var_export($_GET,true));

        $payment  = pay::get_payment('malipay');

        require_once(ROOT . "/lib/plugins/malipay/alipay.config.php");
        require_once(ROOT . "/lib/plugins/malipay/lib/alipay_notify.class.php");

        $alipay_config['ali_public_key_path'] = $payment['alipay_public'];
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if ($verify_result) {//验证成功

            $order_sn = str_replace($_GET['subject'], '', $_GET['out_trade_no']);
            $order_sn = intval($order_sn);

            //如果已经处理过
            $orders = orders::getInstance()->getrow($order_sn);

            if($orders['s_status'] == '1'){
                return false;
            }

            if (!pay::check_money($order_sn, $_GET['total_fee'])) {
                return false;
            }
            if ($_GET['trade_status'] == "TRADE_FINISHED" || $_GET['trade_status'] == "TRADE_SUCCESS") {
                pay::changeorders($order_sn, $_GET);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}