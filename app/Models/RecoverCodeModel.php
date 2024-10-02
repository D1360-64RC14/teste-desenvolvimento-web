<?php

namespace App\Models;

use CodeIgniter\Model;

class RecoverCodeModel extends Model
{
    protected $table            = 'recover_code';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'code',
        'expired_at',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = false;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['generateRandomCode', 'setExpirationDate'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function generateRandomCode(array $data)
    {
        if (! isset($data['data']['code'])) {
            $data['data']['code'] = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        }

        return $data;
    }

    public function setExpirationDate(array $data)
    {
        if (! isset($data['data']['expired_at'])) {
            $data['data']['expired_at'] = date('Y-m-d H:i:s', strtotime(env('app.user.recovery.codeExpiration', '+30 min')));
        }

        return $data;
    }
}
