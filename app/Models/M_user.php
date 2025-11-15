<?php

namespace App\Models;

use CodeIgniter\Model;

class M_User extends Model
{
    protected $table      = '3fi_admin';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['username', 'password', 'nama', 'hp', 'email', 'level', 'status', 'foto'];
}
