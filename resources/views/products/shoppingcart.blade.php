<x-app-layout>
    <div class="container mt-5">
        <h1 class="mb-4">My Cart</h1>
        <p class="mb-4">Adding an item to your bag doesn't hold it, so get what you love before it's gone.</p>
        <div class="row">
            <div class="col-md-8">
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
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
                                                    <div class="d-flex">
                                                        <img src="{{ $cartItem['image'] ?? 'https://via.placeholder.com/100' }}"
                                                            alt="Product Image" class="img-fluid me-3"
                                                            style="width: 80px; height: 115px; object-fit: cover;">
                                                        <div>
                                                            <h5 class="mb-1">{{ $cartItem['name'] }}</h5>
                                                            <p class="mb-0">SKU: {{ $cartItem['id'] ?? 'N/A' }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>RM {{ number_format($cartItem['price'], 2) }}</td>
                                                <td>
                                                    <form
                                                        action="{{ route('cart.update', $key) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="input-group" style="width: 120px;">
                                                            <button class="btn btn-outline-secondary" type="submit"
                                                                name="quantity"
                                                                value="{{ $cartItem['quantity'] - 1 }}">-</button>
                                                            <input type="text" class="form-control text-center"
                                                                value="{{ $cartItem['quantity'] }}" readonly>
                                                            <button class="btn btn-outline-secondary" type="submit"
                                                                name="quantity"
                                                                value="{{ $cartItem['quantity'] + 1 }}">+</button>
                                                        </div>
                                                    </form>

                                                    <form
                                                        action="{{ route('cart.remove', $key) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-danger mt-2 d-block btn btn-link">Remove
                                                            &times;</button>
                                                    </form>
                                                </td>

                                                <td>RM
                                                    {{ number_format($cartItem['price'] * $cartItem['quantity'], 2) }}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
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
                                    return is_array($cartItem)
                                        ? $cartItem['price'] * $cartItem['quantity']
                                        : $cartItem->item->price * $cartItem->quantity;
                                }),
                                2,
                            ) }}
                        </p>
                        <p class="card-text">You can choose your shipping option later in the checkout.</p>
                        <a href="#" class="btn btn-dark w-100 mb-2">LOGIN TO CHECKOUT</a>
                        <a href="#" class="btn btn-outline-dark w-100">GUEST CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
