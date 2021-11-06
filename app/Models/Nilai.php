<?php

namespace App\Models;

use CodeIgniter\Model;

class Nilai extends Model
{
    protected $table = "nilai";
    protected $allowedFields = ['id_akun', 'id_mapel', 'id_jurusan', 'nis', 'nama_lengkap', 'nama_kelas', 'jurusan', 'tahun_ajaran', 'nama_guru', 'tugas', 'uts', 'uas'];

    public function getnilai($nama_lengkap = false)
    {
        if ($nama_lengkap == false) {
            return $this->findAll();
        }
        return $this->where(['nama_lengkap' => $nama_lengkap])->first();
    }
    public function updateNilai($data, $id_nilai)
    {
        $query = $this->db->table('nilai')->update($data, array('id_nilai' => $id));
        return $query;
    }
    public function deleteSiswa($id_nilai)
    {
        $query = $this->db->table('nilai')->delete(array('id_nilai' => $id_nilai));
        return $query;
    }
}
