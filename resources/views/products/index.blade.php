<x-app-layout>
    <div class="container mt-4">
        <!-- Sort and Filter Options -->
        <div class="col mb-4">
            <div class="col-md-3">
                <div class="mb-4">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown"
                            aria-expanded="false">
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
        </div>
        <!-- Product Grid -->
        <div class="row">
            @foreach ($items as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card">
                        <img src="{{ $item->photo ? asset($item->photo) : 'https://via.placeholder.com/400x600' }}"
                            style="width: 304px; height: 456px; object-fit: cover;"
                            class="card-img-top img-fluid product-image hover-cursor" alt="{{ $item->name }}"
                            data-bs-toggle="modal"
                            data-bs-target="#{{ Auth::check() && Auth::user()->isStaff() ? 'editItemModal' . $item->id : 'productModal' . $item->id }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text">RM {{ number_format($item->price, 2) }}</p>
                        </div>
                    </div>
                </div>
                <!-- スタッフユーザーかどうかで表示するモーダルを切り替え -->
                @if (Auth::check() && Auth::user()->isStaff())
                    @include('products.staffonly.edit', ['item' => $item])
                @else
                    @include('products.addtocartmodal', ['item' => $item])
                @endif
            @endforeach
            <!-- スタッフユーザー用の商品追加カード -->
            @include('products.staffonly.add')
        </div>
    </div>

    <style>
        .hover-cursor {
            cursor: pointer;
        }

        /* animation */
        .card {
            border: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            background-color: var(--background-color);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            border-radius: 10px 10px 0 0;
            transition: all 0.3s ease;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .card-text {
            color: var(--accent-color);
            font-weight: 600;
        }
    </style>
</x-app-layout>
