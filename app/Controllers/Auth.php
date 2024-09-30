<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function login()
    {
        helper('form');

        return view('auth/login');
    }

    public function signin()
    {
        helper('form');

        return view('auth/signin');
    }

    public function forgotPassword()
    {
        helper('form');

        return view('auth/forgot_password');
    }
}
