<?php

namespace App\Models;

use CodeIgniter\Model;

class M_popup extends Model
{
    protected $table      = '3fi_popup';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['judul', 'gambar',];
}
