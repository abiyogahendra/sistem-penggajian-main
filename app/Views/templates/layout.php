<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title><?= $title; ?></title>
  <meta name="description" content="The small framework with powerful features">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/png" href="/favicon.png" />

  <link href="../../assets/css/sweetalert2.min.css" rel="stylesheet">
  <link href="../../assets/css/style.min.css" rel="stylesheet">
  <link href="../../assets/css/custom-css/yobri.css" rel="stylesheet">

  <?= $this->renderSection('contentHead'); ?>

</head>

<body>

  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>

  <!-- CONTENT WRAPPER -->
  <div id="main-wrapper">

    <!-- HEADER -->
    <?= $this->include('templates/topbar'); ?>
    <!-- END HEADER -->

    <!-- SIDEBAR -->
    <?= $this->include('templates/sidebar'); ?>
    <!-- END SIDEBAR -->

    <!-- Content -->
    <div class="page-wrapper">
      <!-- Content -->
      <div class="page-content container-fluid">
        <?= $this->renderSection('content'); ?>
      </div>
      <!-- END CONTENT -->

    </div>

    <!-- SCRIPTS -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/jquery-ui.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <!-- apps -->
    <script src="../../assets/js/app.min.js"></script>
    <script src="../../assets/js/app.init.minimal.js"></script>
    <script src="../../assets/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../../assets/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="../../assets/js/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../../assets/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../assets/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../../assets/js/feather.min.js"></script>
    <script src="../../assets/js/custom.min.js"></script>
    <!-- SweatAlert -->
    <script src="../../assets/js/sweetalert2.all.min.js"></script>
    <!-- custom validation -->
    <script src="../../assets/js-validation/js-validation-karyawan.js"></script>\

    <script>
      $(".preloader").fadeOut();
    </script>
    <?= $this->renderSection('contentScript'); ?>
    <!-- -->

</body>

</html>