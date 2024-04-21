<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSetting extends Model
{
    public function Dataweb()
    {
        return $this->db->table('tbl_settings')->where('id', 1)->get()->getRowArray();
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_settings')->where('id', 1)->update($data);
    }
}
