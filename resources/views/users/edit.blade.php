@extends('layouts.index')

@section('title') Edit User {{ $user->name }} @endsection
@section('content')
<div class="container">
  <div class="row">
    <h1 class="col-12 text-center text-primary mt-4 mb-4">Edit User</h1>
    <form action='{{ url("/users/$user->id") }}' method="POST" class="card col-12 col-md-6 offset-md-3">
      @method('PUT')
      @csrf
      <div class="card-body">
        <div class="form-group">
          <label>Name</label>
          <input name="name" type="text" class="form-control" placeholder="Enter Name" value="{{ $user->name }}" />
        </div>
        <div class="form-group">
          <label>Email address</label>
          <input name="email" type="email" class="form-control" placeholder="Enter email" value="{{ $user->email }}" />
        </div>
        <div class="form-group">
          <label>Password</label>
          <input name="password" type="password" class="form-control" placeholder="Password" value="" />
        </div>
        <div class="form-group">
          <label>Password Confirmation</label>
          <input name="password_confirmation" type="password" class="form-control" placeholder="Password Confirmation" value="" />
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
