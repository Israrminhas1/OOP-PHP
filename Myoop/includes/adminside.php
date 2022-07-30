<div class="offcanvas offcanvas-start" tabindex="-1" data-bs-backdrop="false" id="offcanvasExample"
    aria-labelledby="offcanvasLabel" style="margin-top:55px; color: white;
  background-color: black; max-width:220px;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasLabel"> <img src="../uploads/<?php if(isset($_SESSION['profileimage'])){ echo $_SESSION['profileimage'];}else { echo "123.png";}
        ?>" alt="..." width="70" height="70"></h5>
        <?php echo $_SESSION['username'] ?>
    </div>
    <div class="offcanvas-body">
        <div class="list-group">
            <a class="list-group-item list-group-item-action list-group-item-dark" href='../admin/viewuser.php'><i
                    class="bi bi-people-fill"></i> User Management</a>
                    <a class="list-group-item list-group-item-action list-group-item-dark" href='../admin/adminblogs.php'>
                        <i class="bi bi-card-heading"></i> Blog Management</a>
        </div>

    </div>
</div>