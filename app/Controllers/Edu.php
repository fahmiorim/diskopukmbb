<?php

namespace App\Controllers;

use App\Models\M_settings;
use App\Models\M_profile;
use App\Models\M_perizinan;
use App\Models\M_edu;
use App\Models\M_berita;


class Edu extends BaseController
{
    public function __construct()
    {
        $this->M_settings = new M_settings();
        $this->M_profile = new M_profile();
        $this->M_perizinan = new M_perizinan();
        $this->M_edu = new M_edu();
        $this->M_berita = new M_berita();
    }

    public function ukm()
    {
        $data = array(
            'title' => 'EDU UKM',
            'settings'      => $this->M_settings->first(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'eduukm'        => $this->M_edu->where('kategori', 'UMKM')->orderBy('tanggal', 'Desc')->paginate(6),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Desc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'pager'         => $this->M_edu->pager,
            'isi' => 'front/v_eduukm',
        );
        echo view('front/layout/v_wrapper', $data);
    }

    public function ukm_detail($slug)
    {
        $data = array(
            'title' => 'EDU UKM',
            'settings'      => $this->M_settings->first(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'ukm_detail'    => $this->M_edu->where('judul_seo', $slug)->findAll(),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Desc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'populer'       => $this->M_berita->orderBy('dilihat', 'Desc')->findAll(6),
            'isi' => 'front/v_eduukm_detail',
        );
        echo view('front/layout/v_wrapper', $data);
    }


    public function koperasi()
    {
        $data = array(
            'title' => 'EDU KOPERASI',
            'settings'      => $this->M_settings->first(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'eduukm'        => $this->M_edu->where('kategori', 'KOPERASI')->orderBy('tanggal', 'Desc')->paginate(6),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Desc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'pager'         => $this->M_edu->pager,
            'isi' => 'front/v_eduukm',
        );
        echo view('front/layout/v_wrapper', $data);
    }

    public function koperasi_detail($slug)
    {
        $data = array(
            'title' => 'EDU KOPERASI',
            'settings'      => $this->M_settings->first(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'ukm_detail'    => $this->M_edu->where('judul_seo', $slug)->findAll(),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Desc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'populer'       => $this->M_berita->orderBy('dilihat', 'Desc')->findAll(6),
            'isi' => 'front/v_eduukm_detail',
        );
        echo view('front/layout/v_wrapper', $data);
    }
}
