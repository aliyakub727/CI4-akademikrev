<?php

namespace App\Controllers;

use App\Models\InnerJoinModel;
use Myth\Auth\Models\UserModel;
use App\Models\GuruModel;
use App\Models\UsersModel;

class Acoount extends BaseController
{
    protected $usermodel;
    protected $innerjoin;
    protected $db, $builder;
    protected $gurumodel;
    protected $uss;
    public function __construct()
    {
        $this->uss = new UsersModel();
        $this->usermodel = new UserModel();
        $this->innerjoin = new InnerJoinModel();
        $this->db = \config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->gurumodel = new GuruModel();
    }

    public function index()
    {
        $this->builder->select('users.id as userid, username, email, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();
        $data = [
            'judul' => 'SUZURAN | ACCOUNT-GURU',
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
            'judul' => 'SUZURAN | ACCOUNT-GURU',
            'users' => $query->getRow()
        ];
        return view('admin/editakun', $data);
    }

    public function update($id)
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
        $password = $_POST['password_hash'];
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $this->uss->save([
            'id' => $id,
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'fullname' => $this->request->getVar('fullname'),
            'password_hash' => $hash
        ]);
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
            'judul' => 'SUZURAN | ACCOUNT-GURU',
            'users' => $query->getRow()
        ];
        return view('admin/detailakun', $data);
    }
    public function createakun()
    {

        $data = [
            'judul' => 'SUZURAN | ACCOUNT-GURU',
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
}
