<?= $this->extend('templates/layout'); ?>

<?= $this->section('contentHead'); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card">
  <div class="border-bottom title-part-padding">
    <h4 class="card-title mb-0">Form Tambah Karyawan</h4>
  </div>
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

    <form action="/tambah_karyawan" method="POST">
      <?= csrf_field(); ?>
      <div class="row">
        <div class="col-md-6 col-sm-12 mb-3">
          <p class="card-subtitle mb-3">Data Diri</p>

          <div class="form-group row mb-3">
            <label class="col-md-2 col-sm-12 col-form-label" style="white-space: nowrap;">Diterima</label>
            <div class="col-auto">
              <input type="date" class="d-inline form-control <?= ($validation->hasError('tanggal_masuk')) ? 'is-invalid' : ''; ?>" name="tanggal_masuk" placeholder="dd/mm/yyyy" value="<?= date("Y-m-d"); ?>">
              <?php if ($validation->hasError('tanggal_masuk')) {
                echo '<div class="invalid-feedback"><small>' . $validation->getError('tanggal_masuk') . '</small></div>';
              } ?>
            </div>
          </div>

          <div class="form-group row mb-3">
            <label class="col-md-2 col-sm-12 col-form-label" style="white-space: nowrap;">Nama</label>
            <div class="col-md-10 col-sm-12">
              <input type="text" class="form-control <?= ($validation->hasError('namalengkap')) ? 'is-invalid' : ''; ?>" onkeypress="ValidationNameInput(event)" name="namalengkap" placeholder="Contoh: John Doe" value="<?= old('namalengkap'); ?>">
              <?php if ($validation->hasError('namalengkap')) {
                echo '<div class="invalid-feedback"><small>' . $validation->getError('namalengkap') . '</small></div>';
              } ?>
            </div>
          </div>

          <div class="form-group row mb-3">
            <label class="col-md-2 col-sm-12 col-form-label" style="white-space: nowrap;">Alamat</label>
            <div class="col-md-10 col-sm-12">
              <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" rows="2" name="alamat" placeholder="Contoh: Jalan Pemuda No.12, Kebumen"><?= old('alamat'); ?></textarea>
              <?php if ($validation->hasError('alamat')) {
                echo '<div class="invalid-feedback"><small>' . $validation->getError('alamat') . '</small></div>';
              } ?>
            </div>
          </div>

          <div class="form-group row mb-3">
            <label class="col-md-2 col-sm-12 col-form-label" style="white-space: nowrap;">Telepon</label>
            <div class="col-md-10 col-sm-12">
              <input type="text" class="form-control <?= ($validation->hasError('telepon')) ? 'is-invalid' : ''; ?>" onkeypress="return ValidationNumberOnly(event)" name="telepon" placeholder="Contoh: 021xxxxx atau 0821xxxxxxxx" value="<?= old('telepon'); ?>">
              <?php if ($validation->hasError('telepon')) {
                echo '<div class="invalid-feedback"><small>' . $validation->getError('telepon') . '</small></div>';
              } ?>
            </div>
          </div>

          <div class="form-group row mb-3">
            <label class="col-md-2 col-sm-12 col-form-label" style="white-space: nowrap;">Salary</label>
            <div class="col-md-10 col-sm-12">
              <input type="text" class="form-control <?= ($validation->hasError('salary')) ? 'is-invalid' : ''; ?>" onkeypress="return ValidationNumberOnly(event)" name="salary" placeholder="Contoh: 1750000" value="<?= old('salary'); ?>">
              <?php if ($validation->hasError('salary')) {
                echo '<div class="invalid-feedback"><small>' . $validation->getError('salary') . '</small></div>';
              } ?>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12 mb-3">
          <p class="card-subtitle mb-3">Akun</p>

          <div class="form-group row">
            <label class="col-md-2 col-sm-12 col-form-label" style="white-space: nowrap;">Username</label>
            <div class="col-md-10 col-sm-12">
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i data-feather="user" class="feather-sm"></i></span>
                <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>"  name="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" style="border-top-right-radius: 2px; border-bottom-right-radius: 2px;" value="<?= old('username'); ?>">
                <?php if ($validation->hasError('username')) {
                  echo '<div class="invalid-feedback"><small>' . $validation->getError('username') . '</small></div>';
                } ?>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-2 col-sm-12 col-form-label" style="white-space: nowrap;">Password</label>
            <div class="col-md-10 col-sm-12">
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i data-feather="lock" class="feather-sm"></i></span>
                <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" name="password" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" style="border-top-right-radius: 2px; border-bottom-right-radius: 2px;">
                <?php if ($validation->hasError('password')) {
                  echo '<div class="invalid-feedback"><small>' . $validation->getError('password') . '</small></div>';
                } ?>
              </div>
            </div>
          </div>
        </div>

      </div>

      <button class="btn btn-success" type="submit">Tambah</button>
    </form>
  </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('contentScript'); ?>
<?= $this->endSection(); ?>