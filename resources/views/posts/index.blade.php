@extends('layouts.app')

@section('title') Index @endsection

@section('content')





    <div class="text-center">
        <a type="button" class="mt-4 btn btn-success" href="{{ route('posts.create') }}">Create Post</a>
    </div>
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                @if($post->user)
                <td>{{$post->user->name}}</td>
                @else
                <td>not found</td>
                @endif

                <td>{{$post->created_at}}</td>
                <td>
                    <a href="{{ route('posts.show', ['post' => $post['id']]) }}" class="btn btn-info">View</a>
                    <a href="{{ route('posts.edit', ['post'=> $post['id']]) }}" class="btn btn-primary">Edit</a>
                    <form style="display: inline;" method="post" action="{{ route('posts.destroy' , ['post' => $post['id']]) }}" id="delete-form">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit"  onclick="confirmDelete(event)">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    <script>
        function confirmDelete(event) {
            event.preventDefault();
            if (confirm("Are you sure you want to delete this post?")) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
    <div class="d-flex justify-content-center">
        <ul class="pagination">
            <li class="page-item {{ $posts->previousPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $posts->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $posts->previousPageUrl() ? 'false' : 'true' }}">Previous</a>
            </li>
            @foreach ($posts->links()->elements[0] as $page => $url)
                <li class="page-item {{ $page == $posts->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach
            <li class="page-item {{ $posts->nextPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $posts->nextPageUrl() }}" aria-disabled="{{ $posts->nextPageUrl() ? 'false' : 'true' }}">Next</a>
            </li>
        </ul>
    </div>

@endsection

