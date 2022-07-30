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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
img {
  border-radius: 50%;
}
</style>
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
          header("location:../admin/dashboard.php");
        }  else {
             header("location:../index.php");
         }
         ?>
        
          </header>

       
        <div class="container">
        <img src="../uploads/<?php if(isset($_SESSION['profileimage'])){ echo $_SESSION['profileimage'];}
        ?>"  alt="..." width="300" height="300">
            <h4>User Details</h3>
      UserPhone: <?php echo $_SESSION['userphone']?> <br>
      UserName: <?php echo $_SESSION['username']?>
        </div>
        
    
   
</body>
</html>