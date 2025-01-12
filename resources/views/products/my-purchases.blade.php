<x-app-layout>
    <div class="container-xxl my-5">
        @if (session('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
            </div>
        @endif

        <h2 class="mb-4">Purchase History</h2>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#all" data-toggle="tab">All Orders</a>
            </li>
        </ul>

        <div class="tab-content">
            <!-- All Orders Tab -->
            <div class="tab-pane active" id="all">
                @foreach ($orders as $order)
                    <div class="order-container">
                        <div class="order-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    Ordered on {{ $order->created_at->format('F j, Y \a\t h:i A') }}
                                </h5>
                                <span class="order-status {{ $order->status == 'paid' ? 'bg-accent' : 'bg-warning' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="order-content">
                            @php
                                $lineItems = json_decode($order->line_items, true);
                                $billingDetails = json_decode($order->billing_details, true); // Changed to billingDetails
                            @endphp

                            @if (!empty($lineItems))
                                @foreach ($lineItems as $item)
                                    @php
                                        $product = App\Models\Item::find($item['id']);
                                    @endphp

                                    @if ($product)
                                        <div class="item-details">
                                            <!-- Item Image -->
                                            <div class="col-md-2 col-sm-12">
                                                <img src="{{ asset($product->photo) }}" alt="Item image"
                                                    class="img-fluid"
                                                    style="width: 80px; height: 115px; object-fit: cover;">
                                            </div>

                                            <!-- Item Details -->
                                            <div class="col-md-3 col-sm-12">
                                                <h5 class="mb-1">{{ $product->name }}</h5>
                                                <p class="text-muted">Variation: {{ $product->type->name ?? 'N/A' }}</p>
                                                <p class="text-muted">x{{ $item['quantity'] }}</p>
                                            </div>

                                            <!-- Delivery Address -->
                                            <div class="col-md-4 col-sm-12">
                                                <h5 class="mb-1">Delivery To:</h5>
                                                <p class="mb-0">{{ $order->delivery_name ?? 'N/A' }}</p>
                                                <p class="mb-0">{{ $order->delivery_phone ?? 'N/A' }}</p>
                                                <p class="mb-0">{{ $order->delivery_address ?? 'N/A' }}</p>
                                                <p class="mb-0">{{ $order->delivery_city ?? 'N/A' }}, {{ $order->delivery_state ?? 'N/A' }} {{ $order->delivery_postcode ?? 'N/A' }}</p>
                                                <p class="mb-0">Method: {{ ucfirst($order->delivery_method) ?? 'N/A' }}</p>
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
                        <div class="row py-3 mb-2">
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

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
<style>
    .order-container {
        background-color: var(--background-color);
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
        overflow: hidden;
        border: none;
        transition: all 0.3s ease;
    }

    .order-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .order-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #eee;
        padding: 1rem 1.5rem;
        border-radius: 10px 10px 0 0;
    }

    .order-content {
        padding: 1.5rem;
        width: 100%;
        /* Add this to ensure full width */
    }

    .order-item {
        border: 1px solid #ced4da;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        padding: 1.5rem;
        background-color: white;
        transition: all 0.3s ease;
    }

    .order-item:hover {
        box-shadow: 0 4px 8px rgba(159, 122, 234, 0.1);
        transform: translateY(-2px);
    }

    .product-image {
        border-radius: 8px;
        overflow: hidden;
    }

    .order-status {
        font-weight: 500;
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
    }

    .order-total {
        font-size: 1.1rem;
        color: var(--primary-color);
    }

    .btn-pay {
        background-color: var(--accent-color);
        color: white;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 5px;
        transition: all 0.2s ease;
    }

    .btn-pay:hover {
        background-color: darken(var(--accent-color), 10%);
        transform: translateY(-1px);
    }

    .shipping-info {
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 8px;
        margin-top: 1rem;
    }

    .item-details {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        width: 100%;
        padding-right: 1rem;
    }

    .item-price {
        font-weight: 600;
        color: var(--accent-color);
    }

    .text-end {
        text-align: right;
        padding-right: 4rem;
        min-width: 120px;
    }

    .bg-accent {
        background-color: var(--accent-color) !important;
        color: white;
    }

    .order-status {
        font-weight: 500;
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.875rem;
    }
</style>
