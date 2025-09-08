<ul class="navbar-nav mx-auto"> <!-- Centered Navigation -->
    <li class="nav-item">
    <a class="nav-link" href="{{ route('products') }}">All Products</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#" id="newInDropdown" role="button"
            aria-expanded="false">
            New In
        </a>
        <ul class="dropdown-menu" aria-labelledby="newInDropdown">
            <li><a class="dropdown-item" href="#">Item 1</a></li>
            <li><a class="dropdown-item" href="#">Item 2</a></li>
            <li><a class="dropdown-item" href="#">Item 3</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#" id="scarvesDropdown" role="button"
           aria-expanded="false">
            Scarves
        </a>
        <ul class="dropdown-menu animate-dropdown" aria-labelledby="scarvesDropdown">
            <li><a class="dropdown-item" href="#">Combo Deals</a></li>
            <li><hr class="dropdown-divider"></li>
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
        <a class="nav-link dropdown-toggle " href="#" id="readyToWearDropdown" role="button"
            aria-expanded="false">
            Ready To Wear
        </a>
        <ul class="dropdown-menu" aria-labelledby="readyToWearDropdown">
            <li><a class="dropdown-item" href="#">Item 1</a></li>
            <li><a class="dropdown-item" href="#">Item 2</a></li>
            <li><a class="dropdown-item" href="#">Item 3</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#" id="collaborationsDropdown" role="button"
            aria-expanded="false">
            Collaborations
        </a>
        <ul class="dropdown-menu" aria-labelledby="collaborationsDropdown">
            <li><a class="dropdown-item" href="#">Item 1</a></li>
            <li><a class="dropdown-item" href="#">Item 2</a></li>
            <li><a class="dropdown-item" href="#">Item 3</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#" id="aryanDropdown" role="button"
            aria-expanded="false">
            Aryan
        </a>
        <ul class="dropdown-menu" aria-labelledby="aryanDropdown">
            <li><a class="dropdown-item" href="#">Item 1</a></li>
            <li><a class="dropdown-item" href="#">Item 2</a></li>
            <li><a class="dropdown-item" href="#">Item 3</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#" id="LuxeDropdown" role="button"
            aria-expanded="false">
            Luxe
        </a>
        <ul class="dropdown-menu" aria-labelledby="LuxeDropdown">
            <li><a class="dropdown-item" href="#">Item 1</a></li>
            <li><a class="dropdown-item" href="#">Item 2</a></li>
            <li><a class="dropdown-item" href="#">Item 3</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#" id="prayerwearDropdown" role="button"
            aria-expanded="false">
            Suit
        </a>
        <ul class="dropdown-menu" aria-labelledby="prayerwearDropdown">
            <li><a class="dropdown-item" href="{{ route('products', ['type' => 'Leena Suit']) }}">Leena suit</a></li>
            <li><a class="dropdown-item" href="{{ route('products', ['type' => 'Tasneem Suit']) }}">Taneem suit</a>
            </li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="accessoriesAndGiftingDropdown" role="button"
            aria-expanded="false">
            Accessories & Gifting
        </a>
        <ul class="dropdown-menu" aria-labelledby="accessoriesAndGiftingDropdown">
            <li><a class="dropdown-item" href="#">Item 1</a></li>
            <li><a class="dropdown-item" href="#">Item 2</a></li>
            <li><a class="dropdown-item" href="#">Item 3</a></li>
        </ul>
    </li>
</ul>
