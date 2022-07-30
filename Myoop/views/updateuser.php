<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="http://localhost/Myproject/bootstrap-5.2.0-beta1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
    <header>
   
        <?php
         
        if (isset($_SESSION['logged_in'])
         && $_SESSION['logged_in']=='u'
        ) {
            include("../includes/usernav.php");
        } elseif(isset($_SESSION['logged_in'])
        && $_SESSION['logged_in'] == 'a'){
          include("../includes/adminnav.php");
          include("../includes/adminside.php");
        }  else {
             header("location:../index.php");
         }
         ?>
        
          </header>
          
          <h1 class="text-center">Update User Details</h1>
    <div class="container my-4">
        <div class="row justify-content-center">
        <div class="col-4">
   
        <form class="row g-3" method='POST' action="../modals/update.php" enctype="multipart/form-data">
        
        <input type='hidden' class='form-control' name='email' id='inputEmail4' placeholder='Enter Your Email' value="<?php echo $_SESSION['emailuser'];?>" > 
        <div class="col-12">
    <label for="inputName" class="form-label">Name</label>
    <input type='text' class='form-control' id='inputName' name="name" placeholder='Enter Name' value="<?php echo $_SESSION['username'];?>" >
    <span style="color:red"><?php if (isset($_SESSION['nameError'])){ echo $_SESSION['nameError']; unset($_SESSION['nameError']);}?></span>

  </div>
  <div class='col-12'>
    <label for='inputPhone' class='form-label'>Phone</label>
    <input type='text' class='form-control' id='inputphone' name='phone' placeholder='Enter Your Phone Number' value="<?php echo $_SESSION['userphone'];?>" >
    <span style="color:red"><?php if (isset($_SESSION['errorPhone'])){ echo $_SESSION['errorPhone']; unset($_SESSION["errorPhone"]);}?></span>

  </div>
  <div class="mb-3">
  <label for="fileToUpload" class="form-label">Upload Your Profile Picture</label>
  <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
 

</div>
  <div class="mb-3">
    <label for="exampleInputPassword2" class="form-label">Old Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword2" placeholder='Enter Old Password'>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">New Password</label>
    <input type="password" class="form-control" name="newpassword" id="exampleInputPassword1" placeholder='Enter New Password'>
    <span style="color:red"><?php if (isset($_SESSION['errorPassword'])){ echo $_SESSION['errorPassword']; unset($_SESSION["errorPassword"]);}?></span>

  </div>
 
  <div class='col-12'>
      
    <button type='submit' class='btn btn-warning' name='update'>update</button>
  </div>
 
</form>
</div>
</div>
  </div>
        
    
   
</body>
</html>