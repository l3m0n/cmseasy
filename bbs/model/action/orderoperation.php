<?php
class action_orderoperation {
  public function dopay($pid) {
	
	$cmd  = "cmd=pay&pid={$pid}\r\n";
	$svr  = Config::getIP('pay_svr');
	$ret  = NetUtil::tcpCmd($svr['IP'],$svr['PORT'],$cmd,2, 2 );
	
  }

  public function dopayback($pid) {			
	$cmd  = "cmd=refund&pid={$pid}\r\n";
	$svr  = Config::getIP('pay_svr');
	$ret  = NetUtil::tcpCmd($svr['IP'],$svr['PORT'],$cmd,2, 2 );	
 }
	
}