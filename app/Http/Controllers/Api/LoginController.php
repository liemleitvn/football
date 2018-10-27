<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\LoginBlog;

class LoginController extends Controller
{
    private $loginBlog;

    public function __construct(LoginBlog $loginBlog)
    {
        $this->loginBlog = $loginBlog;
    }

    public function index() {
        return view('api.login');
    }

    public function store(Request $request) {
        $result = $this->loginBlog->execute('auth/login', $request);

        if(isset($result['errors'])) {
            $errors = $result;
            return redirect()->route('blog.index')->withErrors($errors);
        }

        return redirect()->route('blog.post.index');
    }
}
