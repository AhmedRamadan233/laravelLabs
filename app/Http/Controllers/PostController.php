<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all();

        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {
        $input = $request->all();

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $post = new Post;
        $post->title = $validatedData['title'];
        $post->description = $validatedData['description'];
        $post->save();
        return redirect('/posts');
    }




    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', ['post' => $post]);
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
