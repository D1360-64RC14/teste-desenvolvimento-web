<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Post extends BaseController
{
    public function index()
    {
        helper('form');

        return view('post/index');
    }

    public function postPost()
    {
        $data = $this->request->getPost(['title', 'body', 'imageUrl']);
    }

    public function putPost()
    {
        $data = $this->request->getPost(['title', 'body', 'imageUrl']);
    }

    public function deletePost() {}
}
