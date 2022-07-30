<?php
require('../classes/myauth.php');
if (isset($_GET['v_code'])) {
    $v_code=$_GET['v_code'];
    $userverify=new Auth();
    $result_fetch =$userverify->verify($v_code);
   
    if ($result_fetch) {
        echo "working";
            
             if ($result_fetch['active'] == 0) {
                $update=$userverify->update($result_fetch['email']);
                if($update){
                    header("location:../index.php?status=primary&code=132");
                } else {
                    header("location:../index.php?status=primary&code=131");
                }
            } else {
                header("location:../index.php?status=primary&code=131");
               
             }  
    } else {
        header("location:../index.php?status=danger&code=125");
    }
}
