@extends('layout/main')

@section('content')
        <?php
                $a [] = $translator->trans('auth.fields.step1.login_mobile');
                $a [] = $translator->trans('auth.fields.step1.login_submit');
                dd($a);
                ?>
    <div class="container">
        <h1>Login</h1>
        <form action="login" method="post">
            <div class="form-group">
                <label for="login">{{$translator->trans('auth.fields.step1.login_mobile')}}</label>
                <input name="login"  type="text" class="form-control" id="login" placeholder="{{$translator->trans('auth.fields.login_mobile')}}">
            </div>

            <input type="submit" value="{{$translator->trans('auth.fields.step1.login_submit')}}" class="btn btn-success">
        </form>
    </div>

@endsection