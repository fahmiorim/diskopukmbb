<?php

namespace App\Controllers\Admin;

use App\Models\M_pengumuman;
use App\Models\M_peraturan;
use App\Models\M_settings;
use App\Models\M_download;

class Informasi extends BaseController
{
    protected $M_pengumuman;

    public function __construct()
    {
        $this->M_pengumuman = new M_pengumuman();
        $this->M_peraturan = new M_peraturan();
        $this->M_settings = new M_settings();
        $this->M_download = new M_download();
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
            $file->move(ROOTPATH . '../public_html/public/media/informasi/', $fileName);
            $data = [
                'uploaded' => true,
                'url' => base_url('public/media/informasi/' . $fileName),
            ];
        } else {
            $data = [
                'uploaded' => false,
                'error' => $file,
            ];
        }
        return $this->response->setJSON($data);
    }

    public function pengumuman()
    {
        $data = array(
            'title' => 'PENGUMUMAN',
            'title2' => $this->M_settings->first(),
            'pengumuman' => $this->M_pengumuman->orderBy('id', 'DESC')->findAll(),
            'isi' => 'admin/informasi/v_pengumuman_lists',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function pengumuman_tambah()
    {
        $data = array(
            'title' => 'Tambah Pengumuman',
            'title2' => $this->M_settings->first(),
            'isi' => 'admin/informasi/v_pengumuman_tambah',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function pengumuman_save()
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
        $gambarName = $gambar->getRandomName();
        $data = [
            'judul'                 => $this->request->getPost('judul'),
            'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
            'deskripsi'            => $this->request->getPost('deskripsi'),
            'tanggal'               => date('Y-m-d'),
            'jam'                   => date('G:i:s'),
            'gambar'                => $gambarName,
            'user'                  => session()->get('nama'),
            'form'            => $this->request->getPost('form'),
            'form_judul'            => $this->request->getPost('form_judul'),
            'batas_pendaftaran'            => $this->request->getPost('batas_pendaftaran'),

        ];
        $gambar->move(ROOTPATH . '../public_html/public/media/pengumuman/', $gambarName);

        $this->M_pengumuman->insert($data);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan ke Database');
        return redirect()->to(base_url('admin/informasi/pengumuman'));
    }

    public function pengumuman_edit($id)
    {

        $data = array(
            'title' => 'Edit Pengumuman',
            'title2' => $this->M_settings->first(),
            'pengumuman' => $this->M_pengumuman->where('id', $id)->first(),
            'isi' => 'admin/informasi/v_pengumuman_edit',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function pengumuman_update($id)
    {
        $validation = $this->validate([
            'gambar' => [
                'rules' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]|max_size[gambar,4098]',
                'errors' => [
                    'uploaded' => 'Lupa ko ngupload Gambarnya kan???',
                    'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                    'max_size' => 'Ukuran Gambar Jangan Lewat dari 2 MB'
                ]
            ],
        ]);

        if ($validation == FALSE) {
            $this->M_pengumuman->update($id, [
                'judul'                 => $this->request->getPost('judul'),
                'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
                'deskripsi'            => $this->request->getPost('deskripsi'),
                'form'            => $this->request->getPost('form'),
                'form_judul'            => $this->request->getPost('form_judul'),
                'batas_pendaftaran'     => $this->request->getPost('batas_pendaftaran'),
            ]);
        } else {
            $data = $this->M_pengumuman->find($id);
            $replace = $data['gambar'];
            if (file_exists(ROOTPATH . '../public_html/public/media/pengumuman/' . $replace)) {
                unlink(ROOTPATH . '../public_html/public/media/pengumuman/' . $replace);
            }

            $gambar   = $this->request->getFile('gambar');
            $fileName = $gambar->getRandomName();
            $this->M_pengumuman->update($id, [
                'judul'                 => $this->request->getPost('judul'),
                'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
                'deskripsi'            => $this->request->getPost('deskripsi'),
                'tanggal'               => date('Y-m-d'),
                'jam'                   => date('G:i:s'),
                'gambar'                => $fileName,
                'form'            => $this->request->getPost('form'),
                'form_judul'            => $this->request->getPost('form_judul'),
                'batas_pendaftaran'     => $this->request->getPost('batas_pendaftaran'),
            ]);
            $gambar->move(ROOTPATH . '../public_html/public/media/pengumuman', $fileName);
        }
        session()->setFlashdata('success', 'Data Berhasil Di Edit');
        return redirect()->to(base_url('admin/informasi/pengumuman'));
    }

    public function pengumuman_delete($id)
    {
        $data = $this->M_pengumuman->find($id);
        $gambar = $data['gambar'];
        if (file_exists(ROOTPATH . '../public_html/public/media/pengumuman/' . $gambar)) {
            unlink(ROOTPATH . '../public_html/public/media/pengumuman/' . $gambar);
        }
        $this->M_pengumuman->delete($id);
        session()->setFlashdata('success', 'Data Berhasil di Hapus');
        return redirect()->to(base_url('admin/informasi/pengumuman'));
    }

    public function peraturan()
    {
        $data = array(
            'title' => 'PERATURAN',
            'title2' => $this->M_settings->first(),
            'peraturan' => $this->M_peraturan->orderBy('id', 'DESC')->findAll(),
            'isi' => 'admin/informasi/v_peraturan_lists',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function peraturan_tambah()
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
                'rules' => 'uploaded[file]|mime_in[file,application/pdf]|max_size[file,20098]',
                'errors' => [
                    'uploaded' => 'Lupa ko ngupload filenya kan???',
                    'mime_in' => 'Cuma PDF aja yang bisa di Upload Lek!!',
                    'max_size' => 'Ukuran File Jangan Lewat dari 20 MB'
                ]
            ],
        ])) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }

        $file   = $this->request->getFile('file');
        $fileName = $file->getClientName();
        $data = [
            'judul'                 => $this->request->getPost('judul'),
            'tanggal'               => date('Y-m-d'),
            'file'                => $fileName,
        ];
        $file->move(ROOTPATH . '../public_html/public/media/peraturan/', $fileName);

        $this->M_peraturan->insert($data);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan ke Database');
        return redirect()->to(base_url('admin/informasi/peraturan'));
    }

    public function peraturan_edit($id)
    {
        $validation = $this->validate([
            'file' => [
                'rules' => 'uploaded[file]|mime_in[file,application/pdf]|max_size[file,20098]',
                'errors' => [
                    'uploaded' => 'Lupa ko ngupload filenya kan???',
                    'mime_in' => 'Cuma PDF aja yang bisa di Upload Lek!!',
                    'max_size' => 'Ukuran File Jangan Lewat dari 20 MB'
                ]
            ],
        ]);

        if ($validation == FALSE) {
            $this->M_peraturan->update($id, [
                'judul'                 => $this->request->getPost('judul'),
            ]);
        } else {
            $data = $this->M_peraturan->find($id);
            $replace = $data['file'];
            if (file_exists(ROOTPATH . '../public_html/public/media/peraturan/' . $replace)) {
                unlink(ROOTPATH . '../public_html/public/media/peraturan/' . $replace);
            }

            $file   = $this->request->getFile('file');
            $fileName = $file->getClientName();
            $this->M_peraturan->update($id, [
                'judul'                 => $this->request->getPost('judul'),
                'tanggal'               => date('Y-m-d'),
                'file'                => $fileName,
            ]);
            $file->move(ROOTPATH . '../public_html/public/media/peraturan', $fileName);
        }
        session()->setFlashdata('success', 'Data Berhasil Di Edit');
        return redirect()->to(base_url('admin/informasi/peraturan'));
    }

    public function peraturan_delete($id)
    {
        $data = $this->M_peraturan->find($id);
        $file = $data['file'];
        if (file_exists(ROOTPATH . '../public_html/public/media/peraturan/' . $file)) {
            unlink(ROOTPATH . '../public_html/public/media/peraturan/' . $file);
        }
        $this->M_peraturan->delete($id);
        session()->setFlashdata('success', 'Data Berhasil di Hapus');
        return redirect()->to(base_url('admin/informasi/peraturan'));
    }

    public function download()
    {
        $data = array(
            'title' => 'DOWNLOAD',
            'title2' => $this->M_settings->first(),
            'download' => $this->M_download->orderBy('id', 'DESC')->findAll(),
            'isi' => 'admin/informasi/v_download_lists',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function download_tambah()
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
                'rules' => 'uploaded[file]|mime_in[file,application/pdf,application/msword,application/xml]|max_size[file,20098]',
                'errors' => [
                    'uploaded' => 'Lupa ko ngupload filenya kan???',
                    'mime_in' => 'Cuma PDF,Word sama Excel aja yang bisa di Upload Lek!!',
                    'max_size' => 'Ukuran File Jangan Lewat dari 20 MB'
                ]
            ],
        ])) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }

        $file   = $this->request->getFile('file');
        $fileName = $file->getClientName();
        $data = [
            'judul'                 => $this->request->getPost('judul'),
            'tanggal'               => date('Y-m-d'),
            'file'                => $fileName,
        ];
        $file->move(ROOTPATH . '../public_html/public/media/download/', $fileName);

        $this->M_download->insert($data);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan ke Database');
        return redirect()->to(base_url('admin/informasi/download'));
    }

    public function download_edit($id)
    {
        $validation = $this->validate([
            'file' => [
                'rules' => 'uploaded[file]|mime_in[file,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]|max_size[file,20098]',
                'errors' => [
                    'uploaded' => 'Lupa ko ngupload filenya kan???',
                    'mime_in' => 'Cuma PDF,Word sama Excel aja yang bisa di Upload Lek!!',
                    'max_size' => 'Ukuran File Jangan Lewat dari 20 MB'
                ]
            ],
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
            $fileName = $file->getClientName();
            $this->M_download->update($id, [
                'judul'                 => $this->request->getPost('judul'),
                'tanggal'               => date('Y-m-d'),
                'file'                => $fileName,
            ]);
            $file->move(ROOTPATH . '../public_html/public/media/download', $fileName);
        }
        session()->setFlashdata('success', 'Data Berhasil Di Edit');
        return redirect()->to(base_url('admin/informasi/download'));
    }

    public function download_delete($id)
    {
        $data = $this->M_download->find($id);
        $file = $data['file'];
        if (file_exists(ROOTPATH . '../public_html/public/media/download/' . $file)) {
            unlink(ROOTPATH . '../public_html/public/media/download/' . $file);
        }
        $this->M_download->delete($id);
        session()->setFlashdata('success', 'Data Berhasil di Hapus');
        return redirect()->to(base_url('admin/informasi/download'));
    }
}
