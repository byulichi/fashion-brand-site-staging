<div class="card">
    <div class="card-body">

        <h2 class="fs-5 card-title mb-3">Cart Items</h2>
        @if ($cartItems->isNotEmpty())
            @foreach ($cartItems as $cartItem)
                @php
                    $product = is_array($cartItem)
                        ? (object) $cartItem
                        : $cartItem->item;
                    $quantity = is_array($cartItem)
                        ? $cartItem['quantity']
                        : $cartItem->quantity;
                    $unitPrice = is_array($cartItem)
                        ? $cartItem['price']
                        : $cartItem->item->price;
                @endphp
                <div class="d-flex align-items-center mb-3">
                    <div>
                        @if (asset($cartItem->item->photo))
                            <div class="bg-secondary d-flex align-items-center justify-content-center" width="64"
                                height="86">
                                <img src="{{ asset($cartItem->item->photo) }}" alt="{{ $product->name }}"
                                    class="" width="64" height="86" style="object-fit: cover;">
                            </div>
                        @else
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                                width="64" height="86">
                                <span>No Image</span>
                            </div>
                        @endif
                    </div>
                    <div class="ms-3">
                        <h3 class="fs-6 fw-semibold mb-1">{{ $product->name }}
                        </h3>
                        <p class="text-muted mb-1 small">Qty: {{ $quantity }}
                        </p>
                        <p class="text-muted mb-1 small">Unit Price: RM
                            {{ number_format($unitPrice, 2) }}</p>
                    </div>
                    <div class="ms-auto fw-semibold">RM
                        {{ number_format($unitPrice * $quantity, 2) }}</div>
                </div>
            @endforeach
        @else
            <p>Your cart is empty.</p>
        @endif
        <hr class="my-4">
        <div class="d-flex justify-content-between fw-semibold mb-2">
            <span>Sub-Total</span>
            <span>RM {{ number_format($totalPrice, 2) }}</span>
        </div>
        <div class="d-flex justify-content-between fw-semibold">
            <span>(Rounded) Total Pay</span>
            <span>RM {{ number_format($totalPrice, 2) }}</span>
        </div>
    </div>
</div>
