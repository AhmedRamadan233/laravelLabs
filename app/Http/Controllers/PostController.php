<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::paginate(15);
        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        $users = User::all();

        return view('posts.create', [
            'users' => $users
        ]);
    }



    public function store(Request $request)
    {
        $data = $request->all();

        Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],

        ]);

        return to_route('posts.index');
    }




    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }


    public function edit(Post $post)
    {
        $users = User::all();
        return view('posts.edit', [
            'post' => $post,
            'users' => $users
        ]);
    }

    // PostController method for updating a post
    public function update(Request $request, Post $post)
    {
        $data = $request->all();

        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->user_id = $data['post_creator'];
        $post->save();

        return redirect()->route('posts.index');
    }








    public function destroy($id)
    {
        $post = Post::find($id);

        if ($post) {
            $post->delete();
            session()->flash('success', 'Post has been deleted.');
        } else {
            session()->flash('error', 'Post not found.');
        }

        return redirect()->route('posts.index');
    }




}
