<?php

namespace App\Controllers\Admin;

use App\Models\M_profile;
use App\Models\M_perizinan;
use App\Models\M_settings;
use App\Models\M_pelatihan;
use App\Models\M_izin;
use App\Models\M_datakopukm;
use App\Models\M_training_category;
use App\Models\M_pelatihan_peserta;
use App\Models\M_business_certificate;
use App\Models\M_business_licensing;


class Pelatihan extends BaseController
{

    public function __construct()
    {
        $this->M_profile = new M_profile();
        $this->M_perizinan = new M_perizinan();
        $this->M_settings = new M_settings();
        $this->M_pelatihan = new M_pelatihan();
        $this->M_izin = new M_izin();
        $this->M_datakopukm = new M_datakopukm();
        $this->M_training_category = new M_training_category();
        $this->M_pelatihan_peserta = new M_pelatihan_peserta();
        $this->M_business_certificate = new M_business_certificate();
        $this->M_business_licensing = new M_business_licensing();
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
            $file->move(ROOTPATH . '../public_html/public/media/', $fileName);
            $data = [
                'uploaded' => true,
                'url' => base_url('public/media/' . $fileName),
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
            'title' => 'Pelatihan',
            'menu' => 'umkm',
            'title2' => $this->M_settings->first(),
            'pelatihan' => $this->M_pelatihan->where('category', 'UMKM')->orderBy('start_date', 'Desc')->findAll(),
            'isi' => 'admin/pelatihan/v_lists',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function tambah()
    {
        $data = array(
            'title' => 'Tambah Kegiatan',
            'menu' => 'umkm',
            'title2' => $this->M_settings->first(),
            'category' => $this->M_training_category->findAll(),
            'isi' => 'admin/pelatihan/v_tambah',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'training_category_id' => [
                'label' => 'Jenis Pelatihan',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isikan dulu {field}nya yaaaaa!!! ',
                ]
            ],
            'training_title' => [
                'label' => 'Judul Kegiatan',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isikan dulu {field}nya yaaaaa!!! ',
                ]
            ],
            'place' => [
                'label' => 'Tempat Pelaksanaan',
                'rules' => 'required',
                'errors' => [
                    'required' => 'isi dlu {field} dimana berapa biar orang tau',
                ]
            ],
            'start_date' => [
                'label' => 'Tanggal Pelaksanaan',
                'rules' => 'required',
                'errors' => [
                    'required' => 'isi dulu {field} berapa biar orang tau',
                ]
            ],
            'finish_date' => [
                'label' => 'Sampai dengan',
                'rules' => 'required',
                'errors' => [
                    'required' => 'isi dlu {field} berapa biar orang tau',
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
            'category'              => 'UMKM',
            'training_category_id'  => $this->request->getPost('training_category_id'),
            'training_title'        => $this->request->getPost('training_title'),
            'training_title_seo'    => url_title($this->request->getPost('training_title'), '-', TRUE),
            'tanggal_posting'       => date('Y-m-d'),
            'gambar'                => $fileName,
            'place'                 => $this->request->getPost('place'),
            'start_date'            => $this->request->getPost('start_date'),
            'finish_date'           => $this->request->getPost('finish_date'),
        ];
        $gambar->move(ROOTPATH . '../public_html/public/media/pelatihan/', $fileName);

        $this->M_pelatihan->insert($data);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan ke Database');
        return redirect()->to(base_url('admin/pelatihan'));
    }

    public function edit($id)
    {
        $data = array(
            'title' => 'Tambah Kegiatan',
            'menu' => 'umkm',
            'title2' => $this->M_settings->first(),
            'category' => $this->M_training_category->findAll(),
            'pelatihan' => $this->M_pelatihan->where('training_id', $id)->join('3fi_training_category', '3fi_training_category.training_category_id = 3fi_pelatihan.training_category_id')->first(),
            'isi' => 'admin/pelatihan/v_edit',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function update($id)
    {
        $validation = $this->validate([
            'gambar' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]|max_size[gambar,4096]'
        ]);

        if ($validation == FALSE) {
            $this->M_pelatihan->update($id, [
                'training_id'           => $this->request->getPost('training_id'),
                'training_title'        => $this->request->getPost('training_title'),
                'training_title_seo'    => url_title($this->request->getPost('training_title'), '-', TRUE),
                'place'                 => $this->request->getPost('place'),
                'start_date'            => $this->request->getPost('start_date'),
                'finish_date'           => $this->request->getPost('finish_date'),
            ]);
        } else {
            $data = $this->M_pelatihan->find($id);
            $replace = $data['gambar'];
            if (file_exists(ROOTPATH . '../public_html/public/media/pelatihan/' . $replace)) {
                unlink(ROOTPATH . '../public_html/public/media/pelatihan/' . $replace);
            }

            $gambar   = $this->request->getFile('gambar');
            $fileName = $gambar->getRandomName();
            $this->M_pelatihan->update($id, [
                'training_id'           => $this->request->getPost('training_id'),
                'training_title'        => $this->request->getPost('training_title'),
                'training_title_seo'    => url_title($this->request->getPost('training_title'), '-', TRUE),
                'tanggal_posting'       => date('Y-m-d'),
                'gambar'                => $fileName,
                'place'                 => $this->request->getPost('place'),
                'start_date'            => $this->request->getPost('start_date'),
                'finish_date'           => $this->request->getPost('finish_date'),
            ]);
            $gambar->move(ROOTPATH . '../public_html/public/media/pelatihan', $fileName);
        }
        session()->setFlashdata('success', 'Data Berhasil Di Edit');
        return redirect()->to(base_url('admin/pelatihan'));
    }

    public function delete($id)
    {
        $data = $this->M_pelatihan->find($id);
        $gambar = $data['gambar'];
        if (file_exists(ROOTPATH . '../public_html/public/media/pelatihan/' . $gambar)) {
            unlink(ROOTPATH . '../public_html/public/media/pelatihan/' . $gambar);
        }
        $this->M_pelatihan->delete($id);
        session()->setFlashdata('success', 'Data Berhasil di Hapus');
        return redirect()->to(base_url('admin/pelatihan'));
    }

    public function peserta($training_id)
    {
        $data = array(
            'title' => 'Data Peserta Pelatihan',
            'menu' => 'umkm',
            'title2' => $this->M_settings->first(),
            'pelatihan' => $this->M_pelatihan->where('training_id', $training_id)->join('3fi_training_category', '3fi_training_category.training_category_id = 3fi_pelatihan.training_category_id')->first(),
            'peserta' => $this->M_pelatihan_peserta->where('training_id', $training_id)->join('3fi_datakopukm', '3fi_datakopukm.data_id = 3fi_pelatihan_peserta.data_id')->orderBy('pelatihan_peserta_id', 'Asc')->findAll(),
            'isi' => 'admin/pelatihan/v_lists_peserta',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function peserta_detail($training_id, $data_id)
    {
        $data = array(
            'title' => 'Data Pelatihan',
            'menu' => 'umkm',
            'title2' => $this->M_settings->first(),
            'data_peserta' => $this->M_datakopukm
                ->where('data_id', $data_id)
                // ->join('3fi_kecamatan', '3fi_kecamatan.kecamatan_kode = 3fi_datakopukm.kecamatan_kode')
                // ->join('3fi_desa', '3fi_desa.desa_kode = 3fi_datakopukm.desa_kode')
                ->findAll(),
            'isi' => 'admin/pelatihan/v_data_peserta',
        );


        echo view('admin/layout/v_wrapper', $data);
    }

    public function peserta_tambah($id)
    {
        $data = array(
            'title' => 'Tambah Peserta',
            'menu' => 'umkm',
            'title2' => $this->M_settings->first(),
            'category' => $this->M_training_category->findAll(),
            'pelatihan' => $this->M_pelatihan->find($id),
            'religion' => $this->db->table('3fi_religion')->get()->getResultArray(),
            'education' => $this->db->table('3fi_education')->get()->getResultArray(),
            'kecamatan' => $this->db->table('3fi_kecamatan')->get()->getResultArray(),
            'business_status' => $this->db->table('3fi_business_status')->get()->getResultArray(),
            'business_sector' => $this->db->table('3fi_business_sector')->get()->getResultArray(),
            'business_field_umkm' => $this->db->table('3fi_business_field_umkm')->get()->getResultArray(),
            'marketing_reach_koperasi' => $this->db->table('3fi_marketing_reach_koperasi')->get()->getResultArray(),
            'accompaniment_entrepreneur' => $this->db->table('3fi_accompaniment_entrepreneur')->get()->getResultArray(),
            'type_koperasi' => $this->db->table('3fi_type_koperasi')->get()->getResultArray(),
            'group_koperasi' => $this->db->table('3fi_group_koperasi')->get()->getResultArray(),
            'fostered_koperasi' => $this->db->table('3fi_fostered_koperasi')->get()->getResultArray(),
            'position_koperasi' => $this->db->table('3fi_position_koperasi')->get()->getResultArray(),
            'form_koperasi' => $this->db->table('3fi_form_koperasi')->get()->getResultArray(),
            'social_media' => $this->db->table('3fi_social_media')->get()->getResultArray(),
            'marketplace' => $this->db->table('3fi_marketplace')->get()->getResultArray(),
            'business_certificate' => $this->db->table('3fi_business_certificate')->get()->getResultArray(),
            'business_licensing' => $this->db->table('3fi_business_licensing')->get()->getResultArray(),
            'm1' => $this->db->table('3fi_m1')->get()->getResultArray(),
            'm2' => $this->db->table('3fi_m2')->get()->getResultArray(),
            'isi' => 'admin/pelatihan/v_tambah_peserta',
        );
        echo view('admin/layout/v_wrapper', $data);
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

    public function peserta_save($id)
    {

        if (!$this->validate([
            // Profile Peserta
            'name' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isikan dulu {field}nya yaaaaa!!! ',
                ]
            ],
            'id_number' => [
                'label' => 'Nomor Induk Kependudukan (NIK)',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isikan dulu {field}nya yaaaaa!!! ',
                ]
            ],
            'gender' => [
                'label' => 'Jenis Kelamin',
                'rules' => 'required',
                'errors' => [
                    'required' => 'isi dlu {field} apa',
                ]
            ],
            'place_birth' => [
                'label' => 'Tempat Lahir',
                'rules' => 'required',
                'errors' => [
                    'required' => 'isi dulu dimana {field}nya',
                ]
            ],
            'date_birth' => [
                'label' => 'Tanggal Lahir',
                'rules' => 'required',
                'errors' => [
                    'required' => 'isi dlu {field} berapa biar orang tau',
                ]
            ],
            'religion_name' => [
                'label' => 'Agama',
                'rules' => 'required',
                'errors' => [
                    'required' => 'isikan dlu {field}nya apa',
                ]
            ],
            'education_name' => [
                'label' => 'Pendidikan Terakhir',
                'rules' => 'required',
                'errors' => [
                    'required' => 'isikan dlu {field}nya apa',
                ]
            ],
            'address_participant' => [
                'label' => 'Alamat Rumah',
                'rules' => 'required',
                'errors' => [
                    'required' => 'isikan dlu {field}nya dimana, mana tau mau di datangikan',
                ]
            ],
            'kecamatan_kode ' => [
                'label' => 'Kecamatan',
                'rules' => 'required',
                'errors' => [
                    'required' => 'isikan dlu {field}nya dimana, mana tau mau di datangikan',
                ]
            ],
            'desa_kode' => [
                'label' => 'Desa',
                'rules' => 'required',
                'errors' => [
                    'required' => 'isikan dlu {field}nya dimana, mana tau mau di datangikan',
                ]
            ],
            'phone_number' => [
                'label' => 'No HP',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus di isi',
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus di isi',
                ]
            ],
            'profile_photo' => [
                'rules' => 'uploaded[profile_photo]|mime_in[profile_photo,image/jpg,image/jpeg,image/gif,image/png]|max_size[profile_photo,4098]',
                'errors' => [
                    'uploaded' => 'Lupa ko ngupload Gambarnya kan???',
                    'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                    'max_size' => 'Ukuran Gambar Jangan Lewat dari 2 MB'
                ]
            ],
            // End Profile Peserta
        ])) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }

        $profile_photo   = $this->request->getFile('profile_photo');
        $fileName = $profile_photo->getRandomName();
        $data = [
            // Profile Peserta
            'training_id'               => $id,
            'name'                      => $this->request->getPost('name'),
            'id_number'                 => $this->request->getPost('id_number'),
            'gender'                    => $this->request->getPost('gender'),
            'place_birth'               => $this->request->getPost('place_birth'),
            'date_birth'                => $this->request->getPost('date_birth'),
            'religion_name'               => $this->request->getPost('religion_name'),
            'education_name'              => $this->request->getPost('education_name'),
            'address_participant'       => $this->request->getPost('address_participant'),
            'province_name'               => '12',
            'districts_city_name'         => '12.19',
            'kecamatan_kode'            => $this->request->getPost('kecamatan_kode'),
            'desa_kode'                 => $this->request->getPost('desa_kode'),
            'phone_number'              => $this->request->getPost('phone_number'),
            'email'                     => $this->request->getPost('email'),
            'profile_photo'             => $fileName,
            // End Profile Peserta
            'business_status_name'        => $this->request->getPost('business_status_name'),
            // Data UMKM
            'name_umkm'                 => $this->request->getPost('name_umkm'),
            'address_umkm'              => $this->request->getPost('address_umkm'),
            'business_sector_name'        => $this->request->getPost('business_sector_name'),
            'business_field_umkm_name'    => $this->request->getPost('business_field_umkm_name'),
            'date_establishment_umkm'   => $this->request->getPost('date_establishment_umkm'),
            'npwp_umkm'                 => $this->request->getPost('npwp_umkm'),
            'nib_umkm'                  => $this->request->getPost('nib_umkm'),
            'asset_umkm'                => $this->request->getPost('asset_umkm'),
            'omset_umkm'                => $this->request->getPost('omset_umkm'),
            'number_employees'          => $this->request->getPost('number_employees'),
            'production_capacity'       => $this->request->getPost('production_capacity'),
            'member_koperasi'           => $this->request->getPost('member_koperasi'),
            // End Data UMKM
            // Data Koperasi
            'registrasion_number_koperasi'          => $this->request->getPost('registrasion_number_koperasi'),
            'name_koperasi'                         => $this->request->getPost('name_koperasi'),
            'legal_entity_number'                   => $this->request->getPost('legal_entity_number'),
            'date_establishment_koperasi'           => $this->request->getPost('date_establishment_koperasi'),
            'address_koperasi'                      => $this->request->getPost('address_koperasi'),
            'type_koperasi_name'                      => $this->request->getPost('type_koperasi_name'),
            'group_koperasi_name'                     => $this->request->getPost('group_koperasi_name'),
            // 'koperasi_sector_name'                    => $this->request->getPost('koperasi_sector_name'),
            'fostered_koperasi_name'                  => $this->request->getPost('fostered_koperasi_name'),
            'position_koperasi_name'                  => $this->request->getPost('position_koperasi_name'),
            'npwp_koperasi'                         => $this->request->getPost('npwp_koperasi'),
            'last_rat'                              => $this->request->getPost('last_rat'),
            'nik_status'                            => $this->request->getPost('nik_status'),
            'form_koperasi_name'                      => $this->request->getPost('form_koperasi_name'),
            'asset_koperasi'                        => $this->request->getPost('asset_koperasi'),
            'omset_koperasi'                        => $this->request->getPost('omset_koperasi'),
            'shu_koperasi'                          => $this->request->getPost('shu_koperasi'),
            'total_member_koperasi_men'             => $this->request->getPost('total_member_koperasi_men'),
            'total_member_koperasi_women'           => $this->request->getPost('total_member_koperasi_women'),
            'total_employee_koperasi_men'           => $this->request->getPost('total_employee_koperasi_men'),
            'total_employee_koperasi_women'         => $this->request->getPost('total_employee_koperasi_women'),
            'marketing_reach_koperasi_name'           => $this->request->getPost('marketing_reach_koperasi_name'),
            'marketing_reach_koperasi_non_local'    => $this->request->getPost('marketing_reach_koperasi_non_local'),
            // End Data Koperasi
            // Calon Wirausaha
            'business_nameea'                     => $this->request->getPost('business_nameea'),
            'entrepreneur_address'              => $this->request->getPost('entrepreneur_address'),
            'entrepreneur_sector_name'            => $this->request->getPost('entrepreneur_sector_name'),
            'business_field_entrepreneur_name'    => $this->request->getPost('business_field_entrepreneur_name'),
            'accompaniment_entrepreneur_name'     => $this->request->getPost('accompaniment_entrepreneur_name'),
            // End Calon Wirausaha
            // Market Place
            'business_email'                    => $this->request->getPost('business_email'),
            'business_website'                  => $this->request->getPost('business_website'),
            // End Market Place
            // Pembiayaan Usaha
            'banking_credit'                    => $this->request->getPost('banking_credit'),
            'savings'                           => $this->request->getPost('savings'),
            // End Pembiayaan Usaha
            // Rantai Pasok dan Ekspor
            'marketing_reach_umkm_name'           => $this->request->getPost('marketing_reach_umkm_name'),
            'marketing_reach_umkm_optional'     => $this->request->getPost('marketing_reach_umkm_optional'),
            'export'                            => $this->request->getPost('export'),
            'export_delivery'                   => $this->request->getPost('export_delivery'),
            'export_destination'                => $this->request->getPost('export_destination'),
            'export_volume'                     => $this->request->getPost('export_volume'),
            'export_value'                      => $this->request->getPost('export_value'),
            'product_supply'                    => $this->request->getPost('product_supply'),
            // End Rantai Pasok dan Ekspor
            // Kemitraan Usaha			                 
            'partnership'                       => $this->request->getPost('partnership'),
            //end Kemitraan Usaha		       
            // Lain-Lainnya
            'm1'                                => $this->request->getPost('m1'),
            'other_m1'                          => $this->request->getPost('other_m1'),
            'm2_name'                             => $this->request->getPost('m2_name'),
            'm3'                                => $this->request->getPost('m3'),
            // End Lain-Lainnya

        ];

        $profile_photo->move(ROOTPATH . '../public_html/public/media/datakopukm/', $fileName);

        $this->M_datakopukm->insert($data);
        $data_id = $this->M_datakopukm->getInsertID();

        $dataTraining = [
            'training_id' => $id,
            'data_id' => $data_id,
        ];
        $this->M_pelatihan_peserta->insert($dataTraining);

        if ($this->request->getPost('business_status_name') == '3') {
        } else {
            $sosmed = array();
            foreach ($this->request->getPost('sosmed_kode') as $key => $val) {
                $sosmed[] = array(
                    "sosmed_kode"  => $this->request->getPost('sosmed_kode')[$key],
                    "data_id"      => $data_id,
                );
            }
            $this->M_sosmed_field->insertBatch($sosmed);

            $marketplace = array();
            foreach ($this->request->getPost('marketplace_kode') as $key => $val) {
                $marketplace[] = array(
                    "marketplace_kode"  => $this->request->getPost('marketplace_kode')[$key],
                    "data_id"      => $data_id,
                );
            }
            $this->M_marketplace_field->insertBatch($marketplace);

            $business_licensing = array();
            foreach ($this->request->getPost('business_licensing_kode') as $key => $val) {
                $business_licensing[] = array(
                    "business_licensing_kode"  => $this->request->getPost('business_licensing_kode')[$key],
                    "data_id"      => $data_id,
                );
            }
            $this->M_business_licensing_field->insertBatch($business_licensing);

            $business_certificate = array();
            foreach ($this->request->getPost('business_certificate_kode') as $key => $val) {
                $business_certificate[] = array(
                    "business_certificate_kode"  => $this->request->getPost('business_certificate_kode')[$key],
                    "data_id"      => $data_id,
                );
            }
            $this->M_business_certificate_field->insertBatch($business_certificate);
        }

        session()->setFlashdata('success', 'Data Berhasil Ditambahkan ke Database');
        return redirect()->to(base_url('admin/pelatihan/peserta/' . $id));
    }

    public function peserta_edit($data_id)
    {
        $sektor = $this->M_datakopukm->find($data_id);

        if ($sektor['business_status_name'] == '1') {
            $data = array(
                'title' => 'Data Pelatihan',
                'menu' => 'umkm',
                'title2' => $this->M_settings->first(),
                'data_peserta' => $this->M_datakopukm
                    ->where('data_id', $data_id)
                    ->join('3fi_religion', '3fi_religion.religion_name = 3fi_datakopukm.religion_name')
                    ->join('3fi_education', '3fi_education.education_name = 3fi_datakopukm.education_name')
                    ->join('3fi_kecamatan', '3fi_kecamatan.kecamatan_kode = 3fi_datakopukm.kecamatan_kode')
                    ->join('3fi_desa', '3fi_desa.desa_kode = 3fi_datakopukm.desa_kode')
                    ->join('3fi_business_status', '3fi_business_status.business_status_name = 3fi_datakopukm.business_status_name')
                    ->join('3fi_business_sector', '3fi_business_sector.business_sector_name = 3fi_datakopukm.business_sector_name')
                    ->join('3fi_business_field_umkm', '3fi_business_field_umkm.business_field_umkm_name = 3fi_datakopukm.business_field_umkm_name')
                    ->join('3fi_marketing_reach_koperasi', '3fi_marketing_reach_koperasi.marketing_reach_koperasi_name = 3fi_datakopukm.marketing_reach_umkm_name')
                    ->join('3fi_m1', '3fi_m1.m1_name = 3fi_datakopukm.m1')
                    ->join('3fi_m2', '3fi_m2.m2_name = 3fi_datakopukm.m2_name')
                    ->findAll(),
                'social_media' => $this->M_sosmed_field
                    ->where('data_id', $data_id)
                    ->join('3fi_social_media', '3fi_social_media.sosmed_kode = 3fi_sosmed_field.sosmed_kode')
                    ->findAll(),
                'marketplace' => $this->M_marketplace_field
                    ->where('data_id', $data_id)
                    ->join('3fi_marketplace', '3fi_marketplace.marketplace_kode = 3fi_marketplace_field.marketplace_kode')
                    ->findAll(),
                'business_licensing' => $this->M_business_licensing_field
                    ->where('data_id', $data_id)
                    ->join('3fi_business_licensing', '3fi_business_licensing.business_licensing_kode = 3fi_business_licensing_field.business_licensing_kode')
                    ->findAll(),
                'business_certificate' => $this->M_business_certificate_field
                    ->where('data_id', $data_id)
                    ->join('3fi_business_certificate', '3fi_business_certificate.business_certificate_kode = 3fi_business_certificate_field.business_certificate_kode')
                    ->findAll(),
                'isi' => 'admin/pelatihan/v_data_peserta_umkm',
            );
        } elseif ($sektor['business_status_name'] == '2') {
            $data = array(
                'title' => 'Data Pelatihan',
                'menu' => 'umkm',
                'title2' => $this->M_settings->first(),
                'religion' => $this->db->table('3fi_religion')->get()->getResultArray(),
                'education' => $this->db->table('3fi_education')->get()->getResultArray(),
                'kecamatan' => $this->db->table('3fi_kecamatan')->get()->getResultArray(),
                'business_status' => $this->db->table('3fi_business_status')->get()->getResultArray(),
                'business_sector' => $this->db->table('3fi_business_sector')->get()->getResultArray(),
                'business_field_umkm' => $this->db->table('3fi_business_field_umkm')->get()->getResultArray(),
                'marketing_reach_koperasi' => $this->db->table('3fi_marketing_reach_koperasi')->get()->getResultArray(),
                'accompaniment_entrepreneur' => $this->db->table('3fi_accompaniment_entrepreneur')->get()->getResultArray(),
                'type_koperasi' => $this->db->table('3fi_type_koperasi')->get()->getResultArray(),
                'group_koperasi' => $this->db->table('3fi_group_koperasi')->get()->getResultArray(),
                'fostered_koperasi' => $this->db->table('3fi_fostered_koperasi')->get()->getResultArray(),
                'position_koperasi' => $this->db->table('3fi_position_koperasi')->get()->getResultArray(),
                'form_koperasi' => $this->db->table('3fi_form_koperasi')->get()->getResultArray(),
                'social_media' => $this->db->table('3fi_social_media')->get()->getResultArray(),
                'marketplace' => $this->db->table('3fi_marketplace')->get()->getResultArray(),
                'business_certificate' => $this->db->table('3fi_business_certificate')->get()->getResultArray(),
                'business_licensing' => $this->db->table('3fi_business_licensing')->get()->getResultArray(),
                'm1' => $this->db->table('3fi_m1')->get()->getResultArray(),
                'm2' => $this->db->table('3fi_m2')->get()->getResultArray(),
                'data_peserta' => $this->M_datakopukm
                    ->where('data_id', $data_id)
                    ->join('3fi_religion', '3fi_religion.religion_name = 3fi_datakopukm.religion_name')
                    ->join('3fi_education', '3fi_education.education_name = 3fi_datakopukm.education_name')
                    ->join('3fi_kecamatan', '3fi_kecamatan.kecamatan_kode = 3fi_datakopukm.kecamatan_kode')
                    ->join('3fi_desa', '3fi_desa.desa_kode = 3fi_datakopukm.desa_kode')
                    ->join('3fi_business_status', '3fi_business_status.business_status_name = 3fi_datakopukm.business_status_name')
                    ->join('3fi_type_koperasi', '3fi_type_koperasi.type_koperasi_name = 3fi_datakopukm.type_koperasi_name')
                    ->join('3fi_group_koperasi', '3fi_group_koperasi.group_koperasi_name = 3fi_datakopukm.group_koperasi_name')
                    ->join('3fi_business_sector', '3fi_business_sector.business_sector_name = 3fi_datakopukm.business_sector_name')
                    ->join('3fi_fostered_koperasi', '3fi_fostered_koperasi.fostered_koperasi_name = 3fi_datakopukm.fostered_koperasi_name')
                    ->join('3fi_position_koperasi', '3fi_position_koperasi.position_koperasi_name = 3fi_datakopukm.position_koperasi_name')
                    ->join('3fi_form_koperasi', '3fi_form_koperasi.form_koperasi_name = 3fi_datakopukm.form_koperasi_name')
                    ->join('3fi_marketing_reach_koperasi', '3fi_marketing_reach_koperasi.marketing_reach_koperasi_name = 3fi_datakopukm.marketing_reach_koperasi_name')
                    ->join('3fi_m1', '3fi_m1.m1_name = 3fi_datakopukm.m1')
                    ->join('3fi_m2', '3fi_m2.m2_name = 3fi_datakopukm.m2_name')
                    ->findAll(),
                'social_media' => $this->M_sosmed_field
                    ->where('data_id', $data_id)
                    ->join('3fi_social_media', '3fi_social_media.sosmed_kode = 3fi_sosmed_field.sosmed_kode')
                    ->findAll(),
                'marketplace' => $this->M_marketplace_field
                    ->where('data_id', $data_id)
                    ->join('3fi_marketplace', '3fi_marketplace.marketplace_kode = 3fi_marketplace_field.marketplace_kode')
                    ->findAll(),
                'business_licensing' => $this->M_business_licensing_field
                    ->where('data_id', $data_id)
                    ->join('3fi_business_licensing', '3fi_business_licensing.business_licensing_kode = 3fi_business_licensing_field.business_licensing_kode')
                    ->findAll(),
                'business_certificate' => $this->M_business_certificate_field
                    ->where('data_id', $data_id)
                    ->join('3fi_business_certificate', '3fi_business_certificate.business_certificate_kode = 3fi_business_certificate_field.business_certificate_kode')
                    ->findAll(),
                'isi' => 'admin/pelatihan/v_edit_peserta_koperasi',
            );
        } else {
            $data = array(
                'title' => 'Data Pelatihan',
                'menu' => 'umkm',
                'title2' => $this->M_settings->first(),
                'data_peserta' => $this->M_datakopukm
                    ->where('data_id', $data_id)
                    ->join('3fi_religion', '3fi_religion.religion_name = 3fi_datakopukm.religion_name')
                    ->join('3fi_education', '3fi_education.education_name = 3fi_datakopukm.education_name')
                    ->join('3fi_kecamatan', '3fi_kecamatan.kecamatan_kode = 3fi_datakopukm.kecamatan_kode')
                    ->join('3fi_desa', '3fi_desa.desa_kode = 3fi_datakopukm.desa_kode')
                    ->join('3fi_business_status', '3fi_business_status.business_status_name = 3fi_datakopukm.business_status_name')
                    ->join('3fi_m1', '3fi_m1.m1_name = 3fi_datakopukm.m1')
                    ->join('3fi_m2', '3fi_m2.m2_name = 3fi_datakopukm.m2_name')
                    ->findAll(),
                'isi' => 'admin/pelatihan/v_data_peserta_calon',
            );
        }

        echo view('admin/layout/v_wrapper', $data);
    }

    public function peserta_delete($data_id, $training_id)
    {
        $data = $this->M_datakopukm->find($data_id);
        $profile_photo = $data['profile_photo'];
        if (file_exists(ROOTPATH . '../public_html/public/media/datakopukm/' . $profile_photo)) {
            unlink(ROOTPATH . '../public_html/public/media/datakopukm/' . $profile_photo);
        }
        $this->M_datakopukm->delete($data_id);
        $this->M_pelatihan_peserta->delete($data_id);
        $this->M_marketplace_field->delete($data_id);
        $this->M_business_certificate_field->delete($data_id);
        $this->M_business_licensing_field->delete($data_id);
        session()->setFlashdata('success', 'Data Berhasil di Hapus');
        return redirect()->to(base_url('admin/pelatihan/peserta/' . $training_id));
    }
}
