<?php

namespace App\Models;

use CodeIgniter\Model;

class LandingPageModel extends Model
{
    protected $primaryKey = "id";
    protected $table = "landing_page";
    protected $allowedFields = ['title', 'judul', 'isi', 'background'];

    public function getPage($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}
