<?php

namespace App\Controllers\Admin;

use App\Models\M_profile;
use App\Models\M_perizinan;
use App\Models\M_settings;
use App\Models\M_izin;
use App\Models\M_edu;
use App\Models\M_datakopukm;

class Koperasi extends BaseController
{
    // Model properties
    protected $M_profile;
    protected $M_perizinan;
    protected $M_settings;
    protected $M_izin;
    protected $M_edu;
    protected $M_datakopukm;
    protected $M_berita;
    protected $db;


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

    public function bantuan()
    {
        $data = [
            'title' => 'Bantuan',
            'menu' => 'koperasi',
            'title2' => $this->M_settings->first(),
            'isi' => 'admin/koperasi/v_bantuan',
        ];
        return view('admin/layout/v_wrapper', $data);
    }


    public function ckeditorUpload()
    {
        $file = $this->request->getFile('upload');
        
        $validated = $this->validate([
            'upload' => [
                'uploaded[upload]',
                'mime_in[upload,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[upload,4098]',
            ],
        ]);
        
        if ($validated && $file) {
            $fileName = $file->getRandomName();
            $file->move(ROOTPATH . '../public_html/public/media/umkm/', $fileName);
            $data = [
                'uploaded' => true,
                'url' => base_url('public/media/umkm/' . $fileName),
            ];
        } else {
            $error = $file ? $file->getErrorString() : 'No file uploaded';
            $data = [
                'uploaded' => false,
                'error' => ['message' => $error],
            ];
        }
        return $this->response->setJSON($data);
    }

    public function data()
    {
        $data = array(
            'title' => 'Data KOPERASI',
            'menu' => 'koperasi',
            'title2' => $this->M_settings->first(),
            'datakoperasi' => $this->M_datakopukm->findAll(),
            'isi' => 'admin/koperasi/v_lists',
        );
        
        
        return view('admin/layout/v_wrapper', $data);
    }

    public function data_tambah()
    {
        $data = array(
            'title' => 'Tambah Data',
            'menu' => 'koperasi',
            'title2' => $this->M_settings->first(),
            'isi' => 'admin/koperasi/v_tambah',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function data_save()
    {
        // Validate the form data
        $validation = $this->validate([
            'name_koperasi' => [
                'label' => 'Nama Koperasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'id_number' => [
                'label' => 'ID Number',
                'rules' => 'required|is_unique[3fi_datakopukm.id_number]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'address_koperasi' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'districts_city_name' => [
                'label' => 'Kecamatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'valid_email',
                'errors' => [
                    'valid_email' => 'Format {field} tidak valid'
                ]
            ]
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Prepare the data for insertion
        $data = [
            'name_koperasi' => $this->request->getPost('name_koperasi'),
            'id_number' => $this->request->getPost('id_number'),
            'address_koperasi' => $this->request->getPost('address_koperasi'),
            'districts_city_name' => $this->request->getPost('districts_city_name'),
            'phone_number' => $this->request->getPost('phone_number'),
            'email' => $this->request->getPost('email'),
            'nib_koperasi' => $this->request->getPost('nib_koperasi'),
            'npwp_koperasi' => $this->request->getPost('npwp_koperasi'),
            'business_status_name' => 'KOPERASI', // Set as KOPERASI
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Insert the data
        $inserted = $this->M_datakopukm->insert($data);
        
        if ($inserted) {
            return redirect()->to(base_url('admin/koperasi/data'))->with('success', 'Data koperasi berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data koperasi')->withInput();
        }
    }

    public function data_edit($id_number = null)
    {
        if ($id_number === null) {
            return redirect()->to(base_url('admin/koperasi/data'))->with('error', 'ID tidak valid');
        }

        $koperasi = $this->M_datakopukm->where('id_number', $id_number)->first();
        
        if (!$koperasi) {
            return redirect()->to(base_url('admin/koperasi/data'))->with('error', 'Data koperasi tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Data Koperasi',
            'menu' => 'koperasi',
            'title2' => $this->M_settings->first(),
            'koperasi' => $koperasi,
            'isi' => 'admin/koperasi/v_edit',
        ];
        
        return view('admin/layout/v_wrapper', $data);
    }

    public function data_update($id_number = null)
    {
        if ($id_number === null) {
            return redirect()->to(base_url('admin/koperasi/data'))->with('error', 'ID tidak valid');
        }

        // Validate the form data
        $validation = $this->validate([
            'name_koperasi' => [
                'label' => 'Nama Koperasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'address_koperasi' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'districts_city_name' => [
                'label' => 'Kecamatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'valid_email',
                'errors' => [
                    'valid_email' => 'Format {field} tidak valid'
                ]
            ]
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Prepare the data for update
        $data = [
            'name_koperasi' => $this->request->getPost('name_koperasi'),
            'address_koperasi' => $this->request->getPost('address_koperasi'),
            'districts_city_name' => $this->request->getPost('districts_city_name'),
            'phone_number' => $this->request->getPost('phone_number'),
            'email' => $this->request->getPost('email'),
            'nib_koperasi' => $this->request->getPost('nib_koperasi'),
            'npwp_koperasi' => $this->request->getPost('npwp_koperasi'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Update the data
        $updated = $this->M_datakopukm->where('id_number', $id_number)->set($data)->update();
        
        if ($updated) {
            return redirect()->to(base_url('admin/koperasi/data'))->with('success', 'Data koperasi berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui data koperasi')->withInput();
        }
    }

    public function data_delete($id_number = null)
    {
        if ($id_number === null) {
            return redirect()->to(base_url('admin/koperasi/data'))->with('error', 'ID tidak valid');
        }

        // Delete the data
        $deleted = $this->M_datakopukm->where('id_number', $id_number)->delete();
        
        if ($deleted) {
            return redirect()->to(base_url('admin/koperasi/data'))->with('success', 'Data koperasi berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data koperasi');
        }
    }

    public function perizinan()
    {
        $data = array(
            'title' => 'Perizinan KOPERASI',
            'menu' => 'koperasi',
            'title2' => $this->M_settings->first(),
            'perizinan' => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'ASC')->findAll(),
            'isi' => 'admin/perizinan/v_lists',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function perizinan_tambah()
    {
        $data = array(
            'title' => 'Tambah Data',
            'menu' => 'koperasi',
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
            'kategori'              => 'KOPERASI',
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
        return redirect()->to(base_url('admin/koperasi/perizinan'));
    }

    public function perizinan_edit($id)
    {

        $data = array(
            'title' => 'Edit Data',
            'menu' => 'koperasi',
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
                'kategori'              => 'KOPERASI',
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
                'kategori'              => 'KOPERASI',
                'judul'                 => $this->request->getPost('judul'),
                'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
                'isi_halaman'            => $this->request->getPost('isi_halaman'),
                'gambar'                => $fileName,
            ]);
            $gambar->move(ROOTPATH . '../public_html/public/media/perizinan', $fileName);
        }
        session()->setFlashdata('success', 'Data Berhasil Di Edit');
        return redirect()->to(base_url('admin/koperasi/perizinan'));
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
            'menu' => 'koperasi',
            'title2' => $this->M_settings->first(),
            'izin' => $this->M_izin->where('kategori', 'KOPERASI')->where('id_perizinan', $id_perizinan)->orderBy('id', 'Desc')->findAll(),
            'perizinan' => $this->M_perizinan->where('id', $id_perizinan)->first(),
            'isi' => 'admin/perizinan/v_lists_izin',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function tambah_izin($id_perizinan)
    {
        $data = array(
            'title' => 'Tambah Data',
            'menu' => 'koperasi',
            'title2' => $this->M_settings->first(),
            'izin' => $this->M_izin->where('kategori', 'KOPERASI')->where('id_perizinan', $id_perizinan)->orderBy('id', 'Desc')->first(),
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
            'kategori'              => 'KOPERASI',
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
            'menu' => 'koperasi',
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
                'kategori'              => 'KOPERASI',
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
                'kategori'              => 'KOPERASI',
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
            'title' => 'Edu Koperasi',
            'menu' => 'koperasi',
            'title2' => $this->M_settings->first(),
            'eduukm' => $this->M_edu->where('kategori', 'KOPERASI')->orderBy('id', 'DESC')->findAll(),
            'isi' => 'admin/eduukm/v_lists',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function tambah_edu()
    {
        $data = array(
            'title' => 'Tambah Data',
            'menu' => 'koperasi',
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
            'kategori'              => 'KOPERASI',
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
        return redirect()->to(base_url('admin/koperasi/edu'));
    }

    public function edu_edit($id)
    {
        $data = array(
            'title' => 'Tambah Data',
            'menu' => 'koperasi',
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
        return redirect()->to(base_url('admin/koperasi/edu'));
    }
}
