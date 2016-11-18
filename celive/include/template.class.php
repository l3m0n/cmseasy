<?php
class Template extends Smarty {
function Template()
{
$this->Smarty();
if ($GLOBALS['config']['safe_mode']) {
$this->use_sub_dirs = false;
}
$this->template_dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$GLOBALS['config']['template'];
$this->compile_dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR.'template';
$this->config_dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$GLOBALS['config']['template'];
$this->caching = 0;
//$this->php_handling = SMARTY_PHP_ALLOW;
$this->assign('conf',$GLOBALS['config']);
$this->assign('lang',$GLOBALS['lang']);
$this->assign('_SERVER',$_SERVER);
$this->assign('epoch',time());
}
}

?>