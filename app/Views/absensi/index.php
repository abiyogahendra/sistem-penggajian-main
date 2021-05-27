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
      <div class="col-md-6 mb-2">
        <button class="justify-content-center btn btn-primary px-3" type="button" data-bs-toggle="modal" data-bs-target="#modalTambahAbsen">
          <i data-feather="plus-square" class="feather-sm me-2"></i>
          <span class="align-middle">Tambah Presensi</span>
        </button>
      </div>

      <div class="col-auto ms-md-auto mb-2" style="text-align: right;">
        <form action="/absensi" method="GET">
          <?= csrf_field(); ?>
          <div class="input-group">
            <input type="date" class="form-control" name="ftgl" placeholder="dd/mm/yyyy" value="<?= empty($tanggal) ? date("Y-m-d") : $tanggal; ?>">
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
          <th style="width: 32px !important;">#</th>
          <th>Nama</th>
          <th>Check In</th>
          <th>Status</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;
        foreach ($data_absensi as $absen) : ?>
          <tr>
            <td>
              <?= $i++; ?>
            </td>
            <td>
              <a class="font-weight-medium" data-bs-toggle="tooltip" href="/absensi/detail?key=<?= $absen['id_karyawan']; ?>" style="text-decoration: none;"><?= $absen['nama']; ?></a>
            </td>
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
<div class="modal fade" id="modalTambahAbsen" tabindex="-1" aria-labelledby="bs-example-modal-lg" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header d-flex align-items-center">
        <h4 class="modal-title" id="myLargeModalLabel">Form Tambah Presensi</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pt-0">
        <div class="row mb-2">
          <div class="col-auto">
            <div class="form-group">
              <label class="small">Tanggal</label>
              <input class="form-control" id="ipt" name="tanggal" type="date" placeholder="dd/mm/yyyy" value="<?= date('Y-m-d'); ?>">
            </div>
          </div>
        </div>

        <div class="table-responsive">
          <table id="tabelTambahPresensi" class="table v-middle no-wrap">
            <thead>
              <tr>
                <th><input type="checkbox" class="form-check-input" name="checkedAll" id="checkedAll" checked></th>
                <th>Nama</th>
                <th>Check In</th>
                <th>Status</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($data_karyawan as $row) : ?>
                <tr>
                  <td><input type="checkbox" class="form-check-input" name="key[]" id="rowCheck_<?= $i; ?>" value="<?= $row['id']; ?>" checked></td>
                  <td><?= $row['nama']; ?></td>
                  <td>
                    <div class="form-group">
                      <input class="form-control" type="time" id="jamMasuk_<?= $i; ?>" name="jam_masuk[]" value="08:00">
                    </div>
                  </td>
                  <td>
                    <select class="form-select" id="idStatus_<?= $i; ?>" name="id_status[]">
                      <?php foreach ($data_status_absen as $stat) : ?>
                        <option value="<?= $stat['id_status_absen']; ?>"><?= $stat['status_absen']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </td>
                  <td>
                    <div class="form-group">
                      <input class="form-control" id="keterangan_<?= $i; ?>" name="keterangan[]" type="text" placeholder="Tambah keterangan">
                    </div>
                  </td>
                </tr>
              <?php $i++;
              endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success waves-effect text-start btn-sv-abs">Tambah</button>
        <button type="button" class="btn btn-secondary waves-effect text-start" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script src="../../assets/js/page-absensi.js"></script>
<?= $this->endSection(); ?>