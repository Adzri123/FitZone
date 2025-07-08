<?php

namespace App\Models;

use CodeIgniter\Model;

class MerchandiseModel extends Model
{
    protected $table = 'merchandise';
    protected $primaryKey = 'merchandiseID';
<<<<<<< HEAD
    protected $allowedFields = ['name', 'price', 'stock_quantity', 'category', 'point_cost', 'is_redeemable'];
    protected $useTimestamps = false;
=======
    
    protected $allowedFields = [
        'name', 
        'category', 
        'price', 
        'point_cost', 
        'stock_quantity', 
        'image_url', 
        'is_redeemable', 
        'status', 
        'added_date'
    ];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';

>>>>>>> 2b26fe64fb9ddb39feaec73708a5d1f5fc002560
} 