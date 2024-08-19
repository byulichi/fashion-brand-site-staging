<!-- Header -->
<header class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container-fluid my-2">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="#" height="40" alt="Brand Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto"> <!-- Centered Navigation -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="newInDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        New In
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="newInDropdown">
                        <li><a class="dropdown-item" href="#">Item 1</a></li>
                        <li><a class="dropdown-item" href="#">Item 2</a></li>
                        <li><a class="dropdown-item" href="#">Item 3</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="scarvesDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Scarves
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="scarvesDropdown">
                        <li><a class="dropdown-item" href="#">Combo Deals</a></li>
                        <li><a class="dropdown-item" href="#">Plain Square</a></li>
                        <li><a class="dropdown-item" href="#">Printed Square</a></li>
                        <li><a class="dropdown-item" href="#">Plain Shawl</a></li>
                        <li><a class="dropdown-item" href="#">Printed Shawl</a></li>
                        <li><a class="dropdown-item" href="#">Capsule Edition</a></li>
                        <li><a class="dropdown-item" href="#">Printed Instant</a></li>
                        <li><a class="dropdown-item" href="#">Plain Instant</a></li>
                        <li><a class="dropdown-item" href="#">Tiara</a></li>
                        <li><a class="dropdown-item" href="#">Wide Square</a></li>
                        <li><a class="dropdown-item" href="#">Packaging</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="readyToWearDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Ready To Wear
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="readyToWearDropdown">
                        <li><a class="dropdown-item" href="#">Item 1</a></li>
                        <li><a class="dropdown-item" href="#">Item 2</a></li>
                        <li><a class="dropdown-item" href="#">Item 3</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="collaborationsDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Collaborations
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="collaborationsDropdown">
                        <li><a class="dropdown-item" href="#">Item 1</a></li>
                        <li><a class="dropdown-item" href="#">Item 2</a></li>
                        <li><a class="dropdown-item" href="#">Item 3</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="aryanDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Aryan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="aryanDropdown">
                        <li><a class="dropdown-item" href="#">Item 1</a></li>
                        <li><a class="dropdown-item" href="#">Item 2</a></li>
                        <li><a class="dropdown-item" href="#">Item 3</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="LuxeDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Luxe
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="LuxeDropdown">
                        <li><a class="dropdown-item" href="#">Item 1</a></li>
                        <li><a class="dropdown-item" href="#">Item 2</a></li>
                        <li><a class="dropdown-item" href="#">Item 3</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="prayerwearDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Prayerwear
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="prayerwearDropdown">
                        <li><a class="dropdown-item" href="#">Item 1</a></li>
                        <li><a class="dropdown-item" href="#">Item 2</a></li>
                        <li><a class="dropdown-item" href="#">Item 3</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="bagsDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Bags
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="bagsDropdown">
                        <li><a class="dropdown-item" href="#">Item 1</a></li>
                        <li><a class="dropdown-item" href="#">Item 2</a></li>
                        <li><a class="dropdown-item" href="#">Item 3</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="accessoriesAndGiftingDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Accessories & Gifting
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="accessoriesAndGiftingDropdown">
                        <li><a class="dropdown-item" href="#">Item 1</a></li>
                        <li><a class="dropdown-item" href="#">Item 2</a></li>
                        <li><a class="dropdown-item" href="#">Item 3</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a class="nav-link">Hi, {{ Auth::check() ? Auth::user()->name : null }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">|</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart') }}">My Cart</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">Logout</button>
                            </form>
                        </li>
                    @else
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
