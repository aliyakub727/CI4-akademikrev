<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $primaryKey = "id_kelas";
    protected $table = "kelas";
    protected $allowedFields = ['nama_kelas'];

    public function getkelas($id_kelas = false)
    {
        if ($id_kelas == false) {
            return $this->findAll();
        }
        return $this->where(['id_kelas' => $id_kelas])->first();
    }
    public function updateKelas($data, $id_kelas)
    {
        $query = $this->db->table('kelas')->update($data, array('id_kelas' => $id_kelas));
        return $query;
    }
    public function deleteKelas($id_kelas)
    {
        $query = $this->db->table('kelas')->delete(array('id_kelas' => $id_kelas));
        return $query;
    }
}
