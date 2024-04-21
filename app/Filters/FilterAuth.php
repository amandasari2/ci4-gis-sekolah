<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FilterAuth implements FilterInterface
{
        public function before(RequestInterface $request, $arguments = null)
        {
                if (session()->get('log') != true) {
                        session()->setFlashdata('pesan', 'Anda Belum Login');
                        return redirect()->to(base_url('Auth/Login'));
                }
        }

        public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
        {
                if (session()->get('log') != true) {
                        return redirect()->to(base_url('Admin'));
                }
        }
}
