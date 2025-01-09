<div class="modal fade" id="shippingModal" tabindex="-1" aria-labelledby="shippingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shippingModalLabel">Billing Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-4">
                <form id="shippingForm" action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="address">Address:</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="city">City:</label>
                        <input type="text" name="city" id="city" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="state">State:</label>
                        <input type="text" name="state" id="state" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="zip">ZIP Code:</label>
                        <input type="text" name="zip" id="zip" class="form-control" required>
                    </div>
                    <hr><br>
                    <button type="submit" class="btn btn-dark w-100">Proceed to payment</button>
                </form>
            </div>
        </div>
    </div>
</div>
