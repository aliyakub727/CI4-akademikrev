<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterdataModel extends Model
{

    protected $table = "masterdatapelajaran";
    protected $primarykey = "id_master";
    protected $allowedFields = ['id_ajaran', 'id_siswa', 'nama_lengkap', 'id_kelas', 'id_jurusan', 'id_guru'];

    public function getmasterdata($id_master = false)
    {
        if ($id_master == false) {
            return $this->findAll();
        }
        return $this->where(['id_master' => $id_master])->first();
    }
    public function joindata()
    {
        return $this->db->table('masterdatapelajaran')
            ->join('tahun_ajaran', 'tahun_ajaran.id_ajaran=masterdatapelajaran.id_ajaran')
            ->join('siswa', 'siswa.id=masterdatapelajaran.id_siswa')
            ->join('kelas', 'kelas.id_kelas=masterdatapelajaran.id_kelas')
            ->join('jurusan', 'jurusan.id_jurusan=masterdatapelajaran.id_jurusan')
            ->join('guru', 'guru.id_guru=masterdatapelajaran.id_guru')
            ->get()->getResultArray();
    }
    public function joindata1($id_master)
    {
        return $this->db->table('masterdatapelajaran')
            ->join('tahun_ajaran', 'tahun_ajaran.id_ajaran=masterdatapelajaran.id_ajaran')
            ->join('siswa', 'siswa.id=masterdatapelajaran.id_siswa')
            ->join('kelas', 'kelas.id_kelas=masterdatapelajaran.id_kelas')
            ->join('jurusan', 'jurusan.id_jurusan=masterdatapelajaran.id_jurusan')
            ->join('guru', 'guru.id_guru=masterdatapelajaran.id_guru')
            ->where('id_master', $id_master)
            ->get()->getResultArray();
    }

    public function save_data($data)
    {
        $query = $this->db->table('masterdatapelajaran')->insert($data);
        return $query;
    }

    public function update_data($data, $id_master)
    {
        $query = $this->db->table('masterdatapelajaran')->update($data, array('id_master' => $id_master));
        return $query;
    }
    public function delete_data($id)
    {
        $query = $this->db->table('masterdatapelajaran')->delete(array('id_master' => $id));
        return $query;
    }
}
