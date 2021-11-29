<?php

namespace App\Controllers;

use App\Models\InnerJoinModel;
use Myth\Auth\Models\UserModel;
use App\Models\GuruModel;
use App\Models\UsersModel;
use App\Models\LandingPageModel;
use App\Models\SliderModel;
use App\Models\AboutModel;
use App\Models\AdminModel;

class Admin extends BaseController
{
    protected $usermodel;
    protected $innerjoin;
    protected $db, $builder;
    protected $gurumodel;
    protected $sliderku;
    protected $about;
    protected $uss;
    protected $admin;
    public function __construct()
    {
        $this->uss = new UsersModel();
        $this->admin = new AdminModel();
        $this->usermodel = new UserModel();
        $this->innerjoin = new InnerJoinModel();
        $this->db = \config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->gurumodel = new GuruModel();
        $this->pagemodel = new LandingPageModel();
        $this->sliderku = new SliderModel();
        $this->about = new AboutModel();
    }

    public function index()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'SUZURAN|ADMIN',
            'admin' => $this->admin->getadmin(),
            'admin' => $this->admin->where('id_akun', $user_id)->findAll(),
        ];
        return view('index', $data);
    }

    public function dataakun()
    {
        $user_id = user_id();
        $this->builder->select('users.id as userid, username, email, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'admin' => $this->admin->getadmin(),
            'users' => $query->getResultArray(),
            'admin' => $this->admin->where('id_akun', $user_id)->findAll(),
        ];
        return view('admin/listdata', $data);
    }

    public function editakun($id)
    {
        $this->builder->select('users.id as userid, username, email, user_image, name, description, password_hash');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'admin' => $this->admin->getadmin(),
            'users' => $query->getRow()
        ];
        return view('admin/editakun', $data);
    }

    public function detail($id)
    {
        $this->builder->select('users.id as userid, username, email, fullname, user_image, name, description, password_hash');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'admin' => $this->admin->getadmin(),
            'users' => $query->getRow()
        ];
        return view('admin/detailakun', $data);
    }
    public function buatakun()
    {

        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'users' => $this->innerjoin->getguru(),
            'admin' => $this->admin->getadmin(),
            'guru' => $this->gurumodel->getguru()

        ];
        return view('admin/createakun', $data);
    }

    public function deleteakun()
    {
        $id = $this->request->getVar('userid');
        $name = $this->request->getVar('name');
        if ($id->getError() == 4) {
            if ($name == 'admin') {
                $this->admin->detele($id);
                $this->uss->delete($id);
            }
        } else {
            $this->uss->delete($id);
        }
        session()->setFlashdata('Pesan', 'Data Berhasil Dihapus.');
        return redirect()->to('/admin/dataakun');
    }

    public function updateakun()
    {
        $id = $this->request->getPost('id');
        $data = [
            'password' => $this->request->getPost('password_hash'),
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
        ];
        $this->uss->update($id, $data);
        return redirect()->to('/admin/dataakun');
    }
    public function landing_page()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'landing_page' =>  $this->pagemodel->getPage(),
            'admin' => $this->admin->where('id_akun', $user_id)->findAll(),
        ];
        return view('admin/landing_page', $data);
    }

    public function ubahpage($id = null)
    {
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'admin' => $this->admin->getadmin(),
            'landing_page' => $this->pagemodel->where('id', $id)->first(),
        ];

        return view('admin/edit_page', $data);
    }

    public function ubahdatapage()
    {
        $id = $this->request->getVar('id');
        $dataGambar = $this->request->getFile('background');
        $gambarlama = $this->request->getVar('gambarlama');
        if ($dataGambar->getError() == 4) {
            $dataGambar = $this->request->getVar('gambarlama');
            $namagambar = $this->request->getVar('gambarlama');
        } elseif ($dataGambar == $gambarlama) {
            $namagambar = $this->request->getVar('gambarlama');
        } else {
            $namagambar = $dataGambar->getRandomName();
            //pindahkan gambar
            $dataGambar->move('img/landingpage/', $namagambar);
            //hapus file lama
            unlink('img/landingpage/' . $this->request->getVar('gambarlama'));
        }
        $data = [
            'title' => $this->request->getVar('title'),
            'judul' => $this->request->getVar('judul'),
            'isi' => $this->request->getVar('isi'),
            'background' => $namagambar
        ];
        $this->pagemodel->update($id, $data);
        return $this->response->redirect(site_url('admin/landing_page'));
    }

    public function sliderku()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'admin' => $this->admin->where('id_akun', $user_id)->findAll(),
            'slider' => $this->sliderku->getslider(),
        ];
        return view('admin/sliderku', $data);
    }

    public function ubahslider($id_slider)
    {
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'admin' => $this->admin->getadmin(),
            'slider' => $this->sliderku->where('id_slider', $id_slider)->first(),
        ];

        return view('admin/edit_slider', $data);
    }

    public function ubahdataslider()
    {
        $id_slider = $this->request->getVar('id_slider');
        $dataGambar = $this->request->getFile('gambar_slider');
        $gambarlama = $this->request->getVar('gambarlama');

        if ($dataGambar->getError() == 4) {
            $dataGambar = $this->request->getVar('gambarlama');
            $namagambar = $this->request->getVar('gambarlama');
        } elseif ($dataGambar == $gambarlama) {
            $namagambar = $this->request->getVar('gambarlama');
        } else {
            $namagambar = $dataGambar->getRandomName();
            //pindahkan gambar
            $dataGambar->move('img/slider/', $namagambar);
            //hapus file lama
            unlink('img/slider/' . $this->request->getVar('gambarlama'));
        }
        $data = [
            'title' => $this->request->getVar('title'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'gambar_slider' => $namagambar
        ];

        $this->sliderku->update($id_slider, $data);
        return $this->response->redirect(site_url('admin/sliderku'));
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
            'judul' => 'SUZURAN | ADMIN',
            'users' => $query->getRow(),
            'admin' => $this->admin->detailakun($id),
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/detailakun', $data);
    }

    public function lengkapi()
    {
        $data = [
            'judul' => 'SUZURAN | ADMIN',
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

            return redirect()->to('/admin/lengkapi/' . $this->request->getVar('id'))->withInput();
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
        return redirect()->to('admin/profile/' . $this->request->getVar('id'));
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

            return redirect()->to('/admin/profile/' . $this->request->getVar('id'))->withInput();
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
        return redirect()->to('admin/profile/' . $this->request->getVar('id'));
    }

    public function gantiprofil($id)
    {
        $filegambar = $this->request->getFile('userimage_Admin');

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

        $this->usermodel->save([
            'id' => $id,
            'user_image' => $namagambar
        ]);

        return redirect()->to('/admin/profile/' . $this->request->getVar('id'));
    }

    public function fasilitas()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'fasilitas' =>  $this->about->getfasilitas(),
            'admin' => $this->admin->where('id_akun', $user_id)->findAll(),
        ];
        return view('admin/fasilitas', $data);
    }

    public function ubahfasilitas($id)
    {
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'admin' => $this->admin->getadmin(),
            'fasilitas' => $this->about->where('id', $id)->first(),
        ];

        return view('admin/edit_fasilitas', $data);
    }

    public function ubahdatafasilitas()
    {
        $id = $this->request->getVar('id');
        $dataGambar = $this->request->getFile('gambar');
        $gambarlama = $this->request->getVar('gambarlama');

        if ($dataGambar->getError() == 4) {
            $dataGambar = $this->request->getVar('gambarlama');
            $namagambar = $this->request->getVar('gambarlama');
        } elseif ($dataGambar == $gambarlama) {
            $namagambar = $this->request->getVar('gambarlama');
        } else {
            $namagambar = $dataGambar->getRandomName();
            //pindahkan gambar
            $dataGambar->move('img/fasilitas/', $namagambar);
            //hapus file lama
            unlink('img/fasilitas/' . $this->request->getVar('gambarlama'));
        }
        $data = [
            'fasilitas' => $this->request->getVar('fasilitas'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'gambar' => $namagambar
        ];

        $this->about->update($id, $data);
        return $this->response->redirect(site_url('admin/fasilitas'));
    }

    public function tambahfasilitas()
    {
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'admin' => $this->admin->getadmin(),
        ];

        return view('admin/tambahfasilitas', $data);
    }

    public function savefasilitas()
    {
        $dataGambar = $this->request->getFile('gambar');
        $namagambar = $dataGambar->getRandomName();

        $data = [
            'fasilitas' => $this->request->getVar('fasilitas'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'gambar' => $namagambar
        ];

        $dataGambar->move('img/fasilitas/', $namagambar);
        $this->about->insert($data);
        return $this->response->redirect(site_url('admin/fasilitas'));
    }
}
