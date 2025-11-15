<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pelatihan extends Model
{
    protected $table      = '3fi_pelatihan';
    protected $primaryKey = 'training_id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['category', 'training_category_id', 'training_title', 'training_title_seo', 'tanggal_posting', 'start_date', 'finish_date', 'gambar', 'place'];
}
