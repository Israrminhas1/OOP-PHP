<?php 

require('../classes/myblogs.php');
require('../includes/status.php');
$allblogs= new blogs();

$result_fetch=$allblogs->getallBlogs();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="http://localhost/Myproject/bootstrap-5.2.0-beta1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

<script src="https://cdn.tiny.cloud/1/0ryaqycrmjxq76vkkpsbxl5v7y7gpijwzh1kzauk53ohxtve/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
        }  else {
             header("location:../index.php");
         }
         ?>


    <!-- delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../modals/blogdelete.php" method="post">
                        <input type="hidden" name="id" id="blogdelete" class="form-control" /><br />
                        <label for="">Are you sure you want to delete?</label>
                        <div class="modal-footer">
                            <button type='submit' class='btn btn-danger' name='deleteid'><i
                                    class="bi bi-trash text-light"></i>
                                Delete</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- edit-->
    <div class="modal fade" id="editModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel"
        aria-hidden="true" >
        <div class="modal-dialog" style=" max-width: 1000px;
    ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container my-4">
                        <div class="row justify-content-center">
                            <div class="col">
                                <form action="../modals/blogupdate.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" class='form-control' id='blogid' name="blogid">
                                    <label for="titleName" class="form-label">Title</label>
                                    <input type="text" class='form-control' id='titleName' name="title">
                                   
                                    <label for="richtext" class="form-label">Description</label>
                                    <textarea id="richtext" name="description">
                    Welcome to TinyMCE!
                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type='submit' class='btn btn-warning' name='editid'><i class="bi bi-arrow-repeat"></i>
                        Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
            </div>

        </div>
    </div>
    </div>
    <div class="container" style="text-align:center;">



        <h2 style="color:green; text-align:center;">Blog Details</h2>

        <table class="table table-sm table-bordered border border-dark" id="myTable">
            <thead>
                <tr>
                    <th scope="col" onclick="sortTable(0)"><i class="abc"></i> ID</th>
                    <th scope="col" onclick="sortTable(1)"><i class="abc"></i>Title</th>
                    <th scope="col" onclick="sortTable(2)"><i class="abc"></i>Blog By</th>


                    <th scope="col" style="width: 390px; color:green;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($result_fetch as $value){
  
 ?>
                <tr>
                    <td><?= $value['id']; ?></td>
                    <td><?= $value['title']; ?></td>
                    <td><?= $value['name']; ?></td>

                    <td> <button type="button" onClick="onDelete(<?php echo $value['id']?>)"
                            class="delete btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="bi bi-trash text-light"></i> Delete</button>
                        <button type="button" onClick="onEdit(<?php echo $value['id']?>)" class="edit btn btn-warning"
                            data-bs-toggle="modal" data-bs-target="#editModal">
                            <i class="bi bi-arrow-repeat"></i> Update</button></td>

                </tr>

                <?php }?>
            </tbody>
        </table>

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
        function onDelete(n) {
            console.log("hello", n);
            $.ajax({
                url: 'blogfile.php',
                type: 'get',
                success: function (res) {
                    const parsed = JSON.parse(res);
                    console.log(parsed);
                    var i = parsed.findIndex(p => p.id == n);
                    console.log(i);
                    document.getElementById("blogdelete").value = parsed[i]['id'];
                }
            });
        }
        //edit
        function onEdit(n) {
      $.ajax({
        url: 'blogfile.php',
        type: 'get',
        success: function (res) {
          const parsed = JSON.parse(res);
          var i = parsed.findIndex(p => p.id == n);
         
          document.getElementById("blogid").value = parsed[i]['id'];
          document.getElementById("titleName").value = parsed[i]['title'];
         // document.getElementById("fileToUpload").value = parsed[i]['main_image'];
        console.log(parsed[i]['description']);
        tinymce.get("richtext").getBody().innerHTML  = parsed[i]['description'];
         
        }

      });
    }
    </script>

</body>

</html>