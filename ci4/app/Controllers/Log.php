<?php

namespace App\Controllers;

use Config\Services;

class Log extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Log Admin',
            'list' => $this->log->list()
        ];
        //var_dump($data);
        return view('auth/log_admin/index', $data); 
    }
}
