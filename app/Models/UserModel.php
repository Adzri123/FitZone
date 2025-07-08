<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'UserID';
    protected $allowedFields = ['name', 'email', 'phone', 'password', 'role'];
    protected $useTimestamps = false;
}
