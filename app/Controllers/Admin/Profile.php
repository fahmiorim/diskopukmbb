<?php

namespace App\Controllers\Admin;

use App\Models\M_profile;
use App\Models\M_kepegawaian;
use App\Models\M_settings;
use App\Models\M_jabatan;

class Profile extends BaseController
{
    protected $M_profile;

    public function __construct()
    {
        $this->M_profile = new M_profile();
        $this->M_kepegawaian = new M_kepegawaian();
        $this->M_settings = new M_settings();
        $this->M_jabatan = new M_jabatan();
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
            $file->move(ROOTPATH . '../public_html/public/media/profile/', $fileName);
            $data = [
                'uploaded' => true,
                'url' => base_url('public/media/profile/' . $fileName),
            ];
        } else {
            $data = [
                'uploaded' => false,
                'error' => $file,
            ];
        }
        return $this->response->setJSON($data);
    }

    public function menu()
    {
        $data = array(
            'title' => 'PROFILE',
            'title2' => $this->M_settings->first(),
            'profile' => $this->M_profile->orderBy('id', 'ASC')->findAll(),
            'isi' => 'admin/profile/v_lists',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function tambah()
    {
        $data = array(
            'title' => 'Tambah Profile',
            'title2' => $this->M_settings->first(),
            'isi' => 'admin/profile/v_tambah',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'urutan' => [
                'label' => 'Urutan',
                'rules' => 'is_unique[3fi_halaman.urutan]',
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
            'urutan'                 => $this->request->getPost('urutan'),
            'kategori'              => 'PROFILE',
            'judul'                 => $this->request->getPost('judul'),
            'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
            'isi_halaman'            => $this->request->getPost('isi_halaman'),
            'hari'                  => date('l'),
            'tanggal'               => date('Y-m-d'),
            'jam'                   => date('G:i:s'),
            'gambar'                => $fileName,
        ];
        $gambar->move(ROOTPATH . '../public_html/public/media/profile/', $fileName);

        $this->M_profile->insert($data);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan ke Database');
        return redirect()->to(base_url('admin/profile/menu'));
    }

    public function edit($id)
    {

        $data = array(
            'title' => 'Edit Profile',
            'title2' => $this->M_settings->first(),
            'profile' => $this->M_profile->where('id', $id)->first(),
            'isi' => 'admin/profile/v_edit',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function update($id)
    {
        $validation = $this->validate([
            'gambar' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]|max_size[gambar,4096]'
        ]);

        if ($validation == FALSE) {
            $this->M_profile->update($id, [
                'urutan'                 => $this->request->getPost('urutan'),
                'kategori'              => 'PROFILE',
                'judul'                 => $this->request->getPost('judul'),
                'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
                'isi_halaman'            => $this->request->getPost('isi_halaman'),
            ]);
        } else {
            $data = $this->M_profile->find($id);
            $replace = $data['gambar'];
            if (file_exists(ROOTPATH . '../public_html/public/media/profile/' . $replace)) {
                unlink(ROOTPATH . '../public_html/public/media/profile/' . $replace);
            }

            $gambar   = $this->request->getFile('gambar');
            $fileName = $gambar->getRandomName();
            $this->M_profile->update($id, [
                'urutan'                 => $this->request->getPost('urutan'),
                'kategori'              => 'PROFILE',
                'judul'                 => $this->request->getPost('judul'),
                'judul_seo'             => url_title($this->request->getPost('judul'), '-', TRUE),
                'isi_halaman'            => $this->request->getPost('isi_halaman'),
                'gambar'                => $fileName,
            ]);
            $gambar->move(ROOTPATH . '../public_html/public/media/profile', $fileName);
        }
        session()->setFlashdata('success', 'Data Berhasil Di Edit');
        return redirect()->to(base_url('admin/profile/menu'));
    }

    public function delete($id)
    {
        $data = $this->M_profile->find($id);
        $gambar = $data['gambar'];
        if (file_exists(ROOTPATH . '../public_html/public/media/profile/' . $gambar)) {
            unlink(ROOTPATH . '../public_html/public/media/profile/' . $gambar);
        }
        $this->M_profile->delete($id);
        session()->setFlashdata('success', 'Data Berhasil di Hapus');
        return redirect()->to(base_url('admin/profile'));
    }

    public function kepegawaian()
    {
        $data = array(
            'title' => 'KEPEGAWAIAN',
            'title2' => $this->M_settings->first(),
            'pegawai' => $this->M_kepegawaian->orderBy('id', 'ASC')->findAll(),
            'isi' => 'admin/profile/v_kepegawaian_lists',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function kepegawaian_tambah()
    {
        $data = array(
            'title' => 'Tambah Pegawai',
            'title2' => $this->M_settings->first(),
            'profile' => $this->M_profile->orderBy('urutan', 'DESC')->first(),
            'jabatan' => $this->M_jabatan->orderBy('id', 'Asc')->findAll(),
            'isi' => 'admin/profile/v_kepegawaian_tambah',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function kepegawaian_save()
    {
        if (!$this->validate([
            'nip' => [
                'label' => 'NIP',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isikan dulu {field}nya yaaaaa!!! ',
                ]
            ],
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isikan {field}nya dululah lek!!',
                ]
            ],
            'golongan' => [
                'label' => 'Gologan',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tinggal milih {field}nya ajapun!!',
                ]
            ],
            'jabatan' => [
                'label' => 'Jabatan',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilihlah {field}nya apa!!',
                ]
            ],
            'status' => [
                'label' => 'Status',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilihlah {field}nya aktip apa gak!!',
                ]
            ],
            'urutan' => [
                'label' => 'Urutan',
                'rules' => 'is_unique[3fi_kepegawaian.urutan]',
                'errors' => [
                    'is_unique' => '{field} ini udah ada !!!',
                ]
            ],
            'foto' => [
                'rules' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto,4098]',
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

        $foto   = $this->request->getFile('foto');
        $fileName = $foto->getRandomName();
        $data = [
            'nip'               => $this->request->getPost('nip'),
            'nama'              => $this->request->getPost('nama'),
            'golongan'          => $this->request->getPost('golongan'),
            'jabatan'           => $this->request->getPost('jabatan'),
            'status'            => $this->request->getPost('status'),
            'urutan'            => $this->request->getPost('urutan'),
            'foto'              => $fileName,
        ];
        $foto->move(ROOTPATH . '../public_html/public/media/kepegawaian/', $fileName);

        $this->M_kepegawaian->insert($data);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan ke Database');
        return redirect()->to(base_url('admin/profile/kepegawaian'));
    }

    public function kepegawaian_edit($id)
    {
        $data = array(
            'title' => 'Edit Pegawai',
            'title2' => $this->M_settings->first(),
            'pegawai' => $this->M_kepegawaian->where('id', $id)->findAll(),
            'jabatan' => $this->M_jabatan->orderBy('id', 'Asc')->findAll(),
            'isi' => 'admin/profile/v_kepegawaian_edit',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function kepegawaian_update($id)
    {
        $validation = $this->validate([
            'foto' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto,4096]',
        ]);

        if ($validation == FALSE) {
            $this->M_kepegawaian->update($id, [
                'nip'               => $this->request->getPost('nip'),
                'nama'              => $this->request->getPost('nama'),
                'golongan'          => $this->request->getPost('golongan'),
                'jabatan'           => $this->request->getPost('jabatan'),
                'status'            => $this->request->getPost('status'),
                'urutan'            => $this->request->getPost('urutan'),
            ]);
        } else {
            $data = $this->M_kepegawaian->find($id);
            $replace = $data['foto'];
            if (file_exists(ROOTPATH . '../public_html/public/media/kepegawaian/' . $replace)) {
                unlink(ROOTPATH . '../public_html/public/media/kepegawaian/' . $replace);
            }

            $foto   = $this->request->getFile('foto');
            $fileName = $foto->getRandomName();
            $this->M_kepegawaian->update($id, [
                'nip'               => $this->request->getPost('nip'),
                'nama'              => $this->request->getPost('nama'),
                'golongan'          => $this->request->getPost('golongan'),
                'jabatan'           => $this->request->getPost('jabatan'),
                'status'            => $this->request->getPost('status'),
                'urutan'            => $this->request->getPost('urutan'),
                'foto'              => $fileName,
            ]);
            $foto->move(ROOTPATH . '../public_html/public/media/kepegawaian', $fileName);
        }
        session()->setFlashdata('success', 'Data Berhasil Di Edit');
        return redirect()->to(base_url('admin/profile/kepegawaian'));
    }

    public function kepegawaian_delete($id)
    {
        $data = $this->M_kepegawaian->find($id);
        $foto = $data['foto'];
        if (file_exists(ROOTPATH . '../public_html/public/media/kepegawaian/' . $foto)) {
            unlink(ROOTPATH . '../public_html/public/media/kepegawaian/' . $foto);
        }
        $this->M_kepegawaian->delete($id);
        session()->setFlashdata('success', 'Data Berhasil di Hapus');
        return redirect()->to(base_url('admin/profile/kepegawaian'));
    }
}
