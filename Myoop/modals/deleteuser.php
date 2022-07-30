<?php 
require('../classes/user.php');
if(isset($_POST['deleteid'])){
    $id=$_POST['id'];
    
    $userdelete=new User();
  $userdelete->setId($id);
  
    $result=$userdelete->deleteUser($id);
    if($result){
        
        header("location:../admin/viewuser.php?status=success&code=138");
    }
    else {
        echo "not working";
    }
}


?>