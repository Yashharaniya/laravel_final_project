<style>
    .custom-navbar-nav .nav-link.active {
        color: yellow; /* Change text color if needed */
        border-bottom: 2px solid yellow; /* Add yellow underline */
    }
</style>

<nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Furni<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                </li>
                <li><a class="nav-link {{ Request::is('shop') ? 'active' : '' }}" href="{{ url('shop') }}">Shop</a></li>
                <li><a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{ url('about') }}">About us</a></li>
                <li><a class="nav-link {{ Request::is('services') ? 'active' : '' }}" href="{{ url('services') }}">Services</a></li>
                <li><a class="nav-link {{ Request::is('blogg') ? 'active' : '' }}" href="{{ url('blogg') }}">Blog</a></li>
                <!-- Ensure the URL and Request::is pattern match -->
                <li><a class="nav-link {{ Request::is('contact') ? 'active' : '' }}" href="{{ url('contact') }}">Contact us</a></li>
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="images/user.svg" alt="User Icon" class="me-2">
                        @if (Auth::check())
                            <span>{{ Auth::user()->name }}</span>
                        @endif
                    </a>
                    @if (Route::has('login'))
                        @auth
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        @else
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                                <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                            </ul>
                        @endauth
                    @endif
                </li>
                <li><a class="nav-link" href="{{ url('cart') }}"><img src="images/cart.svg" alt="Cart Icon"></a></li>
            </ul>
        </div>
    </div>
</nav>
