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
            @include('layouts.navigationitem')
            <ul class="navbar-nav ms-auto">
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i>
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user me-2"></i>Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('cart') }}">
                                        <i class="fas fa-shopping-bag me-2"></i>My Cart
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('my-purchases') }}">
                                        <i class="fas fa-shopping-bag me-2"></i>My Purchases
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="dropdown-item">
                                        @csrf
                                        <button type="submit" class="btn btn-link text-decoration-none p-0">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="{{ route('cart') }}">
                                <i class="fas fa-shopping-cart"></i>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ Auth::user()->cart()->count() }}
                                </span>
                            </a>
                        </li>
                    @else
                        <!-- 非認証ユーザー用のナビゲーション -->
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</header>
<style>
    .dropdown-item:active {
        background-color: #f8f9fa;
        color: #212529;
    }
    .dropdown-item button:hover {
        color: #0d6efd;
    }
    .nav-link {
        transition: all 0.2s ease-in-out;
    }
    .nav-link:hover {
        color: #0d6efd;
    }
    .badge {
        font-size: 0.6rem;
        padding: 0.25em 0.4em;
    }
</style>
