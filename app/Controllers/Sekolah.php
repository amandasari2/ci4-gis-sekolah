<?php

namespace App\Controllers;

use App\Controllers\BaseController;
// use App\Models\ModelWilayah;
use App\Models\ModelSetting;
use App\Models\ModelSekolah;
use App\Models\ModelJenjang;

class Sekolah extends BaseController
{
    public function __construct()
    {
        // $this->ModelWilayah = new ModelWilayah();
        $this->ModelSetting = new ModelSetting();
        $this->ModelSekolah = new ModelSekolah();
        $this->ModelJenjang = new ModelJenjang();
    }
    public function index()
    {
        $data = [
            'judul' => 'Sekolah',
            'menu' => 'sekolah',
            'page' => 'sekolah/v_index',
            'sekolah' => $this->ModelSekolah->AllData(),
        ];
        return view('v_template_back_end', $data);
    }

    public function Input()
    {
        $data = [
            'judul' => 'Input Sekolah',
            'menu' => 'sekolah',
            'page' => 'sekolah/v_input',
            'web' => $this->ModelSetting->Dataweb(),
            // 'provinsi' => $this->ModelSekolah->allProvinsi(),
            // 'wilayah' => $this->ModelWilayah->AllData(),
            'jenjang' => $this->ModelJenjang->AllData(),
        ];
        return view('v_template_back_end', $data);
    }

    public function InsertData()
    {
        if ($this->validate([
            'nama_sekolah' => [
                'label' => 'Nama Sekolah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'akreditasi' => [
                'label' => 'Akreditasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'status' => [
                'label' => 'Status',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'id_jenjang' => [
                'label' => 'Jenjang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'coordinat' => [
                'label' => 'Coordinat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'kepsek' => [
                'label' => 'Kepala Sekolah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'kurikulum' => [
                'label' => 'Kurikulum',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'npsn' => [
                'label' => 'NPSN',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'stts_pemilik' => [
                'label' => 'Status Kepemilikan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            // 'id_wilayah' => [
            //     'label' => 'Wilayah Administrasi',
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => '{field} Wajib Diisi!'
            //     ]
            // ],
            'foto' => [
                'label' => 'Foto Sekolah',
                'rules' => 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => '{field} Wajib Di Isi!!',
                    'max_size' => 'Ukuran {field} Terlalu Besar!',
                    'mime_in' => 'Format {field} Harus Berupa JPG, JPEG, PNG!'
                ]
            ],

        ])) {
            $foto_sekolah = $this->request->getFile('foto');
            $nama_file_foto = $foto_sekolah->getRandomName();
            // Jika Validasi Berhasil
            $data = [
                'nama_sekolah' => $this->request->getPost('nama_sekolah'),
                'akreditasi' => $this->request->getPost('akreditasi'),
                'status' => $this->request->getPost('status'),
                'coordinat' => $this->request->getPost('coordinat'),
                'id_jenjang' => $this->request->getPost('id_jenjang'),
                'kepsek' => $this->request->getPost('kepsek'),
                'kurikulum' => $this->request->getPost('kurikulum'),
                'npsn' => $this->request->getPost('npsn'),
                'stts_pemilik' => $this->request->getPost('stts_pemilik'),
                'alamat' => $this->request->getPost('alamat'),
                // 'id_wilayah' => $this->request->getPost('id_wilayah'),
                'foto' => $nama_file_foto,
            ];
            $foto_sekolah->move('foto', $nama_file_foto);
            //Mengirim Data Ke Function Insert Data Di Model Sekolah
            $this->ModelSekolah->InsertData($data);
            //Notifikasi Data Berhasil Disimpan
            session()->setFlashdata('insert', 'Data Sekolah Berhasil Di Tambahkan!!');
            return redirect()->to('Sekolah');
        } else {
            //Jika Tidak Lolos Validasi
            return redirect()->to(base_url('Sekolah/Input'))->withInput();
        }
    }

    public function EditSekolah($id_sekolah)
    {
        $data = [
            'judul' => 'Edit Sekolah',
            'menu' => 'sekolah',
            'page' => 'sekolah/v_editsekolah',
            'sekolah' => $this->ModelSekolah->DetailData($id_sekolah),
            'web' => $this->ModelSetting->Dataweb(),
            // 'provinsi' => $this->ModelSekolah->allProvinsi(),
            // 'wilayah' => $this->ModelWilayah->AllData(),
            'jenjang' => $this->ModelJenjang->AllData(),
        ];
        return view('v_template_back_end', $data);
    }

    public function UpdateData($id_sekolah)
    {
        if ($this->validate([
            'nama_sekolah' => [
                'label' => 'Nama Sekolah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'akreditasi' => [
                'label' => 'Akreditasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'status' => [
                'label' => 'Status',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'id_jenjang' => [
                'label' => 'Jenjang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'coordinat' => [
                'label' => 'Coordinat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'kepsek' => [
                'label' => 'Kepala Sekolah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'kurikulum' => [
                'label' => 'Kurikulum',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'npsn' => [
                'label' => 'NPSN',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'stts_pemilik' => [
                'label' => 'Status Kepemilikan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            // 'id_wilayah' => [
            //     'label' => 'Wilayah Administrasi',
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => '{field} Wajib Diisi!'
            //     ]
            // ],
            'foto' => [
                'label' => 'Foto Sekolah',
                'rules' => 'max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran {field} Terlalu Besar!',
                    'mime_in' => 'Format {field} Harus Berupa JPG, JPEG, PNG!'
                ]
            ],

        ])) {
            $foto_sekolah = $this->request->getFile('foto');

            if ($foto_sekolah->getError() == 4) {
                $data = [
                    'id_sekolah' => $id_sekolah,
                    'nama_sekolah' => $this->request->getPost('nama_sekolah'),
                    'akreditasi' => $this->request->getPost('akreditasi'),
                    'status' => $this->request->getPost('status'),
                    'coordinat' => $this->request->getPost('coordinat'),
                    'id_jenjang' => $this->request->getPost('id_jenjang'),
                    'kepsek' => $this->request->getPost('kepsek'),
                    'kurikulum' => $this->request->getPost('kurikulum'),
                    'npsn' => $this->request->getPost('npsn'),
                    'stts_pemilik' => $this->request->getPost('stts_pemilik'),
                    'alamat' => $this->request->getPost('alamat'),
                    // 'id_wilayah' => $this->request->getPost('id_wilayah'),
                ];
                $this->ModelSekolah->UpdateData($data);
            } else {
                // Menghapus Foto Sekolah Yang Lama
                $sekolah = $this->ModelSekolah->DetailData($id_sekolah);
                if ($sekolah['foto'] != "") {
                    unlink('foto/' . $sekolah['foto']);
                }
                // Merandom File Foto Sekolah
                $nama_file_foto = $foto_sekolah->getRandomName();
                $data = [
                    'id_sekolah' => $id_sekolah,
                    'nama_sekolah' => $this->request->getPost('nama_sekolah'),
                    'akreditasi' => $this->request->getPost('akreditasi'),
                    'status' => $this->request->getPost('status'),
                    'coordinat' => $this->request->getPost('coordinat'),
                    'id_jenjang' => $this->request->getPost('id_jenjang'),
                    'kepsek' => $this->request->getPost('kepsek'),
                    'kurikulum' => $this->request->getPost('kurikulum'),
                    'npsn' => $this->request->getPost('npsn'),
                    'stts_pemilik' => $this->request->getPost('stts_pemilik'),
                    'alamat' => $this->request->getPost('alamat'),
                    // 'id_wilayah' => $this->request->getPost('id_wilayah'),
                    'foto' => $nama_file_foto,
                ];
                $this->ModelSekolah->UpdateData($data);
                $foto_sekolah->move('foto', $nama_file_foto);
            }
            //Notifikasi Data Berhasil Disimpan
            session()->setFlashdata('update', 'Data Sekolah Berhasil Di Update!!');
            return redirect()->to('Sekolah');
        } else {
            //Jika Tidak Lolos Validasi
            return redirect()->to(base_url('Sekolah/EditSekolah'))->withInput();
        }
    }

    public function Delete($id_sekolah)
    {
        // Menghapus Foto
        $sekolah = $this->ModelSekolah->DetailData($id_sekolah);
        if ($sekolah['foto'] <> "") {
            unlink('foto/' . $sekolah['foto']);
        }

        $data = [
            'id_sekolah' => $id_sekolah,
        ];
        $this->ModelSekolah->DeleteData($data);
        //Notifikasi Data Berhasil Disimpan
        session()->setFlashdata('delete', 'Data Sekolah Berhasil Di Delete!!');
        return redirect()->to('Sekolah');
    }

    public function Detail($id_sekolah)
    {
        $data = [
            'judul' => 'Detail Sekolah',
            'menu' => 'sekolah',
            'page' => 'sekolah/v_detail',
            'sekolah' => $this->ModelSekolah->DetailData($id_sekolah),
            'web' => $this->ModelSetting->Dataweb(),
        ];
        return view('v_template_back_end', $data);
    }

    // Kabupaten, Kecamatan
    // public function Kabupaten()
    // {
    //     $id_provinsi = $this->request->getPost('id_provinsi');
    //     $kab = $this->ModelSekolah->allKabupaten($id_provinsi);
    //     echo '<option value="">-- Pilih Kabupaten --</option>';
    //     foreach ($kab as $key => $value) {
    //         echo '<option value=' . $value['id_kabupaten'] . '>' . $value['nama_kabupaten'] . '</option>';
    //     }
    // }

    // public function Kecamatan()
    // {
    //     $id_kabupaten = $this->request->getPost('id_kabupaten');
    //     $kac = $this->ModelSekolah->allKecamatan($id_kabupaten);
    //     echo '<option value="">-- Pilih Kecamatan --</option>';
    //     foreach ($kac as $key => $value) {
    //         echo '<option value=' . $value['id_kecamatan'] . '>' . $value['nama_kecamatan'] . '</option>';
    //     }
    // }
}
