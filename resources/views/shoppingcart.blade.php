<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    @include('layouts.navigation')
    <div class="container mt-5">
        <h1 class="mb-4">My Cart</h1>
        <p class="mb-4">Adding an item to your bag doesn't hold it, so get what you love before it's gone.</p>
        <div class="row">
            <div class="col-md-8">
                <!-- Product Description -->
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product Description</th>
                                            <th scope="col">Unit Price</th>
                                            <th scope="col">QTY.</th>
                                            <th scope="col">Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- First Product Row -->
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <img src="https://via.placeholder.com/100" alt="Product Image"
                                                        class="img-fluid me-3">
                                                    <div>
                                                        <h5 class="mb-1">THE DREAMSCAPE SHAWL DIAMOND</h5>
                                                        <p class="mb-0">SKU : S807<br>Color : DIM GREY</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>RM 159.00</td>
                                            <td>
                                                <div class="input-group" style="width: 120px;">
                                                    <button class="btn btn-outline-secondary" type="button">-</button>
                                                    <input type="text" class="form-control text-center"
                                                        value="2">
                                                    <button class="btn btn-outline-secondary" type="button">+</button>
                                                </div>
                                                <a href="#" class="text-danger mt-2 d-block text-center">Remove
                                                    &times;</a>
                                            </td>
                                            <td>RM 318.00</td>
                                        </tr>
                                        <!-- Second Product Row -->
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <img src="https://via.placeholder.com/100" alt="Product Image"
                                                        class="img-fluid me-3">
                                                    <div>
                                                        <h5 class="mb-1">ENFOLD LANYARD</h5>
                                                        <p class="mb-0">SKU : M320<br>Color : SILVER MIST</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>RM 89.00</td>
                                            <td>
                                                <div class="input-group" style="width: 120px;">
                                                    <button class="btn btn-outline-secondary" type="button">-</button>
                                                    <input type="text" class="form-control text-center"
                                                        value="1">
                                                    <button class="btn btn-outline-secondary" type="button">+</button>
                                                </div>
                                                <a href="#" class="text-danger mt-2 d-block text-center">Remove
                                                    &times;</a>
                                            </td>
                                            <td>RM 89.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Cart Summary -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Subtotal: (ex. Shipping)</h5>
                        <p class="card-text">RM 159.00</p>
                        <p class="card-text">You can choose your shipping option later in the checkout.</p>
                        <a href="#" class="btn btn-dark w-100 mb-2">LOGIN TO CHECKOUT</a>
                        <a href="#" class="btn btn-outline-dark w-100">GUEST CHECKOUT</a>
                        <div class="mt-3">
                            <img src="https://via.placeholder.com/100x30?text=Visa+Mastercard+FPX"
                                alt="Payment Methods">
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <h5>CUSTOMER SERVICE</h5>
                    <p>Need Help? Email us at <a href="mailto:arianicustomer@gmail.com">○○@gmail.com</a> if you need
                        further helps.</p>
                    <p>Call: +603-00000000</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
