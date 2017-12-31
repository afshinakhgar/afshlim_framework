@extends('layout/main')

@section('content')

    <div class="container">
        <h1>Login</h1>
        <form action="{{route('login.step1')}}" method="post">
            <div class="form-group">
                <label for="login">{{$translator->trans('auth.fields.step1.login_mobile')}}</label>
                <input name="login"  type="text" class="form-control" id="login" placeholder="{{$translator->trans('auth.fields.login_mobile')}}">
            </div>

            @if(!$settings['app']['auth']['2step'])
                <div class="form-group">
                    <label for="login">password</label>
                    <input  name="password"  type="password" class="form-control" id="mobile" placeholder="password">
                </div>
            @endif

            <input type="submit" value="{{$translator->trans('auth.fields.step1.login_submit')}}" class="btn btn-success">
        </form>
    </div>

@endsection