<?php

namespace App\Controllers;

use App\Models\ModelSetting;
use App\Models\ModelWilayah;
use App\Models\ModelSekolah;
use App\Models\ModelJenjang;

class Home extends BaseController
{
    public function __construct()
    {
        $this->ModelWilayah = new ModelWilayah();
        $this->ModelSetting = new ModelSetting();
        $this->ModelSekolah = new ModelSekolah();
        $this->ModelJenjang = new ModelJenjang();
    }

    public function index(): string
    {
        $data = [
            'judul' => 'Home',
            'page' => 'v_home',
            'web' => $this->ModelSetting->Dataweb(),
            'wilayah' => $this->ModelWilayah->AllData(),
            'sekolah' => $this->ModelSekolah->AllData(),
            'jenjang' => $this->ModelJenjang->AllData(),
        ];
        return view('v_template_front_end', $data);
    }

    public function Wilayah($id_wilayah)
    {
        $dw = $this->ModelWilayah->DetailData($id_wilayah);
        $data = [
            'judul' => $dw['nama_wilayah'],
            'page' => 'v_detailwilayah',
            'web' => $this->ModelSetting->Dataweb(),
            'jenjang' => $this->ModelJenjang->AllData(),
            'wilayah' => $this->ModelWilayah->AllData(),
            'detailwilayah' => $this->ModelWilayah->DetailData($id_wilayah),
            'sekolah' => $this->ModelSekolah->AllDataWilayah($id_wilayah),
        ];
        return view('v_template_front_end', $data);
    }

    public function Jenjang($id_jenjang)
    {
        $dj = $this->ModelJenjang->DetailData($id_jenjang);
        $data = [
            'judul' => $dj['jenjang'],
            'page' => 'v_detailjenjang',
            'web' => $this->ModelSetting->Dataweb(),
            'jenjang' => $this->ModelJenjang->AllData(),
            'wilayah' => $this->ModelWilayah->AllData(),
            'sekolah' => $this->ModelSekolah->AllDataJenjang($id_jenjang),
        ];
        return view('v_template_front_end', $data);
    }

    public function DetailSekolah($id_sekolah)
    {
        $sekolah = $this->ModelSekolah->DetailData($id_sekolah);
        $data = [
            'judul' => $sekolah['nama_sekolah'],
            'page' => 'v_detailsekolah',
            'web' => $this->ModelSetting->Dataweb(),
            'jenjang' => $this->ModelJenjang->AllData(),
            'wilayah' => $this->ModelWilayah->AllData(),
            'sekolah' => $sekolah,
        ];
        return view('v_template_front_end', $data);
    }
}
