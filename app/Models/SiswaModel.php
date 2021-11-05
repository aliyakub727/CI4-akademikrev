<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = "siswa";
    protected $allowedFields = ['id_akun', 'nama_lengkap', 'jenis_kelamin', 'nis', 'alamat', 'no_telp', 'tgl_lahir', 'tempat_lahir', 'agama', 'nama_orang_tua', 'alamat_ortu', 'no_telp_ortu', 'jurusan'];

    public function getsiswa($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
    public function updateSiswa($data, $id)
    {
        $query = $this->db->table('siswa')->update($data, array('id' => $id));
        return $query;
    }
    public function deleteSiswa($id)
    {
        $query = $this->db->table('siswa')->delete(array('id' => $id));
        return $query;
    }
}
