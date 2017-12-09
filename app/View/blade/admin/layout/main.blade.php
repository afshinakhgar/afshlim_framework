<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title or '' }}</title>

    @include('admin.includes.head')
</head>
<body>


@include('admin.includes.header')
<div class="container">

@include('admin.includes.dashboard')


    @include('includes.messages')
    @yield('content')
</div>
@include('admin.includes.foot')

</body>
</html>