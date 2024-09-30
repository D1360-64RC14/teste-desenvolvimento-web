<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'email',
        'password',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = false;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[245]',
        'email' => 'required|max_length[245]|valid_email|is_unique[user.email]',
        'password' => 'required|min_length[8]|max_length[245]'
    ];
    protected $validationMessages = [
        'name' => [
            'required' => 'Informe seu nome',
            'min_length' => 'O nome deve ter pelo menos 3 caracteres',
            'max_length' => 'O nome deve ter no máximo 245 caracteres',
        ],
        'email' => [
            'required' => 'Informe seu email',
            'max_length' => 'O email deve ter no máximo 245 caracteres',
            'valid_email' => 'Informe um email válido',
            'is_unique' => 'O email informado já está em uso',
        ],
        'password' => [
            'required' => 'Informe sua senha',
            'min_length' => 'A senha deve ter pelo menos 8 caracteres',
            'max_length' => 'A senha deve ter no máximo 245 caracteres',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['hashPassword'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function hashPassword(array $data): array
    {
        if (! isset($data['data']['password'])) {
            return $data;
        }

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        return $data;
    }
}
