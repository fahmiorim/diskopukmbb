<?php

namespace App\Models;

use CodeIgniter\Model;

class M_kepegawaian extends Model
{
    protected $table      = '3fi_kepegawaian';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['nip', 'nama', 'unit_kerja', 'golongan', 'jabatan', 'status', 'urutan', 'foto'];
}
