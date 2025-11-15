<?php

namespace App\Controllers;

use App\Models\M_settings;
use App\Models\M_profile;
use App\Models\M_pengumuman;
use App\Models\M_peraturan;
use App\Models\M_perizinan;
use App\Models\M_pelatihan;


class Pelatihan extends BaseController
{
    public function __construct()
    {
        $this->M_settings = new M_settings();
        $this->M_profile = new M_profile();
        $this->M_pengumuman = new M_pengumuman();
        $this->M_peraturan = new M_peraturan();
        $this->M_perizinan = new M_perizinan();
        $this->M_pelatihan = new M_pelatihan();
    }

    public function index()
    {
        $data = array(
            'title' => 'Pelatihan',
            'settings'      => $this->M_settings->first(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Asc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'pelatihan'     => $this->M_pelatihan->orderBy('training_id', 'Desc')->join('3fi_training_category', '3fi_training_category.training_category_id = 3fi_pelatihan.training_category_id')->paginate(8),
            'pager'         => $this->M_pelatihan->pager,
            'isi' => 'front/v_pelatihan',
        );
        echo view('front/layout/v_wrapper', $data);
    }

    public function detail($slug)
    {
        $data = array(
            'title' => 'BERITA',
            'settings'      => $this->M_settings->first(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Asc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'detail'        => $this->M_pelatihan->where('training_title_seo', $slug)->join('3fi_training_category', '3fi_training_category.training_category_id = 3fi_pelatihan.training_category_id')->findAll(),
            'peraturan'     => $this->M_peraturan->orderBy('id', 'Desc')->findAll(8),
            'pengumuman'    => $this->M_pengumuman->orderBy('id', 'Desc')->findAll(7),
            'isi' => 'front/v_pelatihan_detail',
        );
        echo view('front/layout/v_wrapper', $data);
    }
}
