<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Frontend extends Migration
{
    public function up()
    {
                   
        $this->forge->addField([
            'id_slider'          => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
            ],
           
            'gambar_slider' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255'
            ],
              ]);
    $this->forge->addKey('id_slider', true);
    $this->forge->createTable('Slider',true);

    
              
    $this->forge->addField([
            'id_home'          => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
            ],
           
            'judul' => [
                    'type' => 'VARCHAR',
                    'constraint' => '50'
            ],
            
            'isi' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255'
            ],
            
            'title' => [
                    'type' => 'VARCHAR',
                    'constraint' => '50'
            ],
              ]);
    $this->forge->addKey('id_home', true);
    $this->forge->createTable('Home',true);
    
    $this->forge->addField([
            'id_fasilitas'          => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
            ],
           
            'gambar_fasilitas' => [
                    'type' => 'VARCHAR',
                    'constraint' => '50'
            ],
            
            'keterangan' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255'
            ],
            
              ]);
    $this->forge->addKey('id_home', true);
    $this->forge->createTable('Fasilitas',true);
   
    }

    public function down()
    {
        //
    }
}
