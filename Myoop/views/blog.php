<?php
 include('../includes/mynav.php');
 require('../classes/myblogs.php');
 $bloglist= new blogs();
 
$result_fetch=$bloglist->getallData();


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
  <?php
  if(isset($_GET['id'])) {
    $id=$_GET['id'];
  
   $data_fetch= $bloglist->matchID($id);
   foreach ($data_fetch as $value){
   ?>
  <div class="container">
  <div class="row">
    <div class="col-md-4">
    <img src="../uploads/<?php echo $value['main_image']; ?>"  class="card-img-top" alt="..." >
    </div>
  </div>
  <h2><?php echo $value['title']; ?>" </h2>
  <p><?php echo $value['description']; ?>" </p>
  <p><small class="text-muted">Blog Created by <?php echo $value['name'] ?></small></p>
  
  <?php } } else {
  foreach ($result_fetch as $value){
 
    
  ?>
<div class="container">
<div class="card mb-3" style="max-width: 540px;">

  <div class="row g-0">
    <div class="col-md-4">
    <img src="../uploads/<?php echo $value['main_image']; ?>"  class="card-img-top" alt="..." >
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?php echo $value['title'] ?></h5>
        <a href="blog.php?id=<?php echo $value['id']; ?>" rel="noopener noreferrer">Click for more detail</a>
        <p class="card-text"><small class="text-muted">Blog Created by <?php echo $value['name'] ?></small></p>
      </div>
    </div>
  </div>
</div>

</div>

 
<?php } }?>
</body>
</html>