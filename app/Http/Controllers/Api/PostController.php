<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ApiHelper;
use App\Services\PostBlog;
use App\Services\PatchBlog;

class PostController extends Controller
{
    private $apiHelper;
    private $postBlog;
    private $patchBlog;

    public function __construct(ApiHelper $apiHelper, PostBlog $postBlog, PatchBlog $patchBlog)
    {
        $this->apiHelper = $apiHelper;
        $this->postBlog = $postBlog;
        $this->patchBlog =$patchBlog;
    }

    public function index() {

        $result = $this->apiHelper->getJson('posts');

        return view('api.show')->with(['result'=>$result]);
    }

    public function create() {
        $category = $this->apiHelper->getJson('categories');

        if(isset($category['errors'])) {
            return redirect()->route('blog.index');
        }

        return view('api.create')->with(['category'=>$category]);
    }

    public function store(Request $request) {
        $request->flashOnly('title', 'content');
        $result = $this->postBlog->execute($request,'posts');

        if(!empty($result['errors'])) {
            return redirect()->route('blog.post.create')->withErrors(['errors'=>$result]);
        }

        return redirect()->route('blog.post.index')->with(['success'=>'Insert successful']);

    }

    public function edit($id) {

        $category = $this->apiHelper->getJson('categories');
        $post = $this->apiHelper->getJson("posts/{$id}");

        if(isset($category['errors']) || isset($post['errors'])) {
            return redirect()->route('blog.index');
        }

        return view('api.edit')->with(['category'=>$category, 'post'=>$post[0], 'id'=>$id]);
    }

    public function update(Request $request, $id) {

        $result = $this->patchBlog->execute($request,"posts/{$id}");

        if(!empty($result['errors'])) {

            $errors = $result;

            return redirect()->route('blog.post.edit',['id'=>$id])->withErrors($errors);
        }
        return redirect()->route('blog.post.index')->with(['success'=>'Update successful']);
    }

    public function destroy($id) {
        $result = $this->apiHelper->deleteJson("posts/{$id}");

        if(!empty($result['errors'])) {
            $errors = $result;

            return redirect()->route('blog.post.index',['id'=>$id])->withErrors($errors);
        }
        return redirect()->route('blog.post.index')->with(['success'=>'Delete successful']);
    }
}
