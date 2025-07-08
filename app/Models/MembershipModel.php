<?php

namespace App\Models;

use CodeIgniter\Model;

class MembershipModel extends Model
{
    protected $table = 'membership';
    protected $primaryKey = 'membershipID';
<<<<<<< HEAD
    protected $allowedFields = ['planName', 'tier', 'discountRate', 'classLimit', 'redeemStatus' ,'price'];
    protected $useTimestamps = false;
=======
    
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

>>>>>>> 2b26fe64fb9ddb39feaec73708a5d1f5fc002560
}