<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAuth;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->ModelAuth = new ModelAuth;
    }

    public function Login()
    {
        $data = [
            'judul' => 'Login'
        ];
        return view('v_login', $data);
    }

    public function CekLogin()
    {
        if ($this->validate([
            'email' => [
                'label' => 'Email',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],

        ])) {
            // Jika Login
            $email = $this->request->getPost('email');
            $password = sha1($this->request->getPost('password') . $this->request->getPost('email'));
            $CekLogin      = $this->ModelAuth->Login($email, $password);
            if ($CekLogin) {
                //Jika Datanya Cocok
                session()->set('log', true);
                session()->set('nama_user', $CekLogin['nama_user']);
                session()->set('foto', $CekLogin['foto']);
                return redirect()->to(base_url('Admin'));
            } else {
                session()->setFlashdata('pesan', 'Email atau Password Anda Salah!');
                return redirect()->to(base_url('Auth/Login'));
            }
        } else {
            //Jika Tidak Lolos Validasi
            return redirect()->to(base_url('Auth/Login'))->withInput();
        }
    }

    public function Logout()
    {
        session()->remove('log');
        session()->remove('nama_user');
        session()->remove('foto');

        session()->setFlashdata('pesan', 'Anda Berhasil Log Out!');
        return redirect()->to(base_url('Auth/Login'));
    }
}
