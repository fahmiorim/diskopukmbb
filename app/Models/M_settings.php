<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Settings extends Model
{
    protected $table      = '3fi_instansi';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['aplikasi', 'instansi', 'deskripsi', 'keyword', 'website', 'alamat', 'telfon', 'email', 'maps', 'logo'];
}
