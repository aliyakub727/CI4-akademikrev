<?php

namespace App\Controllers;

use Myth\Auth\Models\UserModel;
use App\Models\LandingPageModel;
use App\Models\SliderModel;

class Home extends BaseController
{
    protected $user;
    protected $pagemodel;
    protected $sliderku;
    public function __construct()
    {
        $this->user = new UserModel();
        $this->pagemodel = new LandingPageModel();
        $this->sliderku = new SliderModel();
    }
    public function index()
    {
        $data = [
            'judul' => 'SUZURAN | ACCOUNT-GURU',
            'landing_page' =>  $this->pagemodel->getPage(),
        ];
        return view('home', $data);
    }

    public function error()
    {
        return view('munculerror');
    }

    public function About()
    {
        $data = [
            'judul' => 'SUZURAN | ACCOUNT-GURU',
            'landing_page' =>  $this->pagemodel->getPage(),
            'slider1' => $this->sliderku->getslider('1'),
            'slider2' => $this->sliderku->getslider('2'),
            'slider3' => $this->sliderku->getslider('3'),
        ];
        return view('about', $data);
    }
}
