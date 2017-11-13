@extends('layout/main')

@section('content')

    <div class="container">
        <h1>Register</h1>
        <form>
            <div class="form-group">
                <label for="formGroupExampleInput">Name</label>
                <input type="text" class="form-control" id="name" placeholder="first name">
            </div>

            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" id="lastname" placeholder="last name">
            </div>

            <div class="form-group">
                <label for="email">email</label>
                <input type="email" class="form-control" id="formGroupExampleInput2" placeholder="email">
            </div>
        </form>
    </div>


@endsection