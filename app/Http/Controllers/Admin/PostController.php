<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\View\View;

class PostController extends Controller
{

    public function index() : View
    {
        return view('admin.page.post.grid');
    }

    public function create() : View
    {
        return view('admin.page.post.edit');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'short_content' => 'required',
            'content' => 'required',
        ]);

        $data = $request->only(['title', 'short_content', 'content', 'url_key']);

        $post = new Post($data);

        if($post->save()){
            return redirect()->route('admin.post.edit', ['post' => $post->id])->with('success', 'Post created with success!');
        }
        return back()->withErrors(['msg' => 'Something went wrong']);

    }

    public function edit(Request $request, string $id) : View
    {

        if($post = Post::find($id)){
            return view('admin.page.post.edit', ['post' => $post]);
        }
    }

    public function update(Request $request, string $id){

        if($post = Post::find($id)){
            $request->validate([
                'title' => 'required|max:255',
                'short_content' => 'required',
                'content' => 'required',
            ]);
            $data = $request->only(['title', 'short_content', 'content', 'url_key']);

            if($post->update($data)){
                return back()->with('success', 'Post successfully updated!');
            }
            return back()->withErros(['msg' => 'Something went wrong']);
        }

        return back()->withErros(['msg' => 'Post not found']);

    }
}
