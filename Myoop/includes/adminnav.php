<nav class='navbar navbar-expand-lg navbar-dark bg-black'>
  <div class='container-fluid'>
    <button class="btn btn-dark bg-black" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
      aria-controls="offcanvasExample">
      <h5><i class="bi bi-list"></i></h5>
    </button>
    <a class='navbar-brand' href='../admin/dashboard.php'> ADMIN Dashboard</a>
    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarTogglerDemo02'
      aria-controls='navbarTogglerDemo02' aria-expanded='false' aria-label='Toggle navigation'>
      <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='navbarTogglerDemo02'>
      <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
        <li class='nav-item'>
          <a class='nav-link active' aria-current='page' href='#'>Home</a>
        </li>


      </ul>
      <div class="dropdown">
        <button class="btn btn-light dropdown-toggle dropdown-toggle-split" type="button" id="dropdownMenuButton1"
          data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-gear"></i> Settings
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
          <li><a class="dropdown-item" href='../views/updateuser.php'>Account settings</a></li>
         
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item " href='../views/logout.php'>Logout</a></li>
        </ul>
      </div>
    </div>



  </div>
</nav>