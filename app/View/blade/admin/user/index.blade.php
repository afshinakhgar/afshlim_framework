@extends('admin.layout.main')

@section('content')

    <table class="table table-responsive">
        <thead>
        <tr>
            <th>شماره کاربر</th>
            <th>تلفن همراه</th>
            <th>نام</th>
            <th>نام خانوادگی</th>
            <th>نقش</th>
            <th>عملیات</th>
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
                          <i class="badge badge-warning">{{$role->display_name}}</i>
                        @endforeach
                    </td>

                    <td>
                        <a href="{{route('admin.user.editroles',['userid'=>$row->id])}}" class="btn badge-primary ">ویرایش نقش</a>
                        <a href="{{route('admin.user.edit',['mobile'=>$row->mobile])}}" class="btn badge-primary">ویرایش</a>
                    </td>
                </tr>
            @endforeach
        @endif

    </table>


@endsection