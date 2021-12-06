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
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;
use Myth\Auth\Config\Auth as AuthConfig;
use Myth\Auth\Entities\User;

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
            'cekadmin' => $this->admin->where('id_akun', $user_id)->findAll(),
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
            'cekadmin' => $this->admin->where('id_akun', $user_id)->findAll(),
        ];
        return view('admin/listdata', $data);
    }

    public function editakun($id)
    {
        $user_id = user_id();
        $this->builder->select('users.id as userid, username, email, user_image, name, description, password_hash');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'admin' => $this->admin->getadmin(),
            'users' => $query->getRow(),
            'cekadmin' => $this->admin->where('id_akun', $user_id)->findAll(),
        ];
        return view('admin/editakun', $data);
    }

    public function detail($id)
    {
        $user_id = user_id();
        $this->builder->select('users.id as userid, username, email, fullname, user_image, name, description, password_hash');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'admin' => $this->admin->getadmin(),
            'users' => $query->getRow(),
            'cekadmin' => $this->admin->where('id_akun', $user_id)->findAll(),
        ];
        return view('admin/detailakun', $data);
    }

    public function exportusersxlxs()
    {
        $db      = \Config\Database::connect();
        $this->builder = $db->table('auth_groups');
        $query = $this->builder->get();

        $users = $query->getResultArray();
        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'EMAIL')
            ->setCellValue('B1', 'USERNAME')
            ->setCellValue('C1', 'PASSWORD')
            ->setCellValue('D1', 'ROLE')
            ->setCellValue('F1', 'ROLE TERDAFTAR')
            ->setCellValue('G1', 'DESCRIPTION ROLE');

        $column = 2;

        foreach ($users as $ska) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('F' . $column, $ska['name'])
                ->setCellValue('G' . $column, $ska['description']);
            $column++;
        }



        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His') . '-Data-Users';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function uploadusers()
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

            $email = $row[0];
            $username = $row[1];
            $password = $row[2];
            // $role = $row[3];

            $db = \Config\Database::connect();

            $cekusername = $db->table('users')->getWhere(['username' => $username])->getResult();
            if (count($cekusername) > 0) {
                session()->setFlashdata('pesan', 'Data Gagal di Import Username ada yang sama');
            } else {

                $simpandata = [
                    'email'          => $email,
                    'username'        => $username,
                    'password'        => $password,

                ];
                // $kesatian = [
                //     'kesaktian'        => $role,
                // ];

                // $db->table('jadwal')->insert($simpandata);
                // $this->usermodel->save($simpandata);
                // route_to('register', $simpandata);
                // $this->usermodel->withGroup('admin')->insert($simpandata);
                // $rules = [
                //     'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
                //     'email'    => 'required|valid_email|is_unique[users.email]',
                // ];

                // if (!$this->validate($rules)) {
                //     return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
                // }

                // // Validate passwords since they can only be validated properly here
                // $rules = [
                //     'password'     => 'required|strong_password',
                //     'pass_confirm' => 'required|matches[password]',
                // ];

                // if (!$this->validate($rules)) {
                //     return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
                // }
                $this->usermodel->withGroup('admin')->insert($simpandata);
                // $allowedPostFields = array_merge(['password']);
                // $user = new User($this->request->getPost($allowedPostFields));
                session()->setFlashdata('pesan', 'Berhasil import excel');
            }
        }
        return redirect()->to('/admin/dataakun');
    }

    public function buatakun()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'users' => $this->innerjoin->getguru(),
            'admin' => $this->admin->getadmin(),
            'guru' => $this->gurumodel->getguru(),
            'cekadmin' => $this->admin->where('id_akun', $user_id)->findAll(),
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
        $user_id = user_id();
        $id = $this->request->getPost('id');
        $data = [
            'password' => $this->request->getPost('password_hash'),
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'cekadmin' => $this->admin->where('id_akun', $user_id)->findAll(),
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
            'cekadmin' => $this->admin->where('id_akun', $user_id)->findAll(),
        ];
        return view('admin/landing_page', $data);
    }

    public function ubahpage($id = null)
    {
        $user_id = user_id();
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'admin' => $this->admin->getadmin(),
            'landing_page' => $this->pagemodel->where('id', $id)->first(),
            'cekadmin' => $this->admin->where('id_akun', $user_id)->findAll(),
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
        $user_id = user_id();
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'admin' => $this->admin->getadmin(),
            'slider' => $this->sliderku->where('id_slider', $id_slider)->first(),
            'cekadmin' => $this->admin->where('id_akun', $user_id)->findAll(),
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
        $user_id = user_id();
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'admin' => $this->admin->getadmin(),
            'fasilitas' => $this->about->where('id', $id)->first(),
            'cekadmin' => $this->admin->where('id_akun', $user_id)->findAll(),
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
        $user_id = user_id();
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'admin' => $this->admin->getadmin(),
            'cekadmin' => $this->admin->where('id_akun', $user_id)->findAll(),
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
