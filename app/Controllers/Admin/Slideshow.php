<?php

namespace App\Controllers\Admin;

use App\Models\M_slideshow;
use App\Models\M_settings;

class Slideshow extends BaseController
{
    protected $M_slideshow;
    public function __construct()
    {
        $this->M_slideshow = new M_slideshow();
        $this->M_settings = new M_settings();
        helper('form');
    }
    public function index()
    {
        $data = array(
            'title' => 'SLIDESHOW',
            'title2' => $this->M_settings->first(),
            'slideshow' => $this->M_slideshow->orderBy('id', 'DESC')->findAll(),
            'isi' => 'admin/slideshow/v_lists',
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
            'gambar'                => $fileName,
        ];
        $gambar->move(ROOTPATH . '../public_html/public/media/slideshow/', $fileName);

        $this->M_slideshow->insert($data);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan ke Database');
        return redirect()->to(base_url('admin/slideshow'));
    }

    public function edit($id)
    {
        $validation = $this->validate([
            'gambar' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]|max_size[gambar,4096]'
        ]);

        if ($validation == FALSE) {
            $this->M_slideshow->update($id, [
                'judul'                 => $this->request->getPost('judul'),
            ]);
        } else {
            $data = $this->M_slideshow->find($id);
            $replace = $data['gambar'];
            if (file_exists(ROOTPATH . '../public_html/public/media/slideshow/' . $replace)) {
                unlink(ROOTPATH . '../public_html/public/media/slideshow/' . $replace);
            }

            $gambar   = $this->request->getFile('gambar');
            $fileName = $gambar->getRandomName();
            $this->M_slideshow->update($id, [
                'judul'                 => $this->request->getPost('judul'),
                'gambar'                => $fileName,
            ]);
            $gambar->move(ROOTPATH . '../public_html/public/media/slideshow', $fileName);
        }
        session()->setFlashdata('success', 'Data Berhasil Di Edit');
        return redirect()->to(base_url('admin/slideshow'));
    }

    public function delete($id)
    {
        $data = $this->M_slideshow->find($id);
        $gambar = $data['gambar'];
        if (file_exists(ROOTPATH . '../public_html/public/media/slideshow/' . $gambar)) {
            unlink(ROOTPATH . '../public_html/public/media/slideshow/' . $gambar);
        }
        $this->M_slideshow->delete($id);
        session()->setFlashdata('success', 'Data Berhasil di Hapus');
        return redirect()->to(base_url('admin/slideshow'));
    }
}
