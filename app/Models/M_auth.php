<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class M_auth extends Model
{
    protected $table = '3fi_admin';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['username', 'password', 'last_login', 'login_attempts'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function login($username, $password)
    {
        // Cari user berdasarkan username
        $user = $this->db->table($this->table)
            ->where('username', $username)
            ->where('status', 'aktif')
            ->get()
            ->getRowArray();

        // Jika user tidak ditemukan
        if (!$user) {
            log_message('warning', "Failed login attempt - User not found: {$username}");
            return false;
        }

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Reset login attempts on successful login
            $this->update($user['id'], [
                'login_attempts' => 0,
                'last_login' => Time::now()->format('Y-m-d H:i:s')
            ]);
            return $user;
        } else {
            // Update login attempts on failed login
            $attempts = $user['login_attempts'] + 1;
            $this->update($user['id'], ['login_attempts' => $attempts]);
            log_message('warning', "Failed login attempt - Invalid password for user: {$username}");
            return false;
        }
    }

    public function createUser($data)
    {
        // Hash password sebelum disimpan
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        return $this->insert($data);
    }
}
