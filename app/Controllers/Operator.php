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
use App\Models\RaportModel;
use App\Models\RaportDetailModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;

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
          protected $raport;
    protected $raportdetail;

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
         $this->raport = new RaportModel();
        $this->raportdetail = new RaportDetailModel();
    }

    public function index()
    {
        $user_id = user_id();
        $data = [
            'cek' => $this->operator->findAll(),
            'judul' => 'SUZURAN | OPERATOR',
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
            'jumlahsiswa' => $this->siswamodel->countAllResults(),
            'jumlahguru'  => $this->gurumodel->countAllResults(),
            'jumlahkelas'  => $this->kelasmodel->countAllResults(),
        ];
        return view('operator/index', $data);
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
        $user_id = user_id();
        $data = [
            'judul' => 'Form Tambah Data Siswa',
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
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
         $SiswaID = $this->siswamodel->insertID();
        $dataJurusan = $this->jurusan->where('jurusan',$this->request->getVar('jurusan'))->first();
        $this->raport->save([
            'id_siswa' => $SiswaID,
            'id_ajaran' => 3,
            'id_jurusan' => $dataJurusan['id_jurusan'],
            'id_kelas' =>  3,
        ]);
        $raportID = $this->raport->insertID();
        $dataMapel = $this->mapel->findAll();
        foreach ($dataMapel as $k) {
             $this->raportdetail->save([
                'id_raport' => $raportID,
                'id_mapel' =>  $k['id_mapel'],
                'id_nilai' => 0,
             ]);
        }
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
        $user_id = user_id();
        $data = [
            'judul' => 'Form Edit Data Siswa',
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
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

    public function exportsiswaxlxs()
    {
        $siswa = $this->siswamodel->findAll();

        $as = 'siswa';
        $db      = \Config\Database::connect();
        $this->builder = $db->table('users');
        $this->builder->select('users.id as userid, username, email, user_image, name, description, password_hash');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('auth_groups.name', $as);
        $query = $this->builder->get();
        $user = $query->getResultArray();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID AKUN')
            ->setCellValue('B1', 'NOMER INDUK SISWA')
            ->setCellValue('C1', 'NAMA LENGKAP')
            ->setCellValue('D1', 'ALAMAT')
            ->setCellValue('E1', 'NOMER TELPON')
            ->setCellValue('F1', 'TANGGAL LAHIR')
            ->setCellValue('G1', 'TEMPAT LAHIR')
            ->setCellValue('H1', 'AGAMA')
            ->setCellValue('I1', 'NAMA ORANGTUA')
            ->setCellValue('J1', 'ALAMAT ORANGTUA')
            ->setCellValue('K1', 'NOMER TELP ORANGTUA')
            ->setCellValue('L1', 'JURUSAN')
            ->setCellValue('M1', 'JENIS_KELAMIN')
            ->setCellValue('O1', 'ID AKUN TERDAFTAR')
            ->setCellValue('P1', 'USERNAME TERDAFTAR')
            ->setCellValue('Q1', 'EMAIL TERDAFTAR');

        $column = 2;

        foreach ($siswa as $as) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $as['id_akun'])
                ->setCellValue('B' . $column, $as['nis'])
                ->setCellValue('C' . $column, $as['nama_lengkap'])
                ->setCellValue('D' . $column, $as['alamat'])
                ->setCellValue('E' . $column, $as['no_telp'])
                ->setCellValue('F' . $column, $as['tgl_lahir'])
                ->setCellValue('G' . $column, $as['tempat_lahir'])
                ->setCellValue('H' . $column, $as['agama'])
                ->setCellValue('I' . $column, $as['nama_orang_tua'])
                ->setCellValue('J' . $column, $as['alamat_ortu'])
                ->setCellValue('K' . $column, $as['no_telp_ortu'])
                ->setCellValue('L' . $column, $as['jurusan'])
                ->setCellValue('M' . $column, $as['jenis_kelamin']);
            $column++;
        }

        foreach ($user as $us) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('O' . $column, $us['userid'])
                ->setCellValue('P' . $column, $us['username'])
                ->setCellValue('Q' . $column, $us['email']);
            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His') . '-Data-Siswa';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function uploadsiswa()
    {
        $file_excel = $this->request->getFile('fileexcel');
        $ext = $file_excel->getClientExtension();
        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file_excel);

        $data = $spreadsheet->getActiveSheet()->toArray();
        foreach ($data as $x => $row) {
            if ($x == 0) {
                continue;
            }

            $id_akun = $row[0];
            $nis = $row[1];
            $nama_lengkap = $row[2];
            $alamat = $row[3];
            $no_telp = $row[4];
            $tgl_lahir = $row[5];
            $tempat_lahir = $row[6];
            $agama = $row[7];
            $nama_orang_tua = $row[8];
            $alamat_ortu = $row[9];
            $no_telp_ortu = $row[10];
            $jurusan = $row[11];
            $jenis_kelamin = $row[12];

            $db = \Config\Database::connect();

            $cekNis = $db->table('siswa')->getWhere(['nis' => $nis])->getResult();
            // $cekid_akun = $db->table('siswa')->getWhere(['id_akun' => $id_akun])->getResult();
            if (count($cekNis) > 0) {
                session()->setFlashdata('pesan', 'Data Gagal di Import NIS ada yang sama');
            } else {

                $simpandata = [
                    'id_akun'       => $id_akun,
                    'nis'           => $nis,
                    'nama_lengkap'  => $nama_lengkap,
                    'alamat'        => $alamat,
                    'no_telp'       => $no_telp,
                    'tgl_lahir'     => $tgl_lahir,
                    'tempat_lahir'  => $tempat_lahir,
                    'agama'         => $agama,
                    'nama_orang_tua' => $nama_orang_tua,
                    'alamat_ortu'   => $alamat_ortu,
                    'no_telp_ortu'  => $no_telp_ortu,
                    'jurusan'       => $jurusan,
                    'jenis_kelamin' => $jenis_kelamin
                ];

                $db->table('siswa')->insert($simpandata);
                session()->setFlashdata('pesan', 'Berhasil import excel');
            }
        }
        return redirect()->to('/operator/datasiswa');
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
        $user_id = user_id();
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
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
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
        $user_id = user_id();
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
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
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

    public function exportguruxlxs()
    {
        $guru = $this->gurumodel->findAll();
        $mapel = $this->mapel->findAll();
        $as = 'guru';
        $db      = \Config\Database::connect();
        $this->builder = $db->table('users');
        $this->builder->select('users.id as userid, username, email, user_image, name, description, password_hash');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('auth_groups.name', $as);
        $query = $this->builder->get();
        $user = $query->getResultArray();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID MAPEL')
            ->setCellValue('B1', 'ID AKUN')
            ->setCellValue('C1', 'NAMA GURU')
            ->setCellValue('D1', 'ALAMAT')
            ->setCellValue('E1', 'NOMER TELPON')
            ->setCellValue('G1', 'ID MAPEL TERDAFTAR')
            ->setCellValue('H1', 'NAMA MAPEL TERDAFTAR')
            ->setCellValue('J1', 'ID AKUN TERDAFTAR')
            ->setCellValue('K1', 'USERNAME TERDAFTAR')
            ->setCellValue('L1', 'EMAIL TERDAFTAR');

        $column = 2;

        foreach ($guru as $as) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $as['id_mapel'])
                ->setCellValue('B' . $column, $as['id_akun'])
                ->setCellValue('C' . $column, $as['nama_guru'])
                ->setCellValue('D' . $column, $as['alamat'])
                ->setCellValue('E' . $column, $as['no_telp']);
            $column++;
        }
        $column = 2;
        foreach ($mapel as $map) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('G' . $column, $map['id_mapel'])
                ->setCellValue('H' . $column, $map['nama_mapel']);
            $column++;
        }
        $column = 2;
        foreach ($user as $us) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('J' . $column, $us['userid'])
                ->setCellValue('K' . $column, $us['username'])
                ->setCellValue('L' . $column, $us['email']);
            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His') . '-Data-Guru';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function uploadguru()
    {
        $file_excel = $this->request->getFile('fileexcel');
        $ext = $file_excel->getClientExtension();
        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file_excel);

        $data = $spreadsheet->getActiveSheet()->toArray();
        foreach ($data as $x => $row) {
            if ($x == 0) {
                continue;
            }

            $id_mapel = $row[0];
            $id_akun = $row[1];
            $nama_guru = $row[2];
            $alamat = $row[3];
            $no_telp = $row[4];

            $db = \Config\Database::connect();

            $cekmapel = $db->table('guru')->getWhere(['id_mapel' => $id_mapel])->getResult();
            $cekid_akun = $db->table('guru')->getWhere(['id_akun' => $id_akun])->getResult();
            if (count($cekmapel) > 0) {
                session()->setFlashdata('pesan', 'Data Gagal di Import ID Mapel ada yang sama');
            } elseif (count($cekid_akun) > 0) {
                session()->setFlashdata('pesan', 'Data Gagal di Import ID Akun ada yang sama');
            } else {

                $simpandata = [
                    'id_mapel'      => $id_mapel,
                    'id_akun'       => $id_akun,
                    'nama_guru'     => $nama_guru,
                    'alamat'        => $alamat,
                    'no_telp'       => $no_telp,
                ];

                $db->table('guru')->insert($simpandata);
                session()->setFlashdata('pesan', 'Berhasil import excel');
            }
        }
        return redirect()->to('/operator/dataguru');
    }

    // menampilkan data kelas
    public function datakelas()
    {
        $db      = \Config\Database::connect();
        $this->builder = $db->table('jurusan');
        $this->builder->join('kelas', 'kelas.id_jurusan = jurusan.id_jurusan');
        $query = $this->builder->get();
        $user_id = user_id();
        $data = [
            'judul' => 'Akademik | Operator',
            'kelas' => $query->getResultArray(),
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
        ];
        return view('operator/data_kelas/index', $data);
    }


    public function exportkelasxlxs()
    {
        $kelas = $this->kelasmodel->findAll();
        $jurusan = $this->jurusan->findAll();
        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NAMA KELAS')
            ->setCellValue('B1', 'ID JURUSAN')
            ->setCellValue('D1', 'ID JURUSAN TERDAFTAR')
            ->setCellValue('E1', 'JURUSAN TERDAFTAR');

        $column = 2;

        foreach ($kelas as $as) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $as['nama_kelas'])
                ->setCellValue('B' . $column, $as['id_jurusan']);
            $column++;
        }

        $column = 2;

        foreach ($jurusan as $jur) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('D' . $column, $jur['id_jurusan'])
                ->setCellValue('E' . $column, $jur['jurusan']);
            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His') . '-Data-Kelas';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function uploadkelas()
    {
        $file_excel = $this->request->getFile('fileexcel');
        $ext = $file_excel->getClientExtension();
        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file_excel);

        $data = $spreadsheet->getActiveSheet()->toArray();
        foreach ($data as $x => $row) {
            if ($x == 0) {
                continue;
            }

            $nama_kelas = $row[0];
            $id_jurusan = $row[1];

            $db = \Config\Database::connect();

            $ceknama_kelas = $db->table('kelas')->getWhere(['nama_kelas' => $nama_kelas])->getResult();
            if (count($ceknama_kelas) > 0) {
                session()->setFlashdata('pesan', 'Data Gagal di Import ID Mapel ada yang sama');
            } else {

                $simpandata = [
                    'nama_kelas'      => $nama_kelas,
                    'id_jurusan'      => $id_jurusan,
                ];

                $db->table('kelas')->insert($simpandata);
                session()->setFlashdata('pesan', 'Berhasil import excel');
            }
        }
        return redirect()->to('/operator/datakelas');
    }


    // tambah kelas
    public function tambahkelas()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'Form Tambah Data Kelas',
            'validation' => \Config\Services::validation(),
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
            'jurusan' => $this->jurusan->findAll()
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
            'jurusan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelas Harus diisi.',
                ]
            ],

        ])) {

            return redirect()->to('/operator/tambahkelas')->withInput();
        }
        $this->kelasmodel->save([
            'nama_kelas' => $this->request->getVar('nama_kelas'),
            'id_jurusan' => $this->request->getVar('jurusan')
        ]);

        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan.');

        return redirect()->to('/operator/datakelas');
    }

    // edit data kelas
    public function editdatakelas($id_kelas)
    {
        $user_id = user_id();
        $data = [
            'judul' => 'Form Edit Data Kelas',
            'validation' => \Config\Services::validation(),
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
            'kelas' => $this->kelasmodel->getkelas($id_kelas),
            'jurusan' => $this->jurusan->findAll(),
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
            'jurusan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelas Harus diisi.',
                ]
            ],

        ])) {

            return redirect()->to('/operator/editkelas' . $this->request->getVar('id_kelas'))->withInput();
        }

        $model = new KelasModel();
        $id_kelas = $this->request->getPost('id');
        $data = array(
            'nama_kelas' => $this->request->getVar('nama_kelas'),
            'id_jurusan' => $this->request->getVar('jurusan'),
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
        $db      = \Config\Database::connect();
        $this->builder = $db->table('jurusan');
        $this->builder->join('tahun_ajaran', 'tahun_ajaran.id_ajaran=jurusan.id_ajaran');
        $query = $this->builder->get();
        $user_id = user_id();
        $data = [
            'judul' => 'Akademik | Operator',
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
            'jurusan' => $query->getResultArray()
        ];
        return view('operator/data_jurusan/index', $data);
    }

    // tambah jurusan
    public function tambahjurusan()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'Form Tambah Data jurusan',
            'validation' => \Config\Services::validation(),
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
            'tahunajaran' => $this->tahunajaranmodel->findAll(),
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
            'tahun_ajaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun Ajaran Harus diisi.'
                ]
            ],

        ])) {

            return redirect()->to('/operator/tambahjurusan')->withInput();
        }
        $this->jurusan->save([
            'jurusan' => $this->request->getVar('jurusan'),
            'id_ajaran' => $this->request->getVar('tahun_ajaran'),

        ]);

        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan.');

        return redirect()->to('operator/datajurusan/');
    }

    // edit jurusan
    public function editjurusan($id_jurusan)
    {
        $user_id = user_id();
        $data = [
            'judul' => 'Form Tambah Data jurusan',
            'validation' => \Config\Services::validation(),
            'jurusan' => $this->jurusan->getjurusan($id_jurusan),
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
            'tahunajaran' => $this->tahunajaranmodel->findAll(),
        ];
        return view('operator/data_jurusan/edit', $data);
    }

    //save edit jurusan
    public function saveeditjurusan()
    {
        // ambil data yang lama
        $nama_jurusanlama = $this->jurusan->getjurusan(($this->request->getVar('id_jurusan')));

        //cek nama jurusan diganti atau engga
        if ($nama_jurusanlama['jurusan'] == $this->request->getVar('jurusan')) {
            $rule_jurusan = 'required';
        } else {
            $rule_jurusan = 'required|is_unique[jurusan.jurusan]';
        }

        if (!$this->validate([
            'jurusan' => [
                'rules' => $rule_jurusan,
                'errors' => [
                    'required' => 'Jurusan Harus diisi.',
                    'is_unique' => 'Jurusan Sudah terdaftar.'
                ]
            ],
            'tahun_ajaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun Ajaran Harus diisi.',
                ]
            ],

        ])) {

            return redirect()->to('/operator/editjurusan' . $this->request->getVar('id_jurusan'))->withInput();
        }
        $id_jurusan = $this->request->getPost('id_jurusan');
        $data = array(
            'jurusan' => $this->request->getPost('jurusan'),
            'id_ajaran' => $this->request->getPost('tahun_ajaran')
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

    public function exportjurusanxlxs()
    {
        $tahun_ajaran = $this->tahunajaranmodel->findAll();
        $jurusan = $this->jurusan->findAll();
        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'JURUSAN')
            ->setCellValue('B1', 'ID AJARAN')
            ->setCellValue('D1', 'ID AJARAN TERDAFTAR')
            ->setCellValue('E1', 'TAHUN AJARAN TERDAFTAR');

        $column = 2;

        foreach ($jurusan as $as) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $as['jurusan'])
                ->setCellValue('B' . $column, $as['id_ajaran']);
            $column++;
        }

        $column = 2;

        foreach ($tahun_ajaran as $jar) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('D' . $column, $jar['id_ajaran'])
                ->setCellValue('E' . $column, $jar['tahun_ajaran']);
            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His') . '-Data-Jurusan';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function uploadjurusan()
    {
        $file_excel = $this->request->getFile('fileexcel');
        $ext = $file_excel->getClientExtension();
        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file_excel);

        $data = $spreadsheet->getActiveSheet()->toArray();
        foreach ($data as $x => $row) {
            if ($x == 0) {
                continue;
            }

            $jurusan = $row[0];
            $id_ajaran = $row[1];

            $db = \Config\Database::connect();

            $cekjurusan = $db->table('jurusan')->getWhere(['jurusan' => $jurusan])->getResult();
            if (count($cekjurusan) > 0) {
                session()->setFlashdata('pesan', 'Data Gagal di Import Jurusan ada yang sama');
            } else {

                $simpandata = [
                    'jurusan'        => $jurusan,
                    'id_ajaran'      => $id_ajaran,
                ];

                $db->table('jurusan')->insert($simpandata);
                session()->setFlashdata('pesan', 'Berhasil import excel');
            }
        }
        return redirect()->to('/operator/datajurusan');
    }

    //MAPEL

    public function datamapel()
    {
        $db      = \Config\Database::connect();
        $this->builder = $db->table('mapel');
        $this->builder->join('kelas', 'kelas.id_kelas=mapel.id_kelas');
        $query = $this->builder->get();
        $user_id = user_id();
        $data = [
            'judul' => 'Akademik | Administrator',
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
            'mapel' => $query->getResultArray()
        ];
        return view('operator/data_mapel/index', $data);
    }

    public function exportmapelxlxs()
    {
        $mapel = $this->mapel->findAll();
        $kelas = $this->kelasmodel->findAll();
        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NAMA MAPEL')
            ->setCellValue('B1', 'ID KELAS')
            ->setCellValue('D1', 'ID KELAS TERDAFTAR')
            ->setCellValue('E1', 'NAMA KELAS TERDAFTAR');

        $column = 2;

        foreach ($mapel as $as) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $as['nama_mapel'])
                ->setCellValue('B' . $column, $as['id_kelas']);
            $column++;
        }

        $column = 2;

        foreach ($kelas as $jar) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('D' . $column, $jar['id_kelas'])
                ->setCellValue('E' . $column, $jar['nama_kelas']);
            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His') . '-Data-Kelas';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function uploadmapel()
    {
        $file_excel = $this->request->getFile('fileexcel');
        $ext = $file_excel->getClientExtension();
        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file_excel);

        $data = $spreadsheet->getActiveSheet()->toArray();
        foreach ($data as $x => $row) {
            if ($x == 0) {
                continue;
            }

            $nama_mapel = $row[0];
            $id_kelas = $row[1];

            $db = \Config\Database::connect();

            $cekmapel = $db->table('mapel')->getWhere(['nama_mapel' => $nama_mapel])->getResult();
            if (count($cekmapel) > 0) {
                session()->setFlashdata('pesan', 'Data Gagal di Import Nama Mapel ada yang sama');
            } else {

                $simpandata = [
                    'nama_mapel'        => $nama_mapel,
                    'id_kelas'          => $id_kelas
                ];

                $db->table('mapel')->insert($simpandata);
                session()->setFlashdata('pesan', 'Berhasil import excel');
            }
        }
        return redirect()->to('/operator/datamapel');
    }
    // tambah mapel
    public function tambahmapel()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'Form Tambah Data Mapel',
            'validation' => \Config\Services::validation(),
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
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
        $user_id = user_id();
        $data = [
            'judul' => 'Form Edit Data Mapel',
            'validation' => \Config\Services::validation(),
            'mapel' => $this->mapel->getmapel($id_mapel),
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
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
            'tahun_ajaran' => $this->tahunajaranmodel->findAll(),
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
        ];
        return view('operator/data_tahunajaran/index', $data);
    }

    public function exportajaranxlxs()
    {
        $tahun = $this->tahunajaranmodel->findAll();
        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'TAHUN AJARAN');

        $column = 2;

        foreach ($tahun as $as) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $as['tahun_ajaran']);
            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His') . '-Data-TahunAjaran';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function uploadajaran()
    {
        $file_excel = $this->request->getFile('fileexcel');
        $ext = $file_excel->getClientExtension();
        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file_excel);

        $data = $spreadsheet->getActiveSheet()->toArray();
        foreach ($data as $x => $row) {
            if ($x == 0) {
                continue;
            }

            $tahun = $row[0];

            $db = \Config\Database::connect();

            $cektahun = $db->table('tahun_ajaran')->getWhere(['tahun_ajaran' => $tahun])->getResult();
            if (count($cektahun) > 0) {
                session()->setFlashdata('pesan', 'Data Gagal di Import Tahun Ajaran ada yang sama');
            } else {

                $simpandata = [
                    'tahun_ajaran'        => $tahun,
                ];

                $db->table('tahun_ajaran')->insert($simpandata);
                session()->setFlashdata('pesan', 'Berhasil import excel');
            }
        }
        return redirect()->to('/operator/datatahunajaran');
    }

    // tambah
    public function tambahtahunajaran()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'Form Tambah Data Tahun Ajaran',
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
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
        $user_id = user_id();
        $data = [
            'judul' => 'Form Tambah Data tahun AJaran',
            'validation' => \Config\Services::validation(),
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
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

    public function exportmasterxlxs()
    {
        $tahun = $this->tahunajaranmodel->findAll();
        $siswa = $this->siswamodel->findAll();
        $jurusan = $this->jurusan->findAll();
        $guru = $this->gurumodel->findAll();
        $kelas = $this->kelasmodel->findAll();
        $master = $this->masterdata->findAll();
        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID AJARAN')
            ->setCellValue('B1', 'ID SISWA')
            ->setCellValue('C1', 'NAMA SISWA')
            ->setCellValue('D1', 'ID KELAS')
            ->setCellValue('E1', 'ID JURUSAN')
            ->setCellValue('F1', 'ID GURU')
            ->setCellValue('H1', 'ID AJARAN TERDAFTAR')
            ->setCellValue('I1', 'TAHUN AJARAN TERDAFTAR')
            ->setCellValue('K1', 'ID SISWA TERDAFTAR')
            ->setCellValue('L1', 'NAMA SISWA TERDAFTAR')
            ->setCellValue('N1', 'ID KELAS TERDAFTAR')
            ->setCellValue('O1', 'NAMA KELAS TERDAFTAR')
            ->setCellValue('Q1', 'ID JURUSAN TERDAFTAR')
            ->setCellValue('R1', 'JURUSAN TERDAFTAR')
            ->setCellValue('T1', 'ID GURU TERDAFTAR')
            ->setCellValue('U1', 'NAMA GURU TERDAFTAR');


        $column = 2;

        foreach ($master as $as) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $as['id_ajaran'])
                ->setCellValue('B' . $column, $as['id_siswa'])
                ->setCellValue('C' . $column, $as['nama_lengkap'])
                ->setCellValue('D' . $column, $as['id_kelas'])
                ->setCellValue('E' . $column, $as['id_jurusan'])
                ->setCellValue('F' . $column, $as['id_guru']);
            $column++;
        }

        $column = 2;

        foreach ($tahun as $as) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('H' . $column, $as['id_ajaran'])
                ->setCellValue('I' . $column, $as['tahun_ajaran']);
            $column++;
        }

        $column = 2;

        foreach ($siswa as $as) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('K' . $column, $as['id'])
                ->setCellValue('L' . $column, $as['nama_lengkap']);
            $column++;
        }

        $column = 2;

        foreach ($kelas as $jar) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('N' . $column, $jar['id_kelas'])
                ->setCellValue('O' . $column, $jar['nama_kelas']);
            $column++;
        }
        $column = 2;

        foreach ($jurusan as $as) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('Q' . $column, $as['id_jurusan'])
                ->setCellValue('R' . $column, $as['jurusan']);
            $column++;
        }

        $column = 2;

        foreach ($guru as $as) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('T' . $column, $as['id_guru'])
                ->setCellValue('U' . $column, $as['nama_guru']);
            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His') . '-Data-Kelas';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function uploadmaster()
    {
        $file_excel = $this->request->getFile('fileexcel');
        $ext = $file_excel->getClientExtension();
        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file_excel);

        $data = $spreadsheet->getActiveSheet()->toArray();
        foreach ($data as $x => $row) {
            if ($x == 0) {
                continue;
            }

            $id_ajaran = $row[0];
            $id_siswa = $row[1];
            $namasiswa = $row[2];
            $id_kelas = $row[3];
            $id_jurusan = $row[4];
            $id_guru = $row[5];

            $db = \Config\Database::connect();

            $ceksiswa = $db->table('masterdatapelajaran')->getWhere(['id_siswa' => $id_siswa])->getResult();
            if (count($ceksiswa) > 0) {
                session()->setFlashdata('pesan', 'Data Gagal di Import Siswa ada yang sama');
            } else {

                $simpandata = [
                    'id_ajaran'        => $id_ajaran,
                    'id_siswa'        => $id_siswa,
                    'nama_lengkap'        => $namasiswa,
                    'id_kelas'          => $id_kelas,
                    'id_jurusan'          => $id_jurusan,
                    'id_guru'          => $id_guru,
                ];

                $db->table('masterdatapelajaran')->insert($simpandata);
                session()->setFlashdata('pesan', 'Berhasil import excel');
            }
        }
        return redirect()->to('/operator/masterdatapelajaran');
    }

    //tambah masterdata
    public function tambahmasterdatapelajaran()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'Form Tambah Data MasterData Pelajaran',
            'guru' => $this->gurumodel->getguru(),
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
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
                'rules' => 'required|is_unique[masterdatapelajaran.id_siswa]',
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


        $data = [
            'id_ajaran' => $this->request->getVar('tahun_ajaran'),
            'id_siswa' => $this->request->getVar('id'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'id_kelas' => $this->request->getVar('kelas'),
            'id_jurusan' => $this->request->getVar('jurusan'),
            'id_guru' => $this->request->getVar('nama_walikelas')
        ];
        $this->masterdata->insert($data);
        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan.');

        return redirect()->to('operator/masterdatapelajaran');
    }

    public function editmasterdatapelajaran($id_master)
    {
        $user_id = user_id();
        $data = [
            'judul' => 'SUZURAN | Admin',
            'masterdata' => $this->masterdata->getmasterdata($id_master),
            'guru' => $this->gurumodel->getguru(),
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
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
 
    public function datajadwal()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'SUZURAN | Operator',
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
            'jadwal' => $this->jadwal->joinjadwal()
        ];
        return view('operator/jadwal/index', $data);
    }

    public function exportjadwalxlxs()
    {
        $mapel = $this->mapel->findAll();
        $kelas = $this->kelasmodel->findAll();
        $guru = $this->gurumodel->findAll();
        $jadwal = $this->jadwal->findAll();
        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID KELAS')
            ->setCellValue('B1', 'ID MAPEL')
            ->setCellValue('C1', 'ID GURU')
            ->setCellValue('D1', 'NAMA GURU')
            ->setCellValue('E1', 'HARI')
            ->setCellValue('F1', 'JAM MULAI')
            ->setCellValue('G1', 'JAM SELESAI')
            ->setCellValue('I1', 'ID KELAS TERDAFTAR')
            ->setCellValue('J1', 'NAMA KELAS TERDAFTAR')
            ->setCellValue('L1', 'ID MAPEL TERDAFTAR')
            ->setCellValue('M1', 'MAPEL TERDAFTAR')
            ->setCellValue('O1', 'ID GURU TERDAFTAR')
            ->setCellValue('P1', 'NAMA GURU TERDAFTAR');


        $column = 2;

        foreach ($jadwal as $ska) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $ska['id_kelas'])
                ->setCellValue('B' . $column, $ska['id_mapel'])
                ->setCellValue('C' . $column, $ska['id_guru'])
                ->setCellValue('D' . $column, $ska['nama_guru'])
                ->setCellValue('E' . $column, $ska['hari'])
                ->setCellValue('F' . $column, $ska['jam_mulai'])
                ->setCellValue('G' . $column, $ska['jam_selesai']);
            $column++;
        }

        $column = 2;

        foreach ($mapel as $as) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('L' . $column, $as['id_mapel'])
                ->setCellValue('M' . $column, $as['nama_mapel']);
            $column++;
        }

        $column = 2;

        foreach ($kelas as $jar) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('I' . $column, $jar['id_kelas'])
                ->setCellValue('J' . $column, $jar['nama_kelas']);
            $column++;
        }

        $column = 2;

        foreach ($guru as $gur) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('O' . $column, $gur['id_guru'])
                ->setCellValue('P' . $column, $gur['nama_guru']);
            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His') . '-Data-Jadwal';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function uploadjadwal()
    {
        $file_excel = $this->request->getFile('fileexcel');
        $ext = $file_excel->getClientExtension();
        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file_excel);

        $data = $spreadsheet->getActiveSheet()->toArray();
        foreach ($data as $x => $row) {
            if ($x == 0) {
                continue;
            }

            $id_kelas = $row[0];
            $id_mapel = $row[1];
            $id_guru = $row[2];
            $nama_guru = $row[3];
            $hari = $row[4];
            $jam_mulai = $row[5];
            $jam_selesai = $row[6];

            $db = \Config\Database::connect();

            $cekmapel = $db->table('jadwal')->getWhere(['id_mapel' => $id_mapel])->getResult();
            if (count($cekmapel) > 0) {
                session()->setFlashdata('pesan', 'Data Gagal di Import Nama Mapel ada yang sama');
            } else {

                $simpandata = [
                    'id_kelas'          => $id_kelas,
                    'id_mapel'        => $id_mapel,
                    'id_guru'        => $id_guru,
                    'nama_guru'        => $nama_guru,
                    'hari'              => $hari,
                    'jam_mulai'        => $jam_mulai,
                    'jam_selesai'        => $jam_selesai,
                ];

                $db->table('jadwal')->insert($simpandata);
                session()->setFlashdata('pesan', 'Berhasil import excel');
            }
        }
        return redirect()->to('/operator/datajadwal');
    }

    public function tambahjadwal()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'SUZURAN | Operator',
            'jurusan' => $this->jurusan->getjurusan(),
            'cek' => $this->operator->where('id_akun', $user_id)->findAll(),
            'jadwal' => $this->jadwal->find(),
            'kelas' => $this->kelasmodel->findAll(),
            'mapel' => $this->mapel->findAll()
        ];
        return view('operator/jadwal/add', $data);
    }

    public function getkelas()
    {
        if ($this->request->isAJAX()) {
            $id_kelas = $this->request->getVar('id_kelas');
            // $db      = \Config\Database::connect();
            // $this->builder = $db->table('mapel');
            // $this->builder->select('');
            // $this->builder->join('kelas', 'kelas.id_kelas = mapel.id_kelas');
            // $this->builder->where('mapel.id_kelas', $id_kelas);
            // $query = $this->builder->get();
            // $user_id = user_id();
            $data = $this->mapel->getkelas($id_kelas);
            // foreach ($data as $row) {
            //     $output = '<option value="' . $row->id_kelas . '">' . $row->nama_kelas . '</option>';
            // }
        }
        // $this->output->set_content_type('application/json')->set_output(json_encode($output));
        echo json_encode($data);
        // dd($data);
    }
    public function getmapel()
    {
        if ($this->request->isAJAX()) {
            $id_mapel = $this->request->getVar('id_mapel');
            // $db      = \Config\Database::connect();
            // $this->builder = $db->table('mapel');
            // $this->builder->select('');
            // $this->builder->join('kelas', 'kelas.id_kelas = mapel.id_kelas');
            // $this->builder->where('mapel.id_kelas', $id_kelas);
            // $query = $this->builder->get();
            // $user_id = user_id();
            $data = $this->gurumodel->getmapel($id_mapel);
            // foreach ($data as $row) {
            //     $output = '<option value="' . $row->id_kelas . '">' . $row->nama_kelas . '</option>';
            // }
        }
        // $this->output->set_content_type('application/json')->set_output(json_encode($output));
        echo json_encode($data);
        // dd($data);
    }
    public function savejadwal()
    {
        //validasi
        // if (!$this->validate([
        //     'id' => [
        //         'rules' => 'required|is_unique[masterdatapelajaran.id]',
        //         'errors' => [
        //             'required' => 'Nomor induk siswa harus di isi',
        //             'is_unique' => 'Nis sudah didaftarkan'
        //         ]
        //     ],
        //     'kelas' => [
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => 'kelas Harus diisi.',
        //         ]
        //     ],
        //     'jurusan' => [
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => 'Jurusan Harus diisi.',
        //         ]
        //     ],
        //     'nama_walikelas' => [
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => 'Wali Kelas Harus diisi.',
        //         ]
        //     ],
        // ])) {
        //     return redirect()->to('/operator/tambahmasterdatapelajaran')->withInput();
        // }
        $this->jadwal->save([
            'id_kelas' => $this->request->getVar('kelas'),
            'id_mapel' => $this->request->getVar('mapel'),
            'id_guru' => $this->request->getVar('id_guru'),
            'nama_guru' => $this->request->getVar('nama_guru'),
            'hari' => $this->request->getVar('jadwal'),
            'jam_mulai' => $this->request->getVar('jam_mulai'),
            'jam_selesai' => $this->request->getVar('jam_selesai')
        ]);
        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan.');

        return redirect()->to('operator/datajadwal');
    }

    public function deletejadwal()
    {
        $model = new JadwalModel();
        $id_jadwal = $this->request->getPost('id_jadwal');
        $model->deletejadwal($id_jadwal);
        session()->setFlashdata('Pesan', 'Data Berhasil Di Delete.');
        return redirect()->to('/operator/datajadwal');
    }
}
