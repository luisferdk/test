@extends('layouts.index')

@section('title') Users @endsection

@section('content')
<div class="container">
  <div class="row">
    <h1 class="col-12 text-center text-primary mt-4 mb-4">Users</h1>
    <div class="col-12 text-center mb-3">
      <a href="{{ url("/users/create") }}" class="btn btn-primary pl-5 pr-5"
        >Create</a
      >
    </div>
    <table
      class="col-12 col-md-10 offset-md-1 table table-bordered table-striped"
    >
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Options</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td class="text-center buttons">
            <a
              href="{{ url("/users/$user->id") }}"
              class="btn btn-primary ml-1 mr-1"
              >Show</a
            >
            <a
              href="{{ url("/users/$user->id/edit") }}"
              class="btn btn-warning ml-1 mr-1"
              >Edit</a
            >
            <form action='{{ url("/users/$user->id") }}' method="POST">
              {{ csrf_field() }}
              {{ method_field("DELETE") }}
              <button type="submit" class="btn btn-danger ml-1 mr-1">
                Delete
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
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
