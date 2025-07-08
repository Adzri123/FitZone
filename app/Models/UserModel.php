<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'UserID';

   


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


}
