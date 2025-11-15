<?php

namespace App\Models;

use CodeIgniter\Model;

class M_edu extends Model
{
    protected $table      = '3fi_edu';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['kategori', 'judul', 'judul_seo', 'deskripsi', 'materi', 'jenis', 'tanggal', 'jam', 'hari', 'gambar', 'link', 'file'];
}
