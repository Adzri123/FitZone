<?php
namespace App\Models;

use CodeIgniter\Model;

class TrainerModel extends Model
{
    protected $table = 'trainer';
    protected $primaryKey = 'TrainerID';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['name', 'specialty', 'phone', 'email', 'status'];
} 