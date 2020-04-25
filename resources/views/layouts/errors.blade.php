@if ($errors->any())
<div class="col-12 mt-3 alert alert-danger">
@foreach ($errors->all() as $error)
    <div>{{$error}}</div>
@endforeach
</div>
@endif
