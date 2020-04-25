@extends('layouts.index')

@section('title')
User {{ $user->name }}
@endsection

@section('content')
<div class="container">
  <div class="row">
    <h1 class="col-12 text-center text-primary mt-4 mb-4">User {{ $user->id }}</h1>
    <div class="col-12 card">
      <div class="card-body">
        <h3 class="col-12 text-center">{{ $user->name }}</h3>
        <h4 class="col-12 text-center">{{ $user->email }}</h4>
      </div>
    </div>
  </div>
</div>
@endsection
