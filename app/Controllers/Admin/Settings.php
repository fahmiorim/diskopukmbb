<?php

namespace App\Controllers\Admin;

use App\Models\M_settings;


class Settings extends BaseController
{
    protected $M_settings;
    public function __construct()
    {
        $this->M_settings = new M_settings();
    }

    public function index()
    {
        $data = array(
            'title' => 'Daftar Settings',
            'title2' => $this->M_settings->first(),
            'settings' => $this->M_settings->findAll(),
            'isi' => 'admin/settings/v_lists',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function update()
    {
        $validation = $this->validate([
            'logo' => 'uploaded[logo]|mime_in[logo,image/jpg,image/jpeg,image/gif,image/png]|max_size[logo,4096]'
        ]);

        $id = 1;
        if ($validation == FALSE) {
            $this->M_settings->update($id, [
                'aplikasi'                  => $this->request->getPost('aplikasi'),
                'instansi'                  => $this->request->getPost('instansi'),
                'deskripsi'                 => $this->request->getPost('deskripsi'),
                'keyword'                   => $this->request->getPost('keyword'),
                'alamat'                    => $this->request->getPost('alamat'),
                'website'                   => $this->request->getPost('website'),
                'telfon'                    => $this->request->getPost('telfon'),
                'email'                     => $this->request->getPost('email'),
                'maps'                      => $this->request->getPost('maps'),
            ]);
        } else {
            $data = $this->M_settings->find($id);
            $replace = $data['logo'];
            if (file_exists(ROOTPATH . '../public_html/public/media/settings/' . $replace)) {
                unlink(ROOTPATH . '../public_html/public/media/settings/' . $replace);
            }

            $logo   = $this->request->getFile('logo');
            $fileName = $logo->getRandomName();
            $this->M_settings->update($id, [
                'aplikasi'                  => $this->request->getPost('aplikasi'),
                'instansi'                  => $this->request->getPost('instansi'),
                'deskripsi'                 => $this->request->getPost('deskripsi'),
                'keyword'                   => $this->request->getPost('keyword'),
                'alamat'                    => $this->request->getPost('alamat'),
                'website'                   => $this->request->getPost('website'),
                'telfon'                    => $this->request->getPost('telfon'),
                'email'                     => $this->request->getPost('email'),
                'maps'                      => $this->request->getPost('maps'),
                'logo'                      => $fileName,
            ]);
            $logo->move(ROOTPATH . '../public_html/public/media/settings', $fileName);
        }
        session()->setFlashdata('success', 'Data Berhasil Di Update');
        return redirect()->to(base_url('admin/settings'));
    }
}
