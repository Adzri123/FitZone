<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'orderID';
    
    protected $allowedFields = [
        'userID', 
        'order_type', 
        'total_amount', 
        'discount_amount', 
        'final_amount', 
        'points_earned', 
        'points_used', 
        'shipping_option',
        'shipping_cost',
        'payment_method',
        'delivery_address',
        'status', 
        'order_date'
    ];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';

} 