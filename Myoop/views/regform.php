<?php 

require('../includes/status.php');
session_start();
if (
  isset($_SESSION['logged_in'])
  && $_SESSION['logged_in'] == 'u'
) {
  header("location:views/welcome.php");
} elseif(isset($_SESSION['logged_in'])
&& $_SESSION['logged_in'] == 'a'){
  header("location:../admin/dashboard.php");
}  else {
  include('../includes/mynav.php');
  
  if (isset($_GET['status'])) {
      if (
          $_SERVER["REQUEST_METHOD"]
          == "GET"
      ) {
          $param = ["success", "warning", "danger", "primary", "light"];
          if (
              in_array($_GET['status'], $param)
              && array_key_exists($_GET['code'], $message)
          ) {
              // show alert
              $code = $_GET['code'];
              echo "<div class = 'alert alert-$_GET[status]' role = 'alert'>
              $message[$code]
              </div>";
          }
      }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
    <link rel="stylesheet" href="http://localhost/Myproject/bootstrap-5.2.0-beta1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>
<body>
<h1 class="text-center">Register to our website</h1>
    <div class="container my-4">
        <div class="row justify-content-center">
        <div class="col-4">
   
        <form class="row g-3" method='POST' action="../modals/auth.php">
        <div class="col-12">
    <label for="inputName" class="form-label">Name</label>
    <input type='text' class='form-control' id='inputName' name="name" placeholder='Enter Name'
    value="<?php if (isset($_SESSION['name'])){ echo $_SESSION['name']; unset($_SESSION["name"]);}?>"  >
    <span style="color:red"><?php if (isset($_SESSION['nameError'])){ echo $_SESSION['nameError']; unset($_SESSION['nameError']);}?></span>
  </div>
  <div class='col-12'>
    <label for='inputPhone' class='form-label'>Phone</label>
    <input type='text' class='form-control' id='inputphone' name='phone' placeholder='Enter Your Phone Number' 
    value="<?php if (isset($_SESSION['phone'])){  echo $_SESSION['phone'];unset($_SESSION["phone"]);}?>" >
    <span style="color:red"><?php if (isset($_SESSION['errorPhone'])){ echo $_SESSION['errorPhone']; unset($_SESSION["errorPhone"]);}?></span>

  </div>
  <div class='col-md-6'>
    <label for='inputEmail4' class='form-label'>Email</label>
    <input type='email' class='form-control' name='email' id='inputEmail4' placeholder='Enter Your Email' 
    value="<?php if (isset($_SESSION['email'])){  echo $_SESSION['email']; unset($_SESSION["email"]);}?>" >
    <span style="color:red"><?php if (isset($_SESSION['emailError'])){ echo $_SESSION['emailError']; unset($_SESSION['emailError']);}?></span>
 
  </div>
  <div class='col-md-6'>
    <label for='inputPassword4' class='form-label'>Password</label>
    <input type='password' class='form-control' name='password' id='inputPassword4' placeholder='Enter Password'>
    <span style="color:red"><?php if (isset($_SESSION['errorPassword'])){ echo $_SESSION['errorPassword']; unset($_SESSION["errorPassword"]);}?></span>
  </div>
 
  <div class='col-12'>
      
    <button type='submit' class='btn btn-primary' name='register'>Register</button>
  </div>
  <br>
  <a href='http://localhost/Myoop/views/loginform.php' class='btn btn-warning' style="max-width:150px; padding: 3px; margin: 10px;">Click here to login</a>
</form>
</div>
</div>
  </div>
</body>
</html>