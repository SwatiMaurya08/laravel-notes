<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('blog.index') }}">Softhinkers</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">

            <li><a class="nav-item nav-link" href="{{ route('blog.index') }}">Blog</a></li>
            <li><a class="nav-item nav-link" href="{{ route('others.about') }}">About</a></li>
            <li><a class="nav-item nav-link" href="{{ route('others.contact') }}">Contact Us</a></li>
            @if(!Auth::check())
                <li><a class="nav-item nav-link" href="{{ url('/login') }}">Login</a></li>
                <li><a class="nav-item nav-link" href="{{ url('/register') }}">Register</a></li>
            @else

                <li><a class="nav-item nav-link" href="{{ route('admin.index') }}">Posts</a></li>
                <li>
                    <a class="nav-item nav-link" href="{{ url('/logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form');">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="...">
                        {{csrf_field()}}

                    </form>
                </li>
            @endif
        </div>
    </div>
</nav>
