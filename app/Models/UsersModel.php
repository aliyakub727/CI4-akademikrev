<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = "users";
    protected $primaryKey = "id";
    protected $returnType = "object";
    protected $useTimestamps = true;
    protected $allowedFields = ['username', 'email', 'password_hash', 'user_image', 'reset_hash', 'reset_at', 'reset_expires', 'force_pass_reset'];
}
