<?php
namespace App\Models;

use CodeIgniter\Model;

class ClassScheduleModel extends Model
{
    protected $table = 'class_schedule';
    protected $primaryKey = 'scheduleID';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['classID', 'schedule_date', 'start_time', 'end_time'];
} 