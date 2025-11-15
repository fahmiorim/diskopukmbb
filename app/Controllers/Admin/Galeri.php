<?php

namespace App\Controllers\Admin;

use App\Models\M_galeri;
use App\Models\M_settings;

class Galeri extends BaseController
{
    protected $M_galeri;
    public function __construct()
    {
        $this->M_galeri = new M_galeri();
        $this->M_settings = new M_settings();
    }

    public function index()
    {
        $data = array(
            'title' => 'GALERI',
            'title2' => $this->M_settings->first(),
            'galeri' => $this->M_galeri->orderBy('id_galeri', 'DESC')->findAll(),
            // 'foto' => $this->M_galeri->jumlahfoto($id),
            'isi' => 'admin/galeri/v_lists',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function tambah()
    {
        if (!$this->validate([
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isikan dulu {field}nya yaaaaa!!! ',
                ]
            ],
            'gambar' => [
                'rules' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]|max_size[gambar,4098]',
                'errors' => [
                    'uploaded' => 'Lupa ko ngupload Gambarnya kan???',
                    'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                    'max_size' => 'Ukuran Gambar Jangan Lewat dari 4 MB'
                ]
            ]
        ])) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }

        $gambar   = $this->request->getFile('gambar');
        $fileName = $gambar->getRandomName();
        $data = [
            'judul'                 => $this->request->getPost('judul'),
            'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
            'tanggal'               => date('Y-m-d'),
            'jam'                   => date('G:i:s'),
            'gambar'                => $fileName,
        ];
        $gambar->move(ROOTPATH . '../public_html/public/media/galeri/', $fileName);

        $this->M_galeri->insert($data);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan ke Database');
        return redirect()->to(base_url('admin/galeri'));
    }

    public function edit($id)
    {
        $validation = $this->validate([
            'gambar' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]|max_size[gambar,4096]'
        ]);

        if ($validation == FALSE) {
            $this->M_galeri->update($id, [
                'judul'                 => $this->request->getPost('judul'),
                'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
            ]);
        } else {
            $data = $this->M_galeri->find($id);
            $replace = $data['gambar'];
            if (file_exists(ROOTPATH . '../public_html/public/media/galeri/' . $replace)) {
                unlink(ROOTPATH . '../public_html/public/media/galeri/' . $replace);
            }

            $gambar   = $this->request->getFile('gambar');
            $fileName = $gambar->getRandomName();
            $this->M_galeri->update($id, [
                'judul'                 => $this->request->getPost('judul'),
                'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
                'gambar'                => $fileName,
            ]);
            $gambar->move(ROOTPATH . '../public_html/public/media/galeri', $fileName);
        }
        session()->setFlashdata('success', 'Data Berhasil Di Edit');
        return redirect()->to(base_url('admin/galeri'));
    }

    public function delete($id)
    {
        $data = $this->M_galeri->find($id);
        $data1 = $this->M_galeri->getfotoalbum($id);
        $gambar = $data['gambar'];

        if (file_exists(ROOTPATH . '../public_html/public/media/galeri/' . $gambar)) {
            unlink(ROOTPATH . '../public_html/public/media/galeri/' . $gambar);
        }

        foreach ($data1 as $key => $value) {
            if (file_exists(ROOTPATH . '../public_html/public/media/galeri/' . $value['gambar'])) {
                unlink(ROOTPATH . '../public_html/public/media/galeri/' . $value['gambar']);
            }
        }

        $this->M_galeri->delete($id);
        session()->setFlashdata('success', 'Data Berhasil di Hapus');
        return redirect()->to(base_url('admin/galeri'));
    }

    public function foto($id)
    {
        $data = array(
            'title' => 'Daftar Foto',
            'title2' => $this->M_settings->first(),
            'galeri' => $this->M_galeri->where('id_galeri', $id)->findAll(),
            'foto' => $this->M_galeri->getFoto($id),
            'isi' => 'admin/galeri/v_foto',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function add_foto($id)
    {
        if (!$this->validate([
            'gambar' => [
                'rules' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]|max_size[gambar,4098]',
                'errors' => [
                    'uploaded' => 'Lupa ko ngupload Gambarnya kan???',
                    'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                    'max_size' => 'Ukuran Gambar Jangan Lewat dari 4 MB'
                ]
            ]
        ])) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }

        $gambar   = $this->request->getFile('gambar');
        $fileName = $gambar->getRandomName();
        $data = [
            'id_galeri'             => $id,
            'gambar'                => $fileName,
        ];
        $gambar->move(ROOTPATH . '../public_html/public/media/galeri/', $fileName);

        $this->M_galeri->saveFoto($data);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan ke Database');
        return redirect()->to(base_url('admin/galeri/foto/' . $id));
    }

    public function delete_foto($id_galeri, $id)
    {
        $data = $this->M_galeri->foto($id);
        $gambar = $data['gambar'];
        if (file_exists(ROOTPATH . '../public_html/public/media/galeri/' . $gambar)) {
            unlink(ROOTPATH . '../public_html/public/media/galeri/' . $gambar);
        }

        $this->M_galeri->deletefoto($id);
        session()->setFlashdata('success', 'Data Berhasil di Hapus');
        return redirect()->to(base_url('admin/galeri/foto/' . $id_galeri));
    }
}
