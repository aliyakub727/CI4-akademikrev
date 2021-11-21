<?php

namespace App\Models;

use CodeIgniter\Model;

class OperatorModel extends Model
{
    protected $table = "operator";
    protected $primaryKey = "id_operator";
    protected $allowedFields = ['id_akun', 'nama_lengkap', 'jenis_kelamin', 'Alamat', 'No_Telp', 'tgl_lahir', 'tempat_lahir', 'agama'];

    public function getoperator($id_operator = false)
    {
        if ($id_operator == false) {
            return $this->findAll();
        }
        return $this->where(['id_operator' => $id_operator])->first();
    }
    public function detailakun($id)
    {
        return $this->where(['id_akun' => $id])->first();
    }
}
