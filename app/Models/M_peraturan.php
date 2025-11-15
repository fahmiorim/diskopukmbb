<?php

namespace App\Models;

use CodeIgniter\Model;

class M_peraturan extends Model
{
    protected $table      = '3fi_peraturan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['judul', 'tanggal', 'file'];
}
