<?php

namespace App\Models;

use CodeIgniter\Model;

class MerchandiseModel extends Model
{
    protected $table = 'merchandise';
    protected $primaryKey = 'merchandiseID';

    
    

    
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


} 