<?php

namespace App\Controllers;
use App\Models\Nilai;
use App\Models\GuruModel;
use Myth\Auth\Models\UserModel;
use App\Models\JurusanModel;
use App\Models\KelasModel;

class Guru extends BaseController
{
    protected $nilai;
    protected $guru;
    protected $user;
    protected $jurusan;
    protected $kelas;
    public function __construct()
    {
        $this->nilai = new Nilai();
        $this->guru = new GuruModel();
        $this->user = new UserModel();
        $this->jurusan = new JurusanModel();
        $this->kelas = new KelasModel();
    }

    public function index()
    {
       $data = [
            'judul' => 'SUZURAN | OPERATOR',
        ];
        return view('/guru/index', $data);
    }
    //munculin data siswa
        public function guru()
        {
        $data = [
            'judul' => 'Akademik | Administrator',
            'nilai' => $this->nilai->getnilai(),
        ];
        return view('guru/index', $data);
    }

    //tambah data siswa
    public function tambahnilai()
    {
        // session();
        $data = [
            'judul' => 'Form Tambah Data Makanan Favorit',
            'validation' => \Config\Services::validation(),
            'user' => $this->user->findAll(),
            'jurusan' => $this->jurusan->getjurusan(),
            'kelas' => $this->kelas->getkelas(),
              
        ];
        return view('guru/create', $data);
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
}
