<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class PostModel extends Model
{
    protected $table            = 'post';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title',
        'body',
        'image_url',
        'user_id',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'title' => 'required',
        'body' => 'required',
        'image_url' => 'permit_empty',
        'user_id' => 'required',
    ];
    protected $validationMessages   = [
        'title' => [
            'required' => 'O título do Post deve ser informado',
        ],
        'body' => [
            'required' => 'O corpo do Post deve ser informado',
        ],
        'user_id' => [
            'required' => 'O Usuário deve ser informado',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = false;

    // Callbacks
    protected $allowCallbacks = false;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public static function baseQueryJoinUser()
    {
        $db = Database::connect();

        return $db
            ->table('post p')
            ->select('
                p.id AS id,
                p.title AS title,
                p.body AS body,
                p.image_url AS image_url,
                p.user_id AS user_id,
                u.name AS user_name,
                u.email AS user_email
            ')
            ->join('user u', 'u.id = p.user_id')
            ->where('p.deleted_at IS NULL');
    }
}
