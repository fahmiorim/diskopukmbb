<?php

namespace App\Models;

use CodeIgniter\Model;

class M_banner extends Model
{
    protected $table      = '3fi_banner';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['posisi', 'nama', 'gambar', 'status', 'url'];
}
