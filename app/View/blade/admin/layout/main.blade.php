<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title or '' }}</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">

</head>
<body>


@include('admin.includes.header')
<div class="container">

@include('admin.includes.dashboard')


    @include('includes.messages')
    @yield('content')
</div>

</body>
</html>