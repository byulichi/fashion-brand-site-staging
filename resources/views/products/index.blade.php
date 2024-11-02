<x-app-layout>
    <div class="container mt-4">
        <!-- Sort and Filter Options -->
        <div class="col mb-4">
            <div class="col-md-3">
                <div class="mb-4">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Sort By:
                        @if (request('sort') == 'price_asc')
                            Price: Low to High
                        @elseif(request('sort') == 'price_desc')
                            Price: High to Low
                        @else
                            Latest
                        @endif
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                        <li><a class="dropdown-item"
                                href="{{ route('products', array_merge(request()->only(['type']), ['sort' => 'latest'])) }}">Latest</a>
                        </li>

                        <li><a class="dropdown-item"
                                href="{{ route('products', array_merge(request()->only(['type']), ['sort' => 'price_asc'])) }}">Price:
                                Low to High</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('products', array_merge(request()->only(['type']), ['sort' => 'price_desc'])) }}">Price:
                                High to Low</a></li>

                    </ul>
                </div>
            </div>
        </div>
        <!-- Product Grid -->
        <div class="row">
            @foreach ($items as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card">
                        <img src= {{ $item->photo ? asset($item->photo) : "https://via.placeholder.com/400x600" }}
                            style="width: 304px; height: 456px; object-fit: cover;"
                            class="card-img-top img-fluid product-image hover-cursor" alt="{{ $item->name }}"
                            data-bs-toggle="modal" data-bs-target="#productModal{{ $item->id }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text">RM {{ number_format($item->price, 2) }}</p>
                        </div>
                    </div>
                </div>
                <!-- Add to cart Modal -->
            @include("products.addtocartmodal", ['item' => $item])
            @endforeach
        </div>
    </div>

    <style>
        .hover-cursor {
            cursor: pointer;
        }
    </style>
</x-app-layout>
