<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $primaryKey = "id_guru";
    protected $table = "guru";
    protected $allowedFields = ['id_mapel', 'id_akun', 'nama_guru', 'alamat', 'no_telp'];

    public function getguru($id_guru = false)
    {
        if ($id_guru == false) {
            return $this->findAll();
        }
        return $this->where(['id_guru' => $id_guru])->first();
    }

    public function joinguru()
    {
        return $this->db->table('guru')
         ->join('mapel','mapel.id_mapel=guru.id_mapel')
         ->get()->getResultArray();
    }

    public function updateGuru($data, $id_guru)
    {
        $query = $this->db->table('guru')->update($data, array('id_guru' => $id_guru));
        return $query;
    }
    public function deleteGuru($id_guru)
    {
        $query = $this->db->table('guru')->delete(array('id_guru' => $id_guru));
        return $query;
    }
}
