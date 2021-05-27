<?php

namespace App\Models;

use CodeIgniter\Model;

class GajiModel extends Model
{
  protected $table      = 'gaji';
  protected $primaryKey = 'id';
  protected $allowedFields = ['id_karyawan', 'bulan', 'tahun', 'salary', 'hadir', 'potongan', 'gaji_bersih'];
  protected $useTimestamps = true;
}
