<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;

class Post extends BaseController
{
    public function index()
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/login');
        }

        helper('form');

        return view('post/index', [
            'postWithUser' => [
                'id' => null,
                'title' => null,
                'body' => null,
                'imageUrl' => null,
                'user_id' => null,
                'user_email' => null,
            ]
        ]);
    }

    public function viewPost(int $id)
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/login');
        }

        $user = $session->get('user');
        $query = PostModel::baseQueryJoinUser()
            ->where('p.id', $id)
            ->get();

        $postWithUser = $query->getRowArray();

        if (! $postWithUser) {
            return redirect()->to('/');
        }

        if ($postWithUser['user_id'] === $user['id']) {
            return view('post/post_me', compact('postWithUser'));
        }

        return view('post/post_other', compact('postWithUser'));
    }

    public function viewEditPost(int $id)
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/login');
        }

        helper('form');

        $user = $session->get('user');
        $query = PostModel::baseQueryJoinUser()
            ->where('u.id', $user['id'])
            ->where('p.id', $id)
            ->get();

        $postWithUser = $query->getRowArray();

        if (! $postWithUser) {
            return redirect()->to('/');
        }

        $postWithUser['imageUrl'] = $postWithUser['image_url'];

        return view('post/index', compact('postWithUser'));
    }

    public function viewDeletePost(int $id)
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/login');
        }

        helper('form');

        $user = $session->get('user');
        $query = PostModel::baseQueryJoinUser()
            ->where('u.id', $user['id'])
            ->where('p.id', $id)
            ->get();

        $postWithUser = $query->getRowArray();

        if (! $postWithUser) {
            return redirect()->to('/');
        }

        return view('post/delete', compact('postWithUser'));
    }

    public function postPost()
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/login');
        }

        $data = $this->request->getPost(['title', 'body', 'imageUrl']);
        $data['image_url'] = $data['imageUrl'];

        $user = $session->get('user');
        $postModel = model(PostModel::class);

        $data['user_id'] = $user['id'];
        $id = $postModel->insert($data);

        if (! $id) {
            return redirect()->back()->withInput()->with('errors', $postModel->errors());
        }

        return view('redirect', ['url' => '/post/' . $id]);
    }

    public function putPost(int $id)
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/login');
        }

        $data = $this->request->getPost(['title', 'body', 'imageUrl']);
        $data['image_url'] = $data['imageUrl'];

        $user = $session->get('user');
        $postModel = model(PostModel::class);

        $query = PostModel::baseQueryJoinUser()
            ->where('u.id', $user['id'])
            ->where('p.id', $id)
            ->get();

        $postWithUser = $query->getRowArray();

        if (! $postWithUser) {
            return redirect()->to('/');
        }

        $data['user_id'] = $user['id'];

        if (! $postModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $postModel->errors());
        }

        return view('redirect', ['url' => '/post/' . $id]);
    }

    public function deletePost(int $id)
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/login');
        }

        $user = $session->get('user');
        $postModel = model(PostModel::class);

        $query = PostModel::baseQueryJoinUser()
            ->where('u.id', $user['id'])
            ->where('p.id', $id)
            ->get();

        $postWithUser = $query->getRowArray();

        if (! $postWithUser) {
            return redirect()->to('/');
        }

        $postModel->delete($id);

        return view('redirect', ['url' => '/']);
    }
}
