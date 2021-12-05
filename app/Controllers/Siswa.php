<?php

namespace App\Controllers;

use Myth\Auth\Models\UserModel;
use App\Models\UsersModel;
use App\Models\SiswaModel;
use Myth\Auth\Commands\Publish;
use App\Models\JadwalModel;

class Siswa extends BaseController
{
    protected $usermodel;
    protected $db, $builder;
    protected $siswa;
    protected $jadwal;
    public function __construct()
    {
        $this->uss = new UsersModel();
        $this->jadwal = new JadwalModel();
        $this->siswa = new SiswaModel();
        $this->usermodel = new UserModel();
        $this->db = \config\Database::connect();
        $this->builder = $this->db->table('users');
    }

    public function index()
    {
        $user_id = user_id();
        $db      = \Config\Database::connect();
        $this->builder = $db->table('users');
        $this->builder->select('users.id as userid, siswa.id as siswaid, id_kelas');
        $this->builder->join('siswa', 'siswa.id_akun = users.id');
        $this->builder->join('masterdatapelajaran', 'masterdatapelajaran.id_siswa = siswa.id');
        $this->builder->where('users.id', $user_id);
        $query = $this->builder->get();
        $data = [
            'judul' => 'SUZURAN | SISWA',
            'siswa' => $this->siswa->where('id_akun', $user_id)->findAll(),
            'idkelas' => $query->getRow()
        ];
        return view('index', $data);
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

        $ac      = \Config\Database::connect();
        $this->builder = $ac->table('users');
        $this->builder->select('users.id as userid, siswa.id as siswaid, id_kelas');
        $this->builder->join('siswa', 'siswa.id_akun = users.id');
        $this->builder->join('masterdatapelajaran', 'masterdatapelajaran.id_siswa = siswa.id');
        $this->builder->where('users.id', $id);
        $test = $this->builder->get();
        $data = [
            'judul' => 'SUZURAN | SISWA',
            'users' => $query->getRow(),
            'siswa' => $this->siswa->detailakun($id),
            'validation' => \Config\Services::validation(),
            'idkelas' => $test->getRow()
        ];
        return view('Admin/detailakun', $data);
    }

    public function lengkapi()
    {
        $user_id = user_id();
        $ac      = \Config\Database::connect();
        $this->builder = $ac->table('users');
        $this->builder->select('users.id as userid, siswa.id as siswaid, id_kelas');
        $this->builder->join('siswa', 'siswa.id_akun = users.id');
        $this->builder->join('masterdatapelajaran', 'masterdatapelajaran.id_siswa = siswa.id');
        $this->builder->where('users.id', $user_id);
        $test = $this->builder->get();
        $data = [
            'judul' => 'SUZURAN | SISWA',
            'validation' => \Config\Services::validation(),
            'idkelas' => $test->getRow()
        ];
        return view('Admin/lengkapi_akun', $data);
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

            return redirect()->to('/Admin/lengkapi/' . $this->request->getVar('id'))->withInput();
        }
        $this->admin->save([
            'id_akun'   => $this->request->getVar('id'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'alamat'        => $this->request->getVar('alamat'),
            'no_telp'       => $this->request->getVar('no_telp'),
            'tgl_lahir'     => $this->request->getVar('tgl_lahir'),
            'tempat_lahir'  => $this->request->getVar('tempat_lahir'),
            'agama'     => $this->request->getVar('agama')

        ]);
        return redirect()->to('Admin/profile/' . $this->request->getVar('id'));
    }

    public function saveprofile()
    {
        $nplama = $this->admin->getadmin(($this->request->getVar('id_admin')));

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

            return redirect()->to('/Admin/profile/' . $this->request->getVar('id'))->withInput();
        }
        $this->admin->save([
            'id_admin' => $this->request->getVar('id_admin'),
            'id_akun'   => $this->request->getVar('id'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'Alamat'        => $this->request->getVar('alamat'),
            'No_Telp'       => $this->request->getVar('no_telp'),
            'tgl_lahir'     => $this->request->getVar('tgl_lahir'),
            'tempat_lahir'  => $this->request->getVar('tempat_lahir'),
            'agama'     => $this->request->getVar('agama')

        ]);
        return redirect()->to('Admin/profile/' . $this->request->getVar('id'));
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

        return redirect()->to('/Operator/profile/' . $this->request->getVar('id'));
    }

    public function jadwal($id_kelas)
    {
        $db      = \Config\Database::connect();
        $this->builder = $db->table('kelas');
        // $this->builder->select('id_jadwal, jadwal.id_mapel as id_mapel_jadwal, jadwal.id_guru as id_guru_jadwal, jadwal.nama_mapel as nama_mapel_jadwal, mapel.id_mapel as id_mapel_mapel, mapel.id_kelas as id_kelas_mapel, mapel.nama_mapel as nama_mapel_mapel, kelas.id_kelas, kelas.nama_kelas as nama_kelas_kelas');
        $this->builder->join('mapel', 'mapel.id_kelas=kelas.id_kelas');
        $this->builder->join('guru', 'guru.id_mapel=mapel.id_mapel');
        $this->builder->join('jadwal', 'jadwal.id_mapel=mapel.id_mapel');
        $this->builder->where('kelas.id_kelas', $id_kelas);
        $query = $this->builder->get();

        $user_id = user_id();

        $ac      = \Config\Database::connect();
        $this->builder = $ac->table('users');
        $this->builder->select('users.id as userid, siswa.id as siswaid, id_kelas');
        $this->builder->join('siswa', 'siswa.id_akun = users.id');
        $this->builder->join('masterdatapelajaran', 'masterdatapelajaran.id_siswa = siswa.id');
        $this->builder->where('users.id', $user_id);
        $test = $this->builder->get();
        $data = [
            'judul' => 'SUZURAN | SISWA',
            'siswa' => $this->siswa->where('id_akun', $user_id)->findAll(),
            'jadwal' => $query->getResultArray(),
            'idkelas' => $test->getRow()
        ];
        return view('siswa/jadwal', $data);
    }
}
