@extends('layouts.index')

@section('title') Create Post @endsection
@section('content')
<div class="container">
  <div class="row">
    <h1 class="col-12 text-center text-primary mt-4 mb-4">Create Post</h1>
    <form action="{{ url('/posts') }}" method="POST" class="card col-12 col-md-6 offset-md-3">
      @csrf
      <div class="card-body">
        <div class="form-group">
          <label>Title</label>
          <input name="title" type="text" class="form-control" placeholder="Enter Title" value="{{ old('title') }}" />
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea name="description" rows="10" class="form-control">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
          <label>User</label>
          <select name="user_id" class="form-control">
            <option value="">Choose one</option>
            @foreach($users as $user)
              <option value="{{ $user->id }}" {{ ( $user->id == old('user_id')) ? 'selected' : '' }}>{{ $user->name }}</option>
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
