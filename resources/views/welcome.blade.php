<x-app-layout>
    <body>
        <main class="container-fluid">
            <!-- Hero Section -->
            <div class="row">
                <div class="col-12">
                    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('images/Banner/sale up to 70% off.jpeg') }}"
                                    class="d-block img-fluid" alt="Sale Banner">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/Banner/new collection arrived.jpeg') }}"
                                    class="d-block img-fluid" alt="New Collection Banner">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Product Categories -->
            <div class="row mt-5 justify-content-center">
                <div class="col-md-2 col-6 text-center mb-3">
                    <a href="{{ route('products', ['type' => 'Scarves']) }}">
                        <img src="{{ asset("images/Welcome page/scarves.jpg") }}"
                            class="img-fluid rounded-circle mb-2"
                            style="width: 250px; height: 250px; object-fit: cover; max-width: 100%;" alt="Scarves">
                    </a>
                    <h4>Scarves</h4>
                </div>
                <div class="col-md-2 col-6 text-center mb-3">
                    <a href="{{ route('products', ['type' => 'Ready to Wear']) }}">
                        <img src="{{ asset("images/Welcome page/ready to wear.jpg") }}"
                            class="img-fluid rounded-circle mb-2"
                            style="width: 250px; height: 250px; object-fit: cover; max-width: 100%;" alt="Ready To Wear">
                    </a>
                    <h4>Ready To Wear</h4>
                </div>
                <div class="col-md-2 col-6 text-center mb-3">
                    <a href="{{ route('products', ['type' => 'Bags']) }}">
                        <img src="{{ asset("images/Welcome page/bags.webp") }}"
                            class="img-fluid rounded-circle mb-2"
                            style="width: 250px; height: 250px; object-fit: cover; max-width: 100%;" alt="Bags">
                    </a>
                    <h4>Bags</h4>
                </div>
                <div class="col-md-2 col-6 text-center mb-3">
                    <a href="{{ route('products', ['type' => 'Shoes']) }}">
                        <img src="{{ asset("images/Welcome page/shoes.webp") }}"
                            class="img-fluid rounded-circle mb-2"
                            style="width: 250px; height: 250px; object-fit: cover; max-width: 100%;" alt="Shoes">
                    </a>
                    <h4>Shoes</h4>
                </div>
                <div class="col-md-2 col-6 text-center mb-3">
                    <a href="{{ route('products', ['type' => 'Accessories']) }}">
                        <img src="{{ asset("images/Welcome page/accessories.jpg") }}"
                            class="img-fluid rounded-circle mb-2"
                            style="width: 250px; height: 250px; object-fit: cover; max-width: 100%;" alt="Accessories">
                    </a>
                    <h4>Accessories</h4>
                </div>
            </div>
            <!-- -->
            <div class="container-fluid my-5">
                <div class="row">
                    <div class="col-md-4 d-flex flex-column justify-content-center">
                        <h2>Leena Suit</h2>
                        <p>
                            Experience effortless elegance with our Leena suit collection. Designed for both comfort and
                            professional appeal, these suits offer a perfect blend of sophistication and ease.
                            Perfect for the modern woman who values both style and functionality.
                        </p>
                        <a href="#" class="btn btn-outline-primary my-3">Shop Now</a>
                    </div>
                    <div class="col-md-8">
                        <div id="newArrivalsCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="card">
                                                <img src="{{ asset('images/Leena_suit/IMG_0223.JPG') }}" class="card-img-top"
                                                    alt="Shawl Iconic Vol.3" style="width: 517px; height: 775px; object-fit: cover;">
                                                <div class="card-body">
                                                    <h5 class="card-title">Shawl Iconic Vol.3 In Dark Blue</h5>
                                                    <p class="card-text">RM 159.00</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="card">
                                                <img src="{{ asset('images/Leena_suit/IMG_0230.JPG') }}" class="card-img-top"
                                                    alt="Shawl Iconic Vol.3" style="width: 517px; height: 775px; object-fit: cover;">
                                                <div class="card-body">
                                                    <h5 class="card-title">Shawl Iconic Vol.3 In Mustard</h5>
                                                    <p class="card-text">RM 159.00</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="card">
                                                <img src="{{ asset('images/Leena_suit/IMG_0242.JPG') }}" class="card-img-top"
                                                    alt="Shawl Iconic Vol.3" style="width: 517px; height: 775px; object-fit: cover;">
                                                <div class="card-body">
                                                    <h5 class="card-title">Shawl Iconic Vol.3 In Red</h5>
                                                    <p class="card-text">RM 159.00</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="card">
                                                <img src="{{ asset('images/Leena_suit/IMG_0233.JPG') }}" class="card-img-top"
                                                    alt="Shawl Iconic Vol.3" style="width: 517px; height: 775px; object-fit: cover;">
                                                <div class="card-body">
                                                    <h5 class="card-title">Shawl Iconic Vol.3 In Black</h5>
                                                    <p class="card-text">RM 159.00</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#newArrivalsCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#newArrivalsCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- -->
            <div class="container-fluid my-5">
                <div class="row">
                    <div class="col-md-6 position-relative">
                        <div class="position-relative" style="height: 530px;">
                            <img src="{{ asset('images/Welcome page/hijab_bottom.jpeg') }}"
                                style="width: 800px; height: 530px; object-fit: cover;"
                                alt="Scarves">
                            <div class="position-absolute bottom-0 start-0 w-100 h-50"
                                style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                            </div>
                            <div class="position-absolute bottom-0 start-0 p-3">
                                <h2 class="text-white">Scarves</h2>
                                <p class="text-white">Wrap Yourself in Elegance: Discover Our Scarf Range</p>
                                <a href="#" class="btn btn-outline-light">Discover Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 position-relative">
                        <div class="position-relative" style="height: 530px;">
                            <img src="{{ asset('images/Welcome page/ready to wear_bottom.jpg') }}" class="img-fluid"
                                style="width: 800px; height: 530px; object-fit: cover;"
                                alt="Ready-to-Wear">
                            <div class="position-absolute bottom-0 start-0 w-100 h-50"
                                style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                            </div>
                            <div class="position-absolute bottom-0 start-0 p-3">
                                <h2 class="text-white">Ready-to-Wear</h2>
                                <p class="text-white">Seamless Style for Every Occasion</p>
                                <a href="#" class="btn btn-outline-light">Discover Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
</x-app-layout>
