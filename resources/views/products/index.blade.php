<x-app-layout>
    <div class="container mt-4">
        <!-- Sort and Filter Options -->
        <div class="col mb-4">
            <div class="col-md-3">
                <div class="mb-4">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Sort By: Latest
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                        <li><a class="dropdown-item" href="#">Latest</a></li>
                        <li><a class="dropdown-item" href="#">Price: Low to High</a></li>
                        <li><a class="dropdown-item" href="#">Price: High to Low</a></li>
                    </ul>
                </div>
            </div>
            {{-- <div class="col-md-9">
            <div class="row">
                <div class="col-md-3">
                    <button class="btn btn-outline-secondary w-100">Search by Categories</button>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-outline-secondary w-100">Price</button>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-outline-secondary w-100">Color</button>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-outline-secondary w-100">Size</button>
                </div>
            </div>
        </div> --}}
        </div>

        <!-- Product Grid -->
        <div class="row">
            @foreach($items as $item)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/400x600" class="card-img-top img-fluid product-image hover-cursor" alt="{{ $item->name }}" data-bs-toggle="modal" data-bs-target="#productModal">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p class="card-text">RM {{ number_format($item->price, 2) }}</p>
                        {{-- <p class="text-muted">3 payments of RM {{ number_format($item->price / 3, 2) }} with <a href="#">atome</a></p> --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Add to cart Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Add to Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you want to add this product to your cart?
                </div>
                <div class="modal-footer">
                    <a href="{{ route('cart') }}" class="btn btn-primary">Add to Cart</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-cursor {
            cursor: pointer;
        }
    </style>
</x-app-layout>
