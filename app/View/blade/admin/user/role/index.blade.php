@extends('admin.layout.main')

@section('content')

    <table class="table table-responsive">
        <thead>
        <tr>
            <th>id</th>
            <th>display name</th>
            <th>name</th>
            <th>description</th>
        </tr>
        </thead>
        @foreach($list as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->display_name}}</td>
                <td>{{$row->name}}</td>
                <td>{{$row->description}}</td>
                <td>
                    <a href="{{route('admin.role.user_list',['role_id'=>$row->id])}}">Users</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection