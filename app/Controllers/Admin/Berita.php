<?php

namespace App\Controllers\Admin;

use App\Models\M_berita;
use App\Models\M_emagazine;
use App\Models\M_settings;

class Berita extends BaseController
{
    protected $M_berita;

    public function __construct()
    {
        $this->M_berita = new M_berita();
        $this->M_emagazine = new M_emagazine();
        $this->M_settings = new M_settings();
    }

    public function ckeditorUpload()
    {
        $validated = $this->validate([
            'upload' => [
                'uploaded[upload]',
                'mime_in[upload,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[upload,4098]',

            ],
        ]);
        if ($validated) {

            $file   = $this->request->getFile('upload');
            $fileName = $file->getRandomName();
            $file->move(ROOTPATH . '../public_html/public/media/berita/', $fileName);
            $data = [
                'uploaded' => true,
                'url' => base_url('public/media/berita/' . $fileName),
            ];
        } else {
            $data = [
                'uploaded' => false,
                'error' => $file,
            ];
        }
        return $this->response->setJSON($data);
    }

    public function kegiatan()
    {
        $data = array(
            'title' => 'KEGIATAN',
            'title2' => $this->M_settings->first(),
            'berita' => $this->M_berita->orderBy('tanggal', 'DESC')->findAll(),
            'isi' => 'admin/berita/v_kegiatan_lists',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function kegiatan_tambah()
    {
        $data = array(
            'title' => 'Tambah Kegiatan',
            'title2' => $this->M_settings->first(),
            'isi' => 'admin/berita/v_kegiatan_tambah',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function kegiatan_save()
    {
        if (!$this->validate([
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isikan dulu {field}nya yaaaaa!!! ',
                ]
            ],
            'isi_berita' => [
                'label' => 'Isi Berita',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kasih {field} dulu biar orang tau',
                ]
            ],
            'gambar' => [
                'rules' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]|max_size[gambar,4098]',
                'errors' => [
                    'uploaded' => 'Lupa ko ngupload Gambarnya kan???',
                    'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                    'max_size' => 'Ukuran Gambar Jangan Lewat dari 2 MB'
                ]
            ],
        ])) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }

        $gambar   = $this->request->getFile('gambar');
        $fileName = $gambar->getRandomName();
        $data = [
            'judul'                 => $this->request->getPost('judul'),
            'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
            'isi_berita'            => $this->request->getPost('isi_berita'),
            'hari'                  => date('l'),
            'tanggal'               => date('Y-m-d'),
            'jam'                   => date('G:i:s'),
            'gambar'                => $fileName,
            'user'                  => session()->get('nama'),
        ];
        $gambar->move(ROOTPATH . '../public_html/public/media/berita/', $fileName);

        $this->M_berita->insert($data);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan ke Database');
        return redirect()->to(base_url('admin/berita/kegiatan'));
    }

    public function kegiatan_edit($id)
    {

        $data = array(
            'title' => 'Edit Kegiatan',
            'title2' => $this->M_settings->first(),
            'berita' => $this->M_berita->where('id', $id)->first(),
            'isi' => 'admin/berita/v_kegiatan_edit',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function kegiatan_update($id)
    {
        $validation = $this->validate([
            'gambar' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]|max_size[gambar,4096]'
        ]);

        if ($validation == FALSE) {
            $this->M_berita->update($id, [
                'judul'                 => $this->request->getPost('judul'),
                'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
                'isi_berita'            => $this->request->getPost('isi_berita'),
            ]);
        } else {
            $data = $this->M_berita->find($id);
            $replace = $data['gambar'];
            if (file_exists(ROOTPATH . '../public_html/public/media/berita/' . $replace)) {
                unlink(ROOTPATH . '../public_html/public/media/berita/' . $replace);
            }

            $gambar   = $this->request->getFile('gambar');
            $fileName = $gambar->getRandomName();
            $this->M_berita->update($id, [
                'judul'                 => $this->request->getPost('judul'),
                'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
                'isi_berita'            => $this->request->getPost('isi_berita'),
                'gambar'                => $fileName,
            ]);
            $gambar->move(ROOTPATH . '../public_html/public/media/berita', $fileName);
        }
        session()->setFlashdata('success', 'Data Berhasil Di Edit');
        return redirect()->to(base_url('admin/berita/kegiatan'));
    }

    public function kegiatan_delete($id)
    {
        $data = $this->M_berita->find($id);
        $gambar = $data['gambar'];
        if (file_exists(ROOTPATH . '../public_html/public/media/berita/' . $gambar)) {
            unlink(ROOTPATH . '../public_html/public/media/berita/' . $gambar);
        }
        $this->M_berita->delete($id);
        session()->setFlashdata('success', 'Data Berhasil di Hapus');
        return redirect()->to(base_url('admin/berita/kegiatan'));
    }

    public function emagazine()
    {
        $data = array(
            'title' => 'E-Magazine',
            'title2' => $this->M_settings->first(),
            'emagazine' => $this->M_emagazine->orderBy('id', 'Desc')->findAll(),
            'isi' => 'admin/berita/v_emagazine_lists',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function emagazine_tambah()
    {
        if (!$this->validate([
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isikan dulu {field}nya yaaaaa!!! ',
                ]
            ],
            'cover' => [
                'rules' => 'uploaded[cover]|mime_in[cover,image/jpg,image/jpeg,image/gif,image/png]|max_size[cover,4098]',
                'errors' => [
                    'uploaded' => 'Lupa ko ngupload Gambarnya kan???',
                    'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                    'max_size' => 'Ukuran Gambar Jangan Lewat dari 2 MB'
                ]
            ],
            'url' => [
                'label' => 'URL',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isikan dulu {field}nya yaaaaa!!! ',
                ]
            ],

        ])) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }

        $cover   = $this->request->getFile('cover');
        $fileName = $cover->getRandomName();
        $data = [
            'judul'                 => $this->request->getPost('judul'),
            'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
            'hari'                  => date('l'),
            'tanggal'               => date('Y-m-d'),
            'jam'                   => date('G:i:s'),
            'cover'                => $fileName,
            'user'                  => session()->get('nama'),
            'url'                  => $this->request->getPost('url'),
        ];
        $cover->move(ROOTPATH . '../public_html/public/media/emagazine/', $fileName);

        $this->M_emagazine->insert($data);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan ke Database');
        return redirect()->to(base_url('admin/berita/emagazine'));
    }

    public function emagazine_edit($id)
    {
        $validation = $this->validate([
            'cover' => 'uploaded[cover]|mime_in[cover,image/jpg,image/jpeg,image/gif,image/png]|max_size[cover,4096]'
        ]);

        if ($validation == FALSE) {
            $this->M_emagazine->update($id, [
                'judul'                 => $this->request->getPost('judul'),
                'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
                'url'                  => $this->request->getPost('url'),
            ]);
        } else {
            $data = $this->M_emagazine->find($id);
            $replace = $data['cover'];
            if (file_exists(ROOTPATH . '../public_html/public/media/emagazine/' . $replace)) {
                unlink(ROOTPATH . '../public_html/public/media/emagazine/' . $replace);
            }

            $gambar   = $this->request->getFile('cover');
            $fileName = $gambar->getRandomName();
            $this->M_berita->update($id, [
                'judul'                 => $this->request->getPost('judul'),
                'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
                'cover'                => $fileName,
                'url'                  => $this->request->getPost('url'),
            ]);
            $gambar->move(ROOTPATH . '../public_html/public/media/emagazine', $fileName);
        }
        session()->setFlashdata('success', 'Data Berhasil Di Edit');
        return redirect()->to(base_url('admin/berita/emagazine'));
    }

    public function emagazine_delete($id)
    {
        $data = $this->M_emagazine->find($id);
        $cover = $data['cover'];
        if (file_exists(ROOTPATH . '../public_html/public/media/emagazine/' . $cover)) {
            unlink(ROOTPATH . '../public_html/public/media/emagazine/' . $cover);
        }
        $this->M_emagazine->delete($id);
        session()->setFlashdata('success', 'Data Berhasil di Hapus');
        return redirect()->to(base_url('admin/berita/emagazine'));
    }
}
