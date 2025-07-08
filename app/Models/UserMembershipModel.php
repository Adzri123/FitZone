<?php

namespace App\Models;

use CodeIgniter\Model;

class UserMembershipModel extends Model
{
    protected $table = 'user_membership';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'userID', 
        'membershipID', 
        'purchase_date', 
        'payment_status', 
        'payment_amount', 
        'status', 
        'classes_used_this_week', 
        'last_week_reset'
    ];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';

} 