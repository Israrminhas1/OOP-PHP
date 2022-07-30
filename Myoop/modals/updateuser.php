<?php 
require('../classes/user.php');
if(isset($_POST['editid'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $active=$_POST['check'];
    $selectOption = $_POST['taskOption'];
    
    $useredit=new User();
    $useredit->setId($id);
    $useredit -> setName($name);
    $useredit -> setEmail($email);
    $useredit -> setPhone($phone);
    $useredit -> setActive($active);
    $useredit -> setRole($selectOption);
    $result=$useredit->editUser();
    if($result){
        
        header("location:../admin/viewuser.php?status=success&code=139");
    }
}


?>