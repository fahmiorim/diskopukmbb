<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pengumuman extends Model
{
    protected $table      = '3fi_pengumuman';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['judul', 'judul_seo', 'deskripsi', 'tanggal', 'jam', '', 'user', 'gambar', 'form', 'form_judul', 'batas_pendaftaran'];

    public function counter($id)
    {
        $count = $this->db->table('3fi_pengumuman')
            ->where('id', $id)
            ->get()->getRowArray();

        $this->db->table('3fi_pengumuman')
            ->where('id', $id)
            ->set(['dilihat' => $count['dilihat'] + 1])
            ->update();
    }
}
