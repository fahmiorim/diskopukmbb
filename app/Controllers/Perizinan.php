<?php

namespace App\Controllers;

use App\Models\M_settings;
use App\Models\M_profile;
use App\Models\M_perizinan;
use App\Models\M_berita;
use App\Models\M_pengumuman;
use App\Models\M_kepegawaian;

class Perizinan extends BaseController
{
    public function __construct()
    {
        $this->M_settings = new M_settings();
        $this->M_profile = new M_profile();
        $this->M_perizinan = new M_perizinan();
        $this->M_berita = new M_berita();
        $this->M_pengumuman = new M_pengumuman();
        $this->M_kepegawaian = new M_kepegawaian();
    }

    public function detail($slug)
    {
        $data = array(
            'title'         => '',
            'settings'      => $this->M_settings->first(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'perizinan'          => $this->M_perizinan->where('judul_seo', $slug)->findAll(),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Asc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'berita'        => $this->M_berita->orderBy('tanggal', 'Desc')->findAll(6),
            'populer'       => $this->M_berita->orderBy('dilihat', 'Desc')->findAll(6),
            'pengumuman'    => $this->M_pengumuman->orderBy('tanggal', 'Desc')->findAll(5),
            'isi'           => 'front/v_perizinan',
        );
        echo view('front/layout/v_wrapper', $data);
    }
}
