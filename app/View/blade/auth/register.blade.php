@extends('layout/main')

@section('content')

    <div class="container">
        <h1>Register</h1>
        <form action="register" method="post">
            <div class="form-group">
                <label for="firstname">Name</label>
                <input type="text" class="form-control" id="firstname" placeholder="first name">
            </div>

            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" id="lastname" placeholder="last name">
            </div>

            <div class="form-group">
                <label for="email">email</label>
                <input type="email" class="form-control" id="email" placeholder="email">
            </div>

            <div class="form-group">
                <label for="mobile">mobile</label>
                <input type="mobile" class="form-control" id="mobile" placeholder="email">
            </div>

            <div class="form-group">
                <label for="username">username</label>
                <input type="username" class="form-control" id="mobile" placeholder="username">
            </div>


            <div class="form-group">
                <input type="submit" class="submit btn-success">
            </div>



        </form>
    </div>


@endsection