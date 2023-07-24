<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
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
            return back()->with('success', __('Post created with success!'));
        }
        return back()->withErrors(['msg' => __('Something went wrong')]);

    }

    public function edit(Request $request, string $id){
        
        if($post = Post::find($id)){
            return view('admin.page.post', ['post' => $post]);
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
                return back()->with('success', __('Post successfully updated!'));
            }
            return back()->withErros(['msg' => __('Something went wrong')]);
        }

        return back()->withErros(['msg' => __('Post not found')]);

    }
}
