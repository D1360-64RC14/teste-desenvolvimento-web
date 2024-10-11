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

        $query = PostModel::baseQueryJoinUser()
            ->orderBy('p.id', 'desc')
            ->get();

        $postsWithUser = $query->getResultArray();
        $user = $session->get('user');

        return view('home/index', compact('postsWithUser', 'user'));
    }
}
