<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    protected $table = 'order_item';
    protected $primaryKey = 'orderItemID';
    
    protected $allowedFields = [
        'orderID', 
        'merchandiseID', 
        'quantity', 
        'unit_price', 
        'total_price', 
        'points_used'
    ];

    protected $useTimestamps = false;

} 