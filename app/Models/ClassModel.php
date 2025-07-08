<?php
namespace App\Models;

use CodeIgniter\Model;

class ClassModel extends Model
{
    protected $table = 'class';
    protected $primaryKey = 'classID';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['class_name', 'trainerID'];
} 