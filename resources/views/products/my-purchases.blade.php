<x-app-layout>
    <div class="container my-5">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#all" data-toggle="tab">All</a>
            </li>
            {{-- <li class="nav-item">
                    <a class="nav-link" href="#to-receive" data-toggle="tab">To Receive</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#completed" data-toggle="tab">Completed</a>
                </li> --}}
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
                                // Decode the line_item_ids from JSON format to an array
                                $lineItems = json_decode($order->line_items, true);
                            @endphp

                            @if (!empty($lineItems))
                                @foreach ($lineItems as $item)
                                    @php
                                        // Fetch the item details using the item ID
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
                                            <div class="col-md-7 col-sm-12">
                                                <h5 class="mb-1">{{ $product->name }}</h5>
                                                <p class="text-muted">Variation: {{ $product->type->name ?? 'N/A' }}</p>
                                                <p class="text-muted">x{{ $item['quantity'] }}</p>
                                            </div>

                                            <!-- Item Price -->
                                            <div class="col-md-3 col-sm-12 text-end">
                                                <p class="text-danger mb-0">RM {{ number_format($product->price, 2) }}
                                                </p>
                                                {{-- <p class="text-muted text-decoration-line-through">RM {{ number_format($product->original_price, 2) }}</p> --}}
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
                                <!-- Empty Column or Additional Information Here if Needed -->
                            </div>

                            <!-- Order Total and Status Badge -->
                            <div class="col-md-6 col-sm-12 text-end">
                                <h5 class="d-inline">Order Total: <span class="text-danger">RM
                                        {{ number_format($order->total_price, 2) }}</span></h5>
                                <span
                                    class="badge {{ $order->status == 'paid' ? 'bg-info text-dark' : 'bg-danger' }} ms-2">
                                    {{ ucfirst($order->status) }}
                            </div>
                        </div>
                        <hr>
                    @endforeach

                    <!-- Rate and Return/Refund Buttons (Optional) -->
                    {{-- <div class="row">
                        <div class="col-12 text-end">
                            <button class="btn btn-primary">Rate</button>
                            <button class="btn btn-outline-secondary">Request For Return/Refund</button>
                        </div>
                    </div> --}}
                </div>

            </div>

            {{-- <!-- To Receive Tab -->
            <div class="tab-pane" id="to-receive">
                @foreach ($toReceive as $order)
                    <div class="order-item">
                        <img src="{{ asset($order->item->photo) }}" alt="Item image" width="100">
                        <p>{{ $order->item->name }}</p>
                        <p>RM {{ number_format($order->total_price, 2) }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Completed Tab -->
            <div class="tab-pane" id="completed">
                @foreach ($completed as $order)
                    <div class="order-item">
                        <img src="{{ asset($order->item->photo) }}" alt="Item image" width="100">
                        <p>{{ $order->item->name }}</p>
                        <p>RM {{ number_format($order->total_price, 2) }}</p>
                    </div>
                @endforeach
            </div> --}}
        </div>
    </div>

</x-app-layout>
