<?php
<<<<<<< HEAD
=======

>>>>>>> 2b26fe64fb9ddb39feaec73708a5d1f5fc002560
namespace App\Models;

use CodeIgniter\Model;

class ClassModel extends Model
{
    protected $table = 'class';
    protected $primaryKey = 'classID';
<<<<<<< HEAD
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['class_name', 'trainerID'];
=======
    
    protected $allowedFields = [
        'class_name', 
        'trainerID', 
        'class_type', 
        'status', 
        'created_date'
    ];

>>>>>>> 2b26fe64fb9ddb39feaec73708a5d1f5fc002560
} 