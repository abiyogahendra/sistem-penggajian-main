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
      <div class="col-auto mb-2" style="text-align: right;">
        <form action="/laporan" method="GET">
          <?= csrf_field(); ?>
          <div class="input-group">
            <input type="month" class="form-control" name="filter_bulan" value="<?= empty($keyword_bulan) ? date("Y-m") : $keyword_bulan; ?>">
            <button class="btn btn-light-secondary text-secondary" type="submit"><i data-feather="search" class="feather-sm fill-white m-0"></i></button>
          </div>
        </form>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table display v-middle no-wrap" id="tabel-laporan-gaji" style="width: 100% !important;">
        <thead class="table-light">
          <tr>
            <th style="width: 32px !important;">#</th>
            <th>Nama</th>
            <th>Bulan</th>
            <th>Gaji Pokok (Rp)</th>
            <th>Hadir (Hari)</th>
            <th>Potongan (Rp)</th>
            <th>Gaji Bersih (Rp)</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;
          foreach ($data_laporan_gaji as $row) : ?>
            <tr>
              <td><?= $i++; ?></td>
              <td>
                <p class="font-weight-medium"><?= $row['nama']; ?></p>
              </td>
              <td><?= $row['bulan'] . '-' . $row['tahun']; ?></td>
              <td>Rp <?= number_format($row['salary'], 2, ',', '.'); ?></td>
              <td><?= $row['hadir']; ?></td>
              <td>Rp <?= number_format($row['potongan'], 2, ',', '.'); ?></td>
              <td>Rp <?= number_format($row['gaji_bersih'], 2, ',', '.'); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  </div>


</div>
<?= $this->endSection(); ?>

<?= $this->section('contentScript'); ?>
<script src="../../assets/js/jquery.dataTables.min.js"></script>
<script src="../../assets/js/dataTables.buttons.min.js"></script>
<script src="../../assets/js/buttons.flash.min.js"></script>
<script src="../../assets/js/jszip.min.js"></script>
<script src="../../assets/js/pdfmake.min.js"></script>
<script src="../../assets/js/vfs_fonts.js"></script>
<script src="../../assets/js/buttons.html5.min.js"></script>
<script src="../../assets/js/buttons.print.min.js"></script>
<script src="../../assets/js/datatable-advanced.init.js"></script>
<?= $this->endSection(); ?>