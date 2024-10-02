<?php

namespace App\Services;

use App\Models\RecoverAttemptModel;
use App\Models\RecoverCodeModel;
use CodeIgniter\Config\BaseService;
use CodeIgniter\Email\Email;
use CodeIgniter\I18n\Time;

class PasswordRecoveryService extends BaseService
{
    private Email $emailService;

    private RecoverCodeModel $recoverCodeModel;
    private RecoverAttemptModel $recoverAttemptModel;

    private int $maxAttempts;

    public function __construct()
    {
        $this->emailService = service('email');
        $this->recoverCodeModel = model(RecoverCodeModel::class);
        $this->recoverAttemptModel = model(RecoverAttemptModel::class);

        $this->maxAttempts = env('app.user.recovery.maxAttempts', 20);
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

    public function checkRecoveryCode(array $user, string $code): bool
    {
        $this->recoverAttemptModel->insert([
            'user_id' => $user['id'],
            'code' => $code,
        ]);

        $lastCode = $this->recoverCodeModel->where('user_id', $user['id'])->orderBy('id', 'DESC')->first();

        $userAttempts = $this->recoverAttemptModel->where([
            'user_id' => $user['id'],
            'created_at >=' => $lastCode['created_at'],
            'created_at <=' => $lastCode['expired_at'],
        ]);

        $failedAttempts = $userAttempts->count();

        if ($failedAttempts >= $this->maxAttempts) {
            return false;
        }

        return $userAttempts->where('code', $code)->count() > 0;
    }

    private function createCodeFor(int $user_id): array|null
    {
        $codeId = $this->recoverCodeModel->insert([
            'user_id' => $user_id,
        ]);

        return $this->recoverCodeModel->find($codeId);
    }
}
