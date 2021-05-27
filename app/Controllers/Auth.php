<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
  protected $userModel;

  public function __construct()
  {
    $this->userModel = new UserModel();
  }

  public function index()
  {
    // Cek status Login
    if (session()->has('is_logged_in')) {
      return redirect()->back();
    }

    $data = [
      'title' => 'Login - SIPAKAR',
      'validation' => \Config\Services::validation(),
    ];

    return view('auth/login', $data);
  }

  public function login()
  {
    // Validasi input
    if (!$this->validate([
      'username' => [
        'label' => 'Username',
        'rules' => 'required|min_length[6]',
        'errors' => [
          'required' => '{field} tidak boleh kosong',
          'min_length' => '{field} minimal 6 karakter',
        ]
      ],
      'password' => [
        'label' => 'Password',
        'rules' => 'required|min_length[6]',
        'errors' => [
          'required' => '{field} tidak boleh kosong',
          'min_length' => '{field} minimal 6 karakter'
        ]
      ],
    ])) {
      return redirect()->back()->withInput();
    }

    // Data dari form
    $username = htmlspecialchars($this->request->getVar('username'));
    $password = htmlspecialchars($this->request->getVar('password'));

    // Cari user berdasarkan username
    $result = $this->userModel
      ->select('users.*, karyawan.nama')
      ->join('karyawan', 'karyawan.id = users.id_karyawan', 'inner')
      ->where("users.username", $username)->find();

    // Cek user ada atau tidak
    if (count($result) == 1) {
      $user = $result[0];

      // Cek password
      if (password_verify($password, $user['password'])) {
        $ses_data = [
          'is_logged_in' => true,
          'ses_username' => $user['username'],
          'ses_nama' => $user['nama'],
          'ses_userRole' => $user['is_admin'],
        ];
        //Simpan ke Session
        session()->set($ses_data);

        return redirect()->to('/dashboard');
      } else {
        session()->setFlashdata([
          'flashStatus' => 'failed',
          'flashMessage' => 'Username dan password tidak cocok'
        ]);

        return redirect()->back();
      }
    } else {
      session()->setFlashdata([
        'flashStatus' => 'failed',
        'flashMessage' => 'Akun tidak ditemukan'
      ]);

      return redirect()->back();
    }
  }

  public function update()
  {
    $oldusername = htmlspecialchars($this->request->getVar('keyname'));
    $username = htmlspecialchars($this->request->getVar('username'));

    if (hash_equals($oldusername, $username)) {
      $rules = 'required|min_length[6]|max_length[64]|regex_match[/(^[A-Za-z0-9._]+$)/]';
    } else {
      $rules = 'required|is_unique[users.username]|min_length[6]|max_length[64]|regex_match[/(^[A-Za-z0-9._]+$)/]';
    }

    // Validasi input
    if (!$this->validate([
      'username' => [
        'label'  => 'Username',
        'rules'  => $rules,
        'errors' => [
          'required'    => '{field} tidak boleh kosong',
          'is_unique'   => '{field} sudah digunakan',
          'max_length'  => '{field} terlalu panjang',
          'min_length'  => '{field} minimal 6 karakter',
          'regex_match' => '{field} kombinasi karakter, angka, titik (.), atau underscore (_)'
        ]
      ],
      'password' => [
        'label'  => 'Password',
        'rules'  => 'required|min_length[6]|max_length[64]',
        'errors' => [
          'required'   => '{field} tidak boleh kosong',
          'min_length' => '{field} minimal 6 karakter',
          'max_length' => '{field} terlalu panjang',
        ]
      ]
    ])) {
      return redirect()->back()->withInput();
    }

    $data = [
      'username' => $username,
      'password' => password_hash(htmlspecialchars($this->request->getVar('password')), PASSWORD_DEFAULT)
    ];

    if ($this->userModel->where('username', $oldusername)->set($data)->update()) {
      session()->setFlashdata([
        'flashStatus' => 'success',
        'flashMessage' => 'Akun berhasil diperbarui',
      ]);

      $ses_data = [
        'ses_username' => $username,
      ];
      //Simpan ke Session
      session()->set($ses_data);

      return redirect()->back();
    } else {
      // Gagal memperbarui data karyawan
      session()->setFlashdata([
        'flashStatus' => 'failed',
        'flashMessage' => 'Gagal memperbarui akun'
      ]);

      return redirect()->back();
    }
  }

  public function logout()
  {
    // Cek session
    if (session()->has('is_logged_in')) {
      // Hapus data user di session
      session()->remove([
        'is_logged_in',
        'ses_username',
        'ses_nama',
        'ses_userRole'
      ]);

      session()->setFlashdata([
        'flashStatus' => 'success',
        'flashMessage' => 'Logout berhasil'
      ]);

      return redirect()->to('/login');
    } else {
      session()->setFlashdata([
        'flashStatus' => 'failed',
        'flashMessage' => 'Anda belum login'
      ]);
      return redirect()->to('/login');
    }
  }
}
