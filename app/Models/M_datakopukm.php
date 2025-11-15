<?php

namespace App\Models;

use CodeIgniter\Model;

class M_datakopukm extends Model
{
    protected $table      = '3fi_datakopukm';
    protected $primaryKey = 'data_name';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['name', 'id_number', 'gender', 'place_birth', 'date_birth', 'religion_name', 'education_name', 'address_participant', 'province_name', 'profile_photo', 'districts_city_name', 'phone_number', 'email', 'business_status_name', 'name_umkm', 'address_umkm', 'business_sector_name', 'business_field_umkm_name', 'date_establishment_umkm', 'npwp_umkm', 'nib_umkm', 'asset_umkm', 'omset_umkm', 'number_employees', 'production_capacity', 'registrasion_number_koperasi', 'member_koperasi', 'name_koperasi', 'legal_entity_number', 'date_establishment_koperasi', 'address_koperasi', 'type_koperasi_name', 'group_koperasi_name', 'koperasi_sector_name', 'fostered_koperasi_name', 'position_koperasi_name', 'npwp_koperasi', 'last_rat', 'nik_status', 'form_koperasi_name', 'asset_koperasi', 'omset_koperasi', 'shu_koperasi', 'total_member_koperasi_men', 'total_member_koperasi_women', 'total_employee_koperasi_men', 'total_employee_koperasi_women', 'marketing_reach_koperasi_name', 'marketing_reach_koperasi_non_local', 'business_email', 'business_website', 'banking_credit', 'savings', 'marketing_reach_umkm_name', 'export', 'export_delivery', 'export_destination', 'export_volume', 'export_value', 'product_supply', 'partnership', 'business_nameea', 'entrepreneur_address', 'entrepreneur_sector_name', 'business_field_entrepreneur_name', 'accompaniment_entrepreneur_name', 'm1', 'm1_other', 'm2_name', 'm3', 'kecamatan_kode', 'desa_kode'];
}
