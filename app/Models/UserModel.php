<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table      = 'users';
  protected $primaryKey = 'id';
  protected $allowedFields = ['id_karyawan', 'username', 'password', 'is_admin'];
  protected $useTimestamps = true;
}
