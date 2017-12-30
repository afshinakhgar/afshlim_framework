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



   
@endsection
