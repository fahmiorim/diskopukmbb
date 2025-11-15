<?php

namespace App\Models;

use CodeIgniter\Model;

class M_berita extends Model
{
    protected $table      = '3fi_berita';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['kategori', 'judul', 'judul_seo', 'isi_berita', 'tanggal', 'jam', 'hari', 'gambar', 'user', 'dilihat'];

    public function counter($slug)
    {
        $count = $this->db->table('3fi_berita')
            ->where('judul_seo', $slug)
            ->get()->getRowArray();

        $this->db->table('3fi_berita')
            ->where('judul_seo', $slug)
            ->set(['dilihat' => $count['dilihat'] + 1])
            ->update();
    }
}
