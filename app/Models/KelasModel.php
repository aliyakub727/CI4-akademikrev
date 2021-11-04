<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
	protected $primaryKey = "id";
    protected $table = "kelas";
    protected $allowedFields = ['id','kelas'];

    public function getkelas($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
     public function updateKelas($data,$id)
    {
        $query = $this->db->table('kelas')->update($data, array('id' => $id));
        return $query;
    }
    public function deleteKelas($id)
    {
        $query = $this->db->table('kelas')->delete(array('id' => $id));
        return $query;
    } 
}
