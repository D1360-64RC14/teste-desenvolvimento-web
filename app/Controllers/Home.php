<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/login');
        }

        $posts = [
            [
                'id' => 1,
                'user' => 'admin',
                'email' => '7w1tB@example.com',
                'message' => 'Hello, World!',
            ],
            [
                'id' => 2,
                'user' => 'admin',
                'email' => '7w1tB@example.com',
                'message' => 'Hello, World!',
            ],
        ];

        return view('home/index', compact('posts'));
    }
}
