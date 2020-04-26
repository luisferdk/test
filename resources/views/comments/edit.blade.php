@extends('layouts.index')

@section('title') Edit Comment {{ $comment->post->title }} @endsection
@section('content')
<div class="container">
  <div class="row">
    <h1 class="col-12 text-center text-primary mt-4 mb-4">Edit Comment</h1>
    <form action='{{ url("/comments/$comment->id") }}' method="POST" class="col-12 col-md-6 offset-md-3">
      <div class="card">
        @csrf
        @method('PUT')
        <div class="card-header">{{ $comment->post->description }}</div>
        <div class="card-body">
          <div class="form-group">
            <label>User</label>
            <select name="user_id" class="form-control">
              <option value="">Choose one</option>
              @foreach($users as $user)
                <option value="{{ $user->id }}" {{ ( $user->id == $comment->user_id) ? 'selected' : '' }}>{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>description</label>
            <textarea name="description" rows="5" class="form-control">{{ $comment->description }}</textarea>
          </div>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          @include('layouts.errors')
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
