<?php

namespace App\Models;

use CodeIgniter\Model;

class TahunajaranModel extends Model
{
    protected $table = "tahunajaran";
    protected $primaryKey = "id_tahun";

    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_tahun', 'tahunajaran', 'status'];

    public function gettahun($tahunajaran = false)
    {
        if ($tahunajaran == false) {
            return $this->findAll();
        }
        return $this->where(['tahunajaran' => $tahunajaran])->first();
    }
    public function updatetahun($data, $id_tahun)
    {
        $query = $this->db->table('tahunajaran')->update($data, array('id_tahun' => $id_tahun));
        return $query;
    }
    public function deletetahun($id_tahun)
    {
        $query = $this->db->table('tahunajaran')->delete(array('id_tahun' => $id_tahun));
        return $query;
    }
}
