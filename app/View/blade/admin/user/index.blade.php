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
            <th>Edit Role</th>
        </tr>
        </thead>
        @if(isset($list))
            @foreach($list as $row)
                <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->mobile}}</td>
                    <td>{{$row->first_name}}</td>
                    <td>{{$row->last_name}}</td>
                    <td>
                        @foreach($row->roles as $role)
                          <i class="admin_role">{{$role->display_name}}</i>
                        @endforeach
                    </td>

                    <td>
                        <a href="{{route('admin.user.editroles',['userid'=>$row->id])}}">Edit Roles</a>

                    </td>
                </tr>
            @endforeach
        @endif

    </table>

    <style>
        .admin_role{
            display: inline-block;
            background-color:#e9e4e5;
            padding:1px 5px 1px 5px;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            color: #7257fd;
        }
        .admin_role::after{
            content: ',';
        }

        .admin_role:last-child::after{
            content: '';
        }

    </style>
@endsection