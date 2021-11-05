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
                    'is_unique' => 'Nomor Telepon Sudah terdaftar.'
                ]
            ],
        ])) {

            // $validation = \Config\Services::validation();
            // dd($validation);
            // return redirect()->to('/Siswa/create')->withInput()->with('validation', $validation);
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

        return redirect()->to('/operator/datasiswa');
    }

    // edit data siswa
    public function editsiswa($id)
    {
        // session();
        $data = [
            'judul' => 'Form Edit Data Siswa',
            'validation' => \Config\Services::validation(),
            'user' => $this->user->findAll(),
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

            // $validation = \Config\Services::validation();
            // dd($validation);
            // return redirect()->to('/Siswa/create')->withInput()->with('validation', $validation);
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
        return redirect()->to('/operator/datasiswa');
    }
}
