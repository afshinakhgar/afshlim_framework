@extends('admin.layout.main')

@section('content')

    <table class="table table-responsive">
        <thead>
        <tr>
            <th>id</th>
            <th>Mobile</th>
            <th>name</th>
            <th>last Name</th>
            <th>Role</th>
        </tr>
        </thead>

        @foreach($list as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->mobile}}</td>
                <td>{{$row->first_name}}</td>
                <td>{{$row->last_name}}</td>
                {{--                <td><a href="{{ path_for('admin.user.role') }}">Role</a></td>--}}
                <td>{{url('admin.user.list',[])}} </td>
            </tr>
        @endforeach

    </table>
@endsection