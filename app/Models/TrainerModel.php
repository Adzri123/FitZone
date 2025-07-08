<?php

namespace App\Models;

use CodeIgniter\Model;

class TrainerModel extends Model
{
    protected $table = 'trainer';
    protected $primaryKey = 'trainerID';
    
    protected $allowedFields = [
        'name', 
        'email', 
        'phone', 
        'specialization', 
        'experience_years', 
        'status', 
        'hire_date'
    ];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';

} 