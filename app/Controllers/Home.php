<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'SUZURAN | ACCOUNT-GURU',
        ];
        return view('home', $data);
    }
}
