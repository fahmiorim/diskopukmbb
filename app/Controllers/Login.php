<?php

namespace App\Controllers;

use App\Models\M_auth;
use CodeIgniter\I18n\Time;

class Login extends BaseController
{
    protected $M_auth;
    protected $maxLoginAttempts = 5;
    protected $lockoutTime = 300; // 5 menit dalam detik

    public function __construct()
    {
        helper(['form', 'url', 'security']);
        $this->M_auth = new M_auth();
    }

    public function index()
    {
        // Jika sudah login, redirect ke halaman admin
        if (session()->get('log') == true) {
            return redirect()->to(base_url('admin/home'));
        }

        $data = [
            'title' => 'Login Administrator',
            'validation' => \Config\Services::validation(),
            'config' => config('App')
        ];
        
        return view('front/v_login', $data);
    }

    public function cek_login()
    {
        // Validasi input
        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 3 karakter',
                    'max_length' => '{field} maksimal 50 karakter'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 6 karakter'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = $this->request->getPost('username', FILTER_SANITIZE_STRING);
        $password = $this->request->getPost('password');
        
        // Cari user dengan username (case insensitive)
        $user = $this->M_auth->where('LOWER(username)', strtolower($username))->first();
        
        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Username atau password salah');
        }
        

        // Cek status user (case insensitive dan trim spasi)
        if (isset($user['status']) && strtolower(trim($user['status'])) !== 'aktif' && 
            strtolower(trim($user['status'])) !== 'active') {
            return redirect()->back()->withInput()->with('error', 'Akun Anda tidak aktif. Silakan hubungi administrator.');
        }

        // Verifikasi password
        $passwordMatch = password_verify($password, $user['password']);
        
        // Verifikasi password
        if ($passwordMatch) {
            // Set session
            $sessionData = [
                'log'       => true,
                'id'        => $user['id'],
                'nama'      => $user['nama'],
                'username'  => $user['username'],
                'level'     => $user['level'],
                'foto'      => $user['foto'] ?? 'default.png',
                'status'    => $user['status'],
                'hp'        => $user['hp'] ?? '',
                'email'     => $user['email'] ?? '',
                'logged_in' => Time::now()
            ];

            session()->set($sessionData);
            return redirect()->to(base_url('admin/home'))->with('success', 'Selamat datang ' . $user['nama']);

        } else {
            $message = 'Username atau password salah';
            return redirect()->back()
                ->withInput()
                ->with('error', $message);
        }
    }

    public function logout()
    {
        // Log aktivitas logout
        log_message('info', 'User ' . session('username') . ' logged out');
        
        // Hapus semua data session
        $session = session();
        $session->destroy();
        
        // Set pesan sukses
        $session->setFlashdata('success', 'Anda telah berhasil logout');
        
        // Redirect ke halaman login
        return redirect()->to(base_url('login'));
    }
    
    public function forgot_password()
    {
        // Implementasi lupa password bisa ditambahkan di sini
        return view('auth/forgot_password', ['title' => 'Lupa Password']);
    }
}
