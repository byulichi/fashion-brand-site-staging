<x-app-layout>
    <div class="container mt-5">
        @if (session('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
            </div>
        @endif
        <h1 class="mb-4">My Cart</h1>
        <p class="mb-4">Adding an item to your bag doesn't hold it, so get what you love before it's gone.</p>
        <div class="row">
            <div class="col-md-8">
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Product Description</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">QTY.</th>
                                        <th scope="col">Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $key => $cartItem)
                                        <tr>
                                            <td>
                                                <div class="d-flex flex-wrap align-items-center">
                                                    <img src="{{ is_array($cartItem) ? $cartItem['photo'] : asset($cartItem->item->photo) }}"
                                                        alt="Product Image" class="img-fluid me-3"
                                                        style="width: 80px; height: 115px; object-fit: cover;">
                                                    <div class="product-info">
                                                        <h5 class="mb-1">
                                                            {{ is_array($cartItem) ? $cartItem['name'] : $cartItem->item->name }}
                                                        </h5>
                                                        <p class="mb-0">
                                                            {{ is_array($cartItem) ? App\Models\Type::find($cartItem['type_id'])->name : $cartItem->item->type->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>RM
                                                {{ number_format(is_array($cartItem) ? $cartItem['price'] : $cartItem->item->price, 2) }}
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column align-items-center">
                                                    <form
                                                        action="{{ route('cart.update', is_array($cartItem) ? $key : $cartItem->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="input-group" style="width: 120px;">
                                                            <button class="btn btn-outline-secondary" type="submit"
                                                                name="quantity"
                                                                value="{{ is_array($cartItem) ? $cartItem['quantity'] - 1 : $cartItem->quantity - 1 }}">-</button>
                                                            <input type="text" class="form-control text-center"
                                                                value="{{ is_array($cartItem) ? $cartItem['quantity'] : $cartItem->quantity }}"
                                                                readonly>
                                                            <button class="btn btn-outline-secondary" type="submit"
                                                                name="quantity"
                                                                value="{{ is_array($cartItem) ? $cartItem['quantity'] + 1 : $cartItem->quantity + 1 }}">+</button>
                                                        </div>
                                                    </form>
                                                    <form id="removeForm{{ $cartItem->id }}"
                                                        action="{{ route('cart.remove', is_array($cartItem) ? $key : $cartItem->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="text-danger mt-2 btn btn-link"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#confirmRemoveModal{{ $cartItem->id }}">
                                                            Remove &times;
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td>RM
                                                {{ number_format((is_array($cartItem) ? $cartItem['price'] : $cartItem->item->price) * (is_array($cartItem) ? $cartItem['quantity'] : $cartItem->quantity), 2) }}
                                            </td>
                                        </tr>
                                        <!-- Remove item confirmation modal -->
                                        <div class="modal fade" id="confirmRemoveModal{{ $cartItem->id }}"
                                            tabindex="-1" aria-labelledby="confirmRemoveLabel{{ $cartItem->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="confirmRemoveLabel{{ $cartItem->id }}">Confirm Removal
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to remove
                                                        <strong>{{ is_array($cartItem) ? $cartItem['name'] : $cartItem->item->name }}</strong>
                                                        from your
                                                        cart?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" form="removeForm{{ $cartItem->id }}"
                                                            class="btn btn-danger">Yes,
                                                            Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Subtotal: (ex. Shipping)</h5>
                        <p class="card-text">RM
                            {{ number_format(
                                $cartItems->sum(function ($cartItem) {
                                    return (is_array($cartItem) ? $cartItem['price'] : $cartItem->item->price) *
                                        (is_array($cartItem) ? $cartItem['quantity'] : $cartItem->quantity);
                                }),
                                2,
                            ) }}
                        </p>
                        @if (Auth::check())
                            <p class="card-text">You can choose your shipping option later in the checkout.</p>
                            <form action="{{ route('checkout') }}" method="POST">
                                @csrf
                                <button type="button" class="btn btn-dark w-100 mb-2" data-bs-toggle="modal"
                                    data-bs-target="#shippingModal">
                                    CHECKOUT
                                </button>
                            </form>
                        @else
                            <p class="card-text">Login to proceed to checkout.</p>
                            <button type="button" class="btn btn-dark w-100 mb-2">
                                <a class="nav-link" href="{{ route('login') }}">Log in</a>
                            </button>
                        @endif
                        {{-- <a href="{{ route('checkout') }}" class="btn btn-outline-dark w-100">GUEST CHECKOUT</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('products.checkoutmodal')
</x-app-layout>
