<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\UserModel;

class Karyawan extends BaseController
{

  protected $userModel;
  protected $karyawanModel;

  public function __construct()
  {
    $this->userModel = new UserModel();
    $this->karyawanModel = new KaryawanModel();
  }

  public function index()
  {
    $keyword = htmlspecialchars($this->request->getVar('keyword'));

    if (empty($keyword)) {
      $karyawan = $this->karyawanModel
        ->select('karyawan.*, users.username, users.is_admin')
        ->join('users', 'users.id_karyawan = karyawan.id', 'inner')
        ->where('users.is_admin', 0)
        ->orderBy('karyawan.nama', 'ASC')
        ->findAll();
    } else {
      $karyawan = $this->karyawanModel
        ->select('karyawan.*, users.username, users.is_admin')
        ->join('users', 'users.id_karyawan = karyawan.id', 'inner')
        ->like('karyawan.nama', $keyword)
        ->orLike('karyawan.alamat', $keyword)
        ->orLike('karyawan.telepon', $keyword)
        ->orLike('karyawan.tanggal_masuk', $keyword)
        ->orLike('users.username', $keyword)
        ->orderBy('karyawan.nama', 'ASC')
        ->findAll();
    }

    $data = [
      'title'    => 'Data Karyawan - SIPAKAR',
      'karyawan' => $karyawan,
      'keyword'  => $keyword,
    ];
    // dd($data);
    return view('karyawan/index', $data);
  }

  public function tambah()
  {
    $data = [
      'title' => 'Tambah Karyawan - SIPAKAR',
      'validation' => \Config\Services::validation(),
    ];

    return view('karyawan/tambah', $data);
  }

  public function insert()
  {
    $nama = $this->request->getVar("namalengkap");
    $alamat = $this->request->getVar("alamat");
    $telepon = $this->request->getVar("telepon");
    $salary = $this->request->getVar("salary");
    $username = $this->request->getVar("username");
    $password = $this->request->getVar("password");
    $tanggal_masuk = $this->request->getVar("tanggal_masuk");

    // Validasi input
    if (!$this->validate([
      'namalengkap' => [
        'label'   => 'Nama',
        'rules'   => "required|regex_match[/(^[A-Z a-z'.]+$)/]|max_length[128]",
        'errors'  => [
          'required'    => '{field} tidak boleh kosong',
          'regex_match' => '{field} tidak valid',
          'max_length'  => '{field} terlalu panjang',
        ]
      ],
      'alamat' => [
        'label'   => 'Alamat',
        'rules'   => "required|max_length[255]",
        'errors'  => [
          'required'   => '{field} tidak boleh kosong',
          'max_length' => '{field} terlalu panjang',
        ]
      ],
      'telepon' => [
        'label'   => 'Telepon',
        'rules'   => "required|numeric|max_length[16]",
        'errors'  => [
          'required'   => '{field} tidak boleh kosong',
          'numeric'    => '{field} harus berisi angka 0-9',
          'max_length' => '{field} terlalu panjang',
        ]
      ],
      'salary' => [
        'label'   => 'Salary',
        'rules'   => "required|numeric",
        'errors'  => [
          'required'  => '{field} tidak boleh kosong',
          'numeric'  => '{field} harus berisi angka 0-9',
        ]
      ],
      'username' => [
        'label'  => 'Username',
        'rules'  => 'required|is_unique[users.username]|min_length[6]|max_length[64]|regex_match[/(^[A-Za-z0-9._]+$)/]',
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
      ],
      'tanggal_masuk' => [
        'label'   => 'Tanggal',
        'rules'   => "required",
        'errors'  => [
          'required'  => '{field} tidak boleh kosong',
        ]
      ]
    ])) {
      return redirect()->back()->withInput();
    }

    $data_karyawan = [
      'nama'          => $nama,
      'alamat'        => $alamat,
      'telepon'       => $telepon,
      'salary'        => $salary,
      'tanggal_masuk' => $tanggal_masuk,
    ];

    $pass_hash = password_hash($password, PASSWORD_DEFAULT);



    // Simpan data user
    if ($inserId = $this->karyawanModel->insert($data_karyawan)) {
      $data_user = [
        'id_karyawan' => $inserId,
        'username'  => $username,
        'password'  => $pass_hash,
        'is_admin'  => 0,
      ];

      if ($this->userModel->save($data_user)) {
        // Berhasil menambahkan data karyawan
        session()->setFlashdata([
          'flashStatus' => 'success',
          'flashMessage' => 'Berhasil menambahkan data karyawan',
        ]);

        return redirect()->to('/karyawan');
      } else {
        // Gagal manambahkan data karyawan
        session()->setFlashdata([
          'flashStatus' => 'failed',
          'flashMessage' => 'Gagal menambahkan data karyawan'
        ]);

        return redirect()->back()->withInput();
      }
    } else {
      // Gagal menyimpan akun
      session()->setFlashdata([
        'flashStatus' => 'failed',
        'flashMessage' => 'Gagal membuat akun baru'
      ]);

      return redirect()->back()->withInput();
    }
  }

  public function edit()
  {
    $key = htmlspecialchars($this->request->getVar('key'));

    if (empty($key)) {
      return redirect()->back();
    }

    $karyawan = $this->karyawanModel
      ->select('karyawan.*, users.username')
      ->join('users', 'users.id_karyawan = karyawan.id', 'join')
      ->where('users.username', $key)
      ->first();
    $user = $this->userModel->where('username', $key)->first();

    $data = [
      'title'      => 'Edit Data Karyawan - SIPAKAR',
      'validation' => \Config\Services::validation(),
      'karyawan'   => $karyawan,
      'user'       => $user,
    ];

    return view('karyawan/edit', $data);
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
      'namalengkap' => [
        'label'   => 'Nama',
        'rules'   => "required|regex_match[/(^[A-Z a-z'.]+$)/]|max_length[128]",
        'errors'  => [
          'required'    => '{field} tidak boleh kosong',
          'regex_match' => '{field} tidak valid',
          'max_length'  => '{field} terlalu panjang',
        ]
      ],
      'alamat' => [
        'label'   => 'Alamat',
        'rules'   => "required|max_length[255]",
        'errors'  => [
          'required'   => '{field} tidak boleh kosong',
          'max_length' => '{field} terlalu panjang',
        ]
      ],
      'telepon' => [
        'label'   => 'Telepon',
        'rules'   => "required|numeric|max_length[16]",
        'errors'  => [
          'required'   => '{field} tidak boleh kosong',
          'numeric'    => '{field} harus berisi angka 0-9',
          'max_length' => '{field} terlalu panjang',
        ]
      ],
      'salary' => [
        'label'   => 'Salary',
        'rules'   => "required|numeric",
        'errors'  => [
          'required'  => '{field} tidak boleh kosong',
          'numeric'  => '{field} harus berisi angka 0-9',
        ]
      ],
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
      ],
      'tanggal_masuk' => [
        'label'   => 'Tanggal',
        'rules'   => "required",
        'errors'  => [
          'required'  => '{field} tidak boleh kosong',
        ]
      ]
    ])) {
      return redirect()->back()->withInput();
    }

    $id = htmlspecialchars($this->request->getVar('key'));
    $nama = htmlspecialchars($this->request->getVar('namalengkap'));
    $alamat = htmlspecialchars($this->request->getVar('alamat'));
    $telepon = htmlspecialchars($this->request->getVar('telepon'));
    $salary = htmlspecialchars($this->request->getVar('salary'));
    $tanggal_masuk = htmlspecialchars($this->request->getVar('tanggal_masuk'));
    $password = htmlspecialchars($this->request->getVar('password'));

    $data = [
      'id'            => $id,
      'nama'          => $nama,
      'alamat'        => $alamat,
      'telepon'       => $telepon,
      'salary'        => $salary,
      'tanggal_masuk' => $tanggal_masuk,
    ];

    $pass_hash = password_hash($password, PASSWORD_DEFAULT);

    $data_user = [
      'username'  => $username,
      'password'  => $pass_hash,
    ];

    // Simpan data user
    if ($this->userModel->where('username', $oldusername)->set($data_user)->update()) {
      $data = [
        'id'            => $id,
        'nama'          => $nama,
        'alamat'        => $alamat,
        'telepon'       => $telepon,
        'salary'        => $salary,
        'tanggal_masuk' => $tanggal_masuk,
      ];

      if ($this->karyawanModel->save($data)) {
        // Berhasil memperbarui data karyawan
        session()->setFlashdata([
          'flashStatus' => 'success',
          'flashMessage' => 'Data berhasil diperbarui',
        ]);

        return redirect()->back();
      } else {
        // Gagal memperbarui data karyawan
        session()->setFlashdata([
          'flashStatus' => 'failed',
          'flashMessage' => 'Gagal memperbarui data'
        ]);

        return redirect()->back();
      }
    } else {
      // Gagal menyimpan akun
      session()->setFlashdata([
        'flashStatus' => 'failed',
        'flashMessage' => 'Gagal memperbarui data'
      ]);

      return redirect()->back();
    }
  }

  public function delete()
  {
    $id = htmlspecialchars($this->request->getVar('key'));

    // TODO: Cek karyawan ada atau tidak
    $karyawan = $this->karyawanModel->where('id', $id)->first();

    if (empty($karyawan)) {
      $response = [
        'statusCode' => 201,
        'message' => 'Data tidak ditemukan'
      ];
    } else {
      // TODO: Hapus berdasarkan $id
      if ($this->karyawanModel->where('id', $id)->delete()) {
        $pesan = 'Data karyawan berhasil dihapus';

        $response = [
          'statusCode' => 200,
          'message' => $pesan
        ];
      } else {
        $pesan = 'Gagal menghapus data karyawan';

        $response = [
          'statusCode' => 201,
          'message' => $pesan
        ];
      }
    }

    echo json_encode($response);
  }
}
