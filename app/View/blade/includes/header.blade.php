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
<br>
<div class="container">

    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <h1>Navbar example</h1>
        <p>This example is a quick exercise to illustrate how the default, static and fixed to top navbar work. It includes the responsive CSS and HTML, so it also adapts to your viewport and device.</p>
        <p>To see the difference between static and fixed top navbars, just scroll.</p>
        <p>
        </p>
    </div>

</div> <!-- /container -->
