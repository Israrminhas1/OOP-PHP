<?php
 require('../classes/myblogs.php');
 

 $target_dir = "../uploads/";
 $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
 $uploadOk = 1;
 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
 
if(isset($_POST['submit'])){
    $photo = basename($_FILES["fileToUpload"]["name"]);
    $title= $_POST['title'];
    
    $description= $_POST['description'];
$userid=$_SESSION['loginid'];
 $userblog = new blogs();
 $userblog -> setTitle($title);
 $userblog -> setImage($photo);
 $userblog -> setDescription($description);
 $userblog -> setuserID($userid);
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
    $result = $userblog->blogInsert();
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) && $result ) {
      
    header("location:../views/blogs.php?status=success&code=140");
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}


   

}
?>