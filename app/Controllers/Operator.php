<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use Myth\Auth\Models\UserModel;
use App\Models\JurusanModel;

class Operator extends BaseController
{
    protected $siswamodel;
    protected $user;
    protected $jurusan;
    public function __construct()
    {
        $this->siswamodel = new SiswaModel();
        $this->user = new UserModel();
        $this->jurusan = new JurusanModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'SUZURAN | OPERATOR',
        ];
        return view('index', $data);
    }

    //munculin data siswa
    public function datasiswa()
    {
        $data = [
            'judul' => 'Akademik | Administrator',
            'siswa' => $this->siswamodel->getsiswa(),
        ];
        return view('operator/data_siswa/index', $data);
    }

    //tambah data siswa
    public function tambahsiswa()
    {
        // session();
        $data = [
            'judul' => 'Form Tambah Data Makanan Favorit',
            'validation' => \Config\Services::validation(),
            'user' => $this->user->findAll(),
            'jurusan' => $this->jurusan->getjurusan(),
        ];
        return view('operator/data_siswa/create', $data);
    }

    //save data siswa
    public function savesiswa()
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
            return redirect()->to('/operator/tambahsiswa')->withInput();
        }
        $this->siswamodel->save([
            'id_akun'   => $this->request->getVar('id'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'nis' => $this->request->getVar('nis'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telp' => $this->request->getVar('no_telp'),
            'tgl_lahir' => $this->request->getVar('tgl_lahir'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'agama' => $this->request->getVar('agama'),
            'nama_orang_tua' => $this->request->getVar('nama_orangtua'),
            'alamat_ortu' => $this->request->getVar('alamat_orangtua'),
            'no_telp_ortu' => $this->request->getVar('no_telp_orangtua'),
            'jurusan' => $this->request->getVar('jurusan')

        ]);

        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan.');

        return redirect()->to('/operator/datasiswa');
    }
}
