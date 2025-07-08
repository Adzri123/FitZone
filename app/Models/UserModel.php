<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'UserID';
<<<<<<< HEAD
    protected $allowedFields = ['name', 'email', 'phone', 'password', 'role'];
    protected $useTimestamps = false;
=======

    protected $allowedFields = [
        'name', 
        'email', 
        'password', 
        'phone', 
        'role', 
        'balancePoint', 
        'membershipID', 
        'registration_date', 
        'last_updated'
    ];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';

>>>>>>> 2b26fe64fb9ddb39feaec73708a5d1f5fc002560
}
