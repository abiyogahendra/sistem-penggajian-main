<?php

namespace App\Controllers;

use App\Models\AbsensiModel;
use App\Models\GajiModel;
use App\Models\KaryawanModel;

class Gaji extends BaseController
{
  protected $karyawanModel;
  protected $absensiModel;
  protected $gajiModel;

  public function __construct()
  {
    $this->karyawanModel = new KaryawanModel();
    $this->absensiModel = new AbsensiModel();
    $this->gajiModel = new GajiModel();
  }

  public function index()
  {
    // Cek filter bulan
    $bulan = date("m");
    $tahun = date("Y");
    $keyword = $tahun . '-' . $bulan;

    if (!empty($this->request->getVar('filter_bulan'))) {
      $fbulan = explode('-', $this->request->getVar('filter_bulan'));
      $tahun = $fbulan[0];
      $bulan = $fbulan[1];
      $keyword = $tahun . '-' . $bulan;
    }

    $absensi = $this->karyawanModel
      ->select('
        karyawan.id AS id_karyawan,
        karyawan.nama,
        karyawan.salary,
        SUM(IF(absensi.id_status = 1 OR absensi.id_status = 2, 1, 0)) AS hadir,
        SUM(ROUND(TIME_TO_SEC(TIMEDIFF(absensi.jam_masuk, "08:00:00"))/60, 0)) AS menit_telat
      ')
      ->join('absensi', 'absensi.id_karyawan = karyawan.id', 'inner')
      ->join('users', 'users.id_karyawan = karyawan.id', 'inner')
      ->where([
        'MONTH(absensi.tanggal)' => $bulan,
        'YEAR(absensi.tanggal)' => $tahun,
        'users.is_admin' => 0
      ])
      ->groupBy('absensi.id_karyawan')
      ->findAll();

      $karyawan = $this->karyawanModel
      ->select('karyawan.id, karyawan.nama')
      ->join('users', 'users.id_karyawan = karyawan.id', 'inner')
      ->where('users.is_admin', 0)
      ->orderBy('nama', 'ASC')
      ->findAll();

    $data_laporan_gaji = [];
    for ($i = 0; $i < count($karyawan); $i++) {
      $data_laporan_gaji[$i]['id_karyawan'] = $karyawan[$i]['id'];
      $data_laporan_gaji[$i]['nama'] = $karyawan[$i]['nama'];
      $data_laporan_gaji[$i]['bulan'] = $bulan;
      $data_laporan_gaji[$i]['tahun'] = $tahun;

      $salary = 0;
      $hadir = 0;
      $menit_telat = 0;
      $potongan = 0;
      $gaji_bersih = 0;

      foreach ($absensi as $row) {
        if ($karyawan[$i]['id'] == $row['id_karyawan']) {
          $salary = $row['salary'];
          $hadir =  $row['hadir'];
          $menit_telat =  $row['menit_telat'];

          if ($menit_telat >= 0 and $menit_telat <= 15) $potongan = 15000;
          elseif ($menit_telat > 15 and $menit_telat <= 30) $potongan = 30000;
          elseif ($menit_telat > 30) $potongan = 50000;

          $gaji_bersih = $salary - $potongan;
        }
      }

      $data_laporan_gaji[$i]['salary'] = $salary;
      $data_laporan_gaji[$i]['hadir'] = $hadir;
      $data_laporan_gaji[$i]['menit_telat'] = $menit_telat;
      $data_laporan_gaji[$i]['potongan'] = $potongan;
      $data_laporan_gaji[$i]['gaji_bersih'] = $gaji_bersih;
    }

    $data_simpan = [];
    $i = 0;
    foreach ($data_laporan_gaji as $gaji) {
      $data_simpan[$i]['id_karyawan'] = $gaji['id_karyawan'];
      $data_simpan[$i]['bulan'] = $gaji['bulan'];
      $data_simpan[$i]['tahun'] = $gaji['tahun'];
      $data_simpan[$i]['salary'] = $gaji['salary'];
      $data_simpan[$i]['hadir'] = $gaji['hadir'];
      $data_simpan[$i]['potongan'] = $gaji['potongan'];
      $data_simpan[$i]['gaji_bersih'] = $gaji['gaji_bersih'];
      $i++;
    }

    $this->gajiModel
      ->where([
        'bulan' => $bulan,
        'tahun' => $tahun,
      ])
      ->delete();

    if(!empty($data_simpan)) {
      if ($this->gajiModel->insertBatch($data_simpan));
      else {
        session()->setFlashdata([
          'flashStatus' => 'failed',
          'flashMessage' => 'Laporan gaji bulan yang dipilih gagal dibuat'
        ]);
      }
    }

    $data = [
      'title' => 'Laporan Gaji - SIPAKAR',
      'keyword_bulan' => $keyword,
      'karyawan' => $karyawan,
      'data_laporan_gaji' => $data_laporan_gaji
    ];

    // dd($data);

    return view('gaji/index', $data);
  }
}
