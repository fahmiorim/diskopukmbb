<?php

namespace App\Models;

use CodeIgniter\Model;

class M_jabatan extends Model
{
    protected $table      = '3fi_jabatan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['tbl1', 'tbl2', 'tbl3', 'jabatan'];
}
