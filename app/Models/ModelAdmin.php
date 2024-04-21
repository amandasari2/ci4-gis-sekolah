<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdmin extends Model
{
    public function JumlahWilayah()
    {
        return $this->db->table('tbl_wilayah')
            ->countAll();
    }

    public function JumlahSekolah()
    {
        return $this->db->table('tbl_sekolah')
            ->countAll();
    }
}
