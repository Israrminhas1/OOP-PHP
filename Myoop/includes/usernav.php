<nav class='navbar navbar-expand-lg bg-primary'>
          <div class='container-fluid'>
            <a class='navbar-brand' href='../views/welcome.php'><?php echo $_SESSION['username'] ?> Dashboard</a>
            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarTogglerDemo02' aria-controls='navbarTogglerDemo02' aria-expanded='false' aria-label='Toggle navigation'>
              <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarTogglerDemo02'>
              <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                <?php if($_SESSION['permissions']['CreateBlog']) { ?>
                <li class='nav-item'>
                  <a class='nav-link active' aria-current='page' href='../views/blogs.php'>Create Blog</a>
                </li>
              <?php } ?>
              <li class='nav-item'>
                  <a class='nav-link active' aria-current='page' href='../views/udBlog.php'>My Blogs</a>
                </li>
              
              </ul>
              <div class="dropdown">
  <button class="btn btn-light dropdown-toggle dropdown-toggle-split" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  <i class="bi bi-gear"></i> Settings
  </button>
  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item" href='../views/updateuser.php'>Account settings</a></li>
    
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item " href='logout.php'  >Logout</a></li>
  </ul>
            </div>
</div>

      
      
          </div>
        </nav> 