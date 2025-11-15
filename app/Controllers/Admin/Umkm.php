<?php

namespace App\Controllers\Admin;

use App\Models\M_profile;
use App\Models\M_perizinan;
use App\Models\M_settings;
use App\Models\M_izin;
use App\Models\M_edu;
use App\Models\M_datakopukm;

class Umkm extends BaseController
{


    public function __construct()
    {
        $this->M_profile = new M_profile();
        $this->M_perizinan = new M_perizinan();
        $this->M_settings = new M_settings();
        $this->M_izin = new M_izin();
        $this->M_edu = new M_edu();
        $this->M_datakopukm = new M_datakopukm();
        $this->db = \Config\Database::connect();
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
            $file->move(ROOTPATH . '../public_html/public/media/umkm/', $fileName);
            $data = [
                'uploaded' => true,
                'url' => base_url('public/media/umkm/' . $fileName),
            ];
        } else {
            $data = [
                'uploaded' => false,
                'error' => $file,
            ];
        }
        return $this->response->setJSON($data);
    }

    public function data()
    {
        $data = array(
            'title' => 'Data UKM',
            'menu' => 'umkm',
            'title2' => $this->M_settings->first(),
            'datakopukm' => $this->M_datakopukm->findAll(),
            'isi' => 'admin/ukm/v_lists',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function data_tambah()
    {
        $data = array(
            'title' => 'Tambah Data',
            'menu' => 'UKM',
            'title2' => $this->M_settings->first(),
            'isi' => 'admin/ukm/v_tambah',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function perizinan()
    {
        $data = array(
            'title' => 'Perizinan UKM',
            'menu' => 'umkm',
            'title2' => $this->M_settings->first(),
            'perizinan' => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'ASC')->findAll(),
            'isi' => 'admin/perizinan/v_lists',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function perizinan_tambah()
    {
        $data = array(
            'title' => 'Tambah Data',
            'menu' => 'UKM',
            'title2' => $this->M_settings->first(),
            'isi' => 'admin/perizinan/v_tambah',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function perizinan_save()
    {
        if (!$this->validate([
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isikan dulu {field}nya yaaaaa!!! ',
                ]
            ],
            'isi_halaman' => [
                'label' => 'Isi Halaman',
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
            'urutan'                 => $this->request->getPost('urutan'),
            'kategori'              => 'UMKM',
            'judul'                 => $this->request->getPost('judul'),
            'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
            'isi_halaman'            => $this->request->getPost('isi_halaman'),
            'hari'                  => date('l'),
            'tanggal'               => date('Y-m-d'),
            'jam'                   => date('G:i:s'),
            'gambar'                => $fileName,
        ];
        $gambar->move(ROOTPATH . '../public_html/public/media/perizinan/', $fileName);

        $this->M_perizinan->insert($data);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan ke Database');
        return redirect()->to(base_url('admin/umkm/perizinan'));
    }

    public function perizinan_edit($id)
    {

        $data = array(
            'title' => 'Edit Data',
            'menu' => 'umkm',
            'title2' => $this->M_settings->first(),
            'perizinan' => $this->M_perizinan->where('id', $id)->first(),
            'isi' => 'admin/perizinan/v_edit',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function perizinan_update($id)
    {
        $validation = $this->validate([
            'gambar' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]|max_size[gambar,4096]'
        ]);

        if ($validation == FALSE) {
            $this->M_perizinan->update($id, [
                'urutan'                 => $this->request->getPost('urutan'),
                'kategori'              => 'UMKM',
                'judul'                 => $this->request->getPost('judul'),
                'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
                'isi_halaman'            => $this->request->getPost('isi_halaman'),
            ]);
        } else {
            $data = $this->M_perizinan->find($id);
            $replace = $data['gambar'];
            if (file_exists(ROOTPATH . '../public_html/public/media/perizinan/' . $replace)) {
                unlink(ROOTPATH . '../public_html/public/media/perizinan/' . $replace);
            }

            $gambar   = $this->request->getFile('gambar');
            $fileName = $gambar->getRandomName();
            $this->M_perizinan->update($id, [
                'urutan'                 => $this->request->getPost('urutan'),
                'kategori'              => 'UMKM',
                'judul'                 => $this->request->getPost('judul'),
                'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
                'isi_halaman'            => $this->request->getPost('isi_halaman'),
                'gambar'                => $fileName,
            ]);
            $gambar->move(ROOTPATH . '../public_html/public/media/perizinan', $fileName);
        }
        session()->setFlashdata('success', 'Data Berhasil Di Edit');
        return redirect()->to(base_url('admin/umkm/perizinan'));
    }

    public function perizinan_delete($id)
    {
        $data = $this->M_perizinan->find($id);
        $gambar = $data['gambar'];
        if (file_exists(ROOTPATH . '../public_html/public/media/perizinan/' . $gambar)) {
            unlink(ROOTPATH . '../public_html/public/media/perizinan/' . $gambar);
        }
        $this->M_perizinan->delete($id);
        session()->setFlashdata('success', 'Data Berhasil di Hapus');
        return redirect()->to(base_url('admin/umkm/perizinan'));
    }

    public function list_izin($id_perizinan)
    {
        $data = array(
            'title' => 'List Izin',
            'menu' => 'umkm',
            'title2' => $this->M_settings->first(),
            'izin' => $this->M_izin->where('kategori', 'UMKM')->where('id_perizinan', $id_perizinan)->orderBy('id', 'Desc')->findAll(),
            'perizinan' => $this->M_perizinan->where('id', $id_perizinan)->first(),
            'isi' => 'admin/perizinan/v_lists_izin',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function tambah_izin($id_perizinan)
    {
        $data = array(
            'title' => 'Tambah Data',
            'menu' => 'umkm',
            'title2' => $this->M_settings->first(),
            'izin' => $this->M_izin->where('kategori', 'UMKM')->where('id_perizinan', $id_perizinan)->orderBy('id', 'Desc')->first(),
            'perizinan' => $this->M_perizinan->where('id', $id_perizinan)->first(),
            'isi' => 'admin/perizinan/v_tambah_izin',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function save_izin($id_perizinan)
    {
        if (!$this->validate([
            'urutan' => [
                'label' => 'Urutan',
                'rules' => 'is_unique[3fi_perizinan.urutan]',
                'errors' => [
                    'is_unique' => '{field} ini udah ada !!!',
                ]
            ],
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isikan dulu {field}nya yaaaaa!!! ',
                ]
            ],
            'isi_halaman' => [
                'label' => 'Isi Halaman',
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
            'id_perizinan'          => $id_perizinan,
            'kategori'              => 'UMKM',
            'judul'                 => $this->request->getPost('judul'),
            'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
            'isi_halaman'            => $this->request->getPost('isi_halaman'),
            'hari'                  => date('l'),
            'tanggal'               => date('Y-m-d'),
            'jam'                   => date('G:i:s'),
            'gambar'                => $fileName,
        ];
        $gambar->move(ROOTPATH . '../public_html/public/media/perizinan/', $fileName);

        $this->M_izin->insert($data);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan ke Database');
        return redirect()->to(base_url('admin/umkm/list_izin/' . $id_perizinan));
    }

    public function edit_izin($id_perizinan, $id)
    {

        $data = array(
            'title' => 'Edit Data',
            'menu' => 'umkm',
            'title2' => $this->M_settings->first(),
            'izin' => $this->M_izin->where('id', $id)->first(),
            'isi' => 'admin/perizinan/v_edit_izin',
        );
        echo view('admin/layout/v_wrapper', $data);
    }


    public function update_izin($id_perizinan, $id)
    {
        $validation = $this->validate([
            'gambar' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]|max_size[gambar,4096]'
        ]);

        if ($validation == FALSE) {
            $this->M_izin->update($id, [
                'kategori'              => 'UMKM',
                'judul'                 => $this->request->getPost('judul'),
                'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
                'isi_halaman'            => $this->request->getPost('isi_halaman'),
            ]);
        } else {
            $data = $this->M_izin->find($id);
            $replace = $data['gambar'];
            if (file_exists(ROOTPATH . '../public_html/public/media/perizinan/' . $replace)) {
                unlink(ROOTPATH . '../public_html/public/media/perizinan/' . $replace);
            }

            $gambar   = $this->request->getFile('gambar');
            $fileName = $gambar->getRandomName();
            $this->M_izin->update($id, [
                'kategori'              => 'UMKM',
                'judul'                 => $this->request->getPost('judul'),
                'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
                'isi_halaman'            => $this->request->getPost('isi_halaman'),
                'gambar'                => $fileName,
            ]);
            $gambar->move(ROOTPATH . '../public_html/public/media/perizinan', $fileName);
        }
        session()->setFlashdata('success', 'Data Berhasil Di Edit');
        return redirect()->to(base_url('admin/umkm/list_izin/' . $id_perizinan));
    }

    public function delete_izin($id_perizinan, $id)
    {
        $data = $this->M_izin->find($id);
        $gambar = $data['gambar'];
        if (file_exists(ROOTPATH . '../public_html/public/media/perizinan/' . $gambar)) {
            unlink(ROOTPATH . '../public_html/public/media/perizinan/' . $gambar);
        }
        $this->M_izin->delete($id);
        session()->setFlashdata('success', 'Data Berhasil di Hapus');
        return redirect()->to(base_url('admin/umkm/list_izin/' . $id_perizinan));
    }

    public function edu()
    {
        $data = array(
            'title' => 'Edu UKM',
            'menu' => 'umkm',
            'title2' => $this->M_settings->first(),
            'eduukm' => $this->M_edu->where('kategori', 'UMKM')->orderBy('id', 'DESC')->findAll(),
            'isi' => 'admin/eduukm/v_lists',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function tambah_edu()
    {
        $data = array(
            'title' => 'Tambah Data',
            'menu' => 'umkm',
            'title2' => $this->M_settings->first(),
            'isi' => 'admin/eduukm/v_tambah',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function edu_save()
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
                'label' => 'deskripsinya',
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
        $filebaca   = $this->request->getFile('filebaca');
        $gambarName = $gambar->getRandomName();
        $fileName = $filebaca->getRandomName();
        $data = [
            'kategori'              => 'UMKM',
            'judul'                 => $this->request->getPost('judul'),
            'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
            'deskripsi'             => $this->request->getPost('deskripsi'),
            'materi'                => $this->request->getPost('materi'),
            'jenis'                 => $this->request->getPost('jenis'),
            'hari'                  => date('l'),
            'tanggal'               => date('Y-m-d'),
            'jam'                   => date('G:i:s'),
            'gambar'                => $gambarName,
            'link'                  => $this->request->getPost('link'),
            'file'                  => $fileName
        ];

        if ($filebaca == "") {
        } else {
            $filebaca->move(ROOTPATH . '../public_html/public/media/eduukm/', $fileName);
        }


        $gambar->move(ROOTPATH . '../public_html/public/media/eduukm/', $gambarName);

        $this->M_edu->insert($data);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan ke Database');
        return redirect()->to(base_url('admin/umkm/edu'));
    }

    public function edu_edit($id)
    {
        $data = array(
            'title' => 'Tambah Data',
            'menu' => 'umkm',
            'title2' => $this->M_settings->first(),
            'eduedit' => $this->M_edu->where('id', $id)->first(),
            'isi' => 'admin/eduukm/v_edit',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function edu_update($id)
    {
        $validation = $this->validate([
            'gambar' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]|max_size[gambar,4096]'
        ]);

        if ($validation == FALSE) {
            $this->M_edu->update($id, [
                'judul'                 => $this->request->getPost('judul'),
                'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
                'deskripsi'            => $this->request->getPost('deskripsi'),
                'materi'                => $this->request->getPost('materi'),
                'jenis'            => $this->request->getPost('jenis'),
                'link'                  => $this->request->getPost('link'),
            ]);
        } else {
            $data = $this->M_edu->find($id);
            $replace = $data['gambar'];
            if (file_exists(ROOTPATH . '../public_html/public/media/eduukm/' . $replace)) {
                unlink(ROOTPATH . '../public_html/public/media/eduukm/' . $replace);
            }

            $gambar   = $this->request->getFile('gambar');
            $filebaca   = $this->request->getFile('filebaca');
            $gambarName = $gambar->getRandomName();
            $fileName = $filebaca->getRandomName();
            $this->M_berita->update($id, [
                'judul'                 => $this->request->getPost('judul'),
                'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
                'deskripsi'             => $this->request->getPost('deskripsi'),
                'materi'                => $this->request->getPost('materi'),
                'jenis'                 => $this->request->getPost('jenis'),
                'gambar'                => $gambarName,
                'link'                  => $this->request->getPost('link'),
                'file'                  => $fileName
            ]);
            $gambar->move(ROOTPATH . '../public_html/public/media/eduukm', $fileName);
        }
        session()->setFlashdata('success', 'Data Berhasil Di Edit');
        return redirect()->to(base_url('admin/umkm/edu'));
    }
}
