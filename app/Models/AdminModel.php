<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = "admin";
    protected $primaryKey = "id_admin";
    protected $allowedFields = ['id_akun', 'nama_lengkap', 'jenis_kelamin', 'alamat', 'no_telp', 'tgl_lahir', 'tempat_lahir', 'agama'];

    public function getadmin($id_admin = false)
    {
        if ($id_admin == false) {
            return $this->findAll();
        }
        return $this->where(['id_admin' => $id_admin])->first();
    }
    public function detailakun($id)
    {
        return $this->where(['id_akun' => $id])->first();
    }
}
