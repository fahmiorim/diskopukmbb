<?php

namespace App\Models;

use CodeIgniter\Model;

class M_business_certificate extends Model
{
    protected $table      = '3fi_business_certificate';
    protected $primaryKey = 'business_certificate_id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['business_certificate_name', 'business_certificate_kode'];
}
