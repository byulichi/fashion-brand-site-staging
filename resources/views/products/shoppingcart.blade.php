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
                            <table class="table cart-table">
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
                                                        <div class="input-group quantity-selector"
                                                            style="width: 120px;">
                                                            <button class="btn btn-outline-primary quantity-btn"
                                                                type="submit" name="quantity"
                                                                value="{{ is_array($cartItem) ? $cartItem['quantity'] - 1 : $cartItem->quantity - 1 }}">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                            <input type="text"
                                                                class="form-control text-center quantity-input"
                                                                value="{{ is_array($cartItem) ? $cartItem['quantity'] : $cartItem->quantity }}"
                                                                readonly>
                                                            <button class="btn btn-outline-primary quantity-btn"
                                                                type="submit" name="quantity"
                                                                value="{{ is_array($cartItem) ? $cartItem['quantity'] + 1 : $cartItem->quantity + 1 }}">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                    <form
                                                        action="{{ route('cart.remove', is_array($cartItem) ? $key : $cartItem->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-danger mt-2 btn btn-link text-decoration-none">Remove
                                                            ×</button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td>RM
                                                {{ number_format((is_array($cartItem) ? $cartItem['price'] : $cartItem->item->price) * (is_array($cartItem) ? $cartItem['quantity'] : $cartItem->quantity), 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card grey-border">
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
                                <button type="button" class="btn btn-primary w-100 mb-2" data-bs-toggle="modal"
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
<style>
    .quantity-selector {
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        display: flex;
    }
    .quantity-btn {
        border: none;
        background: var(--background-color);
        color: var(--accent-color);
        padding: 0.5rem 0.75rem;
        transition: all 0.2s ease;
        width: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .quantity-btn:hover {
        background: var(--accent-color);
        color: white;
    }
    .quantity-btn:first-of-type::before {
        content: "-";
    }
    .quantity-btn:last-of-type::before {
        content: "+";
    }
    .quantity-btn i.fas {
        display: none;
    }
    .quantity-input {
        border: none;
        background: var(--background-color);
        font-weight: 600;
        color: var(--primary-color);
        width: 30px;
        text-align: center;
    }
    .quantity-input:focus {
        box-shadow: none;
    }
.table.cart-table {
    border-radius: 0.5rem;
    overflow: hidden;
    border: 1px solid #ced4da;
    box-shadow: 0 0 0 1px #ced4da;
    background: var(--background-color);
}
.table.cart-table thead th {
    background-color: var(--background-color);
    color: var(--primary-color);
    border-bottom: 1px solid #ced4da;
    padding: 1rem;
    font-weight: 600;
}
.table.cart-table td {
    padding: 1rem;
    vertical-align: middle;
    border-bottom: 1px solid #ced4da;
}
.table.cart-table tr:last-child td {
    border-bottom: none;
}
.table.cart-table tbody tr:hover {
    background-color: rgba(159, 122, 234, 0.05);
}
.grey-border {
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
}
</style>
