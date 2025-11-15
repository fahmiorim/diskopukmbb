<?php

namespace App\Models;

use CodeIgniter\Model;

class M_training_category extends Model
{
    protected $table      = '3fi_training_category';
    protected $primaryKey = 'category_id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['category_name'];
}
