<?php

namespace App\Models;

use CodeIgniter\Model;

class KepsekModel extends Model
{
    protected $table = "kepala_sekolah";
    protected $primaryKey = "id_kepala_sk";
    protected $allowedFields = ['id_akun', 'nama_lengkap', 'jenis_kelamin', 'alamat', 'no_telp', 'tgl_lahir', 'tempat_lahir', 'agama'];

    public function getkepsek($id_kepala_sk = false)
    {
        if ($id_kepala_sk == false) {
            return $this->findAll();
        }
        return $this->where(['id_kepala_sk' => $id_kepala_sk])->first();
    }
    public function detailakun($id)
    {
        return $this->where(['id_akun' => $id])->first();
    }
}
