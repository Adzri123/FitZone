<?php
<<<<<<< HEAD
=======

>>>>>>> 2b26fe64fb9ddb39feaec73708a5d1f5fc002560
namespace App\Models;

use CodeIgniter\Model;

class TrainerModel extends Model
{
    protected $table = 'trainer';
<<<<<<< HEAD
    protected $primaryKey = 'TrainerID';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['name', 'specialty', 'phone', 'email', 'status'];
=======
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

>>>>>>> 2b26fe64fb9ddb39feaec73708a5d1f5fc002560
} 