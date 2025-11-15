<?php

namespace App\Models;

use CodeIgniter\Model;

class M_business_licensing extends Model
{
    protected $table      = '3fi_business_licensing';
    protected $primaryKey = 'business_licensing_id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['business_licensing_name', 'business_licensing_kode'];
}
