<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center">
                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                    style="width: 30px; height: 30px;">
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
            <p class="mb-1" x-text="billing.address"></p>
            <p class="mb-1" x-text="billing.city"></p>
            <p class="mb-1" x-text="billing.state"></p>
            <p class="mb-0" x-text="billing.postcode"></p>
        </div>
        <div x-show="editingBilling">
            <div class="m-4">
                <form id="billingForm" @submit.prevent="editingBilling = false; editingDelivery = true">
                    <div class="mb-3">
                        <label for="billing_name" class="form-label">Name:</label>
                        <input type="text" name="billing_name" id="billing_name"
                            class="form-control read-only-grey" value="{{ auth()->user()->name }}" required
                            readonly x-model="billing.name">
                    </div>
                    <div class="mb-3">
                        <label for="billing_address" class="form-label">Address:</label>
                        <input type="text" name="billing_address" id="billing_address" class="form-control"
                            value="" required x-model="billing.address">
                    </div>
                    <div class="mb-3">
                        <label for="billing_city" class="form-label">City:</label>
                        <input type="text" name="billing_city" id="billing_city" class="form-control"
                            value="" required x-model="billing.city">
                    </div>
                    <div class="mb-3">
                        <label for="billing_state" class="form-label">State:</label>
                        <select name="billing_state" id="billing_state" class="form-control" required
                            x-model="billing.state">
                            <option value="" disabled selected>Select State
                            </option>
                            @foreach ($states as $state)
                                <option value="{{ $state }}">{{ $state }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="billing_postcode" class="form-label">Postcode:</label>
                        <input type="text" name="billing_postcode" id="billing_postcode" class="form-control"
                            value="" placeholder="eg. 43000" required x-model="billing.postcode">
                    </div>
                    <hr><br>
                    <button type="submit" class="btn btn-primary w-100">Save &
                        Continue</button>
                </form>
            </div>
        </div>
    </div>
</div>
