<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RecoverAttemptModel;
use App\Models\RecoverCodeModel;
use App\Models\UserModel;
use App\Services\PasswordRecoveryService;
use CodeIgniter\I18n\Time;

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
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = model(UserModel::class);
        $session = session();

        $user = $userModel->where('email', $data['email'])->first();

        if (! $user || ! UserModel::verifyPassword($user, $data['password'])) {
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

        $rules = [
            'verifyPassword' => 'required|matches[password]',
            'email' => 'is_unique[user.email]',
            'password' => 'required|min_length[8]|max_length[245]',
        ];

        $messages = [
            'verifyPassword' => [
                'required' => 'Confirme sua senha',
                'matches' => 'As senhas devem ser iguais',
            ],
            'email' => [
                'is_unique' => 'O email informado já está em uso',
            ],
            'password' => [
                'required' => 'Informe sua senha',
                'min_length' => 'A senha deve ter pelo menos 8 caracteres',
                'max_length' => 'A senha deve ter no máximo 245 caracteres',
            ],
        ];

        $userModel = model(UserModel::class);

        if (! $this->validateData($data, $rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if (! $userModel->save($data)) {
            return redirect()->back()->withInput()->with('errors', $userModel->errors());
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

    public function postForgotPassword()
    {
        $data = $this->request->getPost(['email']);

        $rules = [
            'email' => 'required|valid_email',
        ];

        $messages = [
            'email' => [
                'required' => 'Informe um email',
                'valid_email' => 'Informe um email válido',
            ],
        ];

        if (! $this->validateData($data, $rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = model(UserModel::class);

        /** @var PasswordRecoveryService */
        $passwordRecoveryService = service('passwordRecovery');

        $session = session();

        $user = $userModel->where('email', $data['email'])->first();

        if (! $user) {
            return redirect()->back()->withInput()->with('errors', [
                'Email não encontrado',
            ]);
        }

        if (! $passwordRecoveryService->sendRecoveryEmail($user)) {
            return redirect()->back()->withInput()->with('errors', [
                'Oops. Não foi possível lhe enviar o email de recuperação de senha',
            ]);
        }

        $session->set('recovering-email', $user['email']);

        return redirect()->to('/recover-password');
    }

    public function recoverPassword()
    {
        helper('form');

        return view('auth/recover_password', [
            'email' => session()->get('recovering-email'),
        ]);
    }

    public function postRecoverPassword()
    {
        $data = $this->request->getPost(['email', 'code', 'password', 'verifyPassword']);

        $rules = [
            'email' => 'required|valid_email',
            'code' => 'required',
            'password' => 'required|min_length[8]',
            'verifyPassword' => 'required|matches[password]',
        ];

        $messages = [
            'email' => [
                'required' => 'O email deve ser informado',
                'valid_email' => 'Informe um email válido',
            ],
            'code' => [
                'required' => 'Informe o código',
            ],
            'password' => [
                'required' => 'Informe sua senha',
                'min_length' => 'Sua senha deve ter pelo menos 8 caracteres',
            ],
            'verifyPassword' => [
                'required' => 'Confirme sua senha',
                'matches' => 'As senhas devem ser iguais',
            ],
        ];

        if (! $this->validateData($data, $rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = model(UserModel::class);

        /** @var PasswordRecoveryService */
        $passwordRecoveryService = service('passwordRecovery');

        $session = session();

        $user = $userModel->where('email', $data['email'])->first();

        if (! $user) {
            return redirect()->back()->withInput()->with('errors', [
                'Email não encontrado',
            ]);
        }

        if (! $passwordRecoveryService->checkRecoveryCode($user, $data['code'], $this->request->getIPAddress())) {
            return redirect()->back()->withInput()->with('errors', [
                'Código inválido',
            ]);
        }

        $user['password'] = UserModel::hashPassword($data['password']);

        if (! $userModel->save($user)) {
            return redirect()->back()->withInput()->with('errors', $userModel->errors());
        }

        $session->remove('recovering-email');

        return redirect()->to('/login')->with('successes', [
            'Senha alterada com sucesso! Por favor, realize o login',
        ]);
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}
