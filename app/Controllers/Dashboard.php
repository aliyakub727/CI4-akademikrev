<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Akademik | Administrator',
        ];
        return view('index', $data);
    }
}
