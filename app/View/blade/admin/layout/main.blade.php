<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title or '' }}</title>

    @include('admin.includes.head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

@include('admin.includes.navigate')
@include('admin.includes.sidebar')

<div class="content-wrapper">

<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blank page
            <small>it all starts here</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

    @include('includes.messages')
    @yield('content')

</div>

    {{--@include('admin.includes.header')--}}
{{--@include('admin.includes.dashboard')--}}
@include('admin.includes.sidebar_control')
@include('admin.includes.footer')
@include('admin.includes.foot')
</div>
</body>
</html>