<?php 

require('includes/status.php');
session_start();
if (
    isset($_SESSION['logged_in'])
    && $_SESSION['logged_in'] == 'u'
) {
    header("location:views/welcome.php");
} elseif(isset($_SESSION['logged_in'])
&& $_SESSION['logged_in'] == 'a'){
    header("location:admin/dashboard.php");
} else {
    include('includes/mynav.php');
    
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
    <title>User - Login and Register</title>
  <link rel="stylesheet" href="http://localhost/Myproject/bootstrap-5.2.0-beta1-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>
 <body>
 <header>

</header>
<h1 class="text-center">
   Welcome to main page
</h1>
   

</body>
</html>