<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
  protected $table      = 'absensi';
  protected $primaryKey = 'id_absen';
  protected $allowedFields = ['tanggal', 'id_karyawan', 'jam_masuk', 'id_status', 'keterangan'];
  protected $useTimestamps = true;
}
