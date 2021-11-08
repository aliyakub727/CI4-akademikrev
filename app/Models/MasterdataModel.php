<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterdataModel extends Model
{

    protected $table = "masterdatapelajaran";
    protected $allowedFields = ['id_ajaran', 'id_siswa', 'nama_lengkap', 'id_kelas', 'id_jurusan', 'id_guru'];

    public function getmasterdata($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
    public function update_data($data, $id)
    {
        $query = $this->db->table('masterdatapelajaran')->update($data, array('id' => $id));
        return $query;
    }
    public function delete_data($id)
    {
        $query = $this->db->table('masterdatapelajaran')->delete(array('id' => $id));
        return $query;
    }
}
