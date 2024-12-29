<x-app-layout>
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home page</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body>
        <!-- Header -->
        {{-- @include('layouts.navigation') --}}

        <!-- Main Content -->
        <main class="container-fluid">
            <!-- Hero Section -->
            <div class="row">
                <div class="col-12">
                    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="https://via.placeholder.com/1200x400?text=Sale+Up+to+70%25"
                                    class="d-block w-100" alt="Sale Banner">
                            </div>
                            <div class="carousel-item">
                                <img src="https://via.placeholder.com/1200x400?text=New+Collection+Arrived"
                                    class="d-block w-100" alt="New Collection Banner">
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
                <div class="col-md-2 text-center mb-3">
                    <a href="{{ route('products', ['type' => 'Scarves']) }}">
                        <img src="https://via.placeholder.com/300x300?text=Scarves"
                            class="img-fluid rounded-circle mb-2" alt="Scarves">
                    </a>
                    <h4>Scarves</h4>
                </div>
                <div class="col-md-2 text-center mb-3">
                    <a href="{{ route('products', ['type' => 'Ready to Wear']) }}">
                        <img src="https://via.placeholder.com/300x300?text=Ready+To+Wear"
                            class="img-fluid rounded-circle mb-2" alt="Ready To Wear">
                    </a>
                    <h4>Ready To Wear</h4>
                </div>
                <div class="col-md-2 text-center mb-3">
                    <a href="{{ route('products', ['type' => 'Bags']) }}">
                        <img src="https://via.placeholder.com/300x300?text=Bags" class="img-fluid rounded-circle mb-2"
                            alt="Bags">
                    </a>
                    <h4>Bags</h4>
                </div>
                <div class="col-md-2 text-center mb-3">
                    <a href="{{ route('products', ['type' => 'Shoes']) }}">
                        <img src="https://via.placeholder.com/300x300?text=Shoes" class="img-fluid rounded-circle mb-2"
                            alt="Shoes">
                    </a>
                    <h4>Shoes</h4>
                </div>
                <div class="col-md-2 text-center mb-3">
                    <a href="{{ route('products', ['type' => 'Accessories']) }}">
                        <img src="https://via.placeholder.com/300x300?text=Accessories"
                            class="img-fluid rounded-circle mb-2" alt="Accessories">
                    </a>
                    <h4>Accessories</h4>
                </div>
            </div>
            <!-- -->
            <div class="container-fluid my-5">
                <div class="row">
                    <div class="col-md-4 d-flex flex-column justify-content-center">
                        <h2>New Arrivals</h2>
                        <p>
                            Browse our newest array of prints, everyday wear, and accessories to craft a fashion-forward
                            and
                            confident look.
                            Elevate your fashion game and add flair to your wardrobe with our latest styles, curated to
                            bring your style to life.
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
                                                <img src="https://via.placeholder.com/150" class="card-img-top"
                                                    alt="Shawl Iconic Vol.3">
                                                <div class="card-body">
                                                    <h5 class="card-title">Shawl Iconic Vol.3 In Dark Blue</h5>
                                                    <p class="card-text">RM 159.00</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="card">
                                                <img src="https://via.placeholder.com/150" class="card-img-top"
                                                    alt="Shawl Iconic Vol.3">
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
                                                <img src="https://via.placeholder.com/150" class="card-img-top"
                                                    alt="Shawl Iconic Vol.3">
                                                <div class="card-body">
                                                    <h5 class="card-title">Shawl Iconic Vol.3 In Red</h5>
                                                    <p class="card-text">RM 159.00</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="card">
                                                <img src="https://via.placeholder.com/150" class="card-img-top"
                                                    alt="Shawl Iconic Vol.3">
                                                <div class="card-body">
                                                    <h5 class="card-title">Shawl Iconic Vol.3 In Black</h5>
                                                    <p class="card-text">RM 159.00</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add more carousel items as needed -->
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
                        <img src="https://via.placeholder.com/900x600?text=Scarves" class="img-fluid w-100"
                            alt="Scarves">
                        <div class="position-absolute bottom-0 start-0 p-3">
                            <h2 class="text-white">Scarves</h2>
                            <p class="text-white">Wrap Yourself in Elegance: Discover Our Scarf Range</p>
                            <a href="#" class="btn btn-outline-light">Discover Now</a>
                        </div>
                    </div>
                    <div class="col-md-6 position-relative">
                        <img src="https://via.placeholder.com/900x600?text=Ready+to+Wear" class="img-fluid w-100"
                            alt="Ready-to-Wear">
                        <div class="position-absolute bottom-0 start-0 p-3">
                            <h2 class="text-white">Ready-to-Wear</h2>
                            <p class="text-white">Seamless Style for Every Occasion</p>
                            <a href="#" class="btn btn-outline-light">Discover Now</a>
                        </div>
                    </div>
                </div>
            </div>

        </main>

        <!-- Footer -->
        <footer class="bg-white text-center py-3 mt-5">
            <p>&copy; 2024 Your Clothing Store. All rights reserved.</p>
        </footer>
    </body>

    </html>
</x-app-layout>
