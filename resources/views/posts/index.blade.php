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
                <td>{{$post['id']}}</td>
                <td>{{$post['title']}}</td>
                <td>{{$post['posted_by']}}</td>
                <td>{{$post['created_at']}}</td>
                <td>
                    <a href="{{ route('posts.show', ['post' => $post['id']]) }}" class="btn btn-info">View</a>
                    <a href="#" class="btn btn-primary">Edit</a>
                    <form style="display: inline;" method="post" action="{{route('posts.destroy' , ['post' => $post['id']])}}" id="delete-form">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit" onclick="confirmDelete()">Delete</button>
                    </form>




                </td>
            </tr>

        @endforeach


        </tbody>
    </table>
    <script>
    function confirmDelete() {
        if (confirm("Are you sure you want to delete this post?")) {
            document.getElementById('delete-form').submit();
        }
    }
    </script>

@endsection

