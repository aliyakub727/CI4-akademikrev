<?php

namespace App\Models;

use CodeIgniter\Model;

class TahunajaranModel extends Model
{
    protected $table = "tahun_ajaran";
    protected $primaryKey = "id_ajaran";

    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_ajaran', 'tahun_ajaran', 'id_jurusan'];

    public function gettahun($id_ajaran = false)
    {
        if ($id_ajaran == false) {
            return $this->findAll();
        }
        return $this->where(['id_ajaran' => $id_ajaran])->first();
    }
    public function updatetahun($data, $id_ajaran)
    {
        $query = $this->db->table('tahun_ajaran')->update($data, array('id_ajaran' => $id_ajaran));
        return $query;
    }
    public function deletetahun($id_ajaran)
    {
        $query = $this->db->table('tahun_ajaran')->delete(array('id_ajaran' => $id_ajaran));
        return $query;
    }
}
