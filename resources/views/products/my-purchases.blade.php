<x-app-layout>
    <div class="container my-5">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#all" data-toggle="tab">All</a>
            </li>
        </ul>

        <div class="tab-content">
            <!-- All Orders Tab -->
            <div class="tab-pane active" id="all">
                <div class="container my-5">
                    <div class="row">
                        <div class="col-12">
                            <h3>Your Orders</h3>
                        </div>
                    </div>

                    @foreach ($orders as $order)
                        <div class="order-item py-3">
                            @php
                                $lineItems = json_decode($order->line_items, true);
                                $shippingAddress = json_decode($order->shipping_address, true);
                            @endphp

                            @if (!empty($lineItems))
                                @foreach ($lineItems as $item)
                                    @php
                                        $product = App\Models\Item::find($item['id']);
                                    @endphp

                                    @if ($product)
                                        <div class="row mb-3">
                                            <!-- Item Image -->
                                            <div class="col-md-2 col-sm-12">
                                                <img src="{{ asset($product->photo) }}" alt="Item image"
                                                    class="img-fluid"
                                                    style="width: 80px; height: 115px; object-fit: cover;">
                                            </div>

                                            <!-- Item Details -->
                                            <div class="col-md-4 col-sm-12">
                                                <h5 class="mb-1">{{ $product->name }}</h5>
                                                <p class="text-muted">Variation: {{ $product->type->name ?? 'N/A' }}</p>
                                                <p class="text-muted">x{{ $item['quantity'] }}</p>
                                            </div>

                                            <!-- Delivery Address -->
                                            <div class="col-md-3 col-sm-12">
                                                <h5 class="mb-1">Delivery Address:</h5>
                                                {{ $shippingAddress['address'] ?? 'N/A' }}
                                                {{ $shippingAddress['city'] ?? 'N/A' }}, {{ $shippingAddress['state'] ?? 'N/A' }} {{ $shippingAddress['zip'] ?? 'N/A' }}
                                            </div>

                                            <!-- Item Price -->
                                            <div class="col-md-3 col-sm-12 text-end">
                                                <p class="text-danger mb-0">RM {{ number_format($product->price, 2) }}
                                                </p>
                                            </div>
                                        </div>
                                    @else
                                        <p>Item details not available</p>
                                    @endif
                                @endforeach
                            @else
                                <p>No items in this order.</p>
                            @endif
                        </div>

                        <hr>

                        <!-- Order Status and Total Section -->
                        <div class="row py-3 mb-4 border-bottom">
                            <div class="col-md-6 col-sm-12">
                                <!-- Pay Button if Not Paid -->
                                @if ($order->status != 'paid')
                                    <form action="{{ route('order.pay', ['orderId' => $order->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Pay Now</button>
                                    </form>
                                @endif
                            </div>

                            <div class="col-md-6 col-sm-12 text-end">
                                <h5 class="d-inline">Order Total: <span class="text-danger">RM
                                        {{ number_format($order->total_price, 2) }}</span></h5>
                                <span
                                    class="badge {{ $order->status == 'paid' ? 'bg-info text-dark' : 'bg-danger' }} ms-2">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
