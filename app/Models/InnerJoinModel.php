<?php

namespace App\Models;

use CodeIgniter\Model;

class InnerJoinModel extends Model
{
    public function getguru()
    {
        return $this->db->table('auth_groups_users')
            ->join('users', 'users.id=auth_groups_users.user_id')
            // ->join('auth_groups_users', 'auth_groups_users.users_id=user_id')
            ->get()->getResultArray();
    }
}
