<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class FilterAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('level') == "") {
            session()->setFlashdata('pesan', 'Anda belum login, Silahkan Login Dulu !!!');
            return redirect()->to(base_url('error'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // if (session()->get('level') == 'Super Admin' && 'Admin Website') {
        //     return redirect()->to(base_url('admin/home'));
        // }
    }
}
