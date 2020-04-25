@extends('layouts.index')

@section('title') Posts @endsection

@section('content')
<div class="container">
  <div class="row">
    <h1 class="col-12 text-center text-primary mt-4 mb-4">Posts</h1>
    <div class="col-12 text-center mb-3">
      <a href="{{ url("/posts/create") }}" class="btn btn-primary pl-5 pr-5">Create Post</a>
    </div>
    <div class="col-12">
      @foreach($posts as $post)
      <div class="card mb-5">
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
        <div class="card-footer">
          <div class="row">
            <h5 class="col-12 text-primary mb-3">Comments</h5>
            <form class="col-12 mb-3" action='{{ url("/comments?post=$post->id") }}' method="POST">
              @csrf
              <input type="hidden" name="post_id" value="{{ $post->id }}">
              <div class="form-row align-items-center">
                <div class="col-auto">
                  <textarea name="description" placeholder="Enter Comment" rows="1" class="form-control mb-2" required></textarea>
                </div>
                <div class="col-auto">
                  <select name="user_id" id="" class="form-control mb-2" required>
                    <option value="">Choose one</option>
                    @foreach ($users as $user)
                      <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                    <option value=""></option>
                  </select>
                </div>
                <div class="col-auto">
                  <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </div>
                @include('layouts.errors')
              </div>
            </form>
              @foreach($post->comments as $comment)
              <div class="col-12 mb-3 pb-3 border-bottom">
                <h6>{{ $comment->user->name }}</h6>
                <p>{{ $comment->description }}</p>
                <div>
                  <a href='{{ url("comments/$comment->id/edit") }}' class="btn btn-warning pt-0 pb-0">Edit</a>
                  <button onclick="document.getElementById('deleteComment').submit()" class="btn btn-danger pt-0 pb-0">Delete</button>
                  <form id="deleteComment" action='{{ url("/comments/$comment->id") }}' method="POST">
                    @csrf
                    @method('DELETE')
                  </form>
                </div>
              </div>
              @endforeach
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection


@section('js')
  @if(session('create'))
  <script>
    Swal.fire("Post", "successfully created", "success");
  </script>
  @endif

  @if(session('update'))
  <script>
    Swal.fire("Post", "successfully updated", "success");
  </script>
  @endif

  @if(session('delete'))
  <script>
    Swal.fire("Post", "successfully deleted", "success");
  </script>
  @endif


  @if(session('createComment'))
  <script>
    Swal.fire("Comment", "successfully created", "success");
  </script>
  @endif

  @if(session('updateComment'))
  <script>
    Swal.fire("Comment", "successfully updated", "success");
  </script>
  @endif

  @if(session('deleteComment'))
  <script>
    Swal.fire("Comment", "successfully deleted", "success");
  </script>
  @endif
@endsection
