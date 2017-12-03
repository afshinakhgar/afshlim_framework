@extends('admin.layout.main')

@section('content')

    <div class="container">
        <h1>Create Role</h1>
        <form action="{{route('admin.user.role.create')}}" method="post">
            <div class="form-group">
                <input name="name"  type="text" class="form-control" id="name" placeholder="name">
            </div>

            <div class="form-group">
                <input name="display_name"  type="text" class="form-control" id="display_name" placeholder="display name">
            </div>

            <input type="submit" value="create" class="btn btn-success">
        </form>
    </div>

@endsection