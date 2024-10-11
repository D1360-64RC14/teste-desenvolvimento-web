<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;
use Config\Database;

class Home extends BaseController
{
    public function index()
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/login');
        }

        $user = $session->get('user');
        $query = PostModel::baseQueryJoinUser()
            ->orderBy('p.id', 'desc')
            ->get();

        $postsWithUser = $query->getResultArray();

        return view('home/index', compact('postsWithUser', 'user'));
    }
}
