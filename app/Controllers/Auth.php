<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

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

    public function postSignin()
    {
        $data = $this->request->getPost(['name', 'email', 'password', 'verifyPassword']);

        $userModel = model(User::class);

        $userModel->setValidationRule('verifyPassword', 'required|matches[password]');
        $userModel->setValidationMessage('verifyPassword', [
            'required' => 'Confirme sua senha',
            'matches' => 'As senhas devem ser iguais',
        ]);

        $valid = $userModel->save($data);

        if (! $valid) {
            $errors = $userModel->errors();
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        return redirect()->to('/login')->with('successes', [
            'Conta criada com sucesso! Por favor realize o login',
        ]);
    }

    public function forgotPassword()
    {
        helper('form');

        return view('auth/forgot_password');
    }
}
