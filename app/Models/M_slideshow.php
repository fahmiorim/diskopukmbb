<?php

namespace App\Models;

use CodeIgniter\Model;

class M_slideshow extends Model
{
    protected $table      = '3fi_slideshow';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['judul', 'gambar'];
}
