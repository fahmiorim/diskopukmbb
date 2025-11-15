<?php

namespace App\Models;

use CodeIgniter\Model;

class M_video extends Model
{
    protected $table      = '3fi_video';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['judul', 'judul_seo', 'deskripsi', 'url', 'tanggal'];
}
