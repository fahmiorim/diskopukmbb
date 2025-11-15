<?php

namespace App\Models;

use CodeIgniter\Model;

class M_emagazine extends Model
{
    protected $table      = '3fi_emagazine';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['judul', 'judul_seo', 'tanggal', 'jam', '', 'cover', 'url', 'user'];
}
