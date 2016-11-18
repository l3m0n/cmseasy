<?php

if($_GET['type'] == 'remoteinf'){
$f = 'http://aiens.w227.cmseasy.net/server/remoteinf.php?from=celive1&domain='.$_GET['domain'].'&version='.$_GET['version'].'&p='.$_GET['p'].'';
}elseif($_GET['type'] == 'officialinf'){
$f = 'http://aiens.w227.cmseasy.net/server/officialinf.php?from=celive1';
}
$s = @file_get_contents($f);
if(!empty($s)){
echo $s;
}else{
if($_GET['type'] == 'remoteinf'){
echo '';
}elseif($_GET['type'] == 'officialinf'){
echo '<li><a href="http://www.cmseasy.cn"><span style="color:blue; font-weight:bold">获取官方信息</span></a></li>';
}
}

?>