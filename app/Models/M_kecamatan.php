<?php

namespace App\Models;

use CodeIgniter\Model;

class M_kecamatan extends Model
{
    protected $table      = '3fi_kecamatan';
    protected $primaryKey = 'kecamatan_id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['kecamatan_kode', 'kecamatan_name'];
}
