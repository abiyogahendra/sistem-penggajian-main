<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AksesFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    // Cek sesi User
    if (session()->get('ses_userRole') != 1) {
      return redirect()->to('/dashboard');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
