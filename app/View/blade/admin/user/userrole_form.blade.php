@extends('admin.layout.main')

@section('content')

    <div class="container">
        <h1>Create Role</h1>
        <form action="{{route('admin.user.userrole')}}" method="post">
            <select name="roles" id="roles">

                @foreach($all_roles as $key=>$role)
                    <option id="role_item_{{$key}}" value="{{$key}}">
                        {{$role}}
                    </option>



                @endforeach
                <option value="0">-----------</option>

            </select> <a href="" id="add_role" class="btn btn-default"> + </a>

            <input type="hidden" value="" id="current_roles">

            <span id="current_demo_roles">
                @foreach($user_roleList as $roles)
                    <span class="admin_role">
                    {{$roles->display_name}}</span>
                @endforeach
            </div>



            <hr>
            <div class="form-group">
                <label for="mobile">Mobile </label>
                <input name="mobile" disabled="disabled" value="{{$user->mobile}}" type="text" class="form-control" id="username">
            </div>

            <div class="form-group">
                <input name="display_name"  type="text" class="form-control" id="display_name" placeholder="display name">
            </div>

            <input type="submit" value="create" class="btn btn-success">
        </form>
    </div>



    <script type="text/javascript">
        $(function(){
            var val_roles_store = '';
            $('#add_role').on('click',function (e) {
                e.preventDefault();
                var role_val = $('#roles').find(":selected").val();
                var role_text = $('#roles').find(":selected").text();

                val_roles_store += role_val+',';

                $('#current_roles').val(val_roles_store);
                if(role_val !== '0'){
                    $('#role_item_'+role_val).remove();
                    $('#current_demo_roles').append('<span class="admin_role">'+role_text+'</span>');
                }else {
                    alert('first select a role');
                }
            });
        });
    </script>
@endsection
