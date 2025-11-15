<?php

namespace App\Controllers\Admin;

use App\Models\M_settings;
use App\Models\M_popup;


class Popup extends BaseController
{
    public function __construct()
    {
        $this->M_settings = new M_settings();
        $this->M_popup = new M_popup();
    }

    public function index()
    {
        $data = array(
            'title' => 'POPUP',
            'title2' => $this->M_settings->first(),
            'popup' => $this->M_popup->orderBy('id', 'DESC')->findAll(),
            'isi' => 'admin/popup/v_lists',
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
        $gambar->move(ROOTPATH . '../public_html/public/media/popup/', $fileName);

        $this->M_popup->insert($data);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan ke Database');
        return redirect()->to(base_url('admin/popup'));
    }

    public function edit($id)
    {
        $validation = $this->validate([
            'gambar' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]|max_size[gambar,4096]'
        ]);

        if ($validation == FALSE) {
            $this->M_popup->update($id, [
                'judul'                 => $this->request->getPost('judul'),
            ]);
        } else {
            $data = $this->M_popup->find($id);
            $replace = $data['gambar'];
            if (file_exists(ROOTPATH . '../public_html/public/media/popup/' . $replace)) {
                unlink(ROOTPATH . '../public_html/public/media/popup/' . $replace);
            }

            $gambar   = $this->request->getFile('gambar');
            $fileName = $gambar->getRandomName();
            $this->M_popup->update($id, [
                'judul'                 => $this->request->getPost('judul'),
                'gambar'                => $fileName,
            ]);
            $gambar->move(ROOTPATH . '../public_html/public/media/popup', $fileName);
        }
        session()->setFlashdata('success', 'Data Berhasil Di Edit');
        return redirect()->to(base_url('admin/popup'));
    }



    public function delete($id)
    {
        $data = $this->M_popup->find($id);
        $gambar = $data['gambar'];
        if (file_exists(ROOTPATH . '../public_html/public/media/popup/' . $gambar)) {
            unlink(ROOTPATH . '../public_html/public/media/popup/' . $gambar);
        }
        $this->M_popup->delete($id);
        session()->setFlashdata('success', 'Data Berhasil di Hapus');
        return redirect()->to(base_url('admin/popup'));
    }
}
