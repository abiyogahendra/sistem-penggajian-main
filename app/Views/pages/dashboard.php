<?= $this->extend('templates/layout'); ?>

<?= $this->section('contentHead'); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<?php if (session()->get('ses_userRole') == 1) { ?>
	<div class="row">
		<div class="col-md-6 col-lg-3">
			<a href="/karyawan">
				<div class="card pointer">
					<div class="card-body">
						<h5 class="card-title semi-black">Jumlah Karyawan</h5>
						<div class="d-flex align-items-center mb-2 mt-4">
							<h2 class="mb-0 display-5"><i class="icon-people text-info"></i></h2>
							<div class="ms-auto">
								<h2 class="mb-0 display-6 semi-black"><span class="fw-normal"><?= $jumlah_karyawan ?></span></h2>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-md-6 col-lg-3">
			<a href="/absensi">
				<div class="card pointer">
					<div class="card-body">
						<h5 class="card-title semi-black">Riwayat Hadir Karyawan</h5>
						<div class="d-flex align-items-center mb-2 mt-4">
							<h2 class="mb-0 display-5"><i class="icon-folder text-primary"></i></h2>
							<div class="ms-auto">
								<h2 class="mb-0 display-6 semi-black" ><span class="fw-normal"><?= $absensi_hari_ini ?></span></h2>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-md-6 col-lg-3">
			<a href="/laporan">
				<div class="card pointer">
					<div class="card-body">
						<h5 class="card-title semi-black">Laporan</h5>
						<div class="d-flex align-items-center mb-2 mt-4">
							<h2 class="mb-0 display-5"><i class="icon-folder-alt text-danger"></i></h2>
							<div class="ms-auto">
								<h2 class="mb-0 display-6 semi-black"><span class="fw-normal"></span></h2>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>		
	</div>
<?php } else { ?>
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

	<div class="row">
		<div class="col-md-4 col-lg-4">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Hadir</h5>
					<div class="d-flex align-items-center mb-2 mt-4">
						<h2 class="mb-0 display-5"><i class="icon-calender text-success"></i></h2>
						<div class="ms-auto">
							<h2 class="mb-0 display-6"><span class="fw-normal"><?= $absensi['hadir']; ?></span></h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-lg-4">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Telat</h5>
					<div class="d-flex align-items-center mb-2 mt-4">
						<h2 class="mb-0 display-5"><i class="icon-calender text-warning"></i></h2>
						<div class="ms-auto">
							<h2 class="mb-0 display-6"><span class="fw-normal"><?= $absensi['telat']; ?></span></h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-lg-4">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Tidak Hadir</h5>
					<div class="d-flex align-items-center mb-2 mt-4">
						<h2 class="mb-0 display-5"><i class="icon-calender text-danger"></i></h2>
						<div class="ms-auto">
							<h2 class="mb-0 display-6"><span class="fw-normal"><?= $absensi['absen']; ?></span></h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<?= $this->endSection(); ?>

<?= $this->section('contentScript'); ?>
<?= $this->endSection(); ?>