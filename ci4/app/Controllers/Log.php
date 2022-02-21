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

    public function hapus_log()
    {
        // Hapus Data Log Cron Job -> Data Lebih Dari 14 Hari
        $this->log->hapus_log_14day($date);
        
    }

}
