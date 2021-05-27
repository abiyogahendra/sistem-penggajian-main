<?php

namespace App\Controllers;

use App\Models\AbsensiModel;
use App\Models\KaryawanModel;
use App\Models\StatusAbsensiModel;

class Absensi extends BaseController
{

  protected $karyawanModel;
  protected $absensiModel;
  protected $statusAbsenModel;

  public function __construct()
  {
    $this->karyawanModel = new KaryawanModel();
    $this->absensiModel = new AbsensiModel();
    $this->statusAbsenModel = new StatusAbsensiModel();
  }

  public function index()
  {
    $tanggal = htmlspecialchars($this->request->getVar('ftgl'));

    if (empty($tanggal)) $tanggal = date("Y-m-d");

    // Ambil data absensi
    $absensi = $this->absensiModel
      ->select('
        absensi.*,
        karyawan.nama,
        status_absensi.status_absen
      ')
      ->join('karyawan', 'karyawan.id = absensi.id_karyawan', 'inner')
      ->join('status_absensi', 'status_absensi.id_status_absen = absensi.id_status', 'inner')
      ->join('users', 'users.id_karyawan = karyawan.id', 'inner')
      ->where([
        'absensi.tanggal' => $tanggal,
        'users.is_admin' => 0
      ])
      ->findAll();

    $data_karyawan = $this->karyawanModel
      ->select('karyawan.id, karyawan.nama')
      ->join('users', 'users.id_karyawan = karyawan.id', 'inner')
      ->where('users.is_admin', 0)
      ->orderBy('nama', 'ASC')
      ->findAll();

    $data_absensi = [];

    // Set data absensi
    $i = 0;
    foreach ($data_karyawan as $karyawan) {
      $data_absensi[$i]['id_karyawan'] = $karyawan['id'];
      $data_absensi[$i]['nama'] = $karyawan['nama'];
      $data_absensi[$i]['tanggal'] = $tanggal;

      $data_jam_masuk = 'N/A';
      $data_id_status = 'N/A';
      $data_keterangan = 'Data absensi belum ada';

      foreach ($absensi as $abs) {
        if ($karyawan['id'] == $abs['id_karyawan']) {
          $data_jam_masuk = $abs['jam_masuk'];
          $data_id_status = $abs['id_status'];
          $data_keterangan = $abs['keterangan'];
          break;
        }
      }

      $data_absensi[$i]['jam_masuk'] = $data_jam_masuk;
      $data_absensi[$i]['id_status'] = $data_id_status;
      $data_absensi[$i]['keterangan'] = $data_keterangan;

      $i++;
    }

    $data_status_absen = $this->statusAbsenModel
      ->select('id_status_absen, status_absen')
      ->findAll();

    $data = [
      'title'    => 'Absensi Karyawan - SIPAKAR',
      'tanggal'  => $tanggal,
      'data_absensi' => $data_absensi,
      'data_karyawan' => $data_karyawan,
      'data_status_absen' => $data_status_absen,
      'validation' => \Config\Services::validation(),
    ];

    // dd($data);

    return view('absensi/index', $data);
  }

  public function insert()
  {
    $tanggal = $this->request->getVar('tanggal');
    $id_karyawan = $this->request->getVar('id_karyawan');
    $jam_masuk = $this->request->getVar('jam_masuk');
    $id_status = $this->request->getVar('id_status');
    $keterangan = $this->request->getVar('keterangan');

    $countData = count($id_karyawan);

    // TODO: Cek apakah presensi karyawan hari ini sudah ada
    for ($i = 0; $i < count($id_karyawan); $i++) {
      $foundNama[$i] = $this->absensiModel
        ->select(
          'absensi.id_absen,
        karyawan.nama'
        )
        ->join('karyawan', 'karyawan.id = absensi.id_karyawan', 'inner')
        ->where([
          'absensi.id_karyawan' => $id_karyawan[$i],
          'absensi.tanggal' => $tanggal[$i]
        ])->first();
      if (!is_null($foundNama)) $dataNama[$i] = $foundNama[$i];
    }

    // TODO: Nama karyawan yang sudah ada presensinya
    $namaFound = "";
    if (!is_null($dataNama)) {
      foreach ($dataNama as $nama) {
        if (!is_null($nama)) {
          empty($namaFound) ? $namaFound = $namaFound . $nama['nama'] : $namaFound = $namaFound . ", " . $nama['nama'];
        }
      }
    }

    if (empty($namaFound)) $ketemu = false;
    else $ketemu = true;

    // TODO: Jika data presensi sudah ada, kembali ke laman sebelumbya
    if ($ketemu == true) {
      $pesan = "Absensi dari " . $namaFound . " tanggal " . $tanggal[0] . " sudah ditambahkan";
      session()->setFlashdata([
        'flashStatus' => 'failed',
        'flashMessage' => $pesan,
      ]);
    } else {

      // TODO: ambil data
      for ($i = 0; $i < $countData; $i++) {
        if (empty($keterangan[$i])) $keterangan[$i] = "-";

        $data[$i]['tanggal'] = $tanggal[$i];
        $data[$i]['id_karyawan'] = $id_karyawan[$i];
        $data[$i]['jam_masuk'] = $jam_masuk[$i];
        $data[$i]['id_status'] = $id_status[$i];
        $data[$i]['keterangan'] = $keterangan[$i];
      }

      // TODO: Simpan data secara Batch -> keseluruhan
      if ($this->absensiModel->insertBatch($data)) {
        session()->setFlashdata([
          'flashStatus' => 'success',
          'flashMessage' => 'Data absensi berhasil ditambahkan'
        ]);
      } else {
        session()->setFlashdata([
          'flashStatus' => 'failed',
          'flashMessage' => 'Gagal menambahkan data absensi'
        ]);
      }
    }
  }

  public function submit_by_karyawan()
  {
    $tanggal = htmlspecialchars($this->request->getVar('tanggal'));
    $id_karyawan = htmlspecialchars($this->request->getVar('key'));
    $jam_masuk = htmlspecialchars($this->request->getVar('jam_masuk'));
    $id_status = htmlspecialchars($this->request->getVar('status'));
    $keterangan = htmlspecialchars($this->request->getVar('keterangan'));

    if (empty($keterangan)) $keterangan = '-';

    $data = [
      'tanggal' => $tanggal,
      'id_karyawan' => $id_karyawan,
      'jam_masuk' => $jam_masuk,
      'id_status' => $id_status,
      'keterangan' => $keterangan,
    ];

    // dd($data);

    if ($this->absensiModel->save($data)) {
      session()->setFlashdata([
        'flashStatus' => 'success',
        'flashMessage' => 'Berhasil submit absensi'
      ]);
    } else {
      session()->setFlashdata([
        'flashStatus' => 'failed',
        'flashMessage' => 'Gagal menambah data absensi'
      ]);
    }

    return redirect()->to('/dashboard');
  }

  public function detail()
  {
    $id_karyawan = htmlspecialchars($this->request->getVar('key'));

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

    // Ambil data absensi
    $data_absensi = $this->absensiModel
      ->select('
        karyawan.nama,
        absensi.*,
        status_absensi.status_absen
      ')
      ->join('karyawan', 'karyawan.id = absensi.id_karyawan', 'inner')
      ->join('status_absensi', 'status_absensi.id_status_absen = absensi.id_status', 'inner')
      ->where([
        'MONTH(absensi.tanggal)' => $bulan,
        'YEAR(absensi.tanggal)' => $tahun,
        'absensi.id_karyawan' => $id_karyawan,
      ])
      ->orderBy('absensi.tanggal', 'ASC')
      ->findAll();

    $data_status_absen = $this->statusAbsenModel
      ->select('id_status_absen, status_absen')
      ->findAll();

    $data = [
      'title' => 'Detail Absensi',
      'key' => $id_karyawan,
      'keyword_bulan' => $keyword,
      'data_absensi' => $data_absensi,
      'data_status_absen' => $data_status_absen,
    ];

    // dd($data);
    return view('absensi/detail', $data);
  }

  public function update()
  {
    $id_absen = htmlspecialchars($this->request->getVar('id'));
    $id_karyawan = htmlspecialchars($this->request->getVar('key'));
    $tanggal = htmlspecialchars($this->request->getVar('tanggal'));
    $jam_masuk = htmlspecialchars($this->request->getVar('jam_masuk'));
    $id_status = htmlspecialchars($this->request->getVar('id_status'));
    $keterangan = htmlspecialchars($this->request->getVar('keterangan'));

    $data = [
      'id_absen' => $id_absen,
      'tanggal' => $tanggal,
      'id_karyawan' => $id_karyawan,
      'jam_masuk' => $jam_masuk,
      'id_status' => $id_status,
      'keterangan' => $keterangan,
    ];

    // dd($data);

    if ($this->absensiModel->save($data)) {
      session()->setFlashdata([
        'flashStatus' => 'success',
        'flashMessage' => 'Data absensi berhasil diubah'
      ]);
    } else {
      session()->setFlashdata([
        'flashStatus' => 'failed',
        'flashMessage' => 'Gagal mengubah data absensi'
      ]);
    }

    return redirect()->back();
  }

  public function delete()
  {
    $id_karyawan = htmlspecialchars($this->request->getVar('key'));
    $tanggal = htmlspecialchars($this->request->getVar('tanggal'));

    $data_absensi = $this->absensiModel
      ->where([
        'id_karyawan' => $id_karyawan,
        'tanggal' => $tanggal,
      ])
      ->first();

    if (empty($data_absensi)) {
      $response = [
        'statusCode' => 201,
        'message' => 'Data absensi tidak ditemukan'
      ];
    } else {
      // TODO: Hapus berdasarkan id_karyawan dan tanggal
      if ($this->absensiModel->where(['id_karyawan' => $id_karyawan, 'tanggal' => $tanggal])->delete()) {
        $response = [
          'statusCode' => 200,
          'message' => 'Data karyawan berhasil dihapus',
        ];
      } else {
        $response = [
          'statusCode' => 201,
          'message' => 'Gagal menghapus data absensi'
        ];
      }
    }

    echo json_encode($response);
  }
}
