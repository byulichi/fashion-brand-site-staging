<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center">
                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                    style="width: 30px; height: 30px;">
                    3
                </div>
                <h2 class="fs-5 card-title mb-0">Delivery Address</h2>
            </div>
            <button @click="editingDelivery = !editingDelivery" type="button" class="btn btn-link text-primary">
                <i class="fas fa-edit" style="color: #212529"></i>
            </button>
        </div>
        <div x-show="!editingDelivery">
            <p class="mb-1" x-text="delivery.name"></p>
            <p class="mb-1" x-text="delivery.phone"></p>
            <p class="mb-1" x-text="delivery.street_address"></p>
            <p class="mb-1" x-text="delivery.city"></p>
            <p class="mb-0" x-text="delivery.postcode"></p>
            <p class="mb-0" x-text="delivery.state"></p>
        </div>
        <div x-show="editingDelivery">
            <div class="m-4">
                <form id="deliveryForm" @submit.prevent="editingDelivery = false; showDeliveryOptions = true">
                    <div class="mb-3">
                        <label for="delivery_name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="delivery_name"
                            value="{{ auth()->user()->name }}" required x-model="delivery.name">
                    </div>
                    <div class="mb-3">
                        <label for="delivery_contact_number" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="delivery_contact_number"
                            value="{{ auth()->user()->phone }}" required x-model="delivery.phone">
                    </div>
                    <div class="mb-3">
                        <label for="delivery_street_address" class="form-label">Street
                            Address:</label>
                        <input type="text" class="form-control" id="delivery_street_address" value=""
                            required x-model="delivery.street_address">
                    </div>
                    <div class="mb-3">
                        <label for="delivery_city" class="form-label">City:</label>
                        <input type="text" class="form-control" id="delivery_city" value="" required
                            x-model="delivery.city">
                    </div>
                    <div class="mb-3">
                        <label for="delivery_postcode" class="form-label">Postcode:</label>
                        <input type="text" class="form-control" id="delivery_postcode" value="" required
                            x-model="delivery.postcode">
                    </div>
                    <div class="mb-3">
                        <label for="delivery_state" class="form-label">State:</label>
                        <select class="form-control" id="delivery_state" required x-model="delivery.state"
                            @change="shippingPrice = shippingPrices[delivery.state] || 0">
                            <option value="" disabled selected>Select State
                            </option>
                            @foreach ($states as $state)
                                <option value="{{ $state }}">
                                    {{ $state }}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr><br>
                    <button type="submit" class="btn btn-primary w-100">Save &
                        Continue</button>
                </form>
            </div>
        </div>
    </div>
</div>
