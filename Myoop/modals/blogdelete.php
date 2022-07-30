<?php 
require('../classes/myblogs.php');
if(isset($_POST['deleteid'])){
    $id=$_POST['id'];
    $blogdelete=new blogs();
    $blogdelete->setId($id);
    $result=$blogdelete->blogDelete();
    if($result){
        if (
            isset($_SESSION['logged_in'])
            && $_SESSION['logged_in'] == 'u'
        ){ header("location:../views/udBlog.php?status=success&code=141");}
        else {
        header("location:../admin/adminblogs.php?status=success&code=141");
        }
    }
}


?>