<?php

namespace App\Models;

use CodeIgniter\Model;

class Nilai extends Model
{
    protected $table = "nilai";
    protected $allowedFields = ['id_akun', 'id_mapel', 'id_jurusan', 'nis', 'nama_lengkap','nama_kelas','id_kelas', 'jurusan', 'tahun_ajaran', 'nama_guru', 'tugas', 'uts', 'uas','rata_rata'];
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
    public function getnilai2($nama_kelas = false)
    {
        $model = new Nilai();
        $model = $model->where('nama_kelas','19IK');
        return $this->where(['nama_kelas' => $nama_kelas])->first();
    }

    public function innerjoin()
    {
        return $this->db->table('nilai')
        ->join('mapel','mapel.id_mapel=nilai.id_mapel')
        ->join('jurusan','jurusan.id_jurusan=nilai.id_jurusan')
        ->where('id_mapel',$id_mapel)->findAll()
        ->get()->getResultArray();
    }

    public function insertnilai($data)
    {  
        $rataRata = (($data['uas']) + ($data['uts']) + ($data['tugas'])) / 3;
        $dataNilai = [
            'tugas' => $data['tugas'],
            'uts' => $data['uts'],
            'uas' => $data['uas'],
            'rata_rata' => $rataRata
        ];
        $this->set($dataNilai)->where('id_nilai', $data['id'])->update();
        return true;
    }
    
}
