<?php

namespace App\Models;

use CodeIgniter\Model;

class M_daftar extends Model
{
    protected $table      = '3fi_daftar';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['name', 'penempatan', 'penempatan2', 'alamat', 'kecamatan_kode', 'desa_kode', 'alamat_sesuai', 'date_birth', 'jenis_kelamin', 'agama', 'status', 'pekerjaan', 'pengalaman', 'hari', 'tanggal', 'jam', 'foto', 'ktp', 'nik', 'id_pengumuman', 'pekerjaan_lainnya', 'ijazah', 'pendidikan', 'email', 'nohp', 'perkenalan'];
}
