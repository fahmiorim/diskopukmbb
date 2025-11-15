<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class UpdateAdminTable extends Migration
{
    public function up()
    {
        // Tambah kolom baru
        $fields = [
            'login_attempts' => [
                'type' => 'INT',
                'constraint' => 5,
                'default' => 0,
                'after' => 'password'
            ],
            'last_login' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'login_attempts'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
                'after' => 'last_login'
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'on update' => new RawSql('CURRENT_TIMESTAMP'),
                'after' => 'created_at'
            ]
        ];

        $this->forge->addColumn('3fi_admin', $fields);

        // Update password ke format yang lebih aman (opsional)
        // Hapus komentar di bawah jika ingin mengupdate password yang ada
        /*
        $users = $this->db->table('3fi_admin')->get()->getResultArray();
        foreach ($users as $user) {
            $this->db->table('3fi_admin')
                ->where('id', $user['id'])
                ->update([
                    'password' => password_hash($user['password'], PASSWORD_DEFAULT)
                ]);
        }
        */
    }

    public function down()
    {
        // Hapus kolom yang ditambahkan
        $this->forge->dropColumn('3fi_admin', ['login_attempts', 'last_login', 'created_at', 'updated_at']);
    }
}
