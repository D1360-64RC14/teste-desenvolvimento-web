<?php

namespace App\Services;

use App\Models\RecoverCodeModel;
use App\Models\UserModel;
use CodeIgniter\Config\BaseService;
use CodeIgniter\Email\Email;
use CodeIgniter\I18n\Time;

class PasswordRecoveryService extends BaseService
{
    private Email $emailService;

    private RecoverCodeModel $recoverCodeModel;

    public function __construct()
    {
        $this->emailService = service('email');
        $this->recoverCodeModel = model(RecoverCodeModel::class);
    }

    public function sendRecoveryEmail(array $user): bool
    {
        $lastCode = $this->recoverCodeModel->where('user_id', $user['id'])->orderBy('id', 'DESC')->first();

        if (! $lastCode || new Time($lastCode['expired_at']) < Time::now()) {
            $lastCode = $this->createCodeFor($user['id']);
        }

        if (! $lastCode) {
            return false;
        }

        $this->emailService->setTo($user['email']);
        $this->emailService->setSubject('Recuperação de senha');
        $this->emailService->setMessage('Aqui está o código para recuperar sua senha: ' . $lastCode['code']);

        return $this->emailService->send();
    }

    private function createCodeFor(int $user_id): array|null
    {
        $codeId = $this->recoverCodeModel->insert([
            'user_id' => $user_id,
        ]);

        return $this->recoverCodeModel->find($codeId);
    }
}
