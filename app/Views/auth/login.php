<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="assets/images/logos/logo-light-icon.png" type="image/x-icon">
  <title><?= $title; ?></title>
  <link href="assets/css/style.min.css" rel="stylesheet">
</head>

<body>

  <div class="main-wrapper">

    <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div>

    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
      <div class="auth-box p-4 bg-white rounded">
        <div id="loginform">
          <div class="logo">
            <h3 class="box-title mb-3">Login</h3>

          </div>

          <?php if (session()->getFlashdata('flashStatus')) {
            if (session()->getFlashdata('flashStatus') == "success") { ?>
              <!-- Alert -->
              <div class="alert customize-alert border-success text-success" role="alert">
                <div class="d-flex align-items-center">
                  <i data-feather="info" class="text-success fill-white feather-sm me-2"></i>
                  <?= session()->getFlashdata('flashMessage'); ?>
                </div>
              </div>
            <?php
            } else if (session()->getFlashdata('flashStatus') == "failed") { ?>
              <!-- Alert -->
              <div class="alert customize-alert border-danger text-danger" role="alert">
                <div class="d-flex align-items-center">
                  <i data-feather="info" class="text-danger fill-white feather-sm me-2"></i>
                  <?= session()->getFlashdata('flashMessage'); ?>
                </div>
              </div>
          <?php }
          } ?>
          
          <!-- Form -->
          <div class="row">
            <div class="col-12">
              <form class="form-horizontal mt-2 form-material" id="loginform" action="/do_login" method="POST">
                <?= csrf_field(); ?>

                <div class="form-group mb-3">
                  <input class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" type="text" name="username" placeholder="Username" value="<?= !empty(old('username')) ? old('username') : ''; ?>">
                  <?php if ($validation->hasError('username')) {
                    echo '<div class="invalid-feedback"><span class="small">' . $validation->getError('username') . '</span></div>';
                  } ?>
                </div>

                <div class="form-group mb-4">
                  <input class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" type="password" name="password" placeholder="Password">
                  <?php if ($validation->hasError('password')) {
                    echo '<div class="invalid-feedback"><span class="small">' . $validation->getError('password') . '</span></div>';
                  } ?>
                </div>

                <div class="form-group">
                  <div class="d-flex">
                    <div class="ms-auto small">
                      <a href="javascript:void(0)" id="to-recover" class="link font-weight-medium"><i class="fa fa-lock me-1"></i> Lupa password?</a>
                    </div>
                  </div>
                </div>

                <div class="form-group text-center mt-4 mb-3">
                  <div class="col-xs-12">
                    <button class="btn btn-primary d-block w-100 waves-effect waves-light" type="submit">Login</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/feather.min.js"></script>
  <script>
    feather.replace();
    $(".preloader").fadeOut();
  </script>
</body>

</html>