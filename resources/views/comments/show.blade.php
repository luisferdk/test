@extends('layouts.index')

@section('title')
Post {{ $post->name }}
@endsection

@section('content')
<div class="container">
  <div class="row">
    <h1 class="col-12 text-center text-primary mt-4 mb-4">Post {{ $post->id }}</h1>
    <div class="col-12 mb-5">
      <div class="card">
        <div class="card-header bg-dark">
          <div class="row">
            <div class="col-6">
              <h3><a class="text-white" href='{{ url("/posts/$post->id") }}'>{{ $post->title }}</a></h3>
              <h5 class="text-secondary"><strong>{{ $post->user->name }}</strong></h5>
            </div>
            <div class="col-6 text-right">
              <a href='{{ url("/comments/create?post=$post->id") }}' class="btn btn-primary">Add Comment</a>
              <a href='{{ url("/posts/$post->id/edit") }}' class="btn btn-warning">Edit</a>
              <button onclick="document.getElementById('deletePost').submit()" class="btn btn-danger">Delete</button>
              <form id="deletePost" action='{{ url("/posts/$post->id") }}' method="POST">
                @csrf
                @method('DELETE')
              </form>
            </div>
          </div>
        </div>
        <div class="card-body">{{ $post->description }}</div>
        @if(count($post->comments)>0)
        <div class="card-footer">
          <div class="row">
            <h5 class="col-12 text-primary mb-3">Comments</h5>
              @foreach($post->comments as $comment)
              <div class="col-12 mb-3 pb-3 border-bottom">
                <h6>{{ $comment->user->name }}</h6>
                <p>{{ $comment->description }}</p>
                <div>
                  <button class="btn btn-warning pt-0 pb-0">Edit</button>
                  <button class="btn btn-danger pt-0 pb-0 ">Delete</button>
                </div>
              </div>
              @endforeach
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
