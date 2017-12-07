@extends('admin.layout.main')

@section('content')

    <div class="container">
        <h1>Create Role</h1>
        <form action="{{route('admin.user.userrole')}}" method="post">
            <select name="roles" id="roles">
                @foreach($all_roles as $key=>$role)
                    <option value="{{$key}}">
                        {{$role}}
                    </option>

                @endforeach
            </select> <a href="" id="add_role"> + </a>

            <input type="hidden" value="" id="current_roles">

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



<script type="text/javascript">
    $(function(){
        $('#add_role').on('click',function (e) {
            e.preventDefault();
            var role_val = $('roles').val();
            console.log(role_val);
        }) ;
    });
</script>