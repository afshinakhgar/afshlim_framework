@extends('layout/main')

@section('content')

    <div class="container">
        <h1>Register</h1>
        <form action="register" method="post">
            <div class="form-group">
                <label for="firstname">Name</label>
                <input name="firstname" type="text" class="form-control" id="firstname" placeholder="first name">
            </div>

            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input name="lastname"  type="text" class="form-control" id="lastname" placeholder="last name">
            </div>

            <div class="form-group">
                <label for="login">mobile</label>
                <input  name="login"  type="login" class="form-control" id="mobile" placeholder="mobile">
            </div>
            @if(!$settings['app']['auth']['2step'])
            <div class="form-group">
                <label for="login">password</label>
                <input  name="password"  type="password" class="form-control" id="mobile" placeholder="password">
            </div>
            @endif
            <div class="form-group">
                <input type="submit" class="submit btn-success" value="register">
            </div>



        </form>
    </div>


@endsection