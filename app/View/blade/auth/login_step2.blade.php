@extends('layout/main')

@section('content')

    <div class="container">
        <h1>Login</h1>
        <form action="{{route('login.step2')}}" method="post">
            <div class="form-group">
                <label for="code">code</label>
                <input name="code"  type="text" class="form-control" id="code" placeholder="">
                <input name="login" value="{!! $login !!}" type="hidden" class="form-control" id="code" placeholder="">
            </div>


            <input type="submit" value="{{$translator->trans('auth.fields.step1.login_submit')}}" class="btn btn-success">
        </form>
    </div>

@endsection