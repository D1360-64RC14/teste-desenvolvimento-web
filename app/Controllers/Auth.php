<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        helper('form');

        return view('auth/login');
    }

    public function postLogin()
    {
        $data = $this->request->getPost(['email', 'password']);

        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]',
        ];

        $messages = [
            'email' => [
                'required' => 'Informe seu email',
                'valid_email' => 'Informe um email válido',
            ],
            'password' => [
                'required' => 'Informe sua senha',
                'min_length' => 'Sua senha deve ter pelo menos 8 caracteres',
            ]
        ];

        if (! $this->validateData($data, $rules, $messages)) {
            return redirect()->back()->withInput();
        }

        $userModel = model(UserModel::class);
        $session = session();

        $user = $userModel->where('email', $data['email'])->first();

        if (! $user || ! password_verify($data['password'], $user['password'])) {
            return redirect()->back()->withInput()->with('errors', [
                'Usuário ou senha inválidos',
            ]);
        }

        $session->set('user', [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
        ]);

        return redirect()->to('/');
    }

    public function signin()
    {
        helper('form');

        return view('auth/signin');
    }

    public function postSignin()
    {
        $data = $this->request->getPost(['name', 'email', 'password', 'verifyPassword']);

        $userModel = model(UserModel::class);

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

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}
