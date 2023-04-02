@extends('layouts.app')

@section('title') Create @endsection

@section('content')
<form method="POST" action="{{ route('posts.update', ['post' => $post['id']]) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" required>{{ $post->description }}</textarea>
    </div>

    <div class="form-group">
        <label for="post_creator">Post Creator</label>
        <select name="post_creator" class="form-control" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $post->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection
