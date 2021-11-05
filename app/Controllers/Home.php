<?php

namespace App\Controllers;

use Myth\Auth\Models\UserModel;

class Home extends BaseController
{
    protected $user;
    public function __construct()
    {
        $this->user = new UserModel();
    }
    public function index()
    {
        $data = [
            'judul' => 'SUZURAN | ACCOUNT-GURU',
        ];
        return view('home', $data);
    }
}
