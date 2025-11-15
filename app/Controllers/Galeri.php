<?php

namespace App\Controllers;

use App\Models\M_settings;
use App\Models\M_profile;
use App\Models\M_galeri;
use App\Models\M_video;
use App\Models\M_perizinan;


class Galeri extends BaseController
{
    public function __construct()
    {
        $this->M_settings = new M_settings();
        $this->M_profile = new M_profile();
        $this->M_galeri = new M_galeri();
        $this->M_video = new M_video();
        $this->M_perizinan = new M_perizinan();
    }

    public function foto()
    {
        $data = array(
            'title' => 'GALERI FOTO',
            'settings'      => $this->M_settings->first(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'galeri'          => $this->M_galeri->orderBy('tanggal', 'Desc')->paginate(6),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Asc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'pager'         => $this->M_galeri->pager,
            'isi' => 'front/v_foto',
        );
        echo view('front/layout/v_wrapper', $data);
    }

    public function foto_detail($id)
    {
        $data = array(
            'title' => 'GALERI FOTO',
            'settings'      => $this->M_settings->first(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'fotodetail'    => $this->M_galeri->getFoto($id),
            'fotojudul'     => $this->M_galeri->find($id),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Asc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'album'          => $this->M_galeri->orderBy('tanggal', 'Desc')->findAll(4),
            'isi' => 'front/v_foto_detail.php',
        );
        echo view('front/layout/v_wrapper', $data);
    }

    public function video()
    {
        $data = array(
            'title' => 'GALERI VIDEO',
            'settings'      => $this->M_settings->first(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Asc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'video'          => $this->M_video->orderBy('tanggal', 'Desc')->paginate(6),
            'pager'         => $this->M_video->pager,
            'isi' => 'front/v_video',
        );
        echo view('front/layout/v_wrapper', $data);
    }

    public function video_detail($id)
    {
        $data = array(
            'title' => 'GALERI VIDEO',
            'settings'      => $this->M_settings->first(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Asc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'videodetail'    => $this->M_video->find($id),
            'isi' => 'front/v_video_detail.php',
        );
        echo view('front/layout/v_wrapper', $data);
    }
}
