<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;

class Post extends BaseController
{
    public function index()
    {
        helper('form');

        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/login');
        }

        return view('post/index', [
            'post' => [
                'id' => null,
                'user_id' => null,
                'title' => null,
                'email' => null,
                'body' => null,
                'imageUrl' => null
            ]
        ]);
    }

    public function viewPost(int $id)
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/login');
        }

        $postModel = model(PostModel::class);
        $user = $session->get('user');

        $post = $postModel->find($id);

        if (! $post) {
            return redirect()->to('/');
        }

        if ($post['user_id'] !== $user['id']) {
            return view('post/post_me', compact('post', 'user'));
        }

        return view('post/post_other', compact('post', 'user'));
    }

    public function editPost(int $id)
    {
        helper('form');

        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/login');
        }

        $postModel = model(PostModel::class);
        $user = $session->get('user');

        $post = $postModel->where([
            'id' => $id,
            'user' => $user['id'],
        ])->first();

        if (! $post) {
            return redirect()->to('/');
        }

        return view('post/index', compact('post'));
    }

    public function postPost()
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/login');
        }

        $data = $this->request->getPost(['title', 'body', 'imageUrl']);

        $user = $session->get('user');
        $postModel = model(PostModel::class);

        $data['user_id'] = $user['id'];
        $id = $postModel->insert($data);

        if (! $id) {
            return redirect()->back()->withInput()->with('errors', $postModel->errors());
        }

        return view('redirect', ['url' => '/post/' . $id]);
    }

    public function putPost()
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/login');
        }

        $data = $this->request->getPost(['title', 'body', 'imageUrl']);
    }

    public function deletePost()
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/login');
        }
    }
}
