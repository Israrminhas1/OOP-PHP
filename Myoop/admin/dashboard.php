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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <style>
        img {
            border-radius: 50%;
        }

        .navbar {}
    </style>
</head>

<body>

    <?php
         
        if (isset($_SESSION['logged_in'])
         && $_SESSION['logged_in'] == 'u'
        ) {
            header("location:../index.php");
        } elseif (isset($_SESSION['logged_in'])
        && $_SESSION['logged_in'] == 'a'){
            include("../includes/adminnav.php");
            include("../includes/adminside.php");
        }  else {
             header("location:../index.php");
         }
         ?>



    <div class="container" style="text-align:center;">

        <h4>Admin Details</h3>
            UserPhone: <?php echo $_SESSION['userphone']?> <br>
            UserName: <?php echo $_SESSION['username']?>
    </div>



</body>

</html>