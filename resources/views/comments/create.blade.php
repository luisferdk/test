@extends('layouts.index')

@section('title') Create Comment @endsection
@section('content')
<div class="container">
  <div class="row">
    <h1 class="col-12 text-center text-primary mt-4 mb-4">Create Comment</h1>
    <form action="{{ url('/comments') }}" method="POST" class="col-12 col-md-6 offset-md-3">
      <div class="card">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <div class="card-header">{{ $post->description }}</div>
        <div class="card-body">
          <div class="form-group">
            <label>User</label>
            <select name="user_id" class="form-control">
              <option value="">Choose one</option>
              @foreach($users as $user)
                <option value="{{ $user->id }}" {{ ( $user->id == old('user_id')) ? 'selected' : '' }}>{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>description</label>
            <textarea name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
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
