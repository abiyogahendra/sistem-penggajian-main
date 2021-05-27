<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
      <ul id="sidebarnav">
        <div class="devider mt-0 pt-0"></div>
        <li class="sidebar-item">
          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/dashboard" aria-expanded="false">
            <i class="mdi mdi-av-timer"></i>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>
        <?php if (session()->get('ses_userRole') == 1) { ?>
          <div class="devider"></div>
          <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/karyawan" aria-expanded="false">
              <i class="mdi mdi-account-multiple"></i>
              <span class="hide-menu">Karyawan</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/absensi" aria-expanded="false">
              <i class="mdi mdi-calendar-range"></i>
              <span class="hide-menu">Absensi</span>
            </a>
          </li>
          <div class="devider"></div>
          <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/laporan" aria-expanded="false">
              <i class="mdi mdi-file-document"></i>
              <span class="hide-menu">Laporan Gaji</span>
            </a>
          </li>
        <?php } ?>
        <div class="devider mb-0 pb-0"></div>
      </ul>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>