<?php

namespace App\Controllers;
use App\Models\SiswaModel;
use App\Models\GuruModel;
use Myth\Auth\Models\UserModel;
use App\Models\JurusanModel;
use App\Models\KelasModel;

class KepalaSekolah extends BaseController
{
    protected $siswa;
    protected $guru;
    protected $user;
    protected $jurusan;
    protected $kelas;
    public function __construct()
    {
        $this->siswamodel = new SiswaModel();
        $this->nilai = new SiswaModel();
        $this->guru = new GuruModel();
        $this->user = new UserModel();
        $this->jurusan = new JurusanModel();
        $this->kelas = new KelasModel();
    }

    public function index()
    {
       $data = [
            'judul' => 'SUZURAN | KEPALA SEKOLAH',
        ];
        return view('/index', $data);
    }

    public function datasiswa()
    {
       $data = [
            'judul' => 'SUZURAN | KEPALA SEKOLAH',
            'siswa' => $this->siswamodel->getsiswa(),
        ];
        return view('kepalasekolah/data_siswa/index', $data);
    }
}
