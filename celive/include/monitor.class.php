<?php

class Monitor {
function monitor() {
$activeid = $_SESSION['cel_activeid'];
$status = '2';
$sql = "UPDATE `activity` SET `status`='".$status."' WHERE `id`='".$activeid."'";
$GLOBALS['db']->query($sql);
}
}
?>