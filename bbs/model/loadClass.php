<?php
class loadClass {
	static function load($class_name){
		$class_name = str_replace('_', '/', $class_name);
		$filename =  ROOT.'/bbs/model/' . "$class_name" . ".php";
		if (is_file($filename)){
			return include_once $filename;
		}
		else{
			$filename =  ROOT . '/bbs/commonlib/' . "$class_name" . ".php";
			if(is_file($filename)){
				return include_once $filename;
			}
			else{
				echo $filename;
				die('Include File Error!!');
			}
		}
	}
}
spl_autoload_register(array('loadClass', 'load'));
?>