@extends('layouts.index')

@section('title') Edit Post {{ $post->title }} @endsection
@section('content')
<div class="container">
  <div class="row">
    <h1 class="col-12 text-center text-primary mt-4 mb-4">Edit Post</h1>
    <form action='{{ url("/posts/$post->id") }}' method="POST" class="card col-12 col-md-6 offset-md-3">
      @method('PUT')
      @csrf
      <div class="card-body">
        <div class="form-group">
          <label>Title</label>
          <input name="title" type="text" class="form-control" placeholder="Enter Title" value="{{ $post->title }}" />
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea name="description" rows="10" class="form-control">{{ $post->description }}</textarea>
        </div>
        <div class="form-group">
          <label>User</label>
          <select name="user_id" class="form-control">
            <option value="">Choose one</option>
            @foreach($users as $user)
              <option value="{{ $user->id }}" {{ ( $user->id == $post->user_id) ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        @include('layouts.errors')
      </div>
    </form>
  </div>
</div>
@endsection
