<?php

namespace App\Controllers;

use App\Models\M_settings;
use App\Models\M_profile;
use App\Models\M_berita;
use App\Models\M_emagazine;
use App\Models\M_pengumuman;
use App\Models\M_peraturan;
use App\Models\M_perizinan;

class Berita extends BaseController
{
    public function __construct()
    {
        $this->M_settings = new M_settings();
        $this->M_profile = new M_profile();
        $this->M_berita = new M_berita();
        $this->M_emagazine = new M_emagazine();
        $this->M_pengumuman = new M_pengumuman();
        $this->M_peraturan = new M_peraturan();
        $this->M_perizinan = new M_perizinan();
    }

    public function index()
    {
        $data = array(
            'title' => 'BERITA',
            'settings'      => $this->M_settings->first(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'berita'        => $this->M_berita->orderBy('tanggal', 'Desc')->findAll(6),
            'pengumuman'    => $this->M_pengumuman->orderBy('tanggal', 'Desc')->findAll(6),
            'peraturan'    => $this->M_peraturan->orderBy('tanggal', 'Desc')->findAll(6),
            'blog'          => $this->M_berita->orderBy('tanggal', 'Desc')->paginate(4),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Asc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'pager'         => $this->M_berita->pager,
            'isi' => 'front/v_berita',
        );
        echo view('front/layout/v_wrapper', $data);
    }

    public function detail($slug)
    {
        $data = array(
            'title' => 'BERITA',
            'settings'      => $this->M_settings->first(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'berita'        => $this->M_berita->orderBy('tanggal', 'Asc')->findAll(6),
            'populer'       => $this->M_berita->orderBy('dilihat', 'desc')->findAll(6),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Asc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'detail'        => $this->M_berita->where('judul_seo', $slug)->findAll(),
            'counter'  => $this->M_berita->counter($slug),
            'isi' => 'front/v_berita_detail',
        );
        echo view('front/layout/v_wrapper', $data);
    }

    public function emagazine()
    {
        $data = array(
            'title' => 'E-MAGAZINE',
            'settings'      => $this->M_settings->first(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'magazine'      => $this->M_emagazine->orderBy('id', 'Desc')->paginate(6),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Asc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'pager'         => $this->M_emagazine->pager,
            'isi'           => 'front/v_magazine',
        );
        echo view('front/layout/v_wrapper', $data);
    }

    public function emagazine_detail($slug)
    {
        $data = array(
            'title' => 'E-MAGAZINE',
            'settings'      => $this->M_settings->first(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'detail'       => $this->M_emagazine->where('judul_seo', $slug)->findAll(),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Asc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'isi' => 'front/v_magazine_detail',
        );
        echo view('front/layout/v_wrapper', $data);
    }
}
