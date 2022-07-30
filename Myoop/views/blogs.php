<?php
require('../includes/status.php');
 session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Your profile</title>
    <link rel="stylesheet" href="http://localhost/Myproject/bootstrap-5.2.0-beta1-dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="https://cdn.tiny.cloud/1/0ryaqycrmjxq76vkkpsbxl5v7y7gpijwzh1kzauk53ohxtve/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
</head>

<body>
    
        <header>

            <?php
    
   if (isset($_SESSION['logged_in'])
    && $_SESSION['logged_in']=='u'
   ) {
       include("../includes/usernav.php");
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
   } elseif(isset($_SESSION['logged_in'])
   && $_SESSION['logged_in'] == 'a'){
     header("location:../admin/dashboard.php");
   }  else {
        header("location:../index.php");

    }
    ?>

        </header>

   
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-8">
                <form action="../modals/blogs.php" method="post" enctype="multipart/form-data">
                    <label for="titleName" class="form-label">Title</label>
                    <input type="text" class='form-control' id='titleName' name="title">
                    <label for="fileToUpload" class="form-label">Upload Your Profile Picture</label>
                    <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
                    <label for="richtext" class="form-label">Description</label>
                    <textarea id="richtext" name="description">
                    Welcome to TinyMCE!
                </textarea>
                    <button type='submit' class='btn btn-primary' name='submit'>submit</button>
                </form>


            </div>
        </div>
    </div>
    <script>
        tinymce.init({
            selector: '#richtext',
            plugins: [
                'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help',
                'wordcount'
            ],
            toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'

        });
    </script>
</body>

</html>