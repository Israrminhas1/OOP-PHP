<?php
require('../classes/user.php');
$userpermission = new User();
$result_fetch = $userpermission -> getPermissions();
$a = json_encode($result_fetch);
echo $a;
?>