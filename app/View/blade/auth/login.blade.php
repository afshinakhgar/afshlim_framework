@extends('layout/main')

@section('content')

    <div class="container">
        <h1>Login</h1>
        <form action="login" method="post">
            <div class="form-group">
                <label for="login">email</label>
                <input name="login"  type="email" class="form-control" id="login" placeholder="email">
            </div>
            <div class="form-group">
                <label for="mobile">password</label>
                <input  name="password"  type="password" class="form-control" id="password" placeholder="password">
            </div>
            <input type="submit" class="btn btn-success">
        </form>
    </div>

@endsection