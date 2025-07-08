<?php
<<<<<<< HEAD
=======

>>>>>>> 2b26fe64fb9ddb39feaec73708a5d1f5fc002560
namespace App\Models;

use CodeIgniter\Model;

class ClassScheduleModel extends Model
{
    protected $table = 'class_schedule';
    protected $primaryKey = 'scheduleID';
<<<<<<< HEAD
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['classID', 'schedule_date', 'start_time', 'end_time'];
=======
    
    protected $allowedFields = [
        'classID', 
        'schedule_date', 
        'start_time', 
        'end_time', 
        'status', 
        'capacity',
        'created_date'
    ];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';

>>>>>>> 2b26fe64fb9ddb39feaec73708a5d1f5fc002560
} 