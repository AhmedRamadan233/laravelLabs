@extends('layouts.app')

@section('title') Show @endsection

@section('content')
    <div class="card mt-4">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: {{$post['title']}}</h5>
            <p class="card-text">Description: {{$post['description']}}</p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        </div>
    </div>
<hr>
@foreach ($post->comments as $comment)
    <div class="card mb-3">
        <div class="card-body">
            {{ $comment->body }}
        </div>
    </div>
@endforeach

<form method="POST" action="{{ route('comments.store') }}">
    @csrf
    <div class="form-group">
        <label for="body">Comment:</label>
        <textarea class="form-control" name="body" id="body"></textarea>
    </div>
    <input type="hidden" name="commentable_id" value="{{ $post->id }}">
    <input type="hidden" name="commentable_type" value="{{ get_class($post) }}">
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


@endsection
