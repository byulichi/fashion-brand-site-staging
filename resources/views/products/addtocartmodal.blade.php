@if (Auth::check())
    <div class="modal fade" id="productModal{{ $item->id }}" tabindex="-1"
        aria-labelledby="productModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel{{ $item->id }}">Add to Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you want to add <strong>{{ $item->name }}</strong> to your cart?
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <form method="POST" action="{{ route('cart.add', $item->id) }}">
                            @csrf
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                            <input type="hidden" name="type" value="{{ request('type') }}">

                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Add to Cart
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <button type="submit" name="action" value="checkout"
                                        class="dropdown-item">Checkout</button>
                                </li>
                                <li>
                                    <button type="submit" name="action" value="continue"
                                        class="dropdown-item">Continue
                                        Shopping</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="authModalLabel">Sign In Required</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>You need to sign in to continue. Please log in or register to proceed.</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('login') }}" class="btn btn-primary">Log In</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endif
