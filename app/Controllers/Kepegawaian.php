<?php

namespace App\Controllers;

use App\Models\M_settings;
use App\Models\M_profile;
use App\Models\M_galeri;
use App\Models\M_video;
use App\Models\M_perizinan;


class Kepegawaian extends BaseController
{
    public function __construct()
    {
        $this->M_settings = new M_settings();
        $this->M_profile = new M_profile();
        $this->M_galeri = new M_galeri();
        $this->M_video = new M_video();
        $this->M_perizinan = new M_perizinan();
    }

    public function index()
    {
        $data = array(
            'title' => '',
            'settings'      => $this->M_settings->first(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Asc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'galeri'        => $this->M_galeri->orderBy('tanggal', 'Desc')->paginate(6),
            'pager'         => $this->M_galeri->pager,
            'isi'           => 'front/v_kepegawaian',
        );
        echo view('front/layout/v_wrapper', $data);
    }
}
