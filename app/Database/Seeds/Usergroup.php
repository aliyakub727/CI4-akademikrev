<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Usergroup extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'          =>  'admin',
                'description' =>  'Administrator',
            ],
            [
                'name'          =>  'guru',
                'description' =>  'Guru',
            ],
            [
                'name'          =>  'siswa',
                'description' =>  'Siswa',
            ],
            [
                'name'          =>  'kepalasekolah',
                'description' =>  'Kepala Sekolah',
            ],
            [
                'name'          =>  'operator',
                'description' =>  'Operator',
            ],
        ];
        $this->db->table('auth_groups')->insertBatch($data);
    }
}
