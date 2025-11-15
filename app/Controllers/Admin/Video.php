<?php

namespace App\Controllers\Admin;

use App\Models\M_video;
use App\Models\M_settings;

class Video extends BaseController
{
    protected $M_video;
    public function __construct()
    {
        $this->M_video = new M_video();
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
            $file->move(ROOTPATH . '../public_html/public/media/video/', $fileName);
            $data = [
                'uploaded' => true,
                'url' => base_url('public/media/video/' . $fileName),
            ];
        } else {
            $data = [
                'uploaded' => false,
                'error' => $file,
            ];
        }
        return $this->response->setJSON($data);
    }

    public function index()
    {
        $data = array(
            'title' => 'VIDEO',
            'title2' => $this->M_settings->first(),
            'video' => $this->M_video->orderBy('id', 'DESC')->findAll(),
            'isi' => 'admin/video/v_lists',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function tambah()
    {
        $data = array(
            'title' => 'Tambah Video',
            'title2' => $this->M_settings->first(),
            'isi' => 'admin/video/v_tambah',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isikan dulu {field}nya yaaaaa!!! ',
                ]
            ],
            'deskripsi' => [
                'label' => 'Deskripsi',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kasih {field} dulu biar orang tau',
                ]
            ],
            'url' => [
                'label' => 'URL',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Youtube-nya wajib di isi!!!',
                ]
            ],
        ])) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }
        $data = [
            'judul'                 => $this->request->getPost('judul'),
            'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
            'deskripsi'             => $this->request->getPost('deskripsi'),
            'url'                   => $this->request->getPost('url'),
            'tanggal'               => date('Y-m-d'),
        ];

        $this->M_video->insert($data);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan ke Database');
        return redirect()->to(base_url('admin/video'));
    }

    public function edit($id)
    {

        $data = array(
            'title' => 'Edit Video',
            'title2' => $this->M_settings->first(),
            'video' => $this->M_video->where('id', $id)->first(),
            'isi' => 'admin/video/v_edit',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function update($id)
    {
        $this->M_video->update($id, [
            'judul'                 => $this->request->getPost('judul'),
            'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
            'deskripsi'             => $this->request->getPost('deskripsi'),
            'url'                   => $this->request->getPost('url'),
        ]);

        session()->setFlashdata('success', 'Data Berhasil Di Edit');
        return redirect()->to(base_url('admin/video'));
    }


    public function delete($id)
    {
        $this->M_video->delete($id);
        session()->setFlashdata('success', 'Data Berhasil di Hapus');
        return redirect()->to(base_url('admin/video'));
    }
}
