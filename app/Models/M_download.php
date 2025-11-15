<?php

namespace App\Models;

use CodeIgniter\Model;

class M_download extends Model
{
    protected $table      = '3fi_download';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['judul', 'tanggal', 'file'];
}
