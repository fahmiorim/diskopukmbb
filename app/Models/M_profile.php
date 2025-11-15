<?php

namespace App\Models;

use CodeIgniter\Model;

class M_profile extends Model
{
    protected $table      = '3fi_halaman';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['urutan', 'kategori', 'judul', 'judul_seo', 'isi_halaman', 'tanggal', 'jam', '', 'gambar'];
}
