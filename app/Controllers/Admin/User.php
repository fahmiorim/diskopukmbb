<?php

namespace App\Controllers\Admin;

use App\Models\M_user;
use App\Models\M_settings;

class User extends BaseController
{
    protected $M_user;
    public function __construct()
    {
        $this->M_user = new M_user();
        $this->M_settings = new M_settings();
    }

    public function index()
    {
        $data = array(
            'title' => 'USER',
            'title2' => $this->M_settings->first(),
            'user' => $this->M_user->orderBy('id', 'DESC')->findAll(),
            'isi' => 'admin/user/v_lists',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function tambah()
    {
        if ($this->validate([
            'username' =>  [
                'label' => 'Username',
                'rules' => 'trim|required|min_length[3]|max_length[20]|alpha_dash|is_unique[3fi_admin.username]',
                'errors' => [
                    'required' => '{field} wajib di isi dan tidak boleh kosong !!!',
                    'is_unique' => '{field} sudah ada !!!',
                    'alpha_dash' => '{field} hanya boleh berisi karakter alfanumerik, garis bawah, dan tanda hubung',
                    'min_length' => '{field} harus memiliki panjang lebih dari 3 karakter',
                    'max_length' => '{field} tidak boleh melebihi 20 karakter'
                ],
            ],
            'nama' =>  [
                'label' => 'Nama Lengkap',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi dan tidak boleh kosong !!!',
                ],
            ],
            'hp' =>  [
                'label' => 'No Handphone',
                'rules' => 'required|regex_match[^(\+62|62)?[\s-]?0?8[1-9]{1}\d{1}[\s-]?\d{4}[\s-]?\d{2,5}$]',
                'errors' => [
                    'required' => '{field} wajib di isi dan tidak boleh kosong !!!',
                    'regex_match' => 'Penulisan {field} harus benar'
                ],
            ],
            'password' =>  [
                'label' => 'Password',
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} wajib di isi dan tidak boleh kosong !!!',
                    'min_length' => 'Panjang {field} minimal 8 karakter'
                ],
            ],
            'level' =>  [
                'label' => 'Level',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi dan tidak boleh kosong !!!',
                ],
            ],
            'email' =>  [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[3fi_admin.email]|min_length[6]',
                'errors' => [
                    'required' => '{field} wajib di isi dan tidak boleh kosong !!!',
                    'is_unique' => '{field} sudah terdaftar !!!',
                    'valid_email' => 'Format {field} tidak sesuai',
                ],
            ],
            'status' =>  [
                'label' => 'Status',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi dan tidak boleh kosong !!!',
                ],
            ],
            'foto' => [
                'label' => 'Foto',
                'rules' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto,4096]',
                'errors' => [
                    'uploaded' => '{field} Harus diupload',
                    'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                    'max_size' => 'Ukuran File Maksimal 4 MB',
                ],
            ],

        ])) {
            // Jika Valid
            $foto   = $this->request->getFile('foto');
            $fileName = $foto->getRandomName();
            $data = [
                'username'              => $this->request->getPost('username'),
                'nama'                  => $this->request->getPost('nama'),
                'password'              => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'hp'                    => $this->request->getPost('hp'),
                'email'                 => $this->request->getPost('email'),
                'level'                 => $this->request->getPost('level'),
                'status'                => $this->request->getPost('status'),
                'foto'                  => $fileName,
            ];
            $foto->move(ROOTPATH . '../public_html/public/media/user/', $fileName);

            $this->M_user->insert($data);
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan ke Database');
            return redirect()->to(base_url('admin/user'));
        } else {
            //Jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $validation = $this->validate([
            'foto' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto,4096]'
        ]);

        if ($validation == FALSE) {
            $this->M_user->update($id, [
                'nama'                  => $this->request->getPost('nama'),
                'password'              => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'hp'                    => $this->request->getPost('hp'),
                'email'                 => $this->request->getPost('email'),
                'level'                 => $this->request->getPost('level'),
                'status'                => $this->request->getPost('status'),
            ]);
        } else {
            $data = $this->M_user->find($id);
            $replace = $data['foto'];
            if (file_exists(ROOTPATH . '../public_html/public/media/user/' . $replace)) {
                unlink(ROOTPATH . '../public_html/public/media/user/' . $replace);
            }

            $foto   = $this->request->getFile('foto');
            $fileName = $foto->getRandomName();
            $this->M_user->update($id, [
                'nama'                  => $this->request->getPost('nama'),
                'password'              => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'hp'                    => $this->request->getPost('hp'),
                'email'                 => $this->request->getPost('email'),
                'level'                 => $this->request->getPost('level'),
                'status'                => $this->request->getPost('status'),
                'foto'                  => $fileName,
            ]);
            $foto->move(ROOTPATH . '../public_html/public/media/user', $fileName);
        }
        session()->setFlashdata('success', 'Data Berhasil Di Edit');
        return redirect()->to(base_url('admin/user'));
    }

    public function delete($id)
    {
        $data = $this->M_user->find($id);
        $foto = $data['foto'];
        $filename = ROOTPATH . '../public_html/public/media/user/' . $foto;

        if (file_exists($filename)) {
            unlink($filename);
        }

        $this->M_user->delete($id);
        session()->setFlashdata('success', 'Data Berhasil di Hapus');
        return redirect()->to(base_url('admin/user'));
    }
}
