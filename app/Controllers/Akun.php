<?php

namespace App\Controllers;

use App\Models\InnerJoinModel;
use Myth\Auth\Models\UserModel;
use App\Models\GuruModel;
use App\Models\UsersModel;
use App\Models\MapelModel;

class Akun extends BaseController
{
    protected $usermodel;
    protected $innerjoin;
    protected $db, $builder;
    protected $gurumodel;
    protected $uss;
    protected $mapel;
    public function __construct()
    {
        $this->uss = new UsersModel();
        $this->usermodel = new UserModel();
        $this->innerjoin = new InnerJoinModel();
        $this->db = \config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->gurumodel = new GuruModel();
        $this->mapel =  new MapelModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'Akademik | Administrator',
        ];
        return view('index', $data);
    }


    public function profile($id)
    {
        $this->builder->select('users.id as userid, username, email, user_image, name, description, password_hash');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();
        $data = [
            'judul' => 'SUZURAN | ACCOUNT-GURU',
            'users' => $query->getRow(),
            'guru' => $this->gurumodel->detailakun($id),
            'mapel' => $this->mapel->getmapel(),
        ];
        return view('admin/detailakun', $data);
    }
}
