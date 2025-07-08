<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassModel extends Model
{
    protected $table = 'class';
    protected $primaryKey = 'classID';

    
    protected $allowedFields = [
        'class_name', 
        'trainerID', 
        'class_type', 
        'status', 
        'created_date'
    ];
} 