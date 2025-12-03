<?php

namespace App\Controllers;

class Error extends BaseController
{
    public function index()
    {
        // Set the HTTP status code to 404
        $this->response->setStatusCode(404);
        
        // Return the 404 view
        return view('front/v_404');
    }
}
