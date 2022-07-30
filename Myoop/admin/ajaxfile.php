<?php
require('../classes/user.php');
$usergetdata = new User();
$result_fetch = $usergetdata->getAllUsers();
$a = json_encode($result_fetch);
echo $a;
?>