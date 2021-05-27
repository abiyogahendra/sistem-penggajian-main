<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
  protected $table      = 'karyawan';
  protected $primaryKey = 'id';
  protected $allowedFields = ['nama', 'alamat', 'telepon', 'salary', 'tanggal_masuk'];
  protected $useTimestamps = true;
}
