<?php

namespace App\Controllers\Admin;

use App\Models\M_link;
use App\Models\M_settings;

class Link extends BaseController
{
    protected $M_link;
    public function __construct()
    {
        $this->M_link = new M_link();
        $this->M_settings = new M_settings();
    }

    public function index()
    {
        $data = array(
            'title' => 'LINK TERKAIT',
            'title2' => $this->M_settings->first(),
            'link' => $this->M_link->where(['kategori' => '2'])->orderBy('id', 'DESC')->findAll(),
            'isi' => 'admin/link/v_lists',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function tambah()
    {
        if (!$this->validate([
            'nama' => [
                'label' => 'nama',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isikan dulu {field}-nya yaaaaa!!!',
                ]
            ],
            'link_url' => [
                'label' => 'Link URL',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kalo {field}-nya gak ada, isikan dengan tanda "#" ',
                ]
            ],
            'gambar' => [
                'rules' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]|max_size[gambar,4096]',
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
            'nama'                  => $this->request->getPost('nama'),
            'link_url'              => $this->request->getPost('link_url'),
            'gambar'                => $fileName,
            'kategori'              => '2',
        ];
        $gambar->move(ROOTPATH . '../public_html/public/media/link/', $fileName);

        $this->M_link->insert($data);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan ke Database');
        return redirect()->to(base_url('admin/link'));
    }

    public function edit($id)
    {
        $validation = $this->validate([
            'gambar' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]|max_size[gambar,4096]'
        ]);

        if ($validation == FALSE) {
            $this->M_link->update($id, [
                'nama'                  => $this->request->getPost('nama'),
                'link_url'              => $this->request->getPost('link_url'),
            ]);
        } else {
            $data = $this->M_link->find($id);
            $replace = $data['gambar'];
            if (file_exists(ROOTPATH . '../public_html/public/media/link/' . $replace)) {
                unlink(ROOTPATH . '../public_html/public/media/link/' . $replace);
            }

            $gambar   = $this->request->getFile('gambar');
            $fileName = $gambar->getRandomName();
            $this->M_link->update($id, [
                'nama'                  => $this->request->getPost('nama'),
                'link_url'              => $this->request->getPost('link_url'),
                'gambar'                => $fileName,
            ]);
            $gambar->move(ROOTPATH . '../public_html/public/media/link', $fileName);
        }
        session()->setFlashdata('success', 'Data Berhasil Di Edit');
        return redirect()->to(base_url('admin/link'));
    }

    public function delete($id)
    {
        $data = $this->M_link->find($id);
        $gambar = $data['gambar'];

        if (file_exists(ROOTPATH . '../public_html/public/media/link/' . $gambar)) {
            unlink(ROOTPATH . '../public_html/public/media/link/' . $gambar);
        }

        $this->M_link->delete($id);
        session()->setFlashdata('success', 'Data Berhasil di Hapus');
        return redirect()->to(base_url('admin/link'));
    }
}
