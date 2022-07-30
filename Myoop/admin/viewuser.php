<?php 
require('../classes/user.php');
require('../includes/status.php');

$userview=new User();
$result_fetch=$userview->getAllUsers();

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
            header("location:../index.php");
        }elseif(isset($_SESSION['logged_in'])
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
  </header>
  <!-- delete -->
  <div class="modal fade" id="deleteModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="../modals/deleteuser.php" method="post">
            <input type="hidden" name="id" id="userdelete" class="form-control" /><br />
            <label for="">Are you sure you want to delete?</label>
            <div class="modal-footer">
              <button type='submit' class='btn btn-danger' name='deleteid'><i class="bi bi-trash text-light"></i>
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
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="../modals/updateuser.php" method="post">
            <input type="hidden" name="id" id="userid" class="form-control" /><br />

            <div class="mb-3">
              <label for="inputName" class="form-label">Name</label>
              <input type='text' class='form-control' id='username' name="name" placeholder='Enter Name'>

            </div>
            <div class="mb-3">
              <label for='inputPhone' class='form-label'>Phone</label>
              <input type='text' class='form-control' id='userphone' name='phone' placeholder='Enter Your Phone Number'>
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" name="email" id='useremail' class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
              <div class="form-check form-switch">
                <input class="form-check-input" type="hidden" name="check" value="0">
                <input class="form-check-input" type="checkbox" name="check" value="1" id="useractive" checked>
                <label class="form-check-label" for="flexSwitchCheckDefault">is Active</label>
              </div>
              <div class="mb-3">
                <select class="form-select" name="taskOption" id="myselect">
                  <option value="a">Admin</option>
                  <option value="u">User</option>
                </select>
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
   <!-- permissions -->
   <div class="modal fade" id="permissionModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Set Permissions</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body ">
          <form action="../modals/setPermissions.php" method="post">
           
          <label class="form-check-label" >Blog Permissions</label>
          <input type="hidden" name="permid" id="permid" class="form-control" />
          <div class="container mt-5 border border-dark ">
          
          <div class="form-check form-switch">
                <input class="form-check-input" type="hidden" name="checkedit" value="0">
                <input class="form-check-input" type="checkbox" name="checkedit" value="1" id="editactive" checked>
                <label class="form-check-label" for="flexSwitchCheckDefault">Edit Blog</label>
              </div>
          <div class="form-check form-switch">
          
                <input class="form-check-input" type="hidden" name="checkcreate" value="0">
                <input class="form-check-input" type="checkbox" name="checkcreate" value="1" id="createactive" checked>
                <label class="form-check-label" for="flexSwitchCheckDefault">Create Blog</label>
              </div>
          <div class="form-check form-switch">
                <input class="form-check-input" type="hidden" name="checkdelete" value="0">
                <input class="form-check-input" type="checkbox" name="checkdelete" value="1" id="deleteactive" checked>
                <label class="form-check-label" for="flexSwitchCheckDefault">Delete Blog</label>
              </div>
              </div>
            <div class="modal-footer">
              <button type='submit' class='btn btn-success' name='setid'><i class="bi bi-trash text-light"></i>
                Set Permission</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="container" >
    <input style="margin-top:10px;" type="text" id="myInput" onkeyup="mySearch()" placeholder="Search table"
      title="Type">

    <h2 style="color:green; text-align:center;">User Details</h2>

    <table class="table table-bordered border border-dark" id="myTable" >
      <thead>
        <tr>
          <th scope="col" onclick="sortTable(0)"><i class="abc"></i> ID</th>
          <th scope="col" onclick="sortTable(1)"><i class="abc"></i>Name</th>
          <th scope="col" onclick="sortTable(2)"><i class="abc"></i>Phone</th>
          <th scope="col" onclick="sortTable(3)"><i class="abc"></i>Email</th>
          <th scope="col">is_active</th>
          <th scope="col">role</th>
          <th scope="col" style="width: 390px;">action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($result_fetch as $value){
  
 ?>
        <tr>
          <td><?= $value['id']; ?></td>
          <td><?= $value['name']; ?></td>
          <td><?= $value['phone']; ?></td>
          <td><?= $value['email']; ?></td>
          <td><?php if($value['active']=='1'){echo "Active";}else { echo "Inactive";} ?></td>
          <td><?php if($value['role']=='a'){echo "Admin";}else { echo "User";} ?></td>
          <td> <button type="button" onClick="onDelete(<?php echo $value['id']?>)"
    class="delete btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
              <i class="bi bi-trash text-light"></i> Delete</button>
            <button type="button" onClick="onEdit(<?php echo $value['id']?>)" 
              class="edit btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal">
              <i class="bi bi-arrow-repeat"></i> Update</button>
              <button type="button" onClick="onSetPerm(<?php echo $value['id']?>)" 
              class="permission btn btn-success" data-bs-toggle="modal" data-bs-target="#permissionModal">
              <i class="bi bi-person-check-fill"></i> Set Permissions</button></td>

        </tr>

        <?php }?>
      </tbody>
    </table>
  </div>
  <script>
    function mySearch() {
      var input, filter, table, tr, td, td1, td2, td3, i, txtValue, value;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      //console.log(filter);
      for (i = 0; i < tr.length; i++) {
        //gets value of id from each table row

        td = tr[i].getElementsByTagName("td")[0];
        td1 = tr[i].getElementsByTagName("td")[1];
        td2 = tr[i].getElementsByTagName("td")[2];
        td3 = tr[i].getElementsByTagName("td")[3];
        console.log(tr[1].getElementsByTagName("td")[i].innerText);
        //if(tr[0].getElementsByTagName("th")[i].innerText=='ID')

        if (td) {

          if ((td.innerHTML.toUpperCase().indexOf(filter) > -1) ||
            (td1.innerHTML.toUpperCase().indexOf(filter) > -1) ||
            (td2.innerHTML.toUpperCase().indexOf(filter) > -1) ||
            (td3.innerHTML.toUpperCase().indexOf(filter) > -1)) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }


      }



    }

    function onDelete(n) {
      console.log("hello", n);
      $.ajax({
        url: 'ajaxfile.php',
        type: 'get',
        success: function (res) {
          const parsed = JSON.parse(res);
          var i = parsed.findIndex(p => p.id == n);
          console.log(i);
          document.getElementById("userdelete").value = parsed[i]['id'];
        }
      });
    }
    //delete
   
    //removing delete button for super admin
    let myuserid = <?php echo $_SESSION['userid'];?> ;
    console.log("myid", myuserid);
    table = document.getElementById("myTable");
    tr = table.tBodies[0].rows;
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];

      if (td.innerHTML === '1') {

        td1 = tr[i].getElementsByTagName("td")[6];
        td1.innerHTML = "<h5 style='color:red'>SUPER ADMIN</h5>";


      } else if (td.innerHTML == myuserid) {
        td1 = tr[i].getElementsByTagName("td")[6];
        td1.innerHTML = "<h5 style='color:red'>Logged In</h5>";
      }

    }

    function onEdit(n) {
      $.ajax({
        url: 'ajaxfile.php',
        type: 'get',
        success: function (res) {
          const parsed = JSON.parse(res);
          var i = parsed.findIndex(p => p.id == n);
          document.getElementById("userid").value = parsed[i]['id'];
          document.getElementById("username").value = parsed[i]['name'];
          document.getElementById("userphone").value = parsed[i]['phone'];
          document.getElementById("useremail").value = parsed[i]['email'];
          document.getElementById("useractive").checked = Number(parsed[i]['active']);
          document.getElementById("myselect").value = parsed[i]['role'];

          // document.getElementById("useractive").value=Number(parsed[i]['active']);
          console.log(document.getElementById("useractive").checked);
        }

      });
    }
    function onSetPerm(n){
      console.log(n);

      $.ajax({
        url: 'getpermission.php',
        type: 'get',
        success: function (res) {
          const parsed = JSON.parse(res);
          console.log(parsed);
          var i = parsed.findIndex(p => p.userid == n);
          
          document.getElementById("permid").value = parsed[i]['id'];
            console.log(parsed[i]['permissions'])
            const parseperm = JSON.parse(parsed[i]['permissions']);
            console.log(parseperm['EditBlog']);
         document.getElementById("editactive").checked = Number(parseperm['EditBlog']);
         document.getElementById("createactive").checked = Number(parseperm['CreateBlog']);
         document.getElementById("deleteactive").checked = Number(parseperm['DeleteBlog']);
       

          // document.getElementById("useractive").value=Number(parsed[i]['active']);
        }

      });
    }

    function sortTable(n) {
      var table, rows, switching, i, x, y, a, b, c, shouldSwitch, dir, switchcount = 0;
      table = document.getElementById("myTable");
      switching = true;
      //Set the sorting direction to ascending:
      dir = "asc";
      

      /*Make a loop that will continue until
      no switching has been done:*/
      while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
          //start by saying there should be no switching:
          shouldSwitch = false;
          /*Get the two elements you want to compare,
          one from current row and one from the next:*/
          x = rows[i].getElementsByTagName("TD")[n];
          y = rows[i + 1].getElementsByTagName("TD")[n];

          //       if(n=='2')
          //       {
          //         c=x.innerHTML;
          //         c=c.substr(2);
          // console.log(c);

          //       }
          if (!isNaN(x.innerHTML)) {

            if (dir == "asc") {
              if (Number(x.innerHTML) > Number(y.innerHTML)) {
                //if so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
              }
            } else if (dir == "desc") {
              if (Number(x.innerHTML) < Number(y.innerHTML)) {
                //if so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
              }
            }
          } else {

            /*check if the two rows should switch place,
            based on the direction, asc or desc:*/
            if (dir == "asc") {

              if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                //if so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
              }
            } else if (dir == "desc") {
              if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                //if so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
              }
            }
          }
        }
        if (shouldSwitch) {
          /*If a switch has been marked, make the switch
          and mark that a switch has been done:*/
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
          switching = true;
          //Each time a switch is done, increase this count by 1:
          switchcount++;
        } else {
          /*If no switching has been done AND the direction is "asc",
          set the direction to "desc" and run the while loop again.*/
          if (switchcount == 0 && dir == "asc") {
            dir = "desc";
            //  document.getElementBy("myarrowid").className = "bi bi-arrow-down"; 
            

            switching = true;
          }
        }
      }
    }
  </script>

</body>

</html>