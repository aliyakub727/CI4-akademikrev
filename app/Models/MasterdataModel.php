<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterdataModel extends Model
{

    protected $table = "master_data";
    protected $allowedFields = ['tahun_ajaran', 'nis', 'nama_lengkap', 'kelas', 'jurusan', 'nama_walikelas'];

    public function getmasterdata($nama_lengkap = false)
    {
        if ($nama_lengkap == false) {
            return $this->findAll();
        }
        return $this->where(['nama_lengkap' => $nama_lengkap])->first();
    }
    public function update_data($data, $id)
    {
        $query = $this->db->table('master_data')->update($data, array('id' => $id));
        return $query;
    }
    public function delete_data($id)
    {
        $query = $this->db->table('master_data')->delete(array('id' => $id));
        return $query;
    }
}
