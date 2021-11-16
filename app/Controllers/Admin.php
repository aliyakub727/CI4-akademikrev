<?php

namespace App\Controllers;

use App\Models\InnerJoinModel;
use Myth\Auth\Models\UserModel;
use App\Models\GuruModel;
use App\Models\UsersModel;
use App\Models\LandingPageModel;
use App\Models\SliderModel;
use App\Models\AboutModel;
use CodeIgniter\HTTP\Request;
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
    public function __construct()
    {
        $this->uss = new UsersModel();
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
        $data = [
            'judul' => 'SUZURAN|ADMIN',
        ];
        return view('index', $data);
    }

    public function dataakun()
    {
        $this->builder->select('users.id as userid, username, email, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'users' => $query->getResultArray()
        ];
        return view('admin/listdata', $data);
    }

    public function editakun($id)
    {
        $this->builder->select('users.id as userid, username, email, fullname, user_image, name, description, password_hash');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'users' => $query->getRow()
        ];
        return view('admin/editakun', $data);
    }

    public function update()
    {


        // if (!$this->validate([
        //     // 'judul' => 'required|is_unique[komik.judul]'
        //     'inama_minuman' => [
        //         'rules' => $rule_nama,
        //         'errors' => [
        //             'required' => 'Nama minuman Harus diisi.',
        //             'is_unique' => 'Nama minuman Sudah terdaftar.'
        //         ]
        //     ],
        //     'ipict_minuman' => [
        //         'rules' => 'max_size[ipict_minuman,1024]|is_image[ipict_minuman]|mime_in[ipict_minuman,image/jpg,image/jpeg,image/png]',
        //         'errors' => [
        //             'max_size' => 'Ukuran terlalu besar',
        //             'is_image' => 'Yang anda pilih bukan gambar',
        //             'mime_in' => 'Yang anda pilih bukan gambar'
        //         ]
        //     ]

        // ])) {
        //     return redirect()->to('/minuman/edit/' . $this->request->getVar('id'))->withInput();
        // }
        $user->username         = $this->request->getPost('username');
        $user->password         = $this->request->getPost('password');
        $user->reset_hash         = null;
        $user->reset_at         = date('Y-m-d H:i:s');
        $user->reset_expires    = null;
        $user->force_pass_reset = false;
        $users->save($user);
        // $this->uss->save([
        //     'id' => $this->request->getVar('id'),
        //     'username' => $this->request->getVar('username'),
        //     'password_hash' => $this->request->getPost('password'),
        //     'reset_hash'    => null,
        //     'reset_at'         => date('Y-m-d H:i:s'),
        //     'reset_expires'    => null,
        //     'force_pass_reset' => false,
        // ]);
        return redirect()->to('/acoount');
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
            'users' => $query->getRow()
        ];
        return view('admin/detailakun', $data);
    }
    public function buatakun()
    {

        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'users' => $this->innerjoin->getguru(),
            'guru' => $this->gurumodel->getguru()

        ];
        return view('admin/createakun', $data);
    }

    public function deleteakun($id)
    {
        $this->uss->delete($id);
        session()->setFlashdata('Pesan', 'Data Berhasil Dihapus.');
        return redirect()->to('/acoount');
    }

    public function landing_page()
    {
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'landing_page' =>  $this->pagemodel->getPage(),
        ];
        return view('admin/landing_page', $data);
    }

    public function ubahpage($id = null)
    {
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'landing_page' => $this->pagemodel->where('id', $id)->first(),
        ];

        return view('admin/edit_page', $data);
    }

    public function ubahdatapage()
    {
        $id = $this->request->getVar('id');
        $dataGambar = $this->request->getFile('background');
        $fileName = $dataGambar->getRandomName();
        $data = [
            'title' => $this->request->getVar('title'),
            'judul' => $this->request->getVar('judul'),
            'isi' => $this->request->getVar('isi'),
            'background' => $fileName
        ];
        $dataGambar->move('img/', $fileName);
        $this->pagemodel->update($id, $data);
        return $this->response->redirect(site_url('admin/landing_page'));
    }

    public function sliderku()
    {
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'slider' => $this->sliderku->getslider(),
        ];
        return view('admin/sliderku', $data);
    }

    public function ubahslider($id_slider)
    {
        $data = [
            'judul' => 'SUZURAN | ADMIN',
            'slider' => $this->sliderku->where('id_slider', $id_slider)->first(),
        ];

        return view('admin/edit_slider', $data);
    }

    public function ubahdataslider()
    {
        $id_slider = $this->request->getVar('id_slider');
        $dataGambar = $this->request->getFile('gambar_slider');
        $fileName = $dataGambar->getRandomName();
        $data = [
            'title' => $this->request->getVar('title'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'gambar_slider' => $fileName
        ];


        $dataGambar->move('img/', $fileName);
        $this->sliderku->update($id_slider, $data);
        return $this->response->redirect(site_url('admin/sliderku'));
    }
}
