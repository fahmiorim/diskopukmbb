<?php

namespace App\Models;

use CodeIgniter\Model;

class M_link extends Model
{
    protected $table      = '3fi_link';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['kategori', 'nama', 'gambar', 'link_url'];
}
