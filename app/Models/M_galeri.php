<?php

namespace App\Models;

use CodeIgniter\Model;

class M_galeri extends Model
{
    protected $table      = '3fi_galeri';
    protected $primaryKey = 'id_galeri';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['judul', 'judul_seo', 'gambar', 'tanggal', 'jam'];


    public function getFoto($id)
    {
        $builder = $this->db->table('3fi_foto')->getWhere(['id_galeri' => $id]);
        return $builder->getResultArray();
    }

    public function saveFoto($data)
    {
        $builder = $this->db->table('3fi_foto');
        return $builder->insert($data);
    }

    public function deletefoto($id)
    {
        $builder = $this->db->table('3fi_foto');
        return $builder->delete(['id' => $id]);
    }

    public function getfotoalbum($id)
    {
        $builder = $this->db->table('3fi_foto')->getWhere(['id_galeri' => $id]);
        return $builder->getResultArray();
    }

    public function foto($id)
    {
        $builder = $this->db->table('3fi_foto')->getWhere(['id' => $id]);
        return $builder->getRowArray();
    }

    public function jumlahfoto($id)
    {
        $builder = $this->db->table('3fi_foto')->where(['id_galeri' => $id]);
        return $builder->countAllResults();
    }
}
