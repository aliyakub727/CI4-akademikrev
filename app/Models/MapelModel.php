<?php

namespace App\Models;

use CodeIgniter\Model;

class MapelModel extends Model
{
    protected $table = "mapel";
    protected $primaryKey = "id_mapel";
    protected $allowedFields = ['nama_mapel'];

    public function getmapel($mapel = false)
    {
        if ($mapel == false) {
            return $this->findAll();
        }
        return $this->where(['nama_mapel' => $nama_mapel])->first();
    }
    public function updatemapel($data, $id_mapel)
    {
        $query = $this->db->table('mapel')->update($data, array('id_mapel' => $id_mapel));
        return $query;
    }
    public function deletemapel($id_mapel)
    {
        $query = $this->db->table('mapel')->delete(array('id_mapel' => $id_mapel));
        return $query;
    }
}
