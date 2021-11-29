<?php

namespace App\Controllers;

use App\Models\InnerJoinModel;
use Myth\Auth\Models\UserModel;
use App\Models\GuruModel;
use App\Models\UsersModel;
use App\Models\MapelModel;
use App\Models\SiswaModel;
use App\Models\OperatorModel;
use App\Models\AdminModel;
use App\Models\KepsekModel;

class Akun extends BaseController
{
    protected $usermodel;
    protected $innerjoin;
    protected $db, $builder;
    protected $gurumodel;
    protected $siswamodel;
    protected $operatormodel;
    protected $adminmodel;
    protected $kepsekmodel;
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
        $this->siswamodel = new SiswaModel();
        $this->operatormodel = new OperatorModel();
        $this->adminmodel = new AdminModel();
        $this->kepsekmodel = new KepsekModel();
        $this->mapel =  new MapelModel();
    }

    public function index()
    {
        $user_id = user_id();
        $data = [
            'judul' => 'Akademik | Administrator',
            'cek'   => $this->operatormodel->where('id_akun', $user_id)->findAll(),
            'siswa' => $this->siswamodel->where('id_akun', $user_id)->findAll(),
            'admin' => $this->adminmodel->where('id_akun', $user_id)->findAll(),
            'guru'  => $this->gurumodel->where('id_akun', $user_id)->findAll(),
            'kepsek' => $this->kepsekmodel->where('id_akun', $user_id)->findAll(),
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
