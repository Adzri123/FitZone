<?php

namespace App\Models;

use CodeIgniter\Model;

class PointModel extends Model
{
    protected $table = 'points';
    protected $primaryKey = 'pointID';
    protected $allowedFields = ['userID', 'balancePoint', 'membershipID'];
} 