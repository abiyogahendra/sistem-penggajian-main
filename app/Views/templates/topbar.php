<header class="topbar">
  <nav class="navbar top-navbar navbar-expand-md navbar-dark">
    <div class="navbar-header border-end">
      <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
      <a class="navbar-brand" href="/dashboard">
        <!-- Logo icon -->
        <b class="logo-icon">
          <!-- <i class="wi wi-sunset"></i> -->
          <!-- Dark Logo icon -->
          <img src="../../assets/images/logos/logo-icon.png" alt="homepage" class="dark-logo" />
          <!-- Light Logo icon -->
          <img src="../../assets/images/logos/logo-light-icon.png" alt="homepage" class="light-logo" />
        </b>
        <!--End Logo icon -->
        <!-- Logo text -->
        <span class="logo-text">
          <!-- dark Logo text -->
          <img src="../../assets/images/logos/logo-text.png" alt="homepage" class="dark-logo" />
          <!-- Light Logo text -->
          <img src="../../assets/images/logos/logo-light-text.png" class="light-logo" alt="homepage" />
        </span>
      </a>
      <!-- Toggle button -->
      <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
    </div>
    <!-- End Logo -->
    <div class="navbar-collapse collapse" id="navbarSupportedContent">
      <!-- toggle and nav items -->
      <ul class="navbar-nav me-auto">
        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu fs-5"></i></a></li>
      </ul>
      <!-- Right side toggle and nav items -->
      <ul class="navbar-nav">
        <!-- User profile and search -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="../../assets/images/users/avatar.png" alt="user" class="rounded-circle" width="36">
            <span class="ms-2 font-weight-medium">
              <?= session()->get('ses_userRole') == 1 ? 'Admin' : 'Karyawan'; ?>
            </span><span class="fas fa-angle-down ms-2"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-end user-dd dropdown-menu-animate-up">
            <div class="d-flex no-block align-items-center p-3 mb-2">
              <div class=""><img src="../../assets/images/users/avatar.png" alt="user" class="rounded-circle" width="60"></div>
              <div class="ms-2">
                <h4 class="mb-0"><?= session()->get('ses_nama'); ?></h4>
                <p class=" mb-0"><?= session()->get('ses_username'); ?></p>
              </div>
            </div>
            <a class="dropdown-item" href="/settings"><i data-feather="user" class="feather-sm text-info me-1 ms-1"></i> My
              Profile</a>
            <a class="dropdown-item" href="/logout"><i data-feather="log-out" class="feather-sm text-danger me-1 ms-1"></i> Logout</a>
          </div>
        </li>
        <!-- End User Profile and Search -->
      </ul>
    </div>
  </nav>
</header>