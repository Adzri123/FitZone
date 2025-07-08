<?php

namespace App\Models;

use CodeIgniter\Model;

class PointTransactionModel extends Model
{
    protected $table = 'point_transaction';
    protected $primaryKey = 'transactionID';
    
    protected $allowedFields = [
        'userID', 
        'points', 
        'type', 
        'description', 
        'reference_id', 
        'reference_type', 
        'transaction_date'
    ];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';

} 