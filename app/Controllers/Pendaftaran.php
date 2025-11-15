<?php

namespace App\Controllers;

use App\Models\M_settings;
use App\Models\M_profile;
use App\Models\M_perizinan;
use App\Models\M_daftar;
use App\Models\M_pengumuman;
use App\Models\M_kecamatan;




class Pendaftaran extends BaseController
{
    public function __construct()
    {
        $this->M_settings = new M_settings();
        $this->M_profile = new M_profile();
        $this->M_perizinan = new M_perizinan();
        $this->M_daftar = new M_daftar();
        $this->M_pengumuman = new M_pengumuman();
        $this->M_kecamatan = new M_kecamatan();

        $this->db = \Config\Database::connect();
    }

    public function daftar($id)
    {
        $pengumuman = $this->M_pengumuman->where('id', $id)->first();
        $tgl_now = date("Y-m-d");

        if ($tgl_now >= $pengumuman['batas_pendaftaran']) {
            $isi = 'front/v_expired';
        } else {
            $isi = 'front/v_pendaftaran';
        };

        $data = array(
            'title' => 'PENGUMUMAN',
            'settings'      => $this->M_settings->first(),
            'profile'       => $this->M_profile->orderBy('urutan', 'Asc')->findAll(),
            'umkm'          => $this->M_perizinan->where('kategori', 'UMKM')->orderBy('urutan', 'Asc')->findAll(),
            'koperasi'      => $this->M_perizinan->where('kategori', 'KOPERASI')->orderBy('urutan', 'Desc')->findAll(),
            'pendaftaran'   => $this->M_pengumuman->where('id', $id)->first(),
            'kecamatan' => $this->db->table('3fi_kecamatan')->get()->getResultArray(),
            'religion' => $this->db->table('3fi_religion')->get()->getResultArray(),
            'education' => $this->db->table('3fi_education')->get()->getResultArray(),
            'isi' => $isi,
        );
        echo view('front/layout/v_wrapper', $data);
    }

    public function pendaftaran_save($id)
    {
        if (!$this->validate([
            'name' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isikan dulu {field}nya yaaaaa !!! ',
                ]
            ],
            'nik' => [
                'label' => 'NIK',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}-nya harus di isi dulu !!! ',
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus di isi !!! ',
                ]
            ],
            'nohp' => [
                'label' => 'No HP / WA',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} harus di isi, biar gampang di hubungi kalo lulus',
                    'numeric' => '{field} itu angka lah jangan huruf',
                ]
            ],
            'alamat' => [
                'label' => 'tempat tinggal',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kasih tau {field} mu dimana, biar tau kami',
                ]
            ],
            'kecamatan_kode' => [
                'label' => 'Kecamatan',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih {field}nya dlu, abis tu baru pilih desa',
                ]
            ],
            'desa_kode' => [
                'label' => 'desa',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Gak bisa kalo {field}nya di pilih kalo kecamatannya belum',
                ]
            ],
            'alamat_sesuai' => [
                'label' => 'alamatmu sesuai',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isilah apakah {field} sama KTP gak?',
                ]
            ],
            'date_birth' => [
                'label' => '',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Abang ganteng, kakak cantik, kan pernah dilahirkan, masa gak tau kapan lahirnya',
                ]
            ],
            'jenis_kelamin' => [
                'label' => '',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kalo jenis kelaminnya sendiri gak tau, hajab kita bah  -_-',
                ]
            ],
            'agama' => [
                'label' => '',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Abang/Kakak kan punya agama, masa gak punya',
                ]
            ],
            'status' => [
                'label' => '',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih statusnya dlu ya kakak/abangku... mana tau ada yg cocok sama kami -_*',
                ]
            ],
            'pendidikan' => [
                'label' => '',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih pendidikan terakhir apa yaaa..',
                ]
            ],
            'pekerjaan' => [
                'label' => '',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih pekerjaan saat ini apa',
                ]
            ],
            'pengalaman' => [
                'label' => '',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih dulu, udah pernah jadi tukang survei apa belum',
                ]
            ],
            'foto' => [
                'rules' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto,4098]',
                'errors' => [
                    'uploaded' => 'Lupa ko ngupload fotonya kan???',
                    'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                    'max_size' => 'Ukuran Gambar Jangan Lewat dari 4 MB'
                ]
            ],
            'ktp' => [
                'rules' => 'uploaded[ktp]|mime_in[ktp,image/jpg,image/jpeg,image/gif,image/png]|max_size[ktp,4098]',
                'errors' => [
                    'uploaded' => 'Lupa ko ngupload foto KTPnya kan???',
                    'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                    'max_size' => 'Ukuran Gambar Jangan Lewat dari 4 MB'
                ]
            ],
            'ijazah' => [
                'rules' => 'uploaded[ijazah]|mime_in[ijazah,image/jpg,image/jpeg,image/gif,image/png]|max_size[ijazah,4098]',
                'errors' => [
                    'uploaded' => 'Lupa ko ngupload foto Ijazahnya kan???',
                    'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                    'max_size' => 'Ukuran Gambar Jangan Lewat dari 4 MB'
                ]
            ],
            'perkenalan' => [
                'label' => '',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ceritakanlah dlu secara singkat, kau tu orangnya kek mana',
                ]
            ],
        ])) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }

        $foto   = $this->request->getFile('foto');
        $fileName = 'foto-' . $this->request->getPost('name') . '-' . $foto->getRandomName();
        $ktp   =   $this->request->getFile('ktp');
        $filektp = 'ktp-' . $this->request->getPost('name') . '-' . $ktp->getRandomName();
        $ijazah   = $this->request->getFile('ijazah');
        $fileijazah = 'ijazah-' . $this->request->getPost('name') . '-' . $ijazah->getRandomName();
        $data = [
            'name'                  => $this->request->getPost('name'),
            'alamat'                => $this->request->getPost('alamat'),
            'email'                 => $this->request->getPost('email'),
            'nohp'                  => $this->request->getPost('nohp'),
            'nik'                   => $this->request->getPost('nik'),
            'kecamatan_kode'        => $this->request->getPost('kecamatan_kode'),
            'penempatan'            => $this->request->getPost('penempatan'),
            'penempatan2'            => $this->request->getPost('penempatan2'),
            'desa_kode'             => $this->request->getPost('desa_kode'),
            'alamat_sesuai'         => $this->request->getPost('alamat_sesuai'),
            'date_birth'            => $this->request->getPost('date_birth'),
            'jenis_kelamin'         => $this->request->getPost('jenis_kelamin'),
            'agama'                 => $this->request->getPost('agama'),
            'pendidikan'            => $this->request->getPost('pendidikan'),
            'status'                => $this->request->getPost('status'),
            'pekerjaan'             => $this->request->getPost('pekerjaan'),
            'pekerjaan_lainnya'     => $this->request->getPost('pekerjaan_lainnya'),
            'pengalaman'            => $this->request->getPost('pengalaman'),
            'perkenalan'            => $this->request->getPost('perkenalan'),
            'hari'                  => date('l'),
            'tanggal'               => date('Y-m-d'),
            'jam'                   => date('G:i:s'),
            'foto'                  => $fileName,
            'ktp'                   => $filektp,
            'ijazah'                => $fileijazah,
            'id_pengumuman'         => $id,
        ];
        $foto->move(ROOTPATH . 'public/media/daftar/', $fileName);
        $ktp->move(ROOTPATH . 'public/media/daftar/', $filektp);
        $ijazah->move(ROOTPATH . 'public/media/daftar/', $fileijazah);

        $kecamatan_kode = $this->request->getPost('kecamatan_kode');
        $desa_kode = $this->request->getPost('desa_kode');
        $kecamatan = $this->db->table('3fi_kecamatan')->where('kecamatan_kode', $kecamatan_kode)->get()->getRowArray();
        $desa = $this->db->table('3fi_desa')->where('desa_kode', $desa_kode)->get()->getRowArray();
        $pesan_email = '<p>Kepada, ' . $this->request->getPost('name') . '</p>
        <p>Terimakasih telah melakukan pendaftaran pada website <a href="https://diskopukm.batubarakab.go.id">https://diskopukm.batubarakab.go.id</a>&nbsp;</p>
        <p>Berikut adalah data diri yang anda daftarkan :</p>
        <table width="100%">
        <tbody>
        <tr>
        <td width="32%">Nama Lengkap</td>
        <td width="2%">:</td>
        <td width="66%">' . $this->request->getPost('name') . '</td>
        </tr>

        <tr>
        <td>Nomor Induk KTP (NIK)</td>
        <td>:</td>
        <td>' . $this->request->getPost('nik') . '</td>
        </tr>

        <tr>
        <td>Email Aktif</td>
        <td>:</td>
        <td>' . $this->request->getPost('email') . '</td>
        </tr>

        <tr>
        <td>No HP / WA</td>
        <td>:</td>
        <td>' . $this->request->getPost('nohp') . '</td>
        </tr>

        <tr>
        <td>Alamat Domisili saat ini</td>
        <td>:</td>
        <td>' . $this->request->getPost('alamat') . ', ' . 'Kecamatan' . ' ' . $kecamatan['kecamatan_name'] . ', ' . 'Desa/Kelurahan' . ' ' . $desa['desa_name']  . '</td>
        </tr>

        <tr>
        <td>Alamat Domisili Sama dengan Alamat pada KTP?</td>
        <td>:</td>
        <td>' . $this->request->getPost('alamat_sesuai') . '</td>
        </tr>

        <tr>
        <td>Tanggal Lahir</td>
        <td>:</td>
        <td>' . $this->request->getPost('date_birth') . '</td>
        </tr>

        <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td>' . $this->request->getPost('jenis_kelamin') . '</td>
        </tr>

        <tr>
        <td>Agama</td>
        <td>:</td>
        <td>' . $this->request->getPost('agama') . '</td>
        </tr>

        <tr>
        <td>Status Perkawinan</td>
        <td>:</td>
        <td>' . $this->request->getPost('status') . '</td>
        </tr>

        <tr>
        <td>Ijazah Tertinggi</td>
        <td>:</td>
        <td>' . $this->request->getPost('pendidikan') . '</td>
        </tr>

        <tr>
        <td>Pekerjaan/Kegiatan Sehari-hari</td>
        <td>:</td>';

        if ($this->request->getPost('pekerjaan_lainnya') == "") {
            $pesan_email .= '<td>' . $this->request->getPost('pekerjaan') . '</td>';
        } else {
            $pesan_email .= '<td>' . $this->request->getPost('pekerjaan_lainnya') . ' (' . $this->request->getPost('pekerjaan') . ')</td>';
        }

        $pesan_email .= '</tr>
        <tr>
        <td>Apakah punya pengalaman menjadi petugas sensus/survei ?</td>
        <td>:</td>
        <td>' . $this->request->getPost('pengalaman') . '</td>
        </tr>
        <tr>
        <td>Lokasi Penempatan Yang Anda Inginkan</td>
        <td>:</td>
        <td>' . $this->request->getPost('penempatan') . ', ' . $this->request->getPost('penempatan2') . '</td>
        </tr>
        <tr>
        <td>Deskripsi Singkat</td>
        <td>:</td>
        <td>' . $this->request->getPost('perkenalan') . '</td>
        </tr>

        </tbody>
        </table>
        <p>Jika data yang anda masukkan sudah benar, silahkan tunggu email konfirmasi dari kami apabila anda lolos dalam seleksi.</p>
        <p>Terima Kasih,<br>
        Admin DISKOPUKM BATU BARA</p>';

        $email_foto = base_url('./media/daftar/' . $fileName);
        $email_ktp = base_url('./media/daftar/' . $filektp);
        $email_ijazah = base_url('./media/daftar/' . $fileijazah);
        $email_smtp = \Config\Services::email();
        $config["protocol"] = "smtp";
        $config["SMTPHost"]  = "smtp.gmail.com";
        $config["SMTPUser"]  = "diskopukmbatubara1@gmail.com";
        $config["SMTPPass"]  = "batubarabisa";
        $config["SMTPPort"]  = 465;
        $config["SMTPCrypto"] = "ssl";
        $config["mailType "] = "html";
        $email_smtp->attach($email_foto);
        $email_smtp->attach($email_ktp);
        $email_smtp->attach($email_ijazah);
        $email_smtp->initialize($config);
        $email_smtp->setFrom("diskopukmbatubara1@gmail.com", "Dinas Koperasi dan UKM Batu Bara");
        $email_smtp->setTo($this->request->getPost('email'));
        $email_smtp->setSubject("Pendaftaran Petugas Pemetaan / Pendataan K-UKM se Kabupaten Batu Bara");
        $email_smtp->setMessage($pesan_email);
        $email_smtp->send();

        $this->M_daftar->insert($data);
        session()->setFlashdata('success', 'Pendaftaran Berhasil');
        return redirect()->to(base_url('informasi/pengumuman_detail/' . $id));
    }

    function add_ajax_des($id_kec)
    {
        $query = $this->db->table('3fi_desa')->where('kecamatan_kode', $id_kec)->get();
        $data = "<option value=''> - Pilih Desa - </option>";
        foreach ($query->getResultArray() as $key => $value) {
            $data .= "<option value='" . $value['desa_kode'] . "'>" . $value['desa_name'] . "</option>";
        }
        echo $data;
    }
}
