<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kelas extends Migration
{
    public function up()
    {
       $this->forge->addField([
                        'id_kelas'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'unsigned'       => true,
                                'auto_increment' => true,
                        ],
                        
                        'nama_lengkap' => [
                                'type' => 'VARCHAR',
                                'constraint' => '50'
                        ],
                          ]);
        $this->forge->addKey('id_Kelas', true);
        $this->forge->createTable('Kelas');
                 
    }

    public function down()
    {
        $this->forge->dropTable('Kelas');
    }
}
