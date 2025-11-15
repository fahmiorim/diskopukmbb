<?php

namespace App\Controllers\Admin;

use App\Models\M_download;
use App\Models\M_settings;


class Download extends BaseController
{
    protected $M_download;

    public function __construct()
    {
        $this->M_download = new M_download();
        $this->M_settings = new M_settings();
    }

    public function index()
    {
        $data = array(
            'title' => 'FILE DOWNLOAD',
            'title2' => $this->M_settings->first(),
            'download' => $this->M_download->orderBy('id', 'DESC')->findAll(),
            'isi' => 'admin/download/v_lists',
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
            'file' => [
                'rules' => 'uploaded[file]|mime_in[file,application/pdf]|max_size[file,4098]',
                'errors' => [
                    'uploaded' => 'Lupa ko ngupload filenya kan???',
                    'mime_in' => 'Cuma PDF aja yang bisa di Upload Lek!!',
                    'max_size' => 'Ukuran File Jangan Lewat dari 4 MB'
                ]
            ],
        ])) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }

        $file   = $this->request->getFile('file');
        $fileName = $file->getRandomName();
        $data = [
            'judul'                 => $this->request->getPost('judul'),
            'tanggal'               => date('Y-m-d'),
            'file'                => $fileName,
        ];
        $file->move(ROOTPATH . '../public_html/public/media/download/', $fileName);

        $this->M_download->insert($data);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan ke Database');
        return redirect()->to(base_url('admin/download'));
    }

    public function edit($id)
    {
        $validation = $this->validate([
            'file' => 'uploaded[lampiran]|mime_in[lampiran,application/pdf]|max_size[lampiran,4098]',
        ]);

        if ($validation == FALSE) {
            $this->M_download->update($id, [
                'judul'                 => $this->request->getPost('judul'),
            ]);
        } else {
            $data = $this->M_download->find($id);
            $replace = $data['file'];
            if (file_exists(ROOTPATH . '../public_html/public/media/download/' . $replace)) {
                unlink(ROOTPATH . '../public_html/public/media/download/' . $replace);
            }

            $file   = $this->request->getFile('file');
            $fileName = $file->getRandomName();
            $this->M_download->update($id, [
                'judul'                 => $this->request->getPost('judul'),
                'tanggal'               => date('Y-m-d'),
                'file'                => $fileName,
            ]);
            $file->move(ROOTPATH . '../public_html/public/media/download', $fileName);
        }
        session()->setFlashdata('success', 'Data Berhasil Di Edit');
        return redirect()->to(base_url('admin/download'));
    }

    public function delete($id)
    {
        $data = $this->M_download->find($id);
        $file = $data['file'];
        if (file_exists(ROOTPATH . '../public_html/public/media/download/' . $file)) {
            unlink(ROOTPATH . '../public_html/public/media/download/' . $file);
        }
        $this->M_download->delete($id);
        session()->setFlashdata('success', 'Data Berhasil di Hapus');
        return redirect()->to(base_url('admin/download'));
    }
}
