<?php

namespace App\Controllers;
use App\Models\SiswaModel;
use App\Models\GuruModel;
use Myth\Auth\Models\UserModel;
use App\Models\JurusanModel;
use App\Models\KelasModel;
use App\Models\MapelModel;

class KepalaSekolah extends BaseController
{
    protected $siswa;
    protected $guru;
    protected $user;
    protected $jurusan;
    protected $kelas;
    protected $mapel;
    
    public function __construct()
    {
        $this->siswamodel = new SiswaModel();
        $this->nilai = new SiswaModel();
        $this->guru = new GuruModel();
        $this->user = new UserModel();
        $this->jurusan = new JurusanModel();
        $this->kelas = new KelasModel();
        $this->mapel =  new MapelModel();
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
            'jurusan' => $this->jurusan->getjurusan(),
        ];
        return view('kepalasekolah/data_siswa/index', $data);
    }

    public function dataguru()
    {
        
       $data = [
            'judul' => 'SUZURAN | KEPALA SEKOLAH',
            'guru' => $this->guru->joinguru(),
            'mapel' => $this->mapel->getmapel(),
        ];
        return view('kepalasekolah/data_guru/index', $data);
    }
}
