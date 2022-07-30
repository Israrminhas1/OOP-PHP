<?php
require('../classes/myblogs.php');
$blogdel = new blogs();
$result_fetch = $blogdel->getBlogDetails();
$a = json_encode($result_fetch);
echo $a;
?>