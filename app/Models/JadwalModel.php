<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = "jadwal";
    protected $primaryKey = "id_jadwal";
    protected $allowedFields = ['id_mapel', 'id_guru', 'nama_mapel', 'hari', 'jam_mulai', 'jam_selesai'];

    public function getjadwal($id_jadwal = false)
    {
        if ($id_jadwal == false) {
            return $this->findAll();
        }
        return $this->where(['id_jadwal' => $id_jadwal])->first();
    }

    public function getidkelas($user_id)
    {
        return $this->table('users')
            ->select('users.id as userid, siswa.id as siswaid, id_kelas')
            ->join('siswa', 'siswa.id_akun = users.id')
            ->join('masterdatapelajaran', 'masterdatapelajaran.id_siswa = siswa.id')
            ->where('users.id', $user_id)
            ->get()->getResultArray();
    }
    public function munculinjadwal()
    {
        return $this->table('kelas')
            ->select('id_jadwal, jadwal.id_mapel as id_mapel_jadwal, jadwal.id_guru as id_guru_jadwal, jadwal.nama_mapel as nama_mapel_jadwal, mapel.id_mapel as id_mapel_mapel, mapel.id_kelas as id_kelas_mapel, mapel.nama_mapel as nama_mapel_mapel kelas.id_kelas, kelas.nama_kelas as nama_kelas_kelas')
            ->join('mapel', 'mapel.id_kelas=kelas.id_kelas')
            ->join('jadwal', 'jadwal.id_mapel=mapel.id_mapel')
            ->get()->getResultArray();
    }
    public function kelas()
    {
        return $this->table('kelas')
            ->select('id_kelas, nama_kelas')
            ->order_by('id_kelas', 'ASC')
            ->get()->result();
    }

    public function mapel($id_kelas)
    {
        return $this->db->table('mapel')
            ->db->where('id_kelas', $id_kelas)
            ->db->get()->result();
    }

    public function joinjadwal()
    {
        return $this->db->table('jadwal')
            ->join('mapel', 'mapel.id_mapel=jadwal.id_mapel')
            ->join('kelas', 'kelas.id_kelas=mapel.id_kelas')
            ->join('guru', 'guru.id_mapel=mapel.id_mapel')
            ->get()->getResultArray();
    }

    function getprov($searchTerm = "")
    {
        $this->select('id_kelas, nama_kelas');
        $this->where("nama_kelas like '%" . $searchTerm . "%' ");
        $this->order_by('id_kelas', 'asc');
        $fetched_records = $this->get('kelas');
        $dataprov = $fetched_records->result_array();

        $data = array();
        foreach ($dataprov as $prov) {
            $data[] = array("id" => $prov['id_kelas'], "text" => $prov['nama_kelas']);
        }
        return $data;
    }

    function getkab($id_kelas, $searchTerm)
    {
        $this->select('id_mapel, nama_mapel');
        $this->where('id_kelas', $id_kelas);
        $this->where("nama like '%" . $searchTerm . "%' ");
        $this->order_by('id_mapel', 'asc');
        $fetched_records = $this->get('mapel');
        $datakab = $fetched_records->result_array();

        $data = array();
        foreach ($datakab as $kab) {
            $data[] = array("id" => $kab['id_mapel'], "text" => $kab['nama_mapel']);
        }
        return $data;
    }
}
