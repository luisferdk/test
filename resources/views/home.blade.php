@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <div class="mt-4">
                      <a href="{{ url("/posts") }}" class="btn btn-primary p-3">POSTS</a>
                      <a href="{{ url("/users") }}" class="btn btn-warning p-3 ml-3">USERS</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
