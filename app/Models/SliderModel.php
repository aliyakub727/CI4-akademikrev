<?php

namespace App\Models;

use CodeIgniter\Model;

class SliderModel extends Model
{
    protected $primaryKey = "id_slider";
    protected $table = "slider";
    protected $allowedFields = ['gambar_slider','title','deskripsi'];

    public function getslider($id_slider = false)
    {
        if ($id_slider == false) {
            return $this->findAll();
        }
        return $this->where(['id_slider' => $id_slider])->first();
    }

}
