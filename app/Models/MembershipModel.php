<?php

namespace App\Models;

use CodeIgniter\Model;

class MembershipModel extends Model
{
    protected $table = 'membership';
    protected $primaryKey = 'membershipID';
    
    protected $allowedFields = [
        'planName', 
        'tier', 
        'discountRate', 
        'classLimit', 
        'membershipStatus', 
        'redeemStatus', 
        'price', 
        'created_date'
    ];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';

}