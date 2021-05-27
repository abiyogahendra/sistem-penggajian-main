<?= $this->extend('templates/layout'); ?>

<?= $this->section('contentHead'); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card">
  <div class="card-body pb-0">
    <h4 class="card-title">Data Karyawan</h4>

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

    <div class="row pt-2">
      <div class="col-md-6 mb-2">
        <a href="/karyawan/tambah" class="justify-content-center btn btn-primary px-3">
          <i data-feather="user-plus" class="feather-sm me-2"></i>
          <span class="align-middle">Tambah Karyawan</span>
        </a>
      </div>
      <div class="col-auto ms-md-auto mb-2" style="text-align: right;">
        <form action="/karyawan" method="GET">
          <?= csrf_field(); ?>
          <div class="input-group">
            <input type="text" class="form-control" name="keyword" placeholder="Keyword">
            <button class="btn btn-light-secondary text-secondary" type="submit"><i data-feather="search" class="feather-sm fill-white m-0"></i></button>
          </div>
        </form>
      </div>
    </div>

    <?= empty($keyword) ? '' : '<p class="mt-2">Hasil pencarian: <em>' . $keyword . '</em></p>'; ?>

  </div>

  <div class="table-responsive">
    <table class="table customize-table table-hover mb-0 v-middle no-wrap" style="width: 100% !important;">
      <thead class="table-light">
        <tr>
          <th style="width: 48px !important;">#</th>
          <th>Nama</th>
          <th>Username</th>
          <th>Alamat</th>
          <th>Telepon</th>
          <th>Salary</th>
          <th>Sejak</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (count($karyawan) > 0) {
          foreach ($karyawan as $row) : 
          ?>
            <tr>
              <td>
                <form action="/karyawan/edit" class="d-inline">
                  <?= csrf_field(); ?>
                  <input type="hidden" name="key" value="<?= $row['username']; ?>">
                  <button class="btn btn-sm text-warning p-1" type="submit"><i data-feather="edit" class="feather-sm m-0"></i></button>
                </form>
                <button class="btn btn-sm text-danger p-1" onclick="dk(<?= $row['id']; ?>);" type="button"><i data-feather="trash-2" class="feather-sm m-0"></i></button>
              </td>
              <td><span class="font-weight-medium"><?= $row['nama']; ?></span></td>
              <td><?= $row['username']; ?></td>
              <td><?= $row['alamat']; ?></td>
              <td><?= $row['telepon']; ?></td>
              <td>Rp <?= number_format($row['salary'], 2, ',', '.'); ?></td>
              <td><?= $row['tanggal_masuk']; ?></td>
            </tr>
        <?php  endforeach;
        } else {
          echo '<tr><td colspan="7" class="text-center"><em>Data karyawan tidak ditemukan</em></td></tr>';
        } ?>

      </tbody>
    </table>
  </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('contentScript'); ?>
<script src="../../assets/js/sweetalert-page.js"></script>
<?= $this->endSection(); ?>