<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
//        if (\Gate::allows('isAdmin')) {
//            return view('admin.posts.create');
//        }
//        else{
//           abort(403);
//        }
        return view('admin.posts.create');


    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
       $post = new Post();
       $post->title = $request->input('title');
       $post->description = $request->input('description');
       $post->user_id = $user_id;
       $post->save();
       return redirect()->back();
    }

    public function edit(Post $post)
    {
        $this->authorize('edit', $post);
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();
        return redirect()->back();
    }

    public function delete(Post $post)
    {
        $post->delete();
        return redirect()->back();
    }

}
