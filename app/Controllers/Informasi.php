<?php

namespace App\Controllers;

use App\Models\M_settings;
use App\Models\M_profile;
use App\Models\M_berita;
use App\Models\M_pengumuman;
use App\Models\M_peraturan;
use App\Models\M_download;
use App\Models\M_perizinan;

class Informasi extends BaseController
{
    public function __construct()
    {
        $this->M_settings = new M_settings();
        $this->M_profile = new M_profile();
        $this->M_berita = new M_berita();
        $this->M_pengumuman = new M_pengumuman();
        $this->M_peraturan = new M_peraturan();
        $this->M_download = new M_download();
        $this->M_perizinan = new M_perizinan();
    }

    public function pengumuman()
    {
        $data = array(
            'title' => 'PENGUMUMAN',
            'settings'      => $this->M_settings->first(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'populer'       => $this->M_berita->orderBy('dilihat', 'Desc')->findAll(5),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Asc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'pengumuman'    => $this->M_pengumuman->orderBy('tanggal', 'Desc')->paginate(4),
            'peraturan'    => $this->M_peraturan->orderBy('tanggal', 'Desc')->findAll(5),
            'pager'         => $this->M_pengumuman->pager,
            'isi' => 'front/v_pengumuman',
        );
        echo view('front/layout/v_wrapper', $data);
    }

    public function pengumuman_detail($slug)
    {
        $data = array(
            'title' => 'PENGUMUMAN',
            'settings'      => $this->M_settings->first(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'populer'       => $this->M_berita->orderBy('dilihat', 'Desc')->findAll(6),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Asc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'peraturan'    => $this->M_peraturan->orderBy('tanggal', 'Desc')->findAll(5),
            'detail'       => $this->M_pengumuman->where('id', $slug)->findAll(),
            'counter'  => $this->M_pengumuman->counter($slug),
            'isi' => 'front/v_pengumuman_detail',
        );
        echo view('front/layout/v_wrapper', $data);
    }

    public function peraturan()
    {
        $data = array(
            'title' => 'PERATURAN',
            'settings'      => $this->M_settings->first(),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Asc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'peraturan'    => $this->M_peraturan->orderBy('tanggal', 'Desc')->findAll(),
            'isi' => 'front/v_peraturan',
        );
        echo view('front/layout/v_wrapper', $data);
    }

    public function download()
    {
        $data = array(
            'title' => 'DOWNLOAD',
            'settings'      => $this->M_settings->first(),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Asc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'download'    => $this->M_download->orderBy('tanggal', 'Desc')->findAll(),
            'isi' => 'front/v_download',
        );
        echo view('front/layout/v_wrapper', $data);
    }
}
