<?php
require('../includes/status.php');


session_start();


if (isset($_GET['email'])) {
    $_SESSION['resetemail'] = $_GET['email'];
}
if (
    isset($_SESSION['logged_in'])
    && $_SESSION['logged_in'] == 'u'
  ) {
    header("location:welcome.php");
  }  elseif(isset($_SESSION['logged_in'])
  && $_SESSION['logged_in'] == 'a'){
    header("location:../admin/dashboard.php");
  } else {
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
    <title>ForgetPassword</title>
    <link rel="stylesheet" href="http://localhost/Myproject/bootstrap-5.2.0-beta1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
  </head>
<body>
    <h1 class="text-center">Reset Password</h1>
<div class='container my-4'>
        <div class='row justify-content-center'>
        <div class='col-4'>
        <form method="POST"
              action="../modals/auth.php">
        <div class="mb-3">
    <label for="exampleInputPassword2" class="form-label">New Password</label>
    <input type="password" class="form-control" name="newpassword" id="exampleInputPassword2">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Confirm New Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
  </div>
  <div class="mb-3 form-check">
   
  <button type="submit" name="resetpass" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
</div>
</body>
</html>