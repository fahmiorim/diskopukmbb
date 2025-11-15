<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pelatihan_peserta extends Model
{
    protected $table      = '3fi_pelatihan_peserta';
    protected $primaryKey = 'pelatihan_peserta_id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['data_id', 'training_id'];
}
