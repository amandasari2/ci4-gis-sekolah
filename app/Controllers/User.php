<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser;

class User extends BaseController
{
    public function __construct()
    {
        $this->ModelUser = new ModelUser;
    }
    public function index()
    {
        $data = [
            'judul' => 'User',
            'menu' => 'user',
            'page' => 'user/v_index',
            'user' => $this->ModelUser->AllData(),
        ];
        return view('v_template_back_end', $data);
    }

    public function Input()
    {
        $data = [
            'judul' => 'Input User',
            'menu' => 'user',
            'page' => 'user/v_input',
        ];
        return view('v_template_back_end', $data);
    }

    public function InsertData()
    {
        if ($this->validate([
            'nama_user' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
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
            'foto' => [
                'label' => 'Foto User',
                'rules' => 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => '{field} Wajib Di Isi!!',
                    'max_size' => 'Ukuran {field} Terlalu Besar!',
                    'mime_in' => 'Format {field} Harus Berupa JPG, JPEG, PNG!'
                ]
            ],

        ])) {
            $foto_user = $this->request->getFile('foto');
            $nama_file_foto = $foto_user->getRandomName();
            // Jika Validasi Berhasil
            $data = [
                'nama_user' => $this->request->getPost('nama_user'),
                'email' => $this->request->getPost('email'),
                'password' => sha1($this->request->getPost('password') . $this->request->getPost('email')),
                'foto' => $nama_file_foto,
            ];
            $foto_user->move('foto', $nama_file_foto);
            //Mengirim Data Ke Function Insert Data Di Model User
            $this->ModelUser->InsertData($data);
            //Notifikasi Data Berhasil Disimpan
            session()->setFlashdata('insert', 'Data User Berhasil Di Tambahkan!!');
            return redirect()->to('User');
        } else {
            //Jika Tidak Lolos Validasi
            return redirect()->to(base_url('User/Input'))->withInput();
        }
    }

    public function EditUser($id_user)
    {
        $data = [
            'judul' => 'Edit User',
            'menu' => 'user',
            'page' => 'user/v_edituser',
            'user' => $this->ModelUser->DetailData($id_user),
        ];
        return view('v_template_back_end', $data);
    }

    public function UpdateData($id_user)
    {
        if ($this->validate([
            'nama_user' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
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
            'foto' => [
                'label' => 'Foto User',
                'rules' => 'max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran {field} Terlalu Besar!',
                    'mime_in' => 'Format {field} Harus Berupa JPG, JPEG, PNG!'
                ]
            ],

        ])) {
            $foto_user = $this->request->getFile('foto');

            if ($foto_user->getError() == 4) {
                $data = [
                    'id_user' => $id_user,
                    'nama_user' => $this->request->getPost('nama_user'),
                    'email' => $this->request->getPost('email'),
                    'password' => sha1($this->request->getPost('password') . $this->request->getPost('email')),
                ];
                $this->ModelUser->UpdateData($data);
            } else {
                // Menghapus Foto user Yang Lama
                $user = $this->ModelUser->DetailData($id_user);
                if ($user['foto'] != "") {
                    unlink('foto/' . $user['foto']);
                }
                // Merandom File Foto user
                $nama_file_foto = $foto_user->getRandomName();
                $data = [
                    'id_user' => $id_user,
                    'nama_user' => $this->request->getPost('nama_user'),
                    'email' => $this->request->getPost('email'),
                    'password' => sha1($this->request->getPost('password') . $this->request->getPost('email')),
                    'foto' => $nama_file_foto,
                ];
                $this->ModelUser->UpdateData($data);
                $foto_user->move('foto', $nama_file_foto);
            }
            //Notifikasi Data Berhasil Disimpan
            session()->setFlashdata('update', 'Data User Berhasil Di Update!!');
            return redirect()->to('User');
        } else {
            //Jika Tidak Lolos Validasi
            return redirect()->to(base_url('User/EditUser'))->withInput();
        }
    }

    public function Delete($id_user)
    {
        // Menghapus Foto
        $user = $this->ModelUser->DetailData($id_user);
        if ($user['foto'] <> "") {
            unlink('foto/' . $user['foto']);
        }

        $data = [
            'id_user' => $id_user,
        ];
        $this->ModelUser->DeleteData($data);
        //Notifikasi Data Berhasil Disimpan
        session()->setFlashdata('delete', 'Data User Berhasil Di Delete!!');
        return redirect()->to('User');
    }
}
