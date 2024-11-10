<!-- Header -->
<header class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <?php session(['url.intended' => url()->full()]); ?>
    <div class="container-fluid my-2">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="#" height="40" alt="Brand Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            @include("layouts.navigationitem")
            <ul class="navbar-nav ms-auto">
                @if (Route::has('login'))
                    @auth
                        @if (Auth::user()->isStaff())
                            <!-- Display this section only for staff users -->
                            <li class="nav-item">
                                <span class="nav-link text-uppercase fw-bold text-primary">Staff Mode</span>
                            </li>
                        @else
                            <!-- Display this section for non-staff users -->
                            <li class="nav-item">
                                <a class="nav-link">Hi, {{ Auth::user()->name }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">|</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cart') }}">My Cart</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('my-purchases') }}">My Purchases</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">Logout</button>
                            </form>
                        </li>
                    @else
                        <!-- Guest users see this section -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart') }}">My Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">|</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Log in</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</header>
<style>
    .dropdown:hover .dropdown-menu {
        display: block;
    }
</style>
