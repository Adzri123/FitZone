<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'booking';
    protected $primaryKey = 'bookingID';
    
    protected $allowedFields = [
        'userID', 
        'scheduleID', 
        'booking_date', 
        'status'
    ];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';

} 