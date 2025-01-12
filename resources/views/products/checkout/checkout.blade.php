<x-app-layout>
    <x-slot name="header">
        @include('products.checkout._header')
    </x-slot>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" x-data="{
                    editingBilling: true,
                    editingDelivery: false,
                    showDeliveryOptions: false,
                    billing: { name: '{{ auth()->user()->name }}', address: '', city: '', state: '', postcode: '' },
                    delivery: { name: '', phone: '', street_address: '', city: '', postcode: '', state: '' },
                    deliveryMethod: 'shipping', // Default to shipping
                    shippingPrices: {{ json_encode($shippingPrices) }},
                    shippingPrice: 0,
                }" x-init="if (delivery.state) { shippingPrice = shippingPrices[delivery.state] || 0; }">
                    <h3 class="font-bold mb-5 text-center">Quick Checkout</h2>
                        <form id="shippingForm" action="{{ route('checkout') }}" method="POST">
                            @csrf
                            <div class="row mx-5 g-5 mb-5">
                                <div class="col-lg-6 ps-5">
                                    @include('products.checkout._contact-information')
                                    @include('products.checkout._billing-address')
                                    @include('products.checkout._delivery-address')
                                    @include('products.checkout._delivery-options')
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-dark w-100">Continue</button>
                                    </div>
                                </div>
                                <div class="col-lg-6 pe-5"
                                    style="overflow-y: auto; max-height: calc(100vh - /* Adjust header height here */ 100px);">
                                    <div class="sticky-cart">
                                        @include('products.checkout._cart-items')
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <style>
        .read-only-grey {
            background-color: #e9ecef;
            opacity: 1;
        }

        .sticky-cart {
            position: sticky;
            top: 0%;
        }
    </style>
</x-app-layout>
