@extends('layouts.app')

@section('title') Delete @endsection

@section('content')
    <div class="alert alert-danger">
        <p>{{ session('alert-message') }}</p>
        <form action="{{ route('posts.destroy', ['post' => $post['id']]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Yes, delete it</button>
    </form>
    </div>
@endsection
