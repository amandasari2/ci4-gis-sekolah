<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelWilayah;
use App\Models\ModelSetting;
use PSpell\Config;

class Wilayah extends BaseController
{
    public function __construct()
    {
        $this->ModelWilayah = new ModelWilayah();
        $this->ModelSetting = new ModelSetting();
    }

    public function index()
    {
        $data = [
            'judul' => 'Wilayah',
            'menu' => 'wilayah',
            'page' => 'wilayah/v_index',
            'wilayah' => $this->ModelWilayah->AllData(),
            'web' => $this->ModelSetting->Dataweb(),
        ];
        return view('v_template_back_end', $data);
    }

    public function Input()
    {
        $data = [
            'judul' => 'Input Wilayah',
            'menu' => 'wilayah',
            'page' => 'wilayah/v_input',
        ];
        return view('v_template_back_end', $data);
    }

    public function InsertData()
    {
        if ($this->validate([
            'nama_wilayah' => [
                'label' => 'Nama Wilayah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'geojson' => [
                'label' => 'Data GeoJSON',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'warna' => [
                'label' => 'Warna',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],


        ])) {
            // Jika Validasi Berhasil
            $data = [
                'nama_wilayah' => $this->request->getPost('nama_wilayah'),
                'warna' => $this->request->getPost('warna'),
                'geojson' => $this->request->getPost('geojson'),
            ];
            $this->ModelWilayah->InsertData($data);
            //Notifikasi Data Berhasil Disimpan
            session()->setFlashdata('insert', 'Data Wilayah Berhasil Di Tambahkan!!');
            return redirect()->to('Wilayah');
        } else {
            //Jika Tidak Lolos Validasi
            return redirect()->to(base_url('Wilayah/Input'))->withInput();
        }
    }

    public function Edit($id_wilayah)
    {
        $data = [
            'judul' => 'Edit Wilayah',
            'menu' => 'wilayah',
            'page' => 'wilayah/v_edit',
            'wilayah' => $this->ModelWilayah->DetailData($id_wilayah),
        ];
        return view('v_template_back_end', $data);
    }

    public function UpdateData($id_wilayah)
    {
        if ($this->validate([
            'nama_wilayah' => [
                'label' => 'Nama Wilayah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'geojson' => [
                'label' => 'Data GeoJSON',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'warna' => [
                'label' => 'Warna',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],


        ])) {
            // Jika Validasi Berhasil
            $data = [
                'id_wilayah' => $id_wilayah,
                'nama_wilayah' => $this->request->getPost('nama_wilayah'),
                'warna' => $this->request->getPost('warna'),
                'geojson' => $this->request->getPost('geojson'),
            ];
            $this->ModelWilayah->UpdateData($data);
            //Notifikasi Data Berhasil Disimpan
            session()->setFlashdata('update', 'Data Wilayah Berhasil Di Update!!');
            return redirect()->to('Wilayah');
        } else {
            //Jika Tidak Lolos Validasi
            return redirect()->to(base_url('Wilayah/Edit/' . $id_wilayah))->withInput();
        }
    }

    public function Delete($id_wilayah)
    {
        $data = [
            'id_wilayah' => $id_wilayah,
        ];
        $this->ModelWilayah->DeleteData($data);
        //Notifikasi Data Berhasil Disimpan
        session()->setFlashdata('delete', 'Data Wilayah Berhasil Di Delete!!');
        return redirect()->to('Wilayah');
    }
}
