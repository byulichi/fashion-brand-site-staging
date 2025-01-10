<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" x-data="{ editingBilling: false, editingDelivery: false }">
                    <h3 class="font-bold mb-5 text-center">Quick Checkout</h2>

                    <div class="row mx-5 g-5">
                        <div class="col-lg-6 ps-5">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                                                1
                                            </div>
                                            <h2 class="fs-5 card-title mb-0">Contact Information</h2>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="mb-1">{{ auth()->user()->name }}</p>
                                        <p class="mb-1">{{ auth()->user()->email }}</p>
                                        <p class="mb-0">{{ auth()->user()->phone }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                                                2
                                            </div>
                                            <h2 class="fs-5 card-title mb-0">Billing Address</h2>
                                        </div>
                                        <button @click="editingBilling = !editingBilling" type="button" class="btn btn-link text-primary">
                                            <i class="fas fa-edit" style="color: #212529"></i>
                                        </button>
                                    </div>
                                    <div x-show="!editingBilling">
                                        <p class="mb-1">{{ auth()->user()->name }}</p>
                                        <p class="mb-1"></p>
                                        <p class="mb-1"></p>
                                        <p class="mb-1">Selangor</p>
                                        <p class="mb-0">Malaysia</p>
                                    </div>
                                    <div x-show="editingBilling">
                                        <div class="mb-3">
                                            <label for="billing_name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="billing_name" value="{{ auth()->user()->name }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="billing_country" class="form-label">Country *</label>
                                            <input type="text" class="form-control" id="billing_country" value="Malaysia">
                                        </div>
                                        <div class="mb-3">
                                            <label for="billing_state" class="form-label">State *</label>
                                            <input type="text" class="form-control" id="billing_state" value="Selangor">
                                        </div>
                                        <div class="mb-3">
                                            <label for="billing_street_address" class="form-label">Street Address *</label>
                                            <input type="text" class="form-control" id="billing_street_address" value="a">
                                        </div>
                                        <div class="mb-3">
                                            <label for="billing_city" class="form-label">City *</label>
                                            <input type="text" class="form-control" id="billing_city" value="a">
                                        </div>
                                        <div class="mb-3">
                                            <label for="billing_postcode" class="form-label">Postcode *</label>
                                            <input type="text" class="form-control" id="billing_postcode" value="43000">
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <button @click="editingBilling = false" type="button" class="btn btn-secondary">Cancel</button>
                                            <button type="button" class="btn btn-primary">Save & Continue</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                                                3
                                            </div>
                                            <h2 class="fs-5 card-title mb-0">Delivery Address</h2>
                                        </div>
                                        <button @click="editingDelivery = !editingDelivery" type="button" class="btn btn-link text-primary">
                                            <i class="fas fa-edit" style="color: #212529"></i>
                                        </button>
                                    </div>
                                    <div x-show="!editingDelivery">
                                        <p class="mb-1">{{ auth()->user()->name }}</p>
                                        <p class="mb-1">{{ auth()->user()->phone }}</p>
                                        <p class="mb-1"></p>
                                        <p class="mb-1"></p>
                                        <p class="mb-0"></p>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div x-show="editingDelivery">
                                        <div class="mb-3">
                                            <label for="delivery_name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="delivery_name" value="{{ auth()->user()->name }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="delivery_phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control" id="delivery_phone" value="{{ auth()->user()->phone }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="delivery_street_address" class="form-label">Street Address *</label>
                                            <input type="text" class="form-control" id="delivery_street_address" value="a">
                                        </div>
                                        <div class="mb-3">
                                            <label for="delivery_city" class="form-label">City *</label>
                                            <input type="text" class="form-control" id="delivery_city" value="a">
                                        </div>
                                        <div class="mb-3">
                                            <label for="delivery_postcode" class="form-label">Postcode *</label>
                                            <input type="text" class="form-control" id="delivery_postcode" value="a">
                                        </div>
                                        <div class="mb-3">
                                            <label for="delivery_state" class="form-label">State *</label>
                                            <input type="text" class="form-control" id="delivery_state" value="a">
                                        </div>
                                        <div class="mb-3">
                                            <label for="delivery_country" class="form-label">Country *</label>
                                            <input type="text" class="form-control" id="delivery_country" value="a">
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <button @click="editingDelivery = false" type="button" class="btn btn-secondary">Cancel</button>
                                            <button type="button" class="btn btn-primary">Save & Continue</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label for="self-pickup" class="form-label fw-semibold mb-0">Self Pickup</label>
                                        <div class="d-flex align-items-center">
                                            <span class="fw-semibold me-2">RM 0.00</span>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="delivery_method" id="self-pickup">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 pe-5">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="fs-5 card-title mb-3">Cart Items</h2>
                                    @if($cartItems->isNotEmpty())
                                        @foreach($cartItems as $item)
                                            @php
                                                $product = is_array($item) ? (object)$item : $item->item;
                                                $quantity = is_array($item) ? $item['quantity'] : $item->quantity;
                                                $unitPrice = is_array($item) ? $item['price'] : $item->item->price;
                                            @endphp
                                            <div class="d-flex align-items-center mb-3">
                                                <div>
                                                    @if($product->image_url)
                                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="rounded" width="64" height="64" style="object-fit: cover;">
                                                    @else
                                                        <div class="bg-secondary rounded d-flex align-items-center justify-content-center" width="64" height="64">
                                                            <span>No Image</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ms-3">
                                                    <h3 class="fs-6 fw-semibold mb-1">{{ $product->name }}</h3>
                                                    <p class="text-muted mb-1 small">Color: {{ $product->color ?? 'N/A' }}</p>
                                                    <p class="text-muted mb-1 small">Qty: {{ $quantity }}</p>
                                                    <p class="text-muted small">Unit Price: RM {{ number_format($unitPrice, 2) }}</p>
                                                </div>
                                                <div class="ms-auto fw-semibold">RM {{ number_format($unitPrice * $quantity, 2) }}</div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
