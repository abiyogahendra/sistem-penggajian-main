<?= $this->extend('templates/layout'); ?>

<?= $this->section('contentHead'); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card">
  <div class="card-header">Akun pengguna</div>
  <div class="card-body">
    <?php if (session()->getFlashdata('flashStatus')) {
      if (session()->getFlashdata('flashStatus') == "success") { ?>
        <!-- Alert -->
        <div class="alert customize-alert text-success alert-light-success" role="alert">
          <div class="d-flex align-items-center font-weight-medium">
            <i data-feather="info" class="text-success fill-white feather-sm me-2"></i>
            <?= session()->getFlashdata('flashMessage'); ?>
          </div>
        </div>
      <?php
      } else if (session()->getFlashdata('flashStatus') == "failed") { ?>
        <!-- Alert -->
        <div class="alert customize-alert text-danger alert-light-danger" role="alert">
          <div class="d-flex align-items-center font-weight-medium">
            <i data-feather="info" class="text-danger fill-white feather-sm me-2"></i>
            <?= session()->getFlashdata('flashMessage'); ?>
          </div>
        </div>
    <?php }
    } ?>

    <form action="/updt_akun" method="post">
      <?= csrf_field(); ?>
      <input type="hidden" name="keyname" value="<?= session()->get('ses_username') ?>">
      <div class="form-group mb-3">
        <label class="small">Username</label>
        <div>
          <input type="text" name="username" placeholder="Contoh: johndoe" value="<?= empty(old('username')) ? session()->get('ses_username') : old('username'); ?>" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>">
          <?php if ($validation->hasError('username')) {
            echo '<div class="invalid-feedback"><small>' . $validation->getError('username') . '</small></div>';
          } ?>
        </div>
      </div>

      <div class="form-group mb-3">
        <label class="small">Password</label>
        <div>
          <input type="password" name="password" placeholder="Password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>">
          <?php if ($validation->hasError('password')) {
            echo '<div class="invalid-feedback"><small>' . $validation->getError('password') . '</small></div>';
          } ?>
        </div>
      </div>

      <button type="submit" class="btn btn-success px-2">Simpan</button>
    </form>
  </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('contentScript'); ?>
<?= $this->endSection(); ?>