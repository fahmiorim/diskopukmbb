<?php

namespace App\Controllers\Admin;

use App\Models\M_banner;
use App\Models\M_settings;


class Banner extends BaseController
{
    protected $M_banner;
    public function __construct()
    {
        $this->M_banner = new M_banner();
        $this->M_settings = new M_settings();
    }

    public function index()
    {
        $data = array(
            'title' => 'BANNER',
            'title2' => $this->M_settings->first(),
            'banner' => $this->M_banner->orderBy('id', 'DESC')->findAll(),
            'isi' => 'admin/banner/v_lists',
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
            'url' => [
                'label' => 'URL',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kalo {field}-nya gak ada, isikan dengan tanda "#" ',
                ]
            ],
            // 'posisi' => [
            //     'label' => 'posisi',
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => 'Pilih dulu {field}-nya mau di tarok mana!!!',
            //     ]
            // ],
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
            'url'                   => $this->request->getPost('url'),
            'posisi'                => $this->request->getPost('posisi'),
            'gambar'                => $fileName,
        ];
        $gambar->move(ROOTPATH . '../public_html/public/media/banner/', $fileName);

        $this->M_banner->insert($data);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan ke Database');
        return redirect()->to(base_url('admin/banner'));
    }

    public function edit($id)
    {
        $validation = $this->validate([
            'gambar' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]|max_size[gambar,4096]'
        ]);

        if ($validation == FALSE) {
            $this->M_banner->update($id, [
                'nama'                  => $this->request->getPost('nama'),
                'url'                   => $this->request->getPost('url'),
                // 'posisi'                => $this->request->getPost('posisi'),
            ]);
        } else {
            $data = $this->M_banner->find($id);
            $replace = $data['gambar'];
            if (file_exists(ROOTPATH . '../public_html/public/media/banner/' . $replace)) {
                unlink(ROOTPATH . '../public_html/public/media/banner/' . $replace);
            }

            $gambar   = $this->request->getFile('gambar');
            $fileName = $gambar->getRandomName();
            $this->M_banner->update($id, [
                'nama'                  => $this->request->getPost('nama'),
                'url'                   => $this->request->getPost('url'),
                // 'posisi'                => $this->request->getPost('posisi'),
                'gambar'                => $fileName,
            ]);
            $gambar->move(ROOTPATH . '../public_html/public/media/banner', $fileName);
        }
        session()->setFlashdata('success', 'Data Berhasil Di Edit');
        return redirect()->to(base_url('admin/banner'));
    }

    public function delete($id)
    {
        $data = $this->M_banner->find($id);
        $gambar = $data['gambar'];

        if (file_exists(ROOTPATH . '../public_html/public/media/banner/' . $gambar)) {
            unlink(ROOTPATH . '../public_html/public/media/banner/' . $gambar);
        }

        $this->M_banner->delete($id);
        session()->setFlashdata('success', 'Data Berhasil di Hapus');
        return redirect()->to(base_url('admin/banner'));
    }
}
