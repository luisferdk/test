@extends('layouts.index')

@section('title') Users @endsection

@section('content')
<div class="container">
  <div class="row">
    <h1 class="col-12 text-center text-primary mt-4 mb-4">Posts</h1>
    <div class="col-12">
      @foreach($posts as $post)
      <div class="card mb-5">
        <div class="card-header">
          <h3 class="text-primary">{{ $post->title }}</h3>
          <h5><strong>{{ $post->user->name }}</strong></h5>
        </div>
        <div class="card-body">{{ $post->description }}</div>
        @if(count($post->comments)>0)
        <div class="card-footer">
          <div class="row">
            <h5 class="col-12 text-primary mb-3">Comments</h5>
              @foreach($post->comments as $comment)
              <div class="col-12">
                <h6>{{ $comment->user->name }}</h6>
                <p>{{ $comment->description }}</p>
              </div>
              @endforeach
          </div>
        </div>
        @endif
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection


@section('js')
  @if(session('create'))
  <script>
    Swal.fire("Created", "User successfully created", "success");
  </script>
  @endif

  @if(session('update'))
  <script>
    Swal.fire("Updated", "User successfully created", "success");
  </script>
  @endif

  @if(session('delete'))
  <script>
    Swal.fire("Deleted", "Deleted successfully created", "success");
  </script>
  @endif
@endsection
