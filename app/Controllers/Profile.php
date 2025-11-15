<?php

namespace App\Controllers;

use App\Models\M_settings;
use App\Models\M_profile;
use App\Models\M_berita;
use App\Models\M_pengumuman;
use App\Models\M_kepegawaian;
use App\Models\M_perizinan;

class Profile extends BaseController
{
    public function __construct()
    {
        $this->M_settings = new M_settings();
        $this->M_profile = new M_profile();
        $this->M_berita = new M_berita();
        $this->M_pengumuman = new M_pengumuman();
        $this->M_kepegawaian = new M_kepegawaian();
        $this->M_perizinan = new M_perizinan();
    }

    public function detail($slug)
    {
        $data = array(
            'title'         => 'PROFILE',
            'settings'      => $this->M_settings->first(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'profiles'      => $this->M_profile->where('judul_seo', $slug)->findAll(),
            'berita'        => $this->M_berita->orderBy('tanggal', 'Desc')->findAll(6),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Asc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'populer'       => $this->M_berita->orderBy('dilihat', 'Desc')->findAll(6),
            'pengumuman'    => $this->M_pengumuman->orderBy('tanggal', 'Desc')->findAll(5),
            'isi'           => 'front/v_profile',
        );
        echo view('front/layout/v_wrapper', $data);
    }

    public function kepegawaian()
    {
        $data = array(
            'title' => 'KEPEGAWAIAN',
            'settings'      => $this->M_settings->first(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Asc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'pegawai'       => $this->M_kepegawaian->orderBy('urutan', 'Asc')->findAll(),
            'isi'           => 'front/v_kepegawaian',
        );
        echo view('front/layout/v_wrapper', $data);
    }

    public function struktur_organisasi()
    {
        $data = array(
            'title' => 'STRUKTUR ORGANISASI',
            'settings'      => $this->M_settings->first(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Asc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'isi'           => 'front/v_struktur',
        );
        echo view('front/layout/v_wrapper', $data);
    }
}
