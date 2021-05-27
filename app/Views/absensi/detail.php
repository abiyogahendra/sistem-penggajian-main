<?= $this->extend('templates/layout'); ?>

<?= $this->section('contentHead'); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card">
  <div class="card-body pb-0">
    <h4 class="card-title">Absensi Karyawan</h4>

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
      <div class="col-auto ms-md-auto mb-2" style="text-align: right;">
        <form action="/absensi/detail" method="GET">
          <?= csrf_field(); ?>
          <input type="hidden" name="key" value="<?= $key; ?>">
          <div class="input-group">
            <input type="month" class="form-control" name="filter_bulan" value="<?= empty($keyword_bulan) ? date("Y-m") : $keyword_bulan; ?>">
            <button class="btn btn-light-secondary text-secondary" type="submit"><i data-feather="search" class="feather-sm fill-white m-0"></i></button>
          </div>
        </form>
      </div>
    </div>

  </div>

  <div class="table-responsive">
    <table class="table customize-table mb-0 v-middle no-wrap" style="width: 100% !important;">
      <thead class="table-light">
        <tr>
          <th style="width: 48px !important;">#</th>
          <th>Nama</th>
          <th>Tanggal</th>
          <th>Check In</th>
          <th>Status</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data_absensi as $absen) : ?>
          <tr>
            <td>
              <button class="btn btn-sm text-warning p-1" type="button" data-bs-toggle="modal" data-bs-target="#modalEditAbsen" onclick="frmedt(<?= $absen['id_absen'] ?>, <?= $absen['id_karyawan'] ?>, '<?= $absen['tanggal'] ?>', '<?= $absen['jam_masuk'] ?>', '<?= $absen['id_status'] ?>', '<?= $absen['keterangan'] ?>');"><i data-feather="edit" class="feather-sm m-0"></i></button>
              <button class="btn btn-sm text-danger p-1 d-inline" onclick="da('<?= $absen['id_karyawan']; ?>', '<?= $absen['tanggal']; ?>');" type="button"><i data-feather="trash-2" class="feather-sm m-0"></i></button>
            </td>
            <td>
              <a class="font-weight-medium" data-bs-toggle="tooltip" href="/absensi/detail?key=<?= $absen['id_karyawan']; ?>" style="text-decoration: none;"><?= $absen['nama']; ?></a>
            </td>
            <td><?= $absen['tanggal']; ?></td>
            <td><?= $absen['jam_masuk']; ?></td>
            <td>
              <?php if ($absen['id_status'] == 1) { ?>
                <span class="badge bg-light-success text-success fw-normal">Hadir</span>
              <?php } elseif ($absen['id_status'] == 2) { ?>
                <span class="badge bg-light-warning text-warning fw-normal">Telat</span>
              <?php } elseif ($absen['id_status'] == 3) { ?>
                <span class="badge bg-light-danger text-danger fw-normal">Absen</span>
              <?php } else { ?>
                <span class="badge bg-light-danger text-danger fw-normal">N/A</span>
              <?php } ?>
            </td>
            <td><?= $absen['keterangan']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <p class="card-subtitle mt-2 ms-4 small">* Klik nama untuk detail</p>
</div>
<?= $this->endSection(); ?>

<?= $this->section('contentScript'); ?>
<div class="modal fade" id="modalEditAbsen" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header d-flex align-items-center">
        <h4 class="modal-title" id="myLargeModalLabel">Form Edit Presensi</h4>
      </div>
      <form action="/edit_absensi" method="post">
        <?= csrf_field(); ?>
        <input type="hidden" id="edtId" name="id" value="">
        <input type="hidden" id="edtKey" name="key" value="">
        <input type="hidden" id="edtTanggal" name="tanggal" value="">
        <div class="modal-body pt-0">
          <div class="row mb-2">
            <div class="col-md-auto col-sm-12 mb-2">
              <div class="form-group">
                <label class="small">Check In</label>
                <input class="form-control" id="edtJamMasuk" name="jam_masuk" type="time">
              </div>
            </div>
            <div class="col-md-auto col-sm-12 mb-2">
              <div class="form-group">
                <label class="small">Status</label>
                <select class="form-select" id="edtStatus" name="id_status">
                  <?php foreach ($data_status_absen as $stat) : ?>
                    <option value="<?= $stat['id_status_absen']; ?>"><?= $stat['status_absen']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md col-sm-12 mb-2">
              <div class="form-group">
                <label class="small">Keterangan</label>
                <input type="text" class="form-control" id="edtKeterangan" name="keterangan" placeholder="Tambah keterangan">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success waves-effect text-start">Simpan</button>
          <button type="button" class="btn btn-secondary waves-effect text-start" data-bs-dismiss="modal">Tutup</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script src="../../assets/js/page-absensi.js"></script>
<?= $this->endSection(); ?>