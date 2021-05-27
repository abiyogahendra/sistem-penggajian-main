<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusAbsensiModel extends Model
{
  protected $table      = 'status_absensi';
  protected $primaryKey = 'id_status_absen';
  protected $allowedFields = ['status_absen'];
  protected $useTimestamps = true;
}
