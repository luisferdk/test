@extends('layouts.index')

@section('css')
<style>
  .mainContent{
    min-height: 100vh;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
  }
  .main{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
  }
</style>
@endsection


@section('content')
<div class="mainContent">
  <div class="main">
    <h2 class="w-100 mb-4 text-center">Select Option:</h2>
    <div>
      <a href="{{ url("/posts") }}" class="btn btn-primary p-3">POSTS</a>
      <a href="{{ url("/users") }}" class="btn btn-warning p-3 ml-3">USERS</a>
      <a href="{{ url("/login") }}" class="btn btn-info p-3 ml-3">LOGIN</a>
    </div>
  </div>
</div>
@endsection
