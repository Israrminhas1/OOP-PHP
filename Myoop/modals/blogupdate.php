<?php 
require('../classes/myblogs.php');
if(isset($_POST['editid'])){
    echo "me working";
    $id=$_POST['blogid'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $blogedit=new blogs();
    $blogedit->setID($id);
    $blogedit -> setTitle($title);
    $blogedit -> setDescription($description);
    $result=$blogedit->editBlog();
   
    if($result){
        if (
            isset($_SESSION['logged_in'])
            && $_SESSION['logged_in'] == 'u'
        ){
            header("location:../views/udBlog.php?status=success&code=142");
        } else { 
            header("location:../admin/adminblogs.php?status=success&code=142");
        }
        
    }
}


?>