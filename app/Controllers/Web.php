<?php

namespace App\Controllers;

use App\Models\M_pengumuman;
use App\Models\M_emagazine;
use App\Models\M_berita;
use App\Models\M_slideshow;
use App\Models\M_settings;
use App\Models\M_profile;
use App\Models\M_perizinan;
use App\Models\M_galeri;
use App\Models\M_video;
use App\Models\M_peraturan;
use App\Models\M_link;
use App\Models\M_banner;
use App\Models\M_popup;
use App\Models\M_pelatihan;
use App\Models\M_edu;

class Web extends BaseController
{
    public function __construct()
    {
        $this->M_emagazine = new M_emagazine();
        $this->M_berita = new M_berita();
        $this->M_slideshow = new M_slideshow();
        $this->M_settings = new M_settings();
        $this->M_profile = new M_profile();
        $this->M_perizinan = new M_perizinan();
        $this->M_galeri = new M_galeri();
        $this->M_video = new M_video();
        $this->M_pengumuman = new M_pengumuman();
        $this->M_peraturan = new M_peraturan();
        $this->M_link = new M_link();
        $this->M_banner = new M_banner();
        $this->M_popup = new M_popup();
        $this->M_pelatihan = new M_pelatihan();
        $this->M_edu = new M_edu();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = array(
            'title'         => 'HOME',
            'settings'      => $this->M_settings->first(),
            'newsflash'     => $this->M_berita->orderBy('tanggal', 'Desc')->findAll(5),
            'kegiatan'      => $this->M_berita->orderBy('tanggal', 'Desc')->findAll(1),
            'kegiatanthumb' => $this->M_berita->orderBy('tanggal', 'Desc')->findAll(5, 1),
            'slider'        => $this->M_slideshow->orderBy('id', 'Desc')->findAll(5),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Desc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'pelatihan'     => $this->M_pelatihan->orderBy('training_id', 'Desc')->join('3fi_training_category', '3fi_training_category.training_category_id = 3fi_pelatihan.training_category_id')->findAll(4),
            'galeri'        => $this->M_galeri->orderBy('id_galeri', 'Desc')->findAll(),
            'magazine'      => $this->M_emagazine->orderBy('id', 'Desc')->findAll(),
            'link'          => $this->M_link->orderBy('id', 'Desc')->findAll(),
            'pengumuman'    => $this->M_pengumuman->orderBy('id', 'Desc')->findAll(7),
            'peraturan'     => $this->M_peraturan->orderBy('id', 'Desc')->findAll(8),
            'banner'        => $this->M_banner->limit('1')->findAll(),
            'popup'        => $this->M_popup->limit('1')->findAll(),
            'video'         => $this->M_video->orderBy('id', 'Desc')->findAll(),
            'eduukm'         => $this->M_edu->where('kategori', 'UMKM')->orderBy('id', 'Desc')->findAll(),
            'edukop'         => $this->M_edu->where('kategori', 'KOPERASI')->orderBy('id', 'Desc')->findAll(),
            'isi'           => 'front/layout/v_web',
        );
        echo view('front/layout/v_wrapper', $data);
    }
}
