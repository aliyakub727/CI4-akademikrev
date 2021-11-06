<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutModel extends Model
{
    protected $table = "about_us";
    protected $allowedFields = ['fasilitas','deskripsi','gambar'];

    public function getslider($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }

}
