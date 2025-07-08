<?php

namespace App\Models;

use CodeIgniter\Model;

class MembershipModel extends Model
{
    protected $table = 'membership';
    protected $primaryKey = 'membershipID';

    protected $allowedFields = ['planName', 'tier', 'discountRate', 'classLimit', 'redeemStatus' ,'price'];
    protected $useTimestamps = false;

    
    


}