<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="#">Logo</a>

    <!-- Links -->
    <ul class="navbar-nav">
        @if(\Core\Facades\Auth::check())
            <li class="nav-item">
                <a class="nav-link" href="#">{{\Core\Facades\Auth::user()->first_name}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('logout')}}">LogOut</a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{url('login.step1')}}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('register')}}">Register</a>
            </li>
        @endif
    </ul>
</nav>
<div class="container">

    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <h1>Admin</h1>

    </div>

</div> <!-- /container -->

