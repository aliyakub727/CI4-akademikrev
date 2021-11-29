<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use Myth\Auth\Models\UserModel;
use App\Models\JurusanModel;
use App\Models\GuruModel;
use App\Models\TahunajaranModel;
use App\Models\MapelModel;
use App\Models\KelasModel;
use App\Models\MasterdataModel;
use App\Models\OperatorModel;
use App\Models\JadwalModel;

class Operator extends BaseController
{
    protected $siswamodel;
    protected $masterdata;
    protected $kelasmodel;
    protected $db, $builder;
    protected $gurumodel;
    protected $mapel;
    protected $user;
    protected $tahunajaranmodel;
    protected $jurusan;
    protected $operator;
    protected $jadwal;

    public function __construct()
    {
        $this->siswamodel = new SiswaModel();
        $this->jadwal = new JadwalModel();
        $this->user = new UserModel();
        $this->masterdata = new MasterdataModel();
        $this->jurusan = new JurusanModel();
        $this->gurumodel = new GuruModel();
        $this->mapel =  new MapelModel();
        $this->db = \config\Database::connect();
        $this->tahunajaranmodel = new TahunajaranModel();
        $this->kelasmodel = new KelasModel();
        $this->operator = new OperatorModel();
    }

    public function index()
    {
        $user_id = user_id();
        $data = [
            'cek' => $this->operator->findAll(),
            'judul' => 'SUZURAN | OPERATOR',
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
        ];
        return view('index', $data);
    }

    //munculin data siswa
    public function datasiswa()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'SUZURAN | OPERATOR',
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
            'siswa' => $this->siswamodel->getsiswa(),
        ];
        return view('operator/data_siswa/index', $data);
    }

    //tambah data siswa
    public function tambahsiswa()
    {
        $siswa = 'siswa';
        $db      = \Config\Database::connect();
        $this->builder = $db->table('users');
        $this->builder->select('users.id as userid, username, email, user_image, name, description, password_hash');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('auth_groups.name', $siswa);
        $query = $this->builder->get();
        // session();
        $data = [
            'judul' => 'Form Tambah Data Siswa',
            'cek' => $this->operator->findAll(),
            'validation' => \Config\Services::validation(),
            'user' => $query->getResult(),
            'jurusan' => $this->jurusan->getjurusan(),
        ];
        return view('operator/data_siswa/create', $data);
    }

    //save data siswa
    public function savesiswa()
    {
        if (!$this->validate([
            'nama_lengkap' => [
                'rules' => 'required|is_unique[siswa.nama_lengkap]',
                'errors' => [
                    'required' => 'Nama Harus diisi.',
                    'is_unique' => 'Nama Lengkap Sudah terdaftar.'
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin Harus diisi'
                ]
            ],
            'nis' => [
                'rules' => 'required|is_unique[siswa.nis]',
                'errors' => [
                    'required' => 'Nis Harus diisi',
                    'is_unique' => 'Nis Sudah terdaftar.'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Harus diisi'
                ]
            ],
            'no_telp' => [
                'rules' => 'required|is_unique[siswa.no_telp]',
                'errors' => [
                    'required' => 'Nomor Telepon Harus diisi',
                    'is_unique' => 'Nomor Telepon Sudah terdaftar.'
                ]
            ],
            'tempat_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tempat Lahir Harus diisi'
                ]
            ],
            'tgl_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tanggal Lahir Harus diisi'
                ]
            ],
            'agama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Agama Harus diisi'
                ]
            ],
            'nama_orangtua' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Orangtua Harus diisi'
                ]
            ],
            'alamat_orangtua' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat orangtua Harus diisi'
                ]
            ],
            'no_telp_orangtua' => [
                'rules' => 'required',
                'errors' => [
                    'required' => ' Nomor Telepon Orang tua Harus diisi'
                ]
            ],
            'jurusan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jurusan Harus diisi'
                ]
            ],
            'id_akun' => [
                'rules' => 'required|is_unique[siswa.id_akun]',
                'errors' => [
                    'required' => 'id akun Harus diisi',
                    'is_unique' => 'id akun Sudah terdaftar.'
                ]
            ],
        ])) {

            return redirect()->to('/operator/tambahsiswa')->withInput();
        }

        $this->siswamodel->save([
            'id_akun'   => $this->request->getVar('id_akun'),
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
        return redirect()->to('operator/datasiswa/');
    }

    // edit data siswa
    public function editsiswa($id)
    {
        $siswa = 'siswa';
        $db      = \Config\Database::connect();
        $this->builder = $db->table('users');
        $this->builder->select('users.id as userid, username, email, user_image, name, description, password_hash');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('auth_groups.name', $siswa);
        $query = $this->builder->get();
        // session();
        $data = [
            'judul' => 'Form Edit Data Siswa',
            'cek' => $this->operator->findAll(),
            'validation' => \Config\Services::validation(),
            'user' => $query->getResult(),
            'jurusan' => $this->jurusan->getjurusan(),
            'siswa' => $this->siswamodel->getsiswa($id),
        ];
        return view('operator/data_siswa/edit', $data);
    }

    // save edit data siswa
    public function saveeditsiswa()
    {
        // ambil data yang lama
        $nama =  $this->siswamodel->getsiswa($this->request->getVar('id'));
        $nis =  $this->siswamodel->getsiswa($this->request->getVar('id'));
        $no_telp =  $this->siswamodel->getsiswa($this->request->getVar('id'));
        $id_akun =  $this->siswamodel->getsiswa($this->request->getVar('id'));

        //cek nama lengkap diganti atau engga
        if ($nama['nama_lengkap'] == $this->request->getVar('nama_lengkap')) {
            $rule_nama = 'required';
        } else {
            $rule_nama = 'required|is_unique[siswa.nama_lengkap]';
        }

        //cek nis diganti atau engga
        if ($nis['nis'] == $this->request->getVar('nis')) {
            $rule_nis = 'required';
        } else {
            $rule_nis = 'required|is_unique[siswa.nis]';
        }

        //cek no telepon diganti atau engga
        if ($no_telp['no_telp'] == $this->request->getVar('no_telp')) {
            $rule_no_telp = 'required';
        } else {
            $rule_no_telp = 'required|is_unique[siswa.no_telp]';
        }

        //cek id akun diganti atau engga
        if ($id_akun['id_akun'] == $this->request->getVar('id_akun')) {
            $rule_id_akun = 'required';
        } else {
            $rule_id_akun = 'required|is_unique[siswa.id_akun]';
        }

        if (!$this->validate([
            'nama_lengkap' => [
                'rules' => $rule_nama,
                'errors' => [
                    'required' => 'Nama Harus diisi.',
                    'is_unique' => 'Nama Lengkap Sudah terdaftar.'
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin Harus diisi'
                ]
            ],
            'nis' => [
                'rules' => $rule_nis,
                'errors' => [
                    'required' => 'Nis Harus diisi',
                    'is_unique' => 'Nis Sudah terdaftar.'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Harus diisi'
                ]
            ],
            'no_telp' => [
                'rules' => $rule_no_telp,
                'errors' => [
                    'required' => 'Nomor Telepon Harus diisi',
                    'is_unique' => 'Nomor Telepon Sudah terdaftar.'
                ]
            ],
            'tempat_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tempat Lahir Harus diisi'
                ]
            ],
            'tgl_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tanggal Lahir Harus diisi'
                ]
            ],
            'agama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Agama Harus diisi'
                ]
            ],
            'nama_orangtua' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Orangtua Harus diisi'
                ]
            ],
            'alamat_orangtua' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat orangtua Harus diisi'
                ]
            ],
            'no_telp_orangtua' => [
                'rules' => 'required',
                'errors' => [
                    'required' => ' Nomor Telepon Orang tua Harus diisi'
                ]
            ],
            'jurusan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jurusan Harus diisi'
                ]
            ],
            'id_akun' => [
                'rules' => $rule_id_akun,
                'errors' => [
                    'required' => 'id akun Harus diisi',
                    'is_unique' => 'id_akun Sudah terdaftar.'
                ]
            ],
        ])) {

            return redirect()->to('/operator/editsiswa/' . $this->request->getVar('id'))->withInput();
        }

        $model = new SiswaModel();
        $id = $this->request->getPost('id');
        $data = array(
            'id_akun'   => $this->request->getPost('id_akun'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'nis' => $this->request->getPost('nis'),
            'alamat' => $this->request->getPost('alamat'),
            'no_telp' => $this->request->getPost('no_telp'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'agama' => $this->request->getPost('agama'),
            'nama_orang_tua' => $this->request->getPost('nama_orangtua'),
            'alamat_ortu' => $this->request->getPost('alamat_orangtua'),
            'no_telp_ortu' => $this->request->getPost('no_telp_orangtua'),
            'jurusan' => $this->request->getPost('jurusan')
        );
        $model->updateSiswa($data, $id);

        session()->setFlashdata('Pesan', 'Data Berhasil Di Ubah.');

        return redirect()->to('/operator/datasiswa');
    }
    public function deletesiswa()
    {
        $model = new SiswaModel();
        $id = $this->request->getPost('id');
        $model->deleteSiswa($id);
        session()->setFlashdata('Pesan', 'Data Berhasil Di Delete.');
        return redirect()->to('operator/datasiswa');
    }

    // nampilin data Guru
    public function dataguru()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'SUZURAN | OPERATOR',
            'guru' => $this->gurumodel->getguru(),
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
            'user' => $this->user->findAll(),
            'mapel' => $this->mapel->getmapel(),
            'inner' => $this->gurumodel->joinguru(),
        ];
        return view('operator/data_guru/index', $data);
    }

    // tambah data guru
    public function tambahguru()
    {
        $guru = 'guru';
        $db      = \Config\Database::connect();
        $this->builder = $db->table('users');
        $this->builder->select('users.id as userid, username, email, user_image, name, description, password_hash');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('auth_groups.name', $guru);
        $query = $this->builder->get();
        $data = [
            'judul' => 'Form Tambah Data Guru',
            'validation' => \Config\Services::validation(),
            'guru' => $this->gurumodel->getguru(),
            'cek' => $this->operator->findAll(),
            'user' => $query->getResult(),
            'mapel' => $this->mapel->getmapel(),
        ];
        return view('operator/data_guru/create', $data);
    }

    // Save data guru
    public function saveguru()
    {
        if (!$this->validate([
            'id_mapel' => [
                'rules' => 'required|is_unique[guru.id_mapel]',
                'errors' => [
                    'required' => 'Nama Mapel Harus diisi.',
                    'is_unique' => 'Nama Mapel  Sudah terdaftar.'
                ]
            ],
            'id_akun' => [
                'rules' => 'required|is_unique[guru.id_akun]',
                'errors' => [
                    'required' => 'id akun Harus diisi',
                    'is_unique' => 'id akun Sudah terdaftar.'
                ]
            ],
            'nama_guru' => [
                'rules' => 'required|is_unique[guru.nama_guru]',
                'errors' => [
                    'required' => 'Nama Guru Harus diisi',
                    'is_unique' => 'Nama Guru Sudah terdaftar.'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Harus diisi',
                ]
            ],
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No Telepon Harus diisi',
                ]
            ],
        ])) {

            return redirect()->to('/operator/tambahguru')->withInput();
        }
        $this->gurumodel->save([
            'id_mapel' => $this->request->getVar('id_mapel'),
            'id_akun' => $this->request->getVar('id_akun'),
            'nama_guru' => $this->request->getVar('nama_guru'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telp' => $this->request->getVar('no_telp')
        ]);

        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan.');

        return redirect()->to('/operator/dataguru/');
    }

    // edit data guru
    public function editguru($id_guru)
    {
        // session();
        $guru = 'guru';
        $db      = \Config\Database::connect();
        $this->builder = $db->table('users');
        $this->builder->select('users.id as userid, username, email, user_image, name, description, password_hash');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('auth_groups.name', $guru);
        $query = $this->builder->get();
        $data = [
            'judul' => 'Form Edit Data Guru',
            'validation' => \Config\Services::validation(),
            'guru' => $this->gurumodel->getguru($id_guru),
            'user' => $query->getResult(),
            'cek' => $this->operator->findAll(),
            'mapel' => $this->mapel->getmapel(),
        ];
        return view('operator/data_guru/edit', $data);
    }

    public function saveeditguru()
    {
        // ambil data yang lama
        $namaguru =  $this->gurumodel->getguru($this->request->getVar('id_guru'));
        $id_akun =  $this->gurumodel->getguru($this->request->getVar('id_guru'));
        $id_mapel =  $this->gurumodel->getguru($this->request->getVar('id_guru'));

        //cek nama  diganti atau engga
        if ($namaguru['nama_guru'] == $this->request->getVar('nama_guru')) {
            $rule_guru = 'required';
        } else {
            $rule_guru = 'required|is_unique[guru.nama_guru]';
        }

        //cek id_mapel diganti atau engga
        if ($id_mapel['id_mapel'] == $this->request->getVar('id_mapel')) {
            $rule_idmapel = 'required';
        } else {
            $rule_idmapel = 'required|is_unique[guru.id_mapel]';
        }

        //cek id akun diganti atau engga
        if ($id_akun['id_akun'] == $this->request->getVar('id_akun')) {
            $rule_id_akun = 'required';
        } else {
            $rule_id_akun = 'required|is_unique[guru.id_akun]';
        }
        if (!$this->validate([
            'id_mapel' => [
                'rules' => $rule_idmapel,
                'errors' => [
                    'required' => 'Nama Mapel Harus diisi.',
                    'is_unique' => 'Nama Mapel  Sudah terdaftar.'
                ]
            ],
            'id_akun' => [
                'rules' => $rule_id_akun,
                'errors' => [
                    'required' => 'id akun Harus diisi',
                    'is_unique' => 'id akun Sudah terdaftar.'
                ]
            ],
            'nama_guru' => [
                'rules' => $rule_guru,
                'errors' => [
                    'required' => 'Nama Guru Harus diisi',
                    'is_unique' => 'Nama Guru Sudah terdaftar.'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Harus diisi',
                ]
            ],
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No Telepon Harus diisi',
                ]
            ],
        ])) {

            return redirect()->to('/operator/editguru/' . $this->request->getVar('id_guru'))->withInput();
        }

        $model = new GuruModel();
        $id_guru = $this->request->getPost('id_guru');
        $data = array(
            'id_akun' => $this->request->getVar('id_akun'),
            'id_mapel' => $this->request->getVar('id_mapel'),
            'nama_guru' => $this->request->getVar('nama_guru'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telp' => $this->request->getVar('no_telp')

        );
        $model->updateGuru($data, $id_guru);

        session()->setFlashdata('Pesan', 'Data Berhasil Di Ubah.');

        return redirect()->to('/operator/dataguru');
    }

    // delete data guru
    public function deleteguru()
    {
        $model = new GuruModel();
        $id_guru = $this->request->getPost('id_guru');
        $model->deleteguru($id_guru);
        session()->setFlashdata('Pesan', 'Data Berhasil Di Delete.');
        return redirect()->to('/operator/dataguru');
    }



    // menampilkan data kelas
    public function datakelas()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'Akademik | Operator',
            'kelas' => $this->kelasmodel->getkelas(),
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
        ];
        return view('operator/data_kelas/index', $data);
    }

    public function uploadkelas()
    {
        if ($this->request->getMethod() == "post") {
            $file = $this->request->getFile("file");
            $file_name = $file->getTempName();
            $kls = array();
            $csv_data = array_map('str_getcsv', file($file_name));
            if (count($csv_data) > 0) {
                $index = 0;
                foreach ($csv_data as $data) {
                    if ($index > 0) {
                        $kls[] = array(
                            "nama_kelas" => $data[1],
                        );
                    }
                    $index++;
                }
                $builder = $this->db->table('kelas');
                $builder->insertBatch($kls);
                $session = session();
                $session->setFlashdata("success", "data csv berhasil diupload");
                return redirect()->to('/operator/datakelas');
            }
        }
        return redirect()->to('/operator/datakelas');
    }
    public function uploadsiswa()
    {
        if ($this->request->getMethod() == "post") {
            $file = $this->request->getFile("file");
            $file_name = $file->getTempName();
            $siswa = array();
            $csv_data = array_map('str_getcsv', file($file_name));
            if (count($csv_data) > 0) {
                $index = 0;
                foreach ($csv_data as $data) {
                    if ($index > 0) {
                        $siswa[] = array(
                            "id_akun" => $data[1],
                            "nis" => $data[2],
                            "nama_lengkap" => $data[3],
                            "alamat" => $data[4],
                            "tgl_lahir" => $data[5],
                            "tempat_lahir" => $data[6],
                            "agama" => $data[7],
                            "nama_orang_tua" => $data[8],
                            "alamat_ortu" => $data[9],
                            "no_telp_ortu" => $data[10],
                            "jurusan" => $data[11],
                            "jenis_kelamin" => $data[12],
                        );
                    }
                    $index++;
                }
                $builder = $this->db->table('siswa');
                $builder->insertBatch($siswa);
                $session = session();
                $session->setFlashdata("success", "data csv berhasil diupload");
                return redirect()->to('/operator/datasiswa');
            }
        }
        return redirect()->to('/operator/datakelas');
    }

    // tambah kelas
    public function tambahkelas()
    {
        $data = [
            'judul' => 'Form Tambah Data Kelas',
            'validation' => \Config\Services::validation(),
            'cek' => $this->operator->findAll(),
        ];
        return view('operator/data_kelas/create', $data);
    }

    //save data kelas
    public function savekelas()
    {
        if (!$this->validate([
            'nama_kelas' => [
                'rules' => 'required|is_unique[kelas.nama_kelas]',
                'errors' => [
                    'required' => 'Kelas Harus diisi.',
                    'is_unique' => 'Kelas Lengkap Sudah terdaftar.'
                ]
            ],

        ])) {

            return redirect()->to('/operator/tambahkelas')->withInput();
        }
        $this->kelasmodel->save([
            'nama_kelas' => $this->request->getVar('nama_kelas'),
        ]);

        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan.');

        return redirect()->to('/operator/datakelas');
    }

    // edit data kelas
    public function editdatakelas($id_kelas)
    {
        $data = [
            'judul' => 'Form Edit Data Kelas',
            'validation' => \Config\Services::validation(),
            'cek' => $this->operator->findAll(),
            'kelas' => $this->kelasmodel->getkelas($id_kelas),
        ];
        return view('operator/data_kelas/edit', $data);
    }

    //save editdata kelas
    public function saveeditkelas()
    {
        // ambil data yang lama
        $namakelaslama = $this->kelasmodel->getkelas(($this->request->getVar('id_kelas')));

        //cek nama kelas diganti atau engga
        if ($namakelaslama['nama_kelas'] == $this->request->getVar('nama_kelas')) {
            $rule_nama = 'required';
        } else {
            $rule_nama = 'required|is_unique[kelas.nama_kelas]';
        }
        if (!$this->validate([
            'nama_kelas' => [
                'rules' => $rule_nama,
                'errors' => [
                    'required' => 'Kelas Harus diisi.',
                    'is_unique' => 'Kelas Lengkap Sudah terdaftar.'
                ]
            ],

        ])) {

            return redirect()->to('/operator/editkelas' . $this->request->getVar('id_kelas'))->withInput();
        }

        $model = new KelasModel();
        $id_kelas = $this->request->getPost('id');
        $data = array(
            'nama_kelas' => $this->request->getVar('nama_kelas'),
        );
        $model->updateKelas($data, $id_kelas);

        session()->setFlashdata('Pesan', 'Data Berhasil Di Ubah.');

        return redirect()->to('/operator/datakelas');
    }
    public function deletekelas()
    {
        $model = new KelasModel();
        $id_kelas = $this->request->getPost('id');
        $model->deleteKelas($id_kelas);
        session()->setFlashdata('Pesan', 'Data Berhasil Di Delete.');
        return redirect()->to('/operator/datakelas');
    }

    // menampilkan data jurusan
    public function datajurusan()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'Akademik | Operator',
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
            'jurusan' => $this->jurusan->getjurusan()
        ];
        return view('operator/data_jurusan/index', $data);
    }

    // tambah jurusan
    public function tambahjurusan()
    {
        $data = [
            'judul' => 'Form Tambah Data jurusan',
            'validation' => \Config\Services::validation(),
            'cek' => $this->operator->findAll(),
            'jurusan' => $this->jurusan->getjurusan(),
            'kelas' => $this->kelasmodel->getkelas(),
        ];
        return view('operator/data_jurusan/create', $data);
    }

    // save jurusan
    public function savejurusan()
    {
        if (!$this->validate([
            'jurusan' => [
                'rules' => 'required|is_unique[jurusan.jurusan]',
                'errors' => [
                    'required' => 'Jurusan Harus diisi.',
                    'is_unique' => 'Jurusan Sudah terdaftar.'
                ]
            ],
            'id_kelas' => [
                'rules' => 'required|is_unique[jurusan.id_kelas]',
                'errors' => [
                    'required' => 'id_kelas Harus diisi.',
                    'is_unique' => 'id_kelas Sudah terdaftar.'
                ]
            ],

        ])) {

            return redirect()->to('/operator/tambahjurusan')->withInput();
        }
        $this->jurusan->save([
            'jurusan' => $this->request->getVar('jurusan'),
            'id_kelas' => $this->request->getVar('id_kelas'),

        ]);

        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan.');

        return redirect()->to('operator/datajurusan/');
    }

    // edit jurusan
    public function editjurusan($id_jurusan)
    {
        $data = [
            'judul' => 'Form Tambah Data jurusan',
            'validation' => \Config\Services::validation(),
            'jurusan' => $this->jurusan->getjurusan($id_jurusan),
            'cek' => $this->operator->findAll(),
            'kelas' => $this->kelasmodel->getkelas(),
        ];
        return view('operator/data_jurusan/edit', $data);
    }

    //save edit jurusan
    public function saveeditjurusan()
    {
        // ambil data yang lama
        $nama_jurusanlama = $this->jurusan->getjurusan(($this->request->getVar('id_jurusan')));
        $id_kelaslama = $this->jurusan->getjurusan(($this->request->getVar('id_jurusan')));

        //cek nama jurusan diganti atau engga
        if ($nama_jurusanlama['jurusan'] == $this->request->getVar('jurusan')) {
            $rule_jurusan = 'required';
        } else {
            $rule_jurusan = 'required|is_unique[jurusan.jurusan]';
        }

        //cek id kelas diganti atau engga
        if ($id_kelaslama['id_kelas'] == $this->request->getVar('id_kelas')) {
            $rule_idkelas = 'required';
        } else {
            $rule_idkelas = 'required|is_unique[jurusan.id_kelas]';
        }
        if (!$this->validate([
            'jurusan' => [
                'rules' => $rule_jurusan,
                'errors' => [
                    'required' => 'Jurusan Harus diisi.',
                    'is_unique' => 'Jurusan Sudah terdaftar.'
                ]
            ],
            'id_kelas' => [
                'rules' => $rule_idkelas,
                'errors' => [
                    'required' => 'id_kelas Harus diisi.',
                    'is_unique' => 'id_kelas  Sudah terdaftar.'
                ]
            ],

        ])) {

            return redirect()->to('/operator/editjurusan' . $this->request->getVar('id_jurusan'))->withInput();
        }
        $id_jurusan = $this->request->getPost('id_jurusan');
        $data = array(
            'jurusan' => $this->request->getPost('jurusan'),
            'id_kelas' => $this->request->getPost('id_kelas')
        );
        $this->jurusan->updatejurusan($data, $id_jurusan);

        session()->setFlashdata('Pesan', 'Data Berhasil Di Ubah.');

        return redirect()->to('operator/datajurusan/');
    }

    //detele jurusan
    public function deletejurusan()
    {
        $id_jurusan = $this->request->getPost('id_jurusan');
        $this->jurusan->deletejurusan($id_jurusan);
        session()->setFlashdata('Pesan', 'Data Berhasil Di Delete.');
        return redirect()->to('operator/data_jurusan/');
    }
    // menampilkan data matapelajaran

    //MAPEL

    public function datamapel()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'Akademik | Administrator',
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
            'mapel' => $this->mapel->orderBy('nama_mapel', 'DESC')->findAll()
        ];
        return view('operator/data_mapel/index', $data);
    }

    // tambah mapel
    public function tambahmapel()
    {
        $data = [
            'judul' => 'Form Tambah Data Mapel',
            'validation' => \Config\Services::validation(),
            'cek' => $this->operator->findAll(),
            'mapel' => $this->mapel->getmapel(),
            'kelas' => $this->kelasmodel->getkelas(),
        ];
        return view('operator/data_mapel/create', $data);
    }

    //save mapel
    public function savemapel()
    {
        if (!$this->validate([
            'nama_mapel' => [
                'rules' => 'required|is_unique[mapel.nama_mapel]',
                'errors' => [
                    'required' => 'Mata Pelajaran Harus diisi.',
                    'is_unique' => 'Mata Pelajaran Sudah terdaftar.'
                ]
            ],
            'id_kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelas Harus diisi.',
                ]
            ],

        ])) {

            return redirect()->to('/operator/tambahmapel')->withInput();
        }
        $this->mapel->save([
            'nama_mapel' => $this->request->getVar('nama_mapel'),
            'id_kelas' => $this->request->getVar('id_kelas'),

        ]);
        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan.');
        return redirect()->to('operator/datamapel/');
    }
    public function editmapel($id_mapel)
    {
        $data = [
            'judul' => 'Form Edit Data Mapel',
            'validation' => \Config\Services::validation(),
            'mapel' => $this->mapel->getmapel($id_mapel),
            'cek' => $this->operator->findAll(),
            'kelas' => $this->kelasmodel->getkelas(),
        ];
        return view('operator/data_mapel/edit', $data);
    }
    public function saveeditmapel()
    {
        // ambil data yang lama
        $nama_mapellama = $this->mapel->getmapel(($this->request->getVar('id_mapel')));

        //cek nama mapel diganti atau engga
        if ($nama_mapellama['nama_mapel'] == $this->request->getVar('nama_mapel')) {
            $rule_mapel = 'required';
        } else {
            $rule_mapel = 'required|is_unique[mapel.nama_mapel]';
        }

        if (!$this->validate([
            'nama_mapel' => [
                'rules' => $rule_mapel,
                'errors' => [
                    'required' => 'Nama Mata Pelajaran Harus diisi.',
                    'is_unique' => 'Nama Mata Pelajaran Sudah terdaftar.'
                ]
            ],
            'id_kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ID kelas Harus diisi.',
                ]
            ],

        ])) {

            return redirect()->to('/operator/editmapel' . $this->request->getVar('id_mapel'))->withInput();
        }
        $model = new MapelModel();
        $id_mapel = $this->request->getPost('id_mapel');
        $data = array(
            'nama_mapel' => $this->request->getVar('nama_mapel'),
            'id_kelas' => $this->request->getVar('id_kelas'),
        );
        $model->updatemapel($data, $id_mapel);

        session()->setFlashdata('Pesan', 'Data Berhasil Di Ubah.');

        return redirect()->to('/operator/datamapel');
    }
    public function deletedatamapel()
    {
        $model = new MapelModel();
        $id_mapel = $this->request->getPost('id_mapel');
        $model->deletemapel($id_mapel);
        session()->setFlashdata('Pesan', 'Data Berhasil Di Delete.');
        return redirect()->to('/operator/datamapel');
    }

    // data tahun ajaran
    public function datatahunajaran()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'Akademik | Administrator',
            'tahun_ajaran' => $this->tahunajaranmodel->gettahun(),
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
        ];
        return view('operator/data_tahunajaran/index', $data);
    }

    // tambah mapel
    public function tambahtahunajaran()
    {
        $data = [
            'judul' => 'Form Tambah Data Mapel',
            'cek' => $this->operator->findAll(),
            'validation' => \Config\Services::validation(),
            'tahun_ajaran' => $this->tahunajaranmodel->gettahun(),
            'jurusan' => $this->jurusan->getjurusan(),
        ];
        return view('operator/data_tahunajaran/create', $data);
    }

    //update
    public function savetahunajaran()
    {
        $this->tahunajaranmodel->save([
            'tahun_ajaran' => $this->request->getVar('tahun_ajaran'),
            'id_jurusan' => $this->request->getVar('id_jurusan'),

        ]);
        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan.');
        return redirect()->to('operator/datatahunajaran/');
    }
    public function edittahunajaran($id_ajaran)
    {
        $data = [
            'judul' => 'Form Tambah Data tahun AJaran',
            'validation' => \Config\Services::validation(),
            'cek' => $this->operator->findAll(),
            'tahun_ajaran' => $this->tahunajaranmodel->gettahun($id_ajaran),
            'jurusan' => $this->jurusan->getjurusan(),
        ];
        return view('operator/data_tahunajaran/edit', $data);
    }
    public function saveedittahunajaran()
    {
        // ambil data yang lama
        $tahunlama = $this->tahunajaranmodel->gettahun(($this->request->getVar('id_ajaran')));
        $id_jurusan1 = $this->tahunajaranmodel->gettahun(($this->request->getVar('id_ajaran')));

        //cek tahun ajaran diganti atau engga
        if ($tahunlama['tahun_ajaran'] == $this->request->getVar('tahun_ajaran')) {
            $rule_ajaran = 'required';
        } else {
            $rule_ajaran = 'required|is_unique[tahun_ajaran.tahun_ajaran]';
        }

        //cek id jurusan diganti atau engga
        if ($tahunlama['id_jurusan'] == $this->request->getVar('id_jurusan')) {
            $rule_ajaran = 'required';
        } else {
            $rule_ajaran = 'required|is_unique[tahun_ajaran.id_jurusan]';
        }
        if (!$this->validate([
            'tahun_ajaran' => [
                'rules' => $rule_ajaran,
                'errors' => [
                    'required' => 'Tahun ajaran Harus diisi.',
                    'is_unique' => 'Tahun ajaran Sudah terdaftar.'
                ]
            ],
            'id_jurusan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ID Jurusan Harus diisi.',
                    'is_unique' => 'ID Jurusan Sudah terdaftar.'
                ]
            ],

        ])) {

            return redirect()->to('/operator/edittahunajaran' . $this->request->getVar('id_ajaran'))->withInput();
        }
        $model = new tahunajaranModel();
        $id_ajaran = $this->request->getPost('id_ajaran');
        $data = array(
            'tahun_ajaran' => $this->request->getVar('tahun_ajaran'),
        );
        $model->updatetahun($data, $id_ajaran);

        session()->setFlashdata('Pesan', 'Data Berhasil Di Ubah.');
        return redirect()->to('/operator/datatahunajaran');
    }
    public function deletedatatahunajaran()
    {
        $model = new TahunajaranModel();
        $id_ajaran = $this->request->getPost('id_ajaran');
        $model->deletetahun($id_ajaran);
        session()->setFlashdata('Pesan', 'Data Berhasil Di Delete.');
        return redirect()->to('/operator/datatahunajaran');
    }

    // master data pelajaran
    public function masterdatapelajaran()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'SUZURAN | Operator',
            'masterdata' => $this->masterdata->joindata(),
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
        ];
        return view('operator/masterdata/masterdata', $data);
    }

    //tambah masterdata
    public function tambahmasterdatapelajaran()
    {
        $data = [
            'judul' => 'Form Tambah Data MasterData Pelajaran',
            'guru' => $this->gurumodel->getguru(),
            'cek' => $this->operator->findAll(),
            'jurusan' => $this->jurusan->getjurusan(),
            'nis' => $this->siswamodel->findAll(),
            'kelas' => $this->kelasmodel->getkelas(),
            'validation' => \Config\Services::validation(),
            'tahunajaran' => $this->tahunajaranmodel->gettahun()
        ];
        return view('operator/masterdata/add', $data);
    }
    public function savemasterdatapelajaran()
    {
        //validasi
        if (!$this->validate([
            'tahun_ajaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun Ajaran Harus diisi.',
                ]
            ],
            'id' => [
                'rules' => 'required|is_unique[masterdatapelajaran.id]',
                'errors' => [
                    'required' => 'Nomor induk siswa harus di isi',
                    'is_unique' => 'Nis sudah didaftarkan'
                ]
            ],
            'kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'kelas Harus diisi.',
                ]
            ],
            'jurusan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jurusan Harus diisi.',
                ]
            ],
            'nama_walikelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wali Kelas Harus diisi.',
                ]
            ],
        ])) {
            return redirect()->to('/operator/tambahmasterdatapelajaran')->withInput();
        }
        $this->masterdata->save([
            'id_ajaran' => $this->request->getVar('tahun_ajaran'),
            'id_siswa' => $this->request->getVar('id'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'id_kelas' => $this->request->getVar('kelas'),
            'id_jurusan' => $this->request->getVar('jurusan'),
            'id_guru' => $this->request->getVar('nama_walikelas')
        ]);
        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan.');

        return redirect()->to('operator/masterdatapelajaran');
    }

    public function editmasterdatapelajaran($id_master)
    {
        $data = [
            'judul' => 'SUZURAN | Admin',
            'masterdata' => $this->masterdata->getmasterdata($id_master),
            'guru' => $this->gurumodel->getguru(),
            'cek' => $this->operator->findAll(),
            'jurusan' => $this->jurusan->getjurusan(),
            'nis' => $this->siswamodel->getsiswa(),
            'kelas' => $this->kelasmodel->getkelas(),
            'tahunajaran' => $this->tahunajaranmodel->gettahun(),
            'validation' => \Config\Services::validation(),
        ];
        return view('operator/masterdata/update', $data);
    }

    public function saveeditmasterdatapelajaran()
    {
        $id_master = $this->request->getVar('id_master');
        $nis = $this->masterdata->getmasterdata($id_master);
        //cek tahun ajaran diganti atau engga
        if ($nis['id_siswa'] == $this->request->getVar('id')) {
            $rulenis = 'required';
        } else {
            $rulenis = 'required|is_unique[masterdatapelajaran.id]';
        }
        //validasi
        if (!$this->validate([
            'tahun_ajaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun Ajaran Harus diisi.',
                ]
            ],
            'id' => [
                'rules' => $rulenis,
                'errors' => [
                    'required' => 'Nomor induk siswa harus di isi',
                    'is_unique' => 'Nis sudah didaftarkan'
                ]
            ],
            'kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'kelas Harus diisi.',
                ]
            ],
            'jurusan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jurusan Harus diisi.',
                ]
            ],
            'nama_walikelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wali Kelas Harus diisi.',
                ]
            ],
        ])) {
            return redirect()->to('/operator/editmasterdatapelajaran/' . $id_master)->withInput();
        }


        $model = new MasterdataModel();
        $idam = $this->request->getPost('id_master');
        $data = [
            'id_ajaran' => $this->request->getVar('tahun_ajaran'),
            'id_siswa' => $this->request->getVar('id'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'id_kelas' => $this->request->getVar('kelas'),
            'id_jurusan' => $this->request->getVar('jurusan'),
            'id_guru' => $this->request->getVar('nama_walikelas'),
        ];
        $model->update_data($data, $idam);
        session()->setFlashdata('Pesan', 'Data Berhasil Diupdate.');

        return redirect()->to('operator/masterdatapelajaran');
    }

    // laporan siswa
    public function laporansiswa()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'SUZURAN | Operator',
            'siswa' => $this->siswamodel->getsiswa(),
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
            'jurusan' => $this->jurusan->getjurusan(),
        ];
        return view('operator/laporan/laporansiswa', $data);
    }

    // Laporan Guru
    public function laporanguru()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'SUZURAN | Operator',
            'guru' => $this->gurumodel->joinguru(),
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
            'mapel' => $this->mapel->getmapel()
        ];
        return view('operator/laporan/laporanguru', $data);
    }

    // Laporan Mapel
    public function laporanmapel()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'SUZURAN | Operator',
            'kelas' => $this->kelasmodel->getkelas(),
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
            'masterdata' => $this->masterdata->joindata(),
        ];
        return view('operator/laporan/laporanmapel', $data);
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
            'judul' => 'SUZURAN | OPERATOR',
            'users' => $query->getRow(),
            'guru' => $this->gurumodel->detailakun($id),
            'mapel' => $this->mapel->getmapel(),
            'operator' => $this->operator->detailakun($id),
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/detailakun', $data);
    }

    public function lengkapi($id)
    {
        $db      = \Config\Database::connect();
        $this->builder = $db->table('users');
        $this->builder->select('users.id as userid, username, email, user_image, name, description, password_hash');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();
        $data = [
            'users' => $query->getRow(),
            'judul' => 'SUZURAN | OPERATOR',
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/lengkapi_akun', $data);
    }

    //save lengkapi
    public function saveoperator()
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
                'rules' => 'required|is_unique[operator.No_Telp]',
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

            return redirect()->to('/operator/lengkapi/' . $this->request->getVar('id'))->withInput();
        }
        $this->operator->save([
            'id_akun'   => $this->request->getVar('id'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'Alamat'        => $this->request->getVar('alamat'),
            'No_Telp'       => $this->request->getVar('no_telp'),
            'tgl_lahir'     => $this->request->getVar('tgl_lahir'),
            'tempat_lahir'  => $this->request->getVar('tempat_lahir'),
            'agama'     => $this->request->getVar('agama')

        ]);
        return redirect()->to('operator/profile/' . $this->request->getVar('id'));
    }

    //update
    public function editoperator()
    {
        $nplama = $this->operator->getoperator(($this->request->getVar('id_operator')));

        //cek tahun ajaran diganti atau engga
        if ($nplama['No_Telp'] == $this->request->getVar('no_telp')) {
            $rule_asw = 'required';
        } else {
            $rule_asw = 'required|is_unique[operator.No_Telp]';
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

            return redirect()->to('/operator/profile/' . $this->request->getVar('id'))->withInput();
        }
        $this->operator->save([
            'id_operator' => $this->request->getVar('id_operator'),
            'id_akun'   => $this->request->getVar('id'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'Alamat'        => $this->request->getVar('alamat'),
            'No_Telp'       => $this->request->getVar('no_telp'),
            'tgl_lahir'     => $this->request->getVar('tgl_lahir'),
            'tempat_lahir'  => $this->request->getVar('tempat_lahir'),
            'agama'     => $this->request->getVar('agama')

        ]);
        return redirect()->to('operator/profile/' . $this->request->getVar('id'));
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

        return redirect()->to('/operator/profile/' . $this->request->getVar('id'));
    }

    public function datajadwal($user_id)
    {
        $data = [
            'judul' => 'SUZURAN | Operator',
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
            'jadwal' => $this->jadwal->joinjadwal()
        ];
        return view('operator/jadwal/index', $data);
    }

    public function tambahjadwal()
    {
        $data = [
            'judul' => 'SUZURAN | Operator',
            'jurusan' => $this->jurusan->getjurusan(),
            'jadwal' => $this->jadwal->joinjadwal(),
            'kelas' => $this->kelasmodel->findAll(),
            'mapel' => $this->mapel->findAll()
        ];
        return view('operator/jadwal/add', $data);
    }
    public function getdataprov()
    {
        $searchTerm = $this->input->post('searchTerm');
        $response   = $this->jadwal->getprov($searchTerm);
        echo json_encode($response);
    }
    public function getdatakab($id_kelas)
    {
        $searchTerm = $this->input->post('searchTerm');
        $response   = $this->jadwal->getkab($id_kelas, $searchTerm);
        echo json_encode($response);
    }
}
