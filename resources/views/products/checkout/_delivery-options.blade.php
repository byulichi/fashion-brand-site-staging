<div class="card" x-show="showDeliveryOptions">
    <div class="card-body">
        <div class="border p-3 mb-2 delivery-option" @click="deliveryMethod = 'pickup'"
            :class="{ 'bg-light': deliveryMethod === 'pickup' }">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="delivery_method" id="self-pickup"
                            value="pickup" x-model="deliveryMethod">
                        <label class="form-check-label fw-semibold" for="self-pickup">Self
                            Pickup</label>
                    </div>
                    <div>
                        <p class="mb-1">House of Fashion Clothing Store KL</p>
                        <p class="mb-1">260 Jalan Bunus, Jalan Palestin Off Jalan
                            Masjid
                            India,
                            50100 Kuala Lumpur</p><br>
                        <p class="text-muted" style="font-style: italic;">You will be
                            notified via email when your
                            order
                            is ready for self-collection. Kindly wait for this
                            notification
                            before coming to collect your order.</p>
                    </div>
                </div>
                <div class="ms-2 flex-shrink-0">
                    <span class="fw-semibold">RM 0.00</span>
                </div>
            </div>
        </div>

        <div class="border p-3 delivery-option" @click="deliveryMethod = 'shipping'"
            :class="{ 'bg-light': deliveryMethod === 'shipping' }">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="delivery_method" id="shipping"
                            value="shipping" x-model="deliveryMethod">
                        <label class="form-check-label fw-semibold" for="shipping">Shipping
                            Provider</label>
                    </div>
                    <div>
                        <p class="mb-0" x-text="delivery.state + ', Malaysia'"></p>
                    </div>
                </div>
                <div class="ms-2 flex-shrink-0">
                    <span class="fw-semibold">RM <span x-text="shippingPrice.toFixed(2)"></span></span>
                </div>
            </div>
        </div>
    </div>
</div>
