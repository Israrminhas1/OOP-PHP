<?php 
require('../classes/user.php');
$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["update"])) {
   $photo = basename( $_FILES["fileToUpload"]["name"]);
   
   $name=test_input($_POST["name"]);
   $email=test_input($_POST["email"]);
   $phone=test_input($_POST["phone"]);
   $oldpassword=$_POST["password"];
   $newpassword=$_POST["newpassword"];
   $userupdate=new User();
   $userupdate -> setName($name);
   $userupdate -> setEmail($email);
   $userupdate -> setPhoto($photo);
   $userupdate -> setPhone($phone);
   $userupdate -> setPassword($newpassword);
  $verify_fetch=$userupdate -> verifyPassword();
  if($verify_fetch){
     
      if(password_verify($_POST["password"],$verify_fetch['password'])) {
        if(!$userupdate -> validate()) {
            header("location:../views/updateuser.php");
        }else {
             // Check if file already exists
             if (file_exists($target_file)) {
              // header("location:index.php?status=success&code=126");
             
               unlink($target_file);
           } 
  // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
          }
  
          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
          } else {
            $result=$userupdate->profileUpdate();
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) && $result ) {
                $_SESSION['profileimage']=$photo;
              echo "update";
            } else {
              echo "Sorry, there was an error uploading your file.";
            }
          }
        }
      }
      else {
          echo "not match";
      }
  }
  
}



?>