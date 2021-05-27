<?= $this->extend('templates/layout'); ?>

<?= $this->section('contentHead'); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card text-center">
  <div class="card-header bg-light">
    Submit Absensi
  </div>
  <div class="card-body">
    <h5 class="card-title"><?= session()->get('ses_nama'); ?></h5>
    <p class="card-text"><?= date("d-m-Y"); ?></p>
    <div class="row">
      <form action="/submit_absensi" class="col-md-4 m-auto" method="post">
        <?= csrf_field(); ?>
        <input type="hidden" name="tanggal" value="<?= date("Y-m-d") ?>">
        <input type="hidden" name="key" value="<?= $karyawan['id'] ?>">
        <input type="hidden" name="jam_masuk" value="<?= date("G:i") ?>">
        <input type="hidden" name="status" value="<?= date("i") < 16 ? '1' : '2'; ?>">
        <input type="text" name="keterangan" class="form-control mb-3" placeholder="Tambah keterangan">
        <button class="btn btn-primary" type="submit">Submit</button>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('contentScript'); ?>
<?= $this->endSection(); ?>