@extends('admin.layout.main')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Title</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
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
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                Footer
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>

@endsection