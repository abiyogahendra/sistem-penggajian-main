<?= $this->extend('templates/layout'); ?>

<?= $this->section('contentHead'); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="card">
  <div class="border-bottom title-part-padding">
    <h4 class="card-title mb-0">Form Edit Karyawan</h4>
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

    <form action="/edit_karyawan" method="POST" class="mb-3">
      <?= csrf_field(); ?>
      <input type="hidden" name="key" value="<?= $karyawan['id']; ?>">
      <input type="hidden" name="keyname" value="<?= $karyawan['username']; ?>">

      <div class="row">
        <div class="col-md-6 col-sm-12">
          <p class="card-subtitle mb-3">Data Diri</p>
          <div class="form-group mb-3">
            <label class="small">Tanggal diterima</label>
            <div class="row">
              <div class="col-auto">
                <input type="date" name="tanggal_masuk" placeholder="dd/mm/yyyy" value="<?= $karyawan['tanggal_masuk']; ?>" class="d-inline form-control <?= ($validation->hasError('tanggal_masuk')) ? 'is-invalid' : ''; ?>">
                <?php if ($validation->hasError('tanggal_masuk')) {
                  echo '<div class="invalid-feedback"><small>' . $validation->getError('tanggal_masuk') . '</small></div>';
                } ?>
              </div>
            </div>
          </div>

          <div class="form-group mb-3">
            <label class="small">Nama</label>
            <div>
              <input type="text" name="namalengkap" placeholder="Contoh: John Doe" value="<?= $karyawan['nama']; ?>" class="form-control <?= ($validation->hasError('namalengkap')) ? 'is-invalid' : ''; ?>">
              <?php if ($validation->hasError('namalengkap')) {
                echo '<div class="invalid-feedback"><small>' . $validation->getError('namalengkap') . '</small></div>';
              } ?>
            </div>
          </div>

          <div class="form-group mb-3">
            <label class="small">Alamat</label>
            <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" name="alamat" placeholder="Contoh: Jalan Kenanga No. 12, Kebumen" rows="3"><?= $karyawan['alamat']; ?></textarea>
            <?php if ($validation->hasError('alamat')) {
              echo '<div class="invalid-feedback"><small>' . $validation->getError('alamat') . '</small></div>';
            } ?>
          </div>

          <div class="form-group mb-3">
            <label class="small">Telepon</label>
            <div>
              <input type="text" name="telepon" placeholder="Contoh: 021xxxxx atau 0821xxxxxxxx" value="<?= $karyawan['telepon']; ?>" class="form-control <?= ($validation->hasError('telepon')) ? 'is-invalid' : ''; ?>">
              <?php if ($validation->hasError('telepon')) {
                echo '<div class="invalid-feedback"><small>' . $validation->getError('telepon') . '</small></div>';
              } ?>
            </div>
          </div>

          <div class="form-group mb-3">
            <label class="small">Salary</label>
            <div>
              <input type="text" name="salary" placeholder="Contoh: 1790500" value="<?= $karyawan['salary']; ?>" class="form-control <?= ($validation->hasError('salary')) ? 'is-invalid' : ''; ?>">
              <?php if ($validation->hasError('salary')) {
                echo '<div class="invalid-feedback"><small>' . $validation->getError('salary') . '</small></div>';
              } ?>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12">
          <p class="card-subtitle mb-3">Akun</p>
          <div class="form-group mb-3">
            <label class="small">Username</label>
            <div>
              <input type="text" name="username" placeholder="Contoh: johndoe" value="<?= empty(old('username')) ? $karyawan['username'] : old('username'); ?>" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>">
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
        </div>
      </div>

      <button class="btn btn-success" type="submit">Simpan</button>

    </form>

    <em class="card-subtitle small mb-0">Ditambahkan: <?= $karyawan['created_at']; ?></em>
    <br>
    <em class="card-subtitle small mb-0">Diperbarui: <?= $karyawan['updated_at']; ?></em>
  </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('contentScript'); ?>
<?= $this->endSection(); ?>