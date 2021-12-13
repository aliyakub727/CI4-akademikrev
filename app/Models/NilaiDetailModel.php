<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiDetailModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'nilai_detail';
    protected $primaryKey       = 'id_nilai_detail';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_nilai','id_siswa','tugas','uts','uas','rata_rata'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    
    public function insertnilai($data)
    {  
        $rataRata = (($data['uas']) + ($data['uts']) + ($data['tugas'])) / 3;
        $dataNilai = [
            'tugas' => $data['tugas'],
            'uts' => $data['uts'],
            'uas' => $data['uas'],
            'rata_rata' => $rataRata
        ];
        $this->set($dataNilai)->where('id_nilai_detail', $data['id'])->update();
        return true;
    }
}
