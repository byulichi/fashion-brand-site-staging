<x-app-layout>
    <div class="container mt-5">
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
                                                    <img
                                                        src="{{ is_array($cartItem) ? $cartItem['photo'] : asset($cartItem->item->photo) }}"
                                                        alt="Product Image" class="img-fluid me-3"
                                                        style="width: 80px; height: 115px; object-fit: cover;">
                                                    <div class="product-info">
                                                        <h5 class="mb-1">{{ is_array($cartItem) ? $cartItem['name'] : $cartItem->item->name }}</h5>
                                                        <p class="mb-0">{{ is_array($cartItem) ? App\Models\Type::find($cartItem['type_id'])->name : $cartItem->item->type->name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>RM {{ number_format(is_array($cartItem) ? $cartItem['price'] : $cartItem->item->price, 2) }}</td>
                                            <td>
                                                <div class="d-flex flex-column align-items-center">
                                                    <form action="{{ route('cart.update', is_array($cartItem) ? $key : $cartItem->id) }}" method="POST">
                                                        @csrf
                                                        <div class="input-group" style="width: 120px;">
                                                            <button class="btn btn-outline-secondary" type="submit" name="quantity" value="{{ is_array($cartItem) ? $cartItem['quantity'] - 1 : $cartItem->quantity - 1 }}">-</button>
                                                            <input type="text" class="form-control text-center" value="{{ is_array($cartItem) ? $cartItem['quantity'] : $cartItem->quantity }}" readonly>
                                                            <button class="btn btn-outline-secondary" type="submit" name="quantity" value="{{ is_array($cartItem) ? $cartItem['quantity'] + 1 : $cartItem->quantity + 1 }}">+</button>
                                                        </div>
                                                    </form>
                                                    <form action="{{ route('cart.remove', is_array($cartItem) ? $key : $cartItem->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-danger mt-2 btn btn-link">Remove &times;</button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td>RM {{ number_format((is_array($cartItem) ? $cartItem['price'] : $cartItem->item->price) * (is_array($cartItem) ? $cartItem['quantity'] : $cartItem->quantity), 2) }}</td>
                                        </tr>
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
                        <p class="card-text">RM {{ number_format($cartItems->sum(function ($cartItem) {
                            return (is_array($cartItem) ? $cartItem['price'] : $cartItem->item->price) * (is_array($cartItem) ? $cartItem['quantity'] : $cartItem->quantity);
                        }), 2) }}</p>
                        <p class="card-text">You can choose your shipping option later in the checkout.</p>
                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf
                            <button class="btn btn-dark w-100 mb-2">CHECKOUT</button>
                        </form>
                        <a href="{{ route('checkout') }}" class="btn btn-outline-dark w-100">GUEST CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
