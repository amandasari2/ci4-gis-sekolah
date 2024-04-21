<?php

namespace App\Controllers;

use App\Models\ModelSetting;
use App\Models\ModelAdmin;
use App\Models\ModelJenjang;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->ModelSetting = new ModelSetting();
        $this->ModelAdmin = new ModelAdmin();
        $this->ModelJenjang = new ModelJenjang();
    }

    public function index(): string
    {
        $data = [
            'judul' => 'Dashboard',
            'menu' => 'dashboard',
            'page' => 'v_dashboard',
            'jumlahsekolah' => $this->ModelAdmin->JumlahSekolah(),
            'jumlahwilayah' => $this->ModelAdmin->JumlahWilayah(),
            'jenjang' => $this->ModelJenjang->AllData(),
        ];
        return view('v_template_back_end', $data);
    }

    public function Settings(): string
    {
        $data = [
            'judul' => 'Settings',
            'menu' => 'setting',
            'page' => 'v_settings',
            'web' => $this->ModelSetting->Dataweb(),
        ];
        return view('v_template_back_end', $data);
    }

    public function UpdateSetting()
    {
        $data = [
            'id' => 1,
            'nama_web' => $this->request->getPost('nama_web'),
            'coordinat_wilayah' => $this->request->getPost('coordinat_wilayah'),
            'zoom_view' => $this->request->getPost('zoom_view'),
        ];
        $this->ModelSetting->UpdateData($data);
        session()->setFlashdata('pesan', 'Settingan Web Telah Di Update!');
        return redirect()->to('Admin/Settings');
    }
}
