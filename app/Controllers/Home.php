<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/login');
        }

        return view('home/index');
    }
}
