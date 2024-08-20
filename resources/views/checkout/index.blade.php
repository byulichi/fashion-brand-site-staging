<x-app-layout>
    <div class="container mt-5">
        <h1 class="mb-4">Checkout</h1>

        <form action="{{ route('checkout.process') }}" method="POST" id="payment-form">
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="card-element">Credit or debit card</label>
                <div id="card-element">
                    <!-- A Stripe Element will be inserted here. -->
                </div>
                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert"></div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit Payment</button>
        </form>

        <script src="https://js.stripe.com/v3/"></script>
        <script>
            var stripe = Stripe('{{ env("STRIPE_KEY") }}');
            var elements = stripe.elements();
            var card = elements.create('card');
            card.mount('#card-element');

            card.on('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        var hiddenInput = document.createElement('input');
                        hiddenInput.setAttribute('type', 'hidden');
                        hiddenInput.setAttribute('name', 'stripeToken');
                        hiddenInput.setAttribute('value', result.token.id);
                        form.appendChild(hiddenInput);
                        form.submit();
                    }
                });
            });
        </script>
        <style>

        </style>
    </div>
</x-app-layout>
