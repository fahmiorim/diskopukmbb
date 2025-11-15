<?php

namespace App\Controllers\Admin;

use App\Models\M_settings;


class Home extends BaseController
{
    public function __construct()
    {
        $this->M_settings = new M_settings();
    }

    public function index()
    {
        $data = array(
            'title' => 'DASHBOARD',
            'title2' => $this->M_settings->first(),
            'isi' => 'admin/layout/v_home',
        );
        echo view('admin/layout/v_wrapper', $data);
    }
}
