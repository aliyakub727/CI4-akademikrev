<?php

namespace Myth\Auth\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAuthTables extends Migration
{
    public function up()
    {
        /*
         * Users
         */
        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'email'            => ['type' => 'varchar', 'constraint' => 255],
            'username'         => ['type' => 'varchar', 'constraint' => 30, 'null' => true],
            'user_image'       => ['type' => 'varchar', 'constraint' => 255, 'default' => 'default.svg'],
            'password_hash'    => ['type' => 'varchar', 'constraint' => 255],
            'reset_hash'       => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'reset_at'         => ['type' => 'datetime', 'null' => true],
            'reset_expires'    => ['type' => 'datetime', 'null' => true],
            'activate_hash'    => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'status'           => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'status_message'   => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'active'           => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
            'force_pass_reset' => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('email');
        $this->forge->addUniqueKey('username');

        $this->forge->createTable('users', true);

        /*
         * Auth Login Attempts
         */
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'ip_address' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'email'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'user_id'    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true], // Only for successful logins
            'date'       => ['type' => 'datetime'],
            'success'    => ['type' => 'tinyint', 'constraint' => 1],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('email');
        $this->forge->addKey('user_id');
        // NOTE: Do NOT delete the user_id or email when the user is deleted for security audits
        $this->forge->createTable('auth_logins', true);

        /*
         * Auth Tokens
         * @see https://paragonie.com/blog/2015/04/secure-authentication-php-with-long-term-persistence
         */
        $this->forge->addField([
            'id'              => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'selector'        => ['type' => 'varchar', 'constraint' => 255],
            'hashedValidator' => ['type' => 'varchar', 'constraint' => 255],
            'user_id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'expires'         => ['type' => 'datetime'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('selector');
        $this->forge->addForeignKey('user_id', 'users', 'id', '', 'CASCADE');
        $this->forge->createTable('auth_tokens', true);

        /*
         * Password Reset Table
         */
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'email'      => ['type' => 'varchar', 'constraint' => 255],
            'ip_address' => ['type' => 'varchar', 'constraint' => 255],
            'user_agent' => ['type' => 'varchar', 'constraint' => 255],
            'token'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => false],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('auth_reset_attempts', true);

        /*
         * Activation Attempts Table
         */
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'ip_address' => ['type' => 'varchar', 'constraint' => 255],
            'user_agent' => ['type' => 'varchar', 'constraint' => 255],
            'token'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => false],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('auth_activation_attempts', true);

        /*
         * Groups Table
         */
        $fields = [
            'id'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'        => ['type' => 'varchar', 'constraint' => 255],
            'description' => ['type' => 'varchar', 'constraint' => 255],
        ];

        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->createTable('auth_groups', true);

        /*
         * Permissions Table
         */
        $fields = [
            'id'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'        => ['type' => 'varchar', 'constraint' => 255],
            'description' => ['type' => 'varchar', 'constraint' => 255],
        ];

        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->createTable('auth_permissions', true);

        /*
         * Groups/Permissions Table
         */
        $fields = [
            'group_id'      => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'permission_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
        ];

        $this->forge->addField($fields);
        $this->forge->addKey(['group_id', 'permission_id']);
        $this->forge->addForeignKey('group_id', 'auth_groups', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('permission_id', 'auth_permissions', 'id', '', 'CASCADE');
        $this->forge->createTable('auth_groups_permissions', true);

        /*
         * Users/Groups Table
         */
        $fields = [
            'group_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'user_id'  => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
        ];

        $this->forge->addField($fields);
        $this->forge->addKey(['group_id', 'user_id']);
        $this->forge->addForeignKey('group_id', 'auth_groups', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', '', 'CASCADE');
        $this->forge->createTable('auth_groups_users', true);

        /*
         * Users/Permissions Table
         */
        $fields = [
            'user_id'       => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'permission_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
        ];

        $this->forge->addField($fields);
        $this->forge->addKey(['user_id', 'permission_id']);
        $this->forge->addForeignKey('user_id', 'users', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('permission_id', 'auth_permissions', 'id', '', 'CASCADE');
        $this->forge->createTable('auth_users_permissions', true);

        $this->forge->addField([
                        'id'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'unsigned'       => true,
                                'auto_increment' => true,
                        ],
                        'id_akun'       => [
                                'type'       => 'int',
                                'constraint' => 11,
                                'unsigned'   => true,
                        ],
                        'nis' => [
                                'type' => 'VARCHAR',
                                'constraint' => '20'
                        ],
                        'nama_lengkap' => [
                                'type' => 'VARCHAR',
                                'constraint' => '50'
                        ],
                        'alamat' => [
                                'type' => 'VARCHAR',
                                'constraint' => '255'
                        ],
                        'no_telp' => [
                                'type' => 'VARCHAR',
                                'constraint' => '20'
                        ],
                        'tgl_lahir' => [
                                'type' => 'date',
                                'null' => true,
                        ],
                        'tempat_lahir' => [
                                'type' => 'VARCHAR',
                                'constraint' => '50'
                        ],
                        'agama' => [
                                'type' => 'VARCHAR',
                                'constraint' => '20'
                        ],
                        'nama_orang_tua' => [
                                'type' => 'VARCHAR',
                                'constraint' => '50'
                        ],
                        'alamat_ortu' => [
                                'type' => 'VARCHAR',
                                'constraint' => '255'
                        ],
                        'no_telp_ortu' => [
                                'type' => 'VARCHAR',
                                'constraint' => '20'
                        ],
                        'jurusan' => [
                                'type' => 'VARCHAR',
                                'constraint' => '50'
                        ],
                        'jenis_kelamin' => [
                                'type' => 'VARCHAR',
                                'constraint' => '20'
                        ],

                ]);

                $this->forge->addKey('id', true);
                $this->forge->addForeignKey('id_akun','users','id','','CASCADE');
                $this->forge->createTable('Siswa',true);


                 $this->forge->addField([
                        'id_kelas'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'unsigned'       => true,
                                'auto_increment' => true,
                        ],
                        
                        'Nama_Kelas' => [
                                'type' => 'VARCHAR',
                                'constraint' => '20'
                        ],
                          ]);
                $this->forge->addKey('id_Kelas', true);
                $this->forge->createTable('Kelas',true);


                 $this->forge->addField([
                        'id_mapel'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'unsigned'       => true,
                                'auto_increment' => true,
                        ],
                        'nama_mapel' => [
                                'type' => 'VARCHAR',
                                'constraint' => '20'
                        ],
                        
                       'id_kelas'   => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'unsigned'       => true,
                        
                        ],
                        
                          ]);
                $this->forge->addKey('id_mapel', true); 
                $this->forge->addForeignKey('id_kelas','Kelas','id_kelas','','CASCADE');
                $this->forge->createTable('Mapel', true);


                 $this->forge->addField([
                        'id_jurusan'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'unsigned'       => true,
                                'auto_increment' => true,
                        ],
                        
                        'Jurusan' => [
                                'type' => 'VARCHAR',
                                'constraint' => '20'
                        ],
                        'id_kelas'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'unsigned'       => true,
                              
                        ],
                        
                          ]);
                $this->forge->addKey('id_jurusan', true);
                $this->forge->addForeignKey('id_kelas','Kelas','id_kelas','','CASCADE');
                $this->forge->createTable('Jurusan',true);


                $this->forge->addField([
                        'id_guru'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'unsigned'       => true,
                                'auto_increment' => true,
                        ],
                        
                         'id_mapel'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'unsigned'       => true,
                             
                        ],
                         'id_akun'       => [
                                'type'       => 'int',
                                'constraint' => 11,
                                'unsigned'   => true,
                        ],
                        'Nama_Guru' => [
                                'type' => 'VARCHAR',
                                'constraint' => '50'
                        ],
                        'Alamat' => [
                                'type' => 'VARCHAR',
                                'constraint' => '255'
                        ],
                        'No_Telp' => [
                                'type' => 'VARCHAR',
                                'constraint' => '20'
                        ],
                        
                          ]);
                $this->forge->addKey('id_guru', true);
                $this->forge->addForeignKey('id_mapel','Mapel','id_mapel','','CASCADE');
                $this->forge->addForeignKey('id_akun','Users','id','','CASCADE');
                $this->forge->createTable('Guru',true);


                $this->forge->addField([
                        'id_operator'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'unsigned'       => true,
                                'auto_increment' => true,
                        ],
                        
                         'id_akun'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'unsigned'       => true,
                               
                        ],
                        
                        'nama_lengkap' => [
                                'type' => 'VARCHAR',
                                'constraint' => '50'
                        ],

                        'jenis_kelamin' => [
                                'type' => 'VARCHAR',
                                'constraint' => '20'
                        ],
                        'Alamat' => [
                                'type' => 'VARCHAR',
                                'constraint' => '255'
                        ],
                        'No_Telp' => [
                                'type' => 'VARCHAR',
                                'constraint' => '20'
                        ],
                        'tgl_lahir' => [
                                'type' => 'date',
                                'null' => true,
                        ],
                        'tempat_lahir' => [
                                'type' => 'VARCHAR',
                                'constraint' => '50'
                        ],
                        'agama' => [
                                'type' => 'VARCHAR',
                                'constraint' => '20'
                        ],

                        
                          ]);
                $this->forge->addKey('id_operator', true);
                $this->forge->addForeignKey('id_akun','Users','id','','CASCADE');
                $this->forge->createTable('Operator',true);

                 $this->forge->addField([
                        'id_kepala_sk'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'unsigned'       => true,
                                'auto_increment' => true,
                        ],
                        'id_akun'       => [
                                'type'       => 'int',
                                'constraint' => 11,
                                'unsigned'   => true,
                        ],
                        
                        'nama_lengkap' => [
                                'type' => 'VARCHAR',
                                'constraint' => '50'
                        ],
                        'alamat' => [
                                'type' => 'VARCHAR',
                                'constraint' => '255'
                        ],
                        'no_telp' => [
                                'type' => 'VARCHAR',
                                'constraint' => '20'
                        ],
                        'tgl_lahir' => [
                                'type' => 'date',
                                'null' => true,
                        ],
                        'tempat_lahir' => [
                                'type' => 'VARCHAR',
                                'constraint' => '50'
                        ],
                        'agama' => [
                                'type' => 'VARCHAR',
                                'constraint' => '20'
                        ],
                        'jenis_kelamin' => [
                                'type' => 'VARCHAR',
                                'constraint' => '20'
                        ],

                ]);

                $this->forge->addKey('id_kepala_sk', true);
                $this->forge->addForeignKey('id_akun','users','id','','CASCADE');
                $this->forge->createTable('Kepala_Sekolah',true);




    }

    //--------------------------------------------------------------------

    public function down()
    {
        // drop constraints first to prevent errors
        if ($this->db->DBDriver != 'SQLite3') // @phpstan-ignore-line
        {
            $this->forge->dropForeignKey('auth_tokens', 'auth_tokens_user_id_foreign');
            $this->forge->dropForeignKey('auth_groups_permissions', 'auth_groups_permissions_group_id_foreign');
            $this->forge->dropForeignKey('auth_groups_permissions', 'auth_groups_permissions_permission_id_foreign');
            $this->forge->dropForeignKey('auth_groups_users', 'auth_groups_users_group_id_foreign');
            $this->forge->dropForeignKey('auth_groups_users', 'auth_groups_users_user_id_foreign');
            $this->forge->dropForeignKey('auth_users_permissions', 'auth_users_permissions_user_id_foreign');
            $this->forge->dropForeignKey('auth_users_permissions', 'auth_users_permissions_permission_id_foreign');
        }

        $this->forge->dropTable('users', true);
        $this->forge->dropTable('auth_logins', true);
        $this->forge->dropTable('auth_tokens', true);
        $this->forge->dropTable('auth_reset_attempts', true);
        $this->forge->dropTable('auth_activation_attempts', true);
        $this->forge->dropTable('auth_groups', true);
        $this->forge->dropTable('auth_permissions', true);
        $this->forge->dropTable('auth_groups_permissions', true);
        $this->forge->dropTable('auth_groups_users', true);
        $this->forge->dropTable('auth_users_permissions', true);
    }
}
