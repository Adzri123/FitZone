<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'UserID';

    protected $allowedFields = ['email', 'password', 'name', 'phone', 'role','membershipID'];

}
