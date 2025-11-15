<?php

namespace App\Models;

use CodeIgniter\Model;

class M_izin extends Model
{
    protected $table      = '3fi_izin';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['kategori', 'id_perizinan', 'judul', 'judul_seo', 'isi_halaman', 'tanggal', 'jam', '', 'gambar'];
}
