<?php

namespace App\Models;

use CodeIgniter\Model;

class MerchandiseModel extends Model
{
    protected $table = 'merchandise';
    protected $primaryKey = 'merchandiseID';
    protected $allowedFields = ['name', 'price', 'stock_quantity', 'category', 'point_cost', 'is_redeemable'];
    protected $useTimestamps = false;
} 