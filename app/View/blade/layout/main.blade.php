<!DOCTYPE html>
<html lang="en">
<head>


    @include('includes.head')

</head>
<body>


@include('includes.header')

<div class="container">

@include('includes.messages')
@yield('content')
</div>

@include('includes.foot')
</body>


</html>