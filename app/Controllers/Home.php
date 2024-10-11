<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Database;

class Home extends BaseController
{
    public function index()
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/login');
        }

        $db = Database::connect();

        $query = $db
            ->table('post p')
            ->select('
                p.id AS id,
                p.title AS title,
                p.body AS body,
                p.image_url AS image_url,
                p.user_id AS user_id,
                u.email AS email
            ')
            ->join('user u', 'u.id = p.user_id')
            ->where('p.deleted_at IS NULL')
            ->orderBy('p.id', 'desc')
            ->get();

        $postsWithUser = $query->getResultArray();
        $user = $session->get('user');

        return view('home/index', compact('postsWithUser', 'user'));
    }
}
