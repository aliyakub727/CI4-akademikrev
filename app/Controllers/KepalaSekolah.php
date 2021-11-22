<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\GuruModel;
use Myth\Auth\Models\UserModel;
use App\Models\JurusanModel;
use App\Models\KelasModel;
use App\Models\MapelModel;
use App\Models\KepsekModel;

class KepalaSekolah extends BaseController
{
    protected $siswa;
    protected $guru;
    protected $user;
    protected $jurusan;
    protected $kelas;
    protected $mapel;
    protected $kepsek;

    public function __construct()
    {
        $this->siswamodel = new SiswaModel();
        $this->nilai = new SiswaModel();
        $this->guru = new GuruModel();
        $this->user = new UserModel();
        $this->jurusan = new JurusanModel();
        $this->kelas = new KelasModel();
        $this->mapel =  new MapelModel();
        $this->kepsek = new KepsekModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'SUZURAN | KEPALA SEKOLAH',
            'kepsek' => $this->kepsek->getkepsek(),
        ];
        return view('/index', $data);
    }

    // profile
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
            'kepsek' => $this->kepsek->detailakun($id),
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/detailakun', $data);
    }

    public function lengkapi($id)
    {
        $data = [
            'judul' => 'SUZURAN | ACCOUNT-GURU',
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/lengkapi_akun', $data);
    }

    public function savelengkapi()
    {
        if (!$this->validate([
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Harus diisi.',
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin Harus diisi.',
                ]
            ],
            'tempat_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tempat lahir Harus diisi.',
                ]
            ],
            'tgl_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Lahir Harus diisi.',
                ]
            ],
            'agama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Agama Harus diisi.',
                ]
            ],
            'no_telp' => [
                'rules' => 'required|is_unique[Kepala_sekolah.no_telp]',
                'errors' => [
                    'is_unique' => 'Nomor Sudah Terdaftar',
                    'required' => 'Jenis Kelamin Harus diisi.',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Harus diisi.',
                ]
            ],

        ])) {

            return redirect()->to('/kepalasekolah/lengkapi/' . $this->request->getVar('id'))->withInput();
        }
        $this->kepsek->save([
            'id_akun'   => $this->request->getVar('id'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'alamat'        => $this->request->getVar('alamat'),
            'no_telp'       => $this->request->getVar('no_telp'),
            'tgl_lahir'     => $this->request->getVar('tgl_lahir'),
            'tempat_lahir'  => $this->request->getVar('tempat_lahir'),
            'agama'     => $this->request->getVar('agama')

        ]);
        return redirect()->to('kepalasekolah/profile/' . $this->request->getVar('id'));
    }

    public function saveprofile()
    {
        $nplama = $this->kepsek->getkepsek(($this->request->getVar('id_kepsek')));

        //cek tahun ajaran diganti atau engga
        if ($nplama['no_telp'] == $this->request->getVar('no_telp')) {
            $rule_asw = 'required';
        } else {
            $rule_asw = 'required|is_unique[kepala_sekolah.no_telp]';
        }
        if (!$this->validate([
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Harus diisi.',
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin Harus diisi.',
                ]
            ],
            'tempat_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tempat lahir Harus diisi.',
                ]
            ],
            'tgl_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Lahir Harus diisi.',
                ]
            ],
            'agama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Agama Harus diisi.',
                ]
            ],
            'no_telp' => [
                'rules' => $rule_asw,
                'errors' => [
                    'is_unique' => 'Nomor Sudah Terdaftar',
                    'required' => 'Jenis Kelamin Harus diisi.',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Harus diisi.',
                ]
            ],

        ])) {

            return redirect()->to('/kepalasekolah/profile/' . $this->request->getVar('id'))->withInput();
        }
        $this->kepsek->save([
            'id_kepala_sk' => $this->request->getVar('id_kepsek'),
            'id_akun'   => $this->request->getVar('id'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'Alamat'        => $this->request->getVar('alamat'),
            'No_Telp'       => $this->request->getVar('no_telp'),
            'tgl_lahir'     => $this->request->getVar('tgl_lahir'),
            'tempat_lahir'  => $this->request->getVar('tempat_lahir'),
            'agama'     => $this->request->getVar('agama')

        ]);
        return redirect()->to('kepalasekolah/profile/' . $this->request->getVar('id'));
    }

    public function gantiprofil($id)
    {
        $filegambar = $this->request->getFile('userimage');

        //cek gambar
        $gambarlama = $this->request->getVar('gambarlama');
        if ($gambarlama == 'default.svg') {
            $namagambar = $filegambar->getRandomName();
            //pindahkan gambar
            $filegambar->move('img/fotoprofil/', $namagambar);
        } elseif ($filegambar != $gambarlama) {
            $namagambar = $filegambar->getRandomName();
            //pindahkan gambar
            $filegambar->move('img/fotoprofil/', $namagambar);
            //hapus file lama
            unlink('img/fotoprofil/' . $this->request->getVar('gambarlama'));
        } else {

            $namagambar = $this->request->getVar('gambarlama');
        }

        $this->user->save([
            'id' => $id,
            'user_image' => $namagambar
        ]);

        return redirect()->to('/kepalasekolah/profile/' . $this->request->getVar('id'));
    }

    public function datasiswa()
    {
        $data = [
            'judul' => 'SUZURAN | KEPALA SEKOLAH',
            'siswa' => $this->siswamodel->getsiswa(),
            'kepsek' => $this->kepsek->getkepsek(),
            'jurusan' => $this->jurusan->getjurusan(),
        ];
        return view('kepalasekolah/data_siswa/index', $data);
    }

    public function dataguru()
    {

        $data = [
            'judul' => 'SUZURAN | KEPALA SEKOLAH',
            'guru' => $this->guru->joinguru(),
            'kepsek' => $this->kepsek->getkepsek(),
            'mapel' => $this->mapel->getmapel(),
        ];
        return view('kepalasekolah/data_guru/index', $data);
    }
}
