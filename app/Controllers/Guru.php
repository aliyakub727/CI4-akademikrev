<?php

namespace App\Controllers;

use App\Models\Nilai;
use App\Models\GuruModel;
use Myth\Auth\Models\UserModel;
use App\Models\JurusanModel;
use App\Models\KelasModel;
use App\Models\MapelModel;

class Guru extends BaseController
{
    protected $nilai;
    protected $guru;
    protected $user;
    protected $jurusan;
    protected $db, $builder;
    protected $kelas;
    protected $mapel;
    public function __construct()
    {
        $this->nilai = new Nilai();
        $this->guru = new GuruModel();
        $this->user = new UserModel();
        $this->jurusan = new JurusanModel();
        $this->usermodel = new UserModel();
        $this->kelas = new KelasModel();
        $this->mapel = new MapelModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'SUZURAN | OPERATOR',
            'kelas' => $this->kelas->getkelas(),
            'guru'  => $this->guru->getguru(),

        ];
        return view('/guru/view', $data);
    }
    //munculin data siswa
    public function guru($id_mapel)
    {
        $data = [
            'judul' => 'SUZURAN | OPERATOR',
            'nilai' => $this->nilai->where('id_mapel', $id_mapel)->findAll(),
        ];
        return view('guru/index', $data);
    }

    //tambah data siswa
    public function tambahnilai($user_id)
    {
        // session();
        $data = [
            'judul' => 'SUZURAN | OPERATOR',
            'validation' => \Config\Services::validation(),
            'user' => $this->user->findAll(),
            'jurusan' => $this->jurusan->getjurusan(),
            'kelas' => $this->kelas->getkelas(),
            'guru'  => $this->guru->where('id_akun', $user_id)->findAll(),

        ];
        return view('guru/view', $data);
    }


    //save data siswa
    public function saveguru()
    {
        if (!$this->validate([
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Harus diisi.',
                    'is_unique' => 'Nama minuman Sudah terdaftar.'
                ]
            ]
        ])) {

            // $validation = \Config\Services::validation();
            // dd($validation);
            // return redirect()->to('/Siswa/create')->withInput()->with('validation', $validation);
            return redirect()->to('/guru/create')->withInput();
        }
        $this->nilai->save([
            'id_akun'   => $this->request->getVar('id'),
            'id_mapel'   => $this->request->getVar('id_mapel'),
            'id_jurusan'   => $this->request->getVar('id_jurusan'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'nama_kelas' => $this->request->getVar('nama_kelas'),
            'tahun_ajaran' => $this->request->getVar('tahun_ajaran'),
            'nama_guru' => $this->request->getVar('nama_guru'),
            'nis' => $this->request->getVar('nis'),
            'jurusan' => $this->request->getVar('jurusan'),
            'tugas' => $this->request->getVar('tugas'),
            'uts' => $this->request->getVar('uts'),
            'uas' => $this->request->getVar('uas')


        ]);

        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan.');

        return redirect()->to('/guru/index');
    }
    public function savenilai()
    {
        $data = $this->request->getPost();
        $dataNilai = $this->nilai->insertnilai($data);
        return 'Success';
    }
    public function search($nama_kelas)
    {
        $data = [
            'judul' => 'Akademik | Administrator',
            'nilai' => $this->nilai->getnilai2($nama_kelas),
        ];
        return view('guru/index', $data);
    }

    public function profile($id)
    {
        $db      = \Config\Database::connect();
        $this->builder = $db->table('users');
        $this->builder->select('users.id as userid, username, email, user_image, name, description, password_hash');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();
        $data = [
            'judul' => 'SUZURAN | ACCOUNT-GURU',
            'users' => $query->getRow(),
            'guru' => $this->guru->detailakun($id),
            'mapel' => $this->mapel->getmapel(),
        ];
        return view('admin/detailakun', $data);
    }
}
