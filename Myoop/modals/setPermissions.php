<?php 
require('../classes/user.php');
if(isset($_POST['setid'])){
   echo "hey its me";
     $id=$_POST['permid'];
    $checkedit=$_POST['checkedit'];
    $checkcreate=$_POST['checkcreate'];
    $checkdelete=$_POST['checkdelete'];
   $selected=array();
   $selected["EditBlog"]=$checkedit;
   $selected["CreateBlog"]=$checkcreate;
   $selected["DeleteBlog"]=$checkdelete;
   
   $json_arr=json_encode($selected);
 
 
    
   $permuser=new User();
  $permuser->setId($id);
    $result=$permuser->setPermissions($json_arr);
  
  if($result){
        
     header("location:../admin/viewuser.php?status=success&code=143");
   }
   else {
    header("location:../admin/viewuser.php?status=danger&code=144");
   }
}


?>